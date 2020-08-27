<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
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
<div class="advanced-form-area mg-b-15">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list mt-b-30">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Edit Sub-Category</h1>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="input-knob-dial-wrap">
                               
<form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/edit_shop/<?= $this->uri->segment(2, 0);?>" enctype="multipart/form-data">

<div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="fk_shop_id">Show On Home Page</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <input type="checkbox" id="s_show_on_homepage" name="s_show_on_homepage" value="1" style="margin-left:-171px;" class="form-control" <?= $row['s_show_on_homepage'] == '1'?'checked':''; ?>  />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="fk_category_id">Zone <?= $row['fk_zone_id'];?></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <select id="fk_zone_id" name="fk_zone_id" class="form-control validate[required]"  >
                <option value="">Select Zone</option>
                <?php foreach($zone as $zonerow){ ?>
                <option value="<?= $zonerow['z_id']; ?>"   <?= $row['fk_zone_id'] == $zonerow['z_id']?'selected':'';?>><?= $zonerow['z_name']; ?></option>
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
                <?php $catids = explode(',',$catids['catids']); foreach($category as $categoryrow){  ?>
                <option class="<?php echo (in_array($categoryrow['c_id'],$catids) ? 'selectedids' : '');?>" value="<?= $categoryrow['c_id']; ?>" <?php echo (in_array($categoryrow['c_id'],$catids) ? 'selected' : '');?>      ><?= $categoryrow['c_name']; ?></option>
                <?php } ?>                
                </select>
            </div>
        </div>
    </div>   

    <div class="form-group-inner">
    <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for=""></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php foreach($allcategory as $allcategorydata){ ?>
            <div class="chip" id="delete<?= $allcategorydata['sc_id'];?>">
            <?= $allcategorydata['c_name'];?>
            <span class="closebtn" onclick="this.parentElement.style.display='none';deleterow(<?= $allcategorydata['sc_id']; ?>);">&times;</span>
            </div>
            <?php } ?>
            </div>  
    </div>
    </div>   

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_name">Sub-Category Name</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="s_name" name="s_name" class="form-control validate[required] text-input" placeholder="Enter Shop Name" value="<?php if (isset($row['s_name'])) echo $row['s_name'] ?>" />
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row" style="display:none">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">  
                <label class="login2 pull-right pull-right-pro" for="s_stime">Sub-Category Start Time</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <input type="time" id="s_stime" name="s_stime"  value="10:20:PM" class="form-control validate[required] text-input" placeholder="Enter Shop Name" />
            </div>
        </div>
    </div>

    <div class="form-group-inner" style="display:none"> 
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_etime">Sub-Category End Time</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <input type="time" id="s_etime" name="s_etime"  class="form-control text-input" placeholder="Enter Shop Name" />
            </div>
        </div>
    </div>
    
    <div class="form-group-inner" style="display:none">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_number">Phone Number</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="number" id="s_number" name="s_number" value ="9766167658" class="form-control validate[required] text-input" onkeyup="javascript: return event.keyCode == 69 ? false : true" placeholder="Enter Phone Number" value="<?php if (isset($row['s_number'])) echo $row['s_number'] ?>" />
            </div>
        </div>
    </div>

    <div class="form-group-inner" style="display:none">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_address">Address</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="s_address" name="s_address"  class="form-control text-input" placeholder="Enter Address" value="<?php if (isset($row['s_address'])) echo $row['s_address'] ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_description">Description</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <textarea type="text" id="s_description" name="s_description" class="form-control" placeholder="Enter Description" ><?php if (isset($row['s_description'])) echo $row['s_description'] ?></textarea>
            </div>
        </div>
    </div>    

    
    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="s_image">Sub-Category Image</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="hidden" name="bk_s_image" value="<?php if (isset($row['s_image'])) echo $row['s_image'] ?>">
                <input type="file" id="s_image" name="s_image" class="form-control" >
            </div>
        </div>
    </div> 

    <div class="form-group-inner">
        <div class="login-btn-inner">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-9">
                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="update">Update</button>
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

        <script>
    function deleterow(id){
        // alert(id);
        var deleteid = 'sc_id';
        var tdeletecolumn = 'sc_delete';     
        var tablename = 'shop_category';      
        $.ajax({
            type: "post",
            url: "<?php echo site_url('/deleterow/') ?>",
            data: {id:id,deleteid:deleteid,tablename:tablename,tdeletecolumn:tdeletecolumn},
            datatype: "text",
            success: function(data){                
                if(data == 'success'){                    
                   $("#responsemsg").addClass("hide_respons");
                    $('#delete'+id).hide();
                    $('#responsemsg').show();
                    $('#responsemsg').html('Deleted Sucessfully.');
                }else{                    
                    $("#responsemsg").addClass("hide_respons");
                    $('#responsemsg').show();
                    $('#responsemsg').html('Error!');
                }            
            }
        });
    }
</script>