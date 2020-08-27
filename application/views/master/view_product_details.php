
<?php
// echo "<pre>";
// print_r($productimg);
// $xyz = array();
// foreach($productimg as $abc){
// $xyz[] = $abc;
// }
// print_r($xyz);
?>
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
      <img src="<?php echo base_url().$rowimg['product_img'];?>" class="img-responsive" alt="Los Angeles" style="width:100%;height:250px;">
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
<br>
<div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"> 
            <label class="login2 pull-right pull-right-pro" >Weight Range(<?=$row['weight_unit']?>) </label>     
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
             <?php $i=0; foreach($range as $item){ ?>
                    <span style="font-size:20px;" class = "weight_range_box" id="weight_range_box<?=$i ?>">
                            <?= $item['range']; ?>   
                    </span>
                   
                <?php $i++; } ?>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="p_thumbnail">Total Weight (In stock)</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <?=$row['total_weight']?>
             </div>

        </div>
</div>

        <div class="profile-details-hr">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                    <div class="address-hr">
                        <p><b>Product Name</b><br /> <?php if (isset($row['p_name'])) echo $row['p_name'] ?></p>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                    <div class="address-hr">
                        <p><b>Amount</b><br /> <?php if (isset($row['p_amount'])) echo $row['p_amount'] ?></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                        <p><b>Quantity</b><br /> <?php if (isset($row['p_quantity'])) echo strtoupper($row['p_quantity']); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                    <div class="address-hr">
                        <p><b>Category</b><br /><?php if (isset($row['c_name'])) echo $row['c_name'] ?></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                        <p><b>Brand</b><br /><?php if (isset($row['b_name'])) echo $row['b_name'] ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="address-hr">
                        <p><b>Description</b><br /> <?php if (isset($row['p_description'])) echo $row['p_description'] ?></p>
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


