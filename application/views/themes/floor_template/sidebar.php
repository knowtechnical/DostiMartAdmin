<div class="wrapper">
    <!-- BEGIN LEFTSIDE -->
    <div class="leftside" style="color:red">
        <div class="sidebar">
            <!-- BEGIN RPOFILE -->
            <div class="nav-profile">
                <div class="thumb">
                    <img src="<?php echo base_url(); ?>assets/production/img/avatar.jpg" class="img-circle" alt="" />
                    <span class="label label-danger label-rounded">3</span>
                </div>
                <?php $id = $_SESSION['contact_name']; ?>
                <div class="info">

                    <a><?php if (isset($_SESSION['contact_name'])) echo $_SESSION['contact_name'] ?></a>
                    <!--                    <ul class="tools list-inline">
                                            <li><a href="#" data-toggle="tooltip" title="Settings"><i class="ion-gear-a"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" title="Events"><i class="ion-earth"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" title="Downloads"><i class="ion-archive"></i></a></li>
                                        </ul>-->
                </div>
                <a href="<?php echo site_url() ?>/login" class="button" title="Log Out"><i class="ion-log-out"></i></a>
            </div>
            <!-- END RPOFILE -->
            <!-- BEGIN NAV -->
            <div class="title">Navigation</div>
            <ul class="nav-sidebar">

                <?php
                if (isset($_SESSION['role_type'])) {

                    if ((($_SESSION['role_type']) == "C")) {
                        ?>
                        <!--                 <li><a href="http://localhost/sahweb/indexmap.php">Order Place</a></li>-->
                                         <!--						<li><a href="<?php echo site_url(); ?>/viewcustomer">Register Customer</a></li>-->
 <li><a href="<?php echo site_url(); ?>/customer_orders_count">DashBoard</a></li>
                        <li>   <a href="<?php echo site_url() ?>/updatecustomerprofile/<?php echo $_SESSION['id']; ?>">View Profile</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewchaforcustomer">Register CHA</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewordercustomer">Orders</a></li>
                        <li><a href="<?php echo site_url(); ?>/vieworderwithvehicle">Vehicle Assign Orders</a></li>
                        <li><a href="http://localhost/sahweb/indexmap.php">Track Order</a></li>

                        <!--    <li><a href="<?php echo site_url(); ?>/viewot">Register Operation Team</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvendor">Register Vendor</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewdriverdetailsadmin">Register Driver</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewcha">Register CHA</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvehicledetailsadmin">Vehicle</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewaddvehicletype">Vehicle Type</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewport">Port</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewyard">Yard</a></li>
                        <li><a href="<?php echo site_url(); ?>/vieworders">Orders</a></li>
                        <li><a href="<?php echo site_url(); ?>/marker">MAP</a></li>  -->

                    <?php } elseif (($_SESSION['role_type']) == "V") {
                        ?>

                        <!--     <li><a href="<?php echo site_url(); ?>/viewcustomer">Register Customer</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewot">Register Operation Team</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvendor">Register Vendor</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewcha">Register CHA</a></li>
                                         <li><a href="<?php echo site_url(); ?>/viewport">Port</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewyard">Yard</a></li>
                                         <li><a href="<?php echo site_url(); ?>/marker">MAP</a></li>  -->
                        
                        <li><a href="<?php echo site_url(); ?>/vendor_vehicle_count">DashBoard</a></li>
                        <li><a href="<?php echo site_url(); ?>/updatevendorprofile/<?php echo $_SESSION['id']; ?>">Vendor Profile</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewdriverdetailsadmin">Register Driver</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvehicledetailsadmin">Register Vehicle</a></li>

                        <li><a href="<?php echo site_url(); ?>/viewordervendor">Orders</a></li>

                    <?php } elseif (($_SESSION['role_type']) == "A") {
                        ?>

                            <li><a href="<?php echo site_url(); ?>/admin_count">DashBoard</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewot">Register Operation Team</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewcustomerforadmin">View Customer</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvendorforadmin">View Vendor</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewchaforadmin">Register CHA</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewaddvehicletype">Vehicle Type</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewdriverforadmin">View Driver</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvehicleforadmin">View Vehicle</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewport">Port</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewyard">Yard</a></li>
        <!--                        <li><a href="<?php echo site_url(); ?>/marker">MAP TEST</a></li> -->



                        <li><a href="<?php echo site_url(); ?>/vieworderforadmin">Orders</a></li>





                    <?php } elseif (($_SESSION['role_type']) == "O") {
                        ?>
                         <li><a href="<?php echo site_url(); ?>/ot_orders_count">DashBoard</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewcustomer">Register Customer</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvendor">Register Vendor</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewdriverdetailsadmin">Register Driver</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewcha">Register CHA</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewvehicledetailsadmin">Vehicle</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewaddvehicletype">Vehicle Type</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewport">Port</a></li>
                        <li><a href="<?php echo site_url(); ?>/viewyard">Yard</a></li>
                        <li><a href="<?php echo site_url(); ?>/vieworders">Orders</a></li>
        <!--                        <li><a href="<?php echo site_url(); ?>/marker">MAP TEST</a></li>-->
                        <?php
                    }
                }
                ?>

            </ul>
            <!-- END NAV -->


        </div><!-- /.sidebar -->
    </div>
    <!-- END LEFTSIDE -->


</div><!-- /.wrapper -->
<!-- END CONTENT -->

<!-- BEGIN JAVASCRIPTS -->

<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url(); ?>assets/production/plugins/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/production/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/production/plugins/bootstrap/js/holder.js"></script>
<script src="<?php echo base_url(); ?>assets/production/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/production/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/production/js/core.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- flot chart -->


<!-- sparkline -->
<script src="<?php echo base_url(); ?>assets/production/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

<!-- bootstrap slider -->
<script src="<?php echo base_url(); ?>assets/production/plugins/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>

<!-- datepicker -->
<!--<script src="<?php echo base_url(); ?>assets/production/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/production/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>-->



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- vectormap -->
<script src="<?php echo base_url(); ?>assets/production/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/production/plugins/jquery-jvectormap/jquery-jvectormap-europe-merc-en.js" type="text/javascript"></script>

<!-- counter -->
<script src="<?php echo base_url(); ?>assets/production/plugins/jquery-countTo/jquery.countTo.js" type="text/javascript"></script>

<!-- rickshaw -->
<script src="<?php echo base_url(); ?>assets/production/plugins/rickshaw/vendor/d3.v3.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/production/plugins/rickshaw/rickshaw.min.js" type="text/javascript"></script>

