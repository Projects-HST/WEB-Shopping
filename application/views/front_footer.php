        <!-- Footer Start -->
        <footer>
           <!-- Footer Middle Start -->
            <div class="footer-middle">
                <div class="container-fluid">
                    <div class="container-footer ptb-50">
                         <div class="row">
                            <!-- Single Footer Start -->
                            <div class="single-footer col-md-3 col-sm-6">
                                <div class="footer-logo">
                                    <a href="#"><img class="img" src="<?php echo base_url(); ?>assets/front/img/logo/logo.png" alt="logo-img"></a>
                                </div>
                                <div class="footer-content">
                                    <p>We are a team of designers and developers that create high quality HTML, Magento, Prestashop, Opencart.</p>
                                    
                                </div>
                            </div>
                            <!-- Single Footer Start -->
                            <!-- Single Footer Start -->
                            <div class="single-footer col-md-3 col-sm-6 pl-50">
                                <h4 class="footer-title">information</h4>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                    	<li><a href="<?php echo base_url(); ?>aboutus/">about Us</a></li>
                                        <li><a href="<?php echo base_url(); ?>contactus/">Contact Us</a></li>
                                        <li><a href="<?php echo base_url(); ?>offers/">Offer Zone</a></li>
										<li><a href="#">FAQ</a></li>
										<li><a href="#">warranty</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Single Footer Start -->
                            <!-- Single Footer Start -->
                            <div class="single-footer col-md-3 col-sm-6">
                                <h4 class="footer-title"></h4>
                                <div class="footer-content">
                                    <ul class="footer-list">
                                    	<li><a href="#">delivery information</a></li>
                                        <li><a href="<?php echo base_url(); ?>privacy/">privacy policy</a></li>
                                        <li><a href="#">terms & conditions</a></li>
                                        
                                        <li><a href="#">returns</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Single Footer Start -->
                            <!-- Single Footer Start -->
                            <div class="single-footer col-md-3 col-sm-6">
                                <h4 class="footer-title">Contact Info</h4>
								<div class="footer-content">
                                 <ul class="footer-list first-content">
                                        <li><i class="pe-7s-map-marker"></i>Address will be here</li>
                                        <li><i class="pe-7s-mail"></i>your-email@example.com</li>
                                        <li><i class="pe-7s-call"></i>+00 123 45678</li>
                                    </ul>
								</div>
                            </div>
                            <!-- Single Footer Start -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Container Footer End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Footer Middle End -->
            <!-- Footer Bottom Start -->
            <div class="footer-bottom">
                <div class="container-fluid">
                    <div class="container-footer ptb-30">
                        <div class="row">
                            <div class="col-sm-7">
                                <p class="text-left copyright-text">Copyright ©  <a target="_blank" href="#">Little A More</a> All Rights Reserved.</p>
                            </div>
                            <div class="col-sm-5">
                                <!-- Footer Social List Start -->
                                <div class="socila-footer">
                                    <ul class="social-footer-list list-inline text-right">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Footer Social List End -->
                            </div>
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Container Footer End -->
                </div>
                 <!-- Container End -->
            </div>
            <!-- Footer Bottom End -->
        </footer>
        <!-- Footer End -->
 
    </div>
      <!-- Wrapper End -->

    <!-- mobile menu js  -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.meanmenu.min.js"></script>
    <!-- scroll-up js -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.scrollUp.js"></script>
    <!-- owl-carousel js -->
    <script src="<?php echo base_url(); ?>assets/front/js/owl.carousel.min.js"></script>
    <!-- wow js -->
    <script src="<?php echo base_url(); ?>assets/front/js/wow.min.js"></script>
    <!-- elevateZoom js -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.elevateZoom-3.0.8.min.js"></script>
    <!-- nivo slider js -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.nivo.slider.js"></script>
    <!-- bootstrap -->
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <!-- plugins -->
    <script src="<?php echo base_url(); ?>assets/front/js/plugins.js"></script>
    <!-- main js -->
    <script src="<?php echo base_url(); ?>assets/front/js/main.js"></script>


<script>

	$( function() {
		var availableTags = [<?php
		 $tot_count = count($tag_result);
		 $i = 1;
			foreach($tag_result as $res){
			echo "'";
			echo $str = addslashes($res->tag_name);
			echo "'";
			if ($i < $tot_count) echo ",";
			 $i = $i+1;} ?>];
		 
    $("#search_tags").autocomplete({
		source: availableTags,
		select: function(lamore, ui) {
			$("#search_tags").val(ui.item.value);
   		}
	});

	$("#search_tags1").autocomplete({
		source: availableTags,
		select: function(lamore, ui) {
			$("#search_tags1").val(ui.item.value);
   		}
	});
	
	
  });

 </script>

     </body>
</html>