<?php
$bill_date = '';
if (isset($purchaseResults["bill_date"]))
    $bill_date = date("d-m-Y", strtotime($purchaseResults["bill_date"]));

?>
<div class="advanced-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="sparkline12-graph">
                <div class="input-knob-dial-wrap">
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/edit_purchase/<?= $this->uri->segment(2, 0);?>" enctype="multipart/form-data">
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="customer_name">Supplier</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <select id="supplier" name="supplier" class="form-control validate[required] text-input" onchange="return onSelectSupplier(this.value);">
                                        <option value="">Select Supplier</option>
                                        <option value='new'>New Supplier</option>
                                        <?php  
                                        foreach ($supplierList as $item) {
                                            if($purchaseResults["supplier_id"] == $item["id"]){

                                        ?>
                                                <option value="<?php echo $item['id']; ?>" selected><?php echo $item['name']; ?></option>
                                       <?php  } else{ ?>
                                                <option value="<?php echo $item['id']; ?>" ><?php echo $item['name']; ?></option>
                                        <?php } } ?>
                                      
                                    </select>
                                </div>
                               
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="address">Address</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="address" name="address" class="form-control validate[required] text-input"    autocomplete="off" value="<?php if (isset($supplierDetail["address"])) echo $supplierDetail['address'] ?>"  disabled/> 
                                </div>

                            </div>
                        </div>

                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="customer_name">GSTIN</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="gst_in" name="gst_in" class="form-control validate[required] text-input"    autocomplete="off" value="<?php if (isset($supplierDetail['gst_in'])) echo $supplierDetail['gst_in'] ?>"  disabled /> 
                                </div>
                                
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="l_mobile">Contact No.</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="contact_no" name="contact_no" class="form-control validate[required] text-input" placeholder="Contact No" autocomplete="off" value="<?php if (isset($supplierDetail['contact_no'])) echo $supplierDetail['contact_no'] ?>" disabled /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="customer_name">Bill Date</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="bill_date" name="bill_date" class="form-control validate[required] text-input date1" placeholder="Select Bill Date"  autocomplete="off" value="<?php if (isset($purchaseResults["bill_date"])) echo $bill_date ?>" /> 
                                </div>
                                
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="l_mobile">Bill No</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="bill_no" name="bill_no" class="form-control validate[required] text-input" placeholder="Bill No" autocomplete="off" value="<?php if (isset($purchaseResults["bill_no"])) echo $purchaseResults["bill_no"] ?>" /> 
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="purchase_total">Purchase Total</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="purchase_total" name="purchase_total" class="form-control validate[required] text-input "  autocomplete="off"  disabled /> 
                                </div>
                                
                              
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="a_name">Select Brand</label>
                                </div>

                                <!-- Brand List -->
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display:none;">
                                    <select id="brand_show" name="brand_show" class="form-control text-input" onchange="return onBrand(this.value);">
                                        <option value=''>Select All</option>
                                        <?php  foreach ($brandNames as $item) { ?>
                                            <option value="<?php echo $item['brand_name']; ?>" ><?php echo $item['brand_name']; ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>

                                <!-- Product List -->
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" id="product_div">
                                    <select id="product_show" name="product_show" class="form-control validate[required] text-input">
                                    </select>
                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <input type="text" id="add_quantity" name="add_quantity" class="form-control text-input" placeholder="Prch Qty"  autocomplete="off"  /> 
                                </div>

                               
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                    <button id="add_button" class="form-control" type="button" id="add_button" name="add_button" onclick="return onAddProduct();" placeholder="Qty">Add</button>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#No</th>
                                                        <th>Product Name - Desc(Brand)</th>
                                                        <th>MRP(PU)</th>
                                                        <th>Buy Rt(PU)</th>
                                                        <th>Disc. Rt(%)</th>
                                                        <th>Sell Prc(PU)</th>
                                                        <th>Profit Mrgn(%)</th>
                                                        <th>Prch Qty</th>
                                                        <th style='color:green;'>Stock Qty</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="add_row">
                                                <?php $count = 0; if(isset($productPurchaseLogs)){
                                                          foreach ($productPurchaseLogs as $value) {
                                                ?>
                                                    <tr id="erow<?=  $count; ?>">
                                                        <td> 
                                                            <img src="<?php echo base_url().$value['p_thumbnail'];?>" style="height:120px; width:120px;" />
                                                        </td>
                                                        <td> 
                                                            <?php echo $value['p_name']." - ".$value['p_quantity_description']." (".$value['brand_name'].")"; ?>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="emrp<?= $count?>" name="emrp<?=  $count; ?>" value="<?= $value['p_market_amount']?>" onkeyup="return onUpdateItem(<?=  $count; ?>)" disabled  />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="ebuying_rate<?= $count?>" name="ebuying_rate<?=  $count; ?>" value="<?= $value['p_buying_amount']?>" onkeyup="return onUpdateItem(<?=  $count; ?>)" disabled  />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="ediscount_rate<?= $count?>" name="ediscount_rate<?=  $count; ?>" value="<?= $value['discount_rate']?>" onkeyup="return onUpdateItem(<?=  $count; ?>)"  disabled  />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="eselling_price<?= $count?>" name="eselling_price<?=  $count; ?>" value="<?= $value['p_selling_price']?>" disabled   />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="eprofit_margin<?= $count?>" name="eprofit_margin<?=  $count; ?>" value="<?= $value['profile_margin']?>"  disabled />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="epurchase_qty<?= $count?>" name="epurchase_qty<?=  $count; ?>" value="<?= $value['purchase_quantity']?>"  disabled  />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" id="estock_quantity<?= $count?>" name="estock_quantity<?=  $count; ?>" value="<?= $value['p_quantity']?>"  disabled  />
                                                        </td>
                                                       
                                                        <td>
                                                            <a class="btn btn-danger" href="<?= site_url();?>/deletePurchaseItem/<?= $value['id'] ?>" onclick="return onDeleteItem(<?= $count?>)" >Delete</a>
                                          
                                                            <input type="hidden" value="<?=  $value['product_id']; ?>" name="eadded_product<?= $count?>" id="eadded_product<?= $count?>" />
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="active" name="eactive<?= $count?>" id="eactive<?= $count?>" />
                                                <?php $count++; } } ?>
                                                </tbody>
                                            </table>
                            </div>
                        </div>

                        <div class="form-group-inner">
                            <div class="login-btn-inner">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                            <input id="total_count" type="hidden" name="total_count" value="">
                                            <button class="btn btn-info" type="submit" name="update" onclick="return onSubmitEntry();">Submit</button>
                                            <a class="btn btn-default" href="<?= site_url();?>/view_purchase">
                                                Cancel 
                                            </a>
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


<!-- Pop Up -->
<div id="addmodal" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Add Supplier</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/edit_supplier" enctype="multipart/form-data" onsubmit="return onAddSupplier();">
                <div class="modal-body">
                    

                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="customer_name">Name</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <input type="text" id="supplier_name" name="supplier_name" class="form-control validate[required] text-input" placeholder="Supplier Name"  autocomplete="off" value="<?php if (isset($row['supplier_name'])) echo $row['supplier_name'] ?>" /> 
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="l_mobile">GSTIN</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <input type="text" id="supplier_gst_in" name="supplier_gst_in" class="form-control text-input" placeholder="GSTIN" autocomplete="off" value="<?php if (isset($row['gst_in'])) echo $row['gst_in'] ?>" /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="supplier_contact">Contact</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <input type="text" id="supplier_contact" name="supplier_contact" class="form-control text-input" placeholder="Supplier Contact"  autocomplete="off" value="<?php if (isset($row['supplier_contact'])) echo $row['supplier_contact'] ?>" /> 
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="email">Email</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <input type="text" id="supplier_email" name="supplier_email" class="form-control text-input" placeholder="Email" autocomplete="off" value="<?php if (isset($row['supplier_email'])) echo $row['supplier_email'] ?>" /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="supplier_address">Address</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="supplier_address" name="supplier_address" class="form-control" placeholder="Supplier Address" autocomplete="off" value="<?php if (isset($row['supplier_address'])) echo $row['supplier_address'] ?>" /> 
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 clearfix"> </div>
                            </div>
						</div>


                    
                </div>
                <div class="modal-footer">
                    <div class="login-horizental cancel-wp pull-right form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" id="pop_up_submit" type="submit" name="submit">Submit</button>
                        <button class="btn btn-white" data-dismiss="modal" type="button">Cancel</button>                                         
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.quantity{
    width:60px;
    height:30px;
    text-align:center;
}
</style>
<script src="<?php echo base_url(); ?>assets/js/jqueryui/jquery.searchabledropdown-1.0.8.min.js"></script>
<script>

function onSelectSupplier(value){
 
 if(value == 'new'){
     $('#addmodal').modal('show');
 } else {

     $.ajax({
         type: "post",
         url: "<?php echo site_url('/api_getSupplierById') ?>",
         data: {
             supplier_id: value,
         },
         datatype: "text",
         success: function(data) {
             //alert(data);

             myObj  = JSON.parse(data)
             //jsonObj = myObj
             if(myObj.success == 'success'){
                 name = myObj.name;
                 contact_no = myObj.contact_no;
                 address = myObj.address;
                 gst_in = myObj.gst_in;
                 
                 $('#contact_no').val(contact_no);
                 $('#gst_in').val(gst_in);
                 $('#address').val(address);

              }

         }
     });
     

 }
}

function onAddSupplier(){

    $('#pop_up_submit').attr("disabled", true);
    supplier_name = $('#supplier_name').val();
    supplier_gst_in = $('#supplier_gst_in').val();
    supplier_contact = $('#supplier_contact').val();
    supplier_email = $('#supplier_email').val();
    supplier_address = $('#supplier_address').val();
    $.ajax({
            type: "post",
            url: "<?php echo site_url('/add_supplier') ?>",
            data: {
                supplier_name: supplier_name,
                supplier_gst_in: supplier_gst_in,
                supplier_contact: supplier_contact,
                supplier_email: supplier_email,
                supplier_address: supplier_address,
            },
            datatype: "text",
            success: function(data) {
                //alert(data);

                myObj  = JSON.parse(data)
                //jsonObj = myObj
                if(myObj.success == 'success'){
                    id = myObj.id;
                    name = myObj.name;
                    $('#supplier').append('<option value="'+id+'" selected>'+name+'</option>');

                    onSelectSupplier(id);
                }
                //product_name = myObj.data[j].p_name + ' - '+myObj.data[j].p_quantity_description+' - MRP: '+myObj.data[j].p_market_amount;
                $('#pop_up_submit').attr("disabled", false);
                $('#addmodal').modal('hide');
            }
    });

    return false;
}


actual_count = 0;
counter = 0;
productname = '';
product_id = 0;
edit_counter = <?= $count ?>;
var jsonObj;
var data;
purchase_total = 0;

function onBrand(brandName){
    //alert(brandName);
 
    //alert(data);
    if(brandName != ''){
        myObj  = JSON.parse(data)
        jsonObj = myObj

        j = 0;
        html = '';
        for (j = 0; j < myObj.data.length; ++j) {

            if(brandName == myObj.data[j].brand_name){
                product_name = myObj.data[j].p_name + ' - '+myObj.data[j].p_quantity_description+' - MRP: '+myObj.data[j].p_market_amount;
                html = html + '<option value="'+myObj.data[j].p_id+'"> '+product_name+' </option>';
            }
        }

        $('#product_show').html(html);
        select = $('#product_div div select:nth-child(2)');
        //alert(select.html())
        select.html(html);
    } else {
        populateAllProducts();
    }

    return true;
}

function onAddProduct() {
  
  selectedValue = $('#product_show').val();
  if (typeof selectedValue === "undefined" || $('#add_quantity').val() == '' || selectedValue == '') {
        alert('Please fill information to add product');
        return false;
  }
  
  if(!checkProductExists(selectedValue)){

    myObj  = JSON.parse(data)
    jsonObj = myObj
    for (j = 0; j < jsonObj.data.length; ++j) {
        if(selectedValue == jsonObj.data[j].p_id) {
        counter = counter + 1;
        actual_count = actual_count + 1;
        name = myObj.data[j].p_name + ' - '+myObj.data[j].p_quantity_description+' ('+myObj.data[j].brand_name+')';
        add_quantity = $('#add_quantity').val();
        subTotal = parseFloat(add_quantity)*parseFloat(jsonObj.data[j].price);

        siteUrl = "<?php echo base_url() ?>"
        //onkeyup="return onUpdateIte(this.value,'+counter+','+jsonObj.data[j].p_quantity+')"
        tr = '<tr id="row'+counter+'"><td><img src="'+siteUrl+myObj.data[j].p_thumbnail+'" style="height:120px; width:120px;" /></td> '+
                                    '<td>'+name+'</td> '+
                                    '<td><input type="text" class="quantity" name="mrp'+counter+'" id="mrp'+counter+'" value="'+myObj.data[j].p_market_amount+'"  onkeyup="return onUpdateItem('+counter+');" /></td> '+
                                    '<td><input type="text" class="quantity" name="buying_rate'+counter+'" id="buying_rate'+counter+'" value="'+myObj.data[j].p_buying_amount+'" onkeyup="return onUpdateItem('+counter+');"  /></td> '+
                                    '<td><input type="text" class="quantity" name="discount_rate'+counter+'" id="discount_rate'+counter+'" value="'+myObj.data[j].discount_rate+'" onkeyup="return onUpdateItem('+counter+');" /></td> '+
                                    '<td><input type="text" class="quantity" name="selling_price'+counter+'" id="selling_price'+counter+'" value="'+myObj.data[j].price+'"  /></td> '+
                                    '<td><input type="text" class="quantity" name="profit_margin'+counter+'" id="profit_margin'+counter+'" value="'+myObj.data[j].profile_margin+'" /></td> '+
                                    '<td><input type="text" class="quantity" name="purchase_qty'+counter+'" id="purchase_qty'+counter+'" value="'+add_quantity+'"  onkeyup="return calculatePurchaseTotal();" /></td> '+
                                    '<td><input type="text" class="quantity" name="stock_quantity'+counter+'"  id="quantity'+counter+'" value="'+jsonObj.data[j].p_quantity+'" disabled /></td> '+
                                    '<td><button class="btn btn-danger" name="remove'+counter+'" id="reomve'+counter+'" onclick="return onDeleteItem('+counter+')" >Delete</button>'+
                                    '<input type="hidden" value="'+jsonObj.data[j].p_id+'" name="added_product'+counter+'" id="added_product'+counter+'" />'+
                                    '<input type="hidden" value="'+jsonObj.data[j].p_admin_profit+'" name="p_admin_profit'+counter+'" id="p_admin_profit'+counter+'" />'+
                                    '<input type="hidden" value="'+jsonObj.data[j].p_user_profit+'" name="p_user_profit'+counter+'" id="p_user_profit'+counter+'" />'+
                                    '</td></tr>'
            $('#add_row').append(tr);
            $('#add_row').append('<input type="hidden" value="active" name="active'+counter+'" id="active'+counter+'" />');
            calculatePurchaseTotal();
        
        }
    }
  
      $('#total_count').val(counter);
    } else {
        alert('Item already exists in the list');
    }
  
  $("#product_show").focus();
  //$('#myInput').val('');
  //$('#myInput').focus();
  return false;
}

function onDeleteItem(index){
  conf = confirm("Are you sure , you want to delete?");
  if(conf){
        $('#active'+index).val('deleted');
        $('#row'+index).remove();
        actual_count = actual_count - 1;
        calculatePurchaseTotal();
  }
  return conf;

}

function onUpdateItem(count){
    mrp = parseFloat($('#mrp'+count).val());
    buying_rate = parseFloat($('#buying_rate'+count).val());
    discount_rate = parseFloat($('#discount_rate'+count).val());

	var selling_rate = mrp - (mrp * (discount_rate / 100));
	profile_margin = ((selling_rate - buying_rate) / buying_rate) * 100;
	profile_margin = Math.round((profile_margin + Number.EPSILON) * 100) / 100
	$('#profit_margin'+count).val(profile_margin)
	
    selling_rate = Math.round((selling_rate + Number.EPSILON) * 100) / 100
	$('#selling_price'+count).val(selling_rate);
	
    var admin_profile = selling_rate - buying_rate;
	admin_profile = Math.round((admin_profile + Number.EPSILON) * 100) / 100
	var user_profile = mrp - selling_rate;
	user_profile = Math.round((user_profile + Number.EPSILON) * 100) / 100
	
    $('#p_admin_profit'+count).val(admin_profile);
	$('#p_user_profit'+count).val(user_profile);

}

function checkProductExists(id) {
    productExists = false;

    for(k = 1; k <= counter; k++){
        if($('#active'+k).val() == 'active' && $('#added_product'+k).val() == id){
            productExists = true;
            break;
        }
    }

    for(k = 0; k <= edit_counter; k++){
        if($('#eactive'+k).val() == 'active' && $('#eadded_product'+k).val() == id){
            productExists = true;
            break;
        }
    }

    return productExists;
}

function onSubmitEntry(){
    conf = confirm("Are you sure , you want to place order?");
    if(conf) {
            if(actual_count == 0){
                alert('Please add items to purchase entry');
            } else {
                return true;
            }
    }

    return false;
}

$(document).ready(function() {
	  $("#brand_show").searchable();
      $("#product_show").searchable();
    
      $.ajax({
            type: "post",
            url: "<?php echo site_url('/api_fetchAllProducts') ?>",
            data: {},
            datatype: "text",
            success: function(response) {
                data = response;
                
                j = 0;
                html = '';
                xyObj  = JSON.parse(data)
                for (j = 0; j < xyObj.data.length; ++j) {
                        product_name = xyObj.data[j].p_name + ' - '+xyObj.data[j].p_quantity_description+' '+' ('+xyObj.data[j].brand_name+') '+'- MRP: '+xyObj.data[j].p_market_amount;
                        html = html + '<option value="'+xyObj.data[j].p_id+'"> '+product_name+' </option>';
                }

                $('#product_show').html(html);

            }
    });

    //   $("#product_div div input").focus(function(){
    //     $("#product_div div input").val('');
    //   });
});

function populateAllProducts(){

    j = 0;
    html = '';
    xyObj  = JSON.parse(data)
    for (j = 0; j < xyObj.data.length; ++j) {
            product_name = xyObj.data[j].p_name + ' - '+xyObj.data[j].p_quantity_description+' - MRP: '+xyObj.data[j].p_market_amount;
            html = html + '<option value="'+xyObj.data[j].p_id+'"> '+product_name+' </option>';
    }

    $('#product_show').html(html);
    select = $('#product_div div select:nth-child(2)');
    //alert(select.html())
    select.html(html);
}

jQuery(window).load(function () {
    calculatePurchaseTotal();
});
function calculatePurchaseTotal(){

    purchase_total = 0
    for(k = 1; k <= counter; k++){
        if(typeof $('#buying_rate'+k).val() != 'undefined' && typeof $('#purchase_qty'+k).val() != 'undefined'){
            purchase_total = purchase_total + (parseFloat($('#buying_rate'+k).val()) * parseFloat($('#purchase_qty'+k).val()))
        }
    }

    for(k = 0; k <= edit_counter; k++){
        //
        if(typeof $('#ebuying_rate'+k).val() != 'undefined' && typeof $('#epurchase_qty'+k).val() != 'undefined'){
            purchase_total = purchase_total + (parseFloat($('#ebuying_rate'+k).val()) * parseFloat($('#epurchase_qty'+k).val()))
        }
    }

    if(isNaN(purchase_total)) purchase_total = 0;

    purchase_total = Math.round((purchase_total + Number.EPSILON) * 100) / 100
    $("#purchase_total").val(purchase_total);

}

jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
</script>