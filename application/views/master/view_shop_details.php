
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/add-multiselct-dropdown-bootstrap.min">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<style>
.multiselect dropdown-toggle  {
  width: 400px !important;
}

.checkbox dropdown-toggle  {
  width: 400px !important;
}


.chip {
  display: inline-block;
  padding: 0 25px;
  height: 50px;
  font-size: 18px;
  line-height: 50px;
  border-radius: 25px;
  background-color: #f1f1f1;
}

.chip img {
  float: left;
  margin: 0 10px 0 -25px;
  height: 50px;
  width: 50px;
  border-radius: 50%;
}

.closebtn {
  padding-left: 10px;
  color: #888;
  font-weight: bold;
  float: right;
  font-size: 20px;
  cursor: pointer;
}

.closebtn:hover {
  color: #000;
}
/* .buttonwidth{
     width: 400px !important;
} */
</style>
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
    
      <div class="item active">
      <img src="<?php echo base_url().$row['s_image'];?>" class="img-responsive" alt="Los Angeles" style="width:100%;height:250px;">
      </div>    

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
                                            <p><b>Shop Name</b><br /> <?php if (isset($row['s_name'])) echo $row['s_name'] ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                        <?php foreach($allcategory as $allcategorydata){ ?>
                                        <div class="chip" id="delete<?= $allcategorydata['sc_id'];?>">
                                        <?= $allcategorydata['c_name'];?>
                                        </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Phone Number</b><br /> <?php if (isset($row['s_number'])) echo $row['s_number'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>Address</b><br /> <?php if (isset($row['s_address'])) echo strtoupper($row['s_address']); ?></p>
                                        </div>
                                    </div>
                                </div>
                             <div class="row">
                                    <div class="col-lg-12">
                                        <div class="address-hr">
                                            <p><b>Description</b><br /> <?php if (isset($row['s_description'])) echo $row['s_description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <h3>500</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <h3>900</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <h3>600</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   
 