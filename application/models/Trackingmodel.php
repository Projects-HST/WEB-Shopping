<?php
Class Trackingmodel extends CI_Model
{
  public function __construct()
  {
      parent::__construct();
      	$this->load->model('smsmodel');
        $this->load->model('mailmodel');
		$this->load->model('notificationmodel');
  }

   function get_all_recent_orders(){
     $select="SELECT po.*,c.id,c.name FROM  purchase_order AS po left join customers as c on c.id=po.cus_id WHERE po.status!='Pending' ORDER BY  po.id  DESC";
     $res=$this->db->query($select);
     return $res->result();
   }

   function get_all_success_orders(){
     $select="SELECT po.*,c.id,c.name FROM  purchase_order AS po left join customers as c on c.id=po.cus_id WHERE po.status='Success' ORDER BY  po.purchase_date  DESC LIMIT 10";
     $res=$this->db->query($select);
     return $res->result();
   }

function get_success_orders_graph(){
     $select="SELECT
				DATE_FORMAT(purchase_date, '%b-%Y') AS month_year,
				MONTH(purchase_date) AS month_name,
				YEAR(purchase_date) AS year_name,
				IFNULL(SUM(`total_amount`),'0') AS total_sales
			FROM
				purchase_order WHERE status = 'Success'
			GROUP BY
				YEAR(purchase_date),MONTH(purchase_date)
			ORDER BY
				YEAR(purchase_date)DESC , MONTH(purchase_date) DESC
			LIMIT 12";
     $res=$this->db->query($select);
     return $res->result();
   }
   


   function get_all_orders(){
     $select="SELECT po.*,c.id,c.name FROM  purchase_order AS po left join customers as c on c.id=po.cus_id ORDER BY  po.id  DESC";
     $res=$this->db->query($select);
     return $res->result();
   }

   function get_status_msg($status_name){
    $select="SELECT * FROM order_msg_master WHERE status_name='$status_name' AND status='Active'";
    $res=$this->db->query($select);
    return $res->result();
   }

   function check_orders($order_id){
    $id=base64_decode($order_id);
	$select="SELECT
				ca.*,
				c.*,
				pc.*,
				pur.cus_address_id,
				pur.purchase_date,
				pur.promo_amount,
				pur.wallet_amount,
				pur.total_amount AS pur_total_amount,
				pur.paid_amount,
				pur.payment_status,
				p.product_name,
				am.attribute_value,
				am.attribute_name,
				ams.attribute_value AS size,
				comb.id
			FROM
				product_cart AS pc
			LEFT JOIN products AS p
			ON
				p.id = pc.product_id
			LEFT JOIN product_combined AS comb
			ON
				comb.id = pc.product_combined_id
			LEFT JOIN attribute_masters AS am
			ON
				am.id = comb.mas_color_id
			LEFT JOIN attribute_masters AS ams
			ON
				ams.id = comb.mas_size_id
			LEFT JOIN purchase_order AS pur
			ON
				pur.order_id = pc.order_id
			LEFT JOIN customers AS c
			ON
				pur.cus_id = c.id
			LEFT JOIN cus_address AS ca
			ON
				ca.id = pur.cus_address_id
			WHERE
				pur.order_id = '$id'";
     $res=$this->db->query($select);
	 return $res->result();
   }



   function get_update_status($current_order_status,$order_id,$order_status,$msg_to_customer,$user_id){
     $update="UPDATE purchase_order SET status='$order_status' WHERE order_id='$order_id'";
     $res=$this->db->query($update);

     $update_cart="UPDATE product_cart SET status='$order_status' WHERE order_id='$order_id'";
     $res_cart=$this->db->query($update_cart);

     $select="SELECT ca.* FROM purchase_order AS po LEFT JOIN customers AS c ON po.cus_id=c.id LEFT JOIN cus_address AS ca ON ca.id=po.cus_address_id WHERE po.order_id='$order_id'";
     $res_select=$this->db->query($select);
     $result=$res_select->result();
     foreach($result as $rows_val){
		 $phone= $rows_val->mobile_number;
		 $email= $rows_val->email_address;
		 $cus_id= $rows_val->cus_id;
	 }

	 $subject='OSASPP - Order Tracking';
	 $order_message = ''.$msg_to_customer.' Track Your order '.$order_id.'';
	 $track_message = utf8_encode($order_message);
	 
			
	if ($email !=''){
		$this->mailmodel->sendMail($email,$subject,$track_message);
	}

	if ($phone !=''){
		$this->smsmodel->sendSMS($phone,$track_message);
	}
		
	$check_notifi_status = "SELECT * FROM customer_details WHERE customer_id = '$cus_id' AND notification_status = 'Y'";
	$res=$this->db->query($check_notifi_status);
	if($res->num_rows()>0){
		$check_gcm = "SELECT * FROM cus_notification_master WHERE cus_id = '$cus_id'";
		$res_gcm=$this->db->query($check_gcm);

		if($res_gcm->num_rows()>0){
			foreach($res_gcm->result() as $rows) {
				$mob_key = $rows->mob_key;
				$mobile_type = $rows->mobile_type;
			}
			$this->notificationmodel->sendNotification($subject,$track_message,$mob_key,$mobile_type);
		}
	}
	
	$insert="INSERT order_history (order_id,sent_msg,old_status,status,updated_at,updated_by) VALUES('$order_id','$msg_to_customer','$current_order_status','$order_status',NOW(),'$user_id')";
     $res_ins=$this->db->query($insert);
     if($res_ins){
		echo "success";
     }else{
        echo "Something Went wrong";
     }
   }
   
     function return_request(){
		 $select="SELECT
					rt.id,
					c.name,
					po.order_id,
					po.purchase_date,
					po.total_amount,
					po.paid_amount,
					po.status,
					rm.question,
					rt.answer_text
				FROM
					return_item_feedback AS rt
				LEFT JOIN customers AS c
				ON
					rt.customer_id = c.id
				LEFT JOIN purchase_order AS po
				ON
					rt.purchase_order_id = po.id
				LEFT JOIN return_reason_master AS rm
				ON
					rt.question_id = rm.id
				ORDER BY
					rt.id";
		 $res=$this->db->query($select);
		 return $res->result();
   }
   
}
