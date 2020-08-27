
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="profile-info-inner">
                            <div class="profile-img">
                                <!-- <img src="<?php //echo base_url(); ?>assets/img/profile/1.jpg" alt=""  style="height:300px;" /> -->
                                <div class="container">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    <?php $count = 0;  foreach($productimg as $rowimg){ ?>      
      <div class="item <?= $count==0?'active':'non'?>">
      <img src="<?php echo base_url().$rowimg['ai_img'];?>" class="img-responsive" alt="Los Angeles" style="width:100%;height:250px;">
      </div>
      <?php  $count++; }   ?>
     

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
                            </div>
                            <div class="profile-details-hr">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Product Name</b><br /> <?php if (isset($row['a_name'])) echo $row['a_name'] ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Amount</b><br /> <?php if (isset($row['a_amount'])) echo $row['a_amount'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>Total Amount</b><br /> <?php if (isset($row['a_total_amount'])) echo strtoupper($row['a_total_amount']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Start Date</b><br /><?php if (isset($row['a_start_date'])) echo $row['a_start_date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>End Date</b><br /><?php if (isset($row['a_end_date'])) echo $row['a_end_date'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>

                   
 