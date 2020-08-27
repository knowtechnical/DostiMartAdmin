<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/add-multiselct-dropdown-bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<style>
.multiselect dropdown-toggle  {
  width: 400px !important;
}

.checkbox dropdown-toggle  {
  width: 400px !important;
}


/* .buttonwidth{
     width: 400px !important;
} */
</style>
<div class="advanced-form-area mg-b-15">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list mt-b-30">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Add Sub-Category</h1>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="input-knob-dial-wrap">
<form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/add_shop" enctype="multipart/form-data">

<div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="fk_shop_id">Show On Home Page</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <input type="checkbox" id="s_show_on_homepage" name="s_show_on_homepage"  value="1" style="margin-left:-171px;" class="form-control"  />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="fk_category_id">Zone</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <select id="fk_zone_id" name="fk_zone_id" class="form-control validate[required]"  >
                <option value="">Select Zone</option>
                <?php foreach($zone as $zonerow){ ?>
                <option value="<?= $zonerow['z_id']; ?>"><?= $zonerow['z_name']; ?></option>
                <?php } ?>                
                </select>
            </div>
        </div>
    </div>   

<div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="fk_category_id">Category</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <select id="fk_category_id" name="fk_category_id[]" multiple="multiple" class="form-control buttonwidth  validate[required] text-input"  >
                <?php foreach($category as $categoryrow){ ?>
                <option value="<?= $categoryrow['c_id']; ?>"><?= $categoryrow['c_name']; ?></option>
                <?php } ?>                
                </select>
            </div>
        </div>
    </div>   

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_name">Sub-Category Name</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="s_name" name="s_name" class="form-control validate[required] text-input" placeholder="Enter Shop Name" />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row" style="display:none" >
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">  
                <label class="login2 pull-right pull-right-pro" for="s_stime">Sub-Category Start Time</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <input type="time" id="s_stime" name="s_stime" class="form-control text-input" value="10:20:PM" placeholder="Enter Shop Name" />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row" style="display:none">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_etime">Sub-Category End Time</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <input type="time" id="s_etime" name="s_etime" value="10:20:PM" class="form-control text-input" placeholder="Enter Shop Name" />
            </div>
        </div>
    </div>
    
    <div class="form-group-inner">
    <div class="row" style="display:none">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_number">Phone Number</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="number" id="s_number" name="s_number" value = "9766167658" class="form-control text-input" onkeyup="javascript: return event.keyCode == 69 ? false : true" placeholder="Enter Phone Number" />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row" style="display:none">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_address">Address</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="s_address" name="s_address" value = "Parbhani" class="form-control text-input" placeholder="Enter Address" />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="p_description">Description</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <textarea type="text" id="s_description" name="s_description" class="form-control" placeholder="Enter Description" ></textarea>
            </div>
        </div>
    </div>    

    
    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_image">Sub-Category Image</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="file" id="s_image" name="s_image" class="form-control validate[required]" >
            </div>
        </div>
    </div> 

    <div class="form-group-inner">
        <div class="login-btn-inner">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-9">
                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Submit</button>
                        <a href="<?= site_url();?>/view_shop"><button class="btn btn-white" type="button">Cancel</button></a>                                                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        <!-- Advanced Form End-->
    