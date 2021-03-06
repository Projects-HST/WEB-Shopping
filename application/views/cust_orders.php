<!-- Page Breadcrumb Start -->
        <div class="sub-breadcrumb" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url(); ?>assets/category/default_banner.png) no-repeat scroll center center / cover;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center ptb-70" >
                            <h1>My Account</h1>
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="<?php echo base_url(); ?>">home</a></li>
                                <li>Orders</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Breadcrumb End -->
		
		
        <!-- My Account Page Start Here -->
        <div class="my-account white-bg pb-100">
            <div class="container-fluid">
                <div class="account-dashboard">
                   <div class="dashboard-upper-info">
                       <div class="row no-gutters align-items-center">
                           <div class="col-lg-3 col-md-3 col-sm-6">
                               <div class="d-single-info">
                                   <p class="user-name">Hello <span><?php echo $this->session->userdata('cust_email')?></span></p>
                                   <p>(not yourmail@info? <a href="<?php echo base_url(); ?>logout/">Log Out</a>)</p>
                               </div>
                           </div>
                           <div class="col-lg-4 col-md-3 col-sm-6">
                               <div class="d-single-info">
                                   <p>Need Assistance? Customer service at.</p>
                                   <p>admin@example.com.</p>
                               </div>
                           </div>
                           <div class="col-lg-2 col-md-3 col-sm-6">
                               <div class="d-single-info">
                                   <p>E-mail them at </p>
                                   <p>support@example.com</p>
                               </div>
                           </div>
                           <div class="col-lg-3 col-md-2 col-sm-6">
                               <div class="d-single-info text-center">
                                   <?php
                               if (count($count_cart_session) >0) { ?>
                                   <a class="view-cart" href="<?php echo base_url(); ?>viewcart/"><i class="fa fa-cart-plus" aria-hidden="true"></i>view cart</a>
                                   <?php } ?>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <!-- Nav tabs -->
                            <ul class="nav flex-column dashboard-list" role="tablist">
                                <li><a href="<?php echo base_url(); ?>myaccount/">Dashboard</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>cust_orders/">Orders</a></li>
								<li><a href="<?php echo base_url(); ?>cust_wallet/">Wallet</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_address/">Addresses</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_details/">Account Details</a></li>
                                <li><a href="<?php echo base_url(); ?>cust_change_password/">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                            </ul>
                        </div>
                        
                        
                        <div class="col-lg-10 col-md-10">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content mt-all-40">
                                
                                <div id="orders" class="tab-pane fade in active">
                                    <h3>Orders</h3>
                                    <div class="table-responsive">
                        <?php
                        if (count($orders)>0){
						?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
													<th>Paid</th>
                                                    <th>Actions</th>	 	 	 	
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($orders as $order){ 
											$purchase_order_id = $order->id;
											$order_id = $order->order_id;
											$purchase_date = $order->purchase_date;
											$dispDate = date("d M Y", strtotime($purchase_date));
											$status = $order->status;
											$total_amount = $order->total_amount;
											$paid_amount = $order->paid_amount;
											$id=base64_encode($purchase_order_id);
											$return_status = $order->return_status;
											?>
                                                <tr>
                                                    <td><?php echo $order_id;?></td>
                                                    <td><?php echo $dispDate; ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td>₹<?php echo $total_amount;?></td>
													 <td>₹<?php echo $paid_amount;?></td>
                                                    <td><a class="view" href="<?php echo base_url(); ?>home/cust_order_details/<?php echo $id;?>/">View</a>&nbsp; <?php if ($return_status =='0') { ?><a class="view" href="<?php echo base_url(); ?>home/order_return_request/<?php echo $id;?>/">Return</a><?php } else { ?> <a class="view" href="#">Return Requested</a> <?php } ?></td>
                                                </tr>
                                           <?php } ?>
                                            </tbody>
                                        </table>
                               <?php } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account Page End Here -->
