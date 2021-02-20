<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/add_product.css">
<script src="<?php echo base_url(); ?>assets/js/add_product.js"></script>
<!-- Advanced Form Start -->
<div class="advanced-form-area mg-b-15">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="sparkline12-list mt-b-30">
					<div class="sparkline12-hd">
						<div class="main-sparkline12-hd">
							<h1>Add Product</h1> </div>
					</div>
					<div class="sparkline12-graph">
						<div class="input-knob-dial-wrap">
							<form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/add_product" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="login2 pull-right pull-right-pro" for="purchase_qty">Type of update</label>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
										<select id="purchase_type" name="purchase_type" class="form-control validate[required] text-input">
											<option value='update'>Master Update</option>
										</select>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="fk_shop_id">Show On Home Page</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<input type="checkbox" id="p_show_on_homepage" name="p_show_on_homepage" value="1" style="margin-left:-171px;" class="form-control" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="fk_shop_id">Shop</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<select id="fk_shop_id" name="fk_shop_id" class="form-control validate[required] text-input" onchange="get_category_from_shop();">
												<option value="">Select Shop</option>
												<?php foreach($shop as $shoprow){ ?>
													<option value="<?= $shoprow['s_id']; ?>" data-zoneid="<?=  $shoprow['fk_zone_id'];?>" data-zonename="<?=  $shoprow['z_name'];?>">
														<?= $shoprow['s_name']; ?>
													</option>
													<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group-inner zone_section" style="display:none;">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="fk_shop_id">Zone Name</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="zone_name" name="zone_name" class="form-control" readonly />
											<input type="hidden" id="fk_zone_id" name="fk_zone_id" class="form-control" readonly /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="fk_category_id">Category</label>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<select id="fk_category_id_o" name="fk_category_id" class="form-control validate[required] text-input">
												<option value="">Select Category</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_name">Product Name</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="p_name" name="p_name" class="form-control validate[required] text-input" placeholder="Enter Product Name" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
								<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="keywords">Keywords (Easty to find by user)</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="keywords" name="keywords" class="form-control" placeholder="Enter keywords to recognize" value=""  />
										</div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_quantity_description">Product Qty Description</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="p_quantity_description" name="p_quantity_description" class="form-control" placeholder="Enter Qty Desc" value="<?php if (isset($row['p_quantity_description'])) echo $row['p_quantity_description'] ?>"  />
										</div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="brand_name">Brand Name</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="Enter Brand Name" value="<?php if (isset($row['brand_name'])) echo $row['brand_name'] ?>" /> </div>
									</div>
								</div>
								<div class="form-group-inner" style="display:none;">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="brand_name">Invoice No.</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="supplier_name" name="supplier_name" class="form-control" placeholder="Enter Supplier Name" value="<?php if (isset($row['supplier_name'])) echo $row['supplier_name'] ?>" /> </div>
									</div>
								</div>
								<div class="form-group-inner" style="display:none">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="brand_name">Supplier Address</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="supplier_address" name="supplier_address" class="form-control" placeholder="Enter Supplier Name" value="<?php if (isset($row['supplier_address'])) echo $row['supplier_address'] ?>" /> </div>
									</div>
								</div>
								<div class="form-group-inner" style="display:none">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="supplier_contact">Supplier Contact</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="supplier_contact" name="supplier_contact" class="form-control" placeholder="Enter Supplier Name" value="<?php if (isset($row['supplier_contact'])) echo $row['supplier_contact'] ?>" /> </div>
									</div>
								</div>
								<div class="form-group-inner" style="display:none">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="brand_name">GSTIN</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="gstin" name="gstin" class="form-control" placeholder="Enter GSTIN" value="<?php if (isset($row['gst'])) echo $row['gst'] ?>" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_market_amount">MRP (Per Unit)</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="p_market_amount" name="p_market_amount" class="form-control validate[required] text-input " onkeyup="admin_profit_calculation();" placeholder="Enter Market Amount" value="0" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_buying_amount">Buying Rate(Per Unit)</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="p_buying_amount" name="p_buying_amount" class="form-control validate[required] text-input " onkeyup="admin_profit_calculation();" value="0" placeholder="Enter Buying Amount" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="discount_rate">Discount Rate (%)</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="discount_rate" name="discount_rate" class="form-control validate[required] text-input " onkeyup="admin_profit_calculation();" value="0" placeholder="Enter Discount Rate" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_amount">Selling Price(Per Unit)</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="p_amount" name="p_amount" class="form-control validate[required] text-input" placeholder="Enter Selling Amount" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="profile_margin">Profit Margin (%)</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="profile_margin" name="profile_margin" class="form-control validate[required] text-input " value="0" placeholder="Enter Profile Amount" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_admin_profit">Admin Profit</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<input type="number" id="p_admin_profit" name="p_admin_profit" class="form-control validate[required] text-input p_admin_profit" placeholder="Amount" value="0" readonly /> </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_user_profit">User Profit</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<input type="number" id="p_user_profit" name="p_user_profit" class="form-control validate[required] text-input p_user_profit" placeholder="Amount" value="0" readonly /> <span id="discount_percent_s"></span> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_quantity">Total Quantity</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="number" id="p_quantity" name="p_quantity" class="form-control validate[required] text-input" onkeyup="javascript: return event.keyCode == 69 ? false : true" placeholder="Enter Quantity" /> </div>
									</div>
								</div>
								<div class="form-group-inner" style="display:none">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_quantity">Total Weight(Kg)</label>
										</div>
										<div class="col-lg-3 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="p_total_weight" name="p_total_weight" class="form-control text-input" onkeyup="javascript: return event.keyCode == 69 ? false : true" placeholder="Enter Total Weight(Kg)" /> </div>
									</div>
								</div>
								<div class="form-group-inner" style="display:none">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_quantity">Range</label>
										</div>
										<div class="col-lg-3 col-md-9 col-sm-9 col-xs-12">
											<input type="text" id="weight_range" name="weight_range" class="form-control text-input" onkeyup="javascript: return event.keyCode == 69 ? false : true" placeholder="Weight Range" /> </div>
										<div class="col-lg-3 col-md-9 col-sm-9 col-xs-12">
											<select id="weight_unit" name="weight_unit" class="form-control text-input">
												<option>Kilogram</option>
												<option>Gram</option>
											</select>
										</div>
										<div class="col-lg-3 col-md-9 col-sm-9 col-xs-12">
											<button class="btn btn-white" type="button" onclick="onAddRange()">Add</button>
										</div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<input type="hidden" name="total_range_value" id="total_range_value" value="0" /> </div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="range_box">
											<!-- <span class="weight_range_box">
                     1   <span class="close_button">X</span> 
                     </span>
                     
                     <span class="weight_range_box">
                     1   <span class="close_button" id="range_box1">X</span> 
                     </span>
                     
                     <span class="weight_range_box">
                     1   <span class="close_button">X</span> 
                     </span> --></div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_thumbnail">App Image</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<input type="file" id="p_thumbnail" name="p_thumbnail" class="form-control validate[required]" /> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_description">Description</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<textarea type="text" id="p_description" name="p_description" class="form-control" placeholder="Enter Description"></textarea>
										</div>
									</div>
								</div>
								<div class="form-group-inner after-add-more">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="p_quantity">Extra Images</label>
										</div>
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<div class="control-group input-group" style="margin-top:10px">
												<input type="file" name="uploaded_file[]" class="form-control" placeholder="Enter Name Here">
												<div class="input-group-btn">
													<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> </button>
												</div>
											</div>
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
													<a href="<?= site_url();?>/view_product">
														<button class="btn btn-white" type="button">Cancel</button>
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
	</div>
</div>
<!-- Advanced Form End-->
<div class="form-group-inner copy hide">
	<div class="row control-group">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<label class="login2 pull-right pull-right-pro" for="p_quantity">Image</label>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class=" input-group" style="margin-top:10px">
				<input type="file" name="uploaded_file[]" class="form-control" placeholder="Enter Name Here">
				<div class="input-group-btn">
					<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function get_category_from_shop() {
	var fk_shop_id = $('#fk_shop_id').val();
	var fk_zone_id = $("#fk_shop_id option:selected").attr('data-zoneid');
	var zone_name = $("#fk_shop_id option:selected").attr('data-zonename');
	$.ajax({
		type: "post",
		url: "<?php echo site_url('/get_category_from_shop/') ?>",
		data: 'fk_shop_id=' + fk_shop_id,
		datatype: "text",
		success: function(data) {
			//  alert(data);
			$(".zone_section").show('');
			$("#fk_zone_id").val(fk_zone_id);
			$("#zone_name").val(zone_name);
			$("#fk_category_id_o").html(data);
		}
	});
}

function admin_profit_calculation() {
	var discount_rate = parseFloat($("#discount_rate").val());
	var mrp = parseFloat($('#p_market_amount').val());
	var buying_rate = parseFloat($('#p_buying_amount').val());
	var selling_rate = mrp - (mrp * (discount_rate / 100));
	profile_margin = ((selling_rate - buying_rate) / buying_rate) * 100;
	profile_margin = Math.round((profile_margin + Number.EPSILON) * 100) / 100
	$('#profile_margin').val(profile_margin)
		//v
	selling_rate = Math.round((selling_rate + Number.EPSILON) * 100) / 100
	$('#p_amount').val(selling_rate);
	var admin_profile = selling_rate - buying_rate;
	admin_profile = Math.round((admin_profile + Number.EPSILON) * 100) / 100
	var user_profile = mrp - selling_rate;
	user_profile = Math.round((user_profile + Number.EPSILON) * 100) / 100
	$('#p_admin_profit').val(admin_profile);
	$('#p_user_profit').val(user_profile);
	// discount = (user_profile/mrp)*100;
	// discount = Math.round((discount + Number.EPSILON) * 100) / 100
	// $('#discount_percent_s').html(discount)
}

function user_profit_calculation() {
	//var user_profit_calculation = p_market_amount - p_selling_amount;
	//console.log(user_profit_calculation+"="+p_market_amount+"-"+p_selling_amount);
	//$('#p_user_profit').val(user_profit_calculation);        
}
</script>