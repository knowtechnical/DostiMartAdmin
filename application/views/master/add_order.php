<!-- Advanced Form Start -->
<div class="advanced-form-area mg-b-15">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="sparkline12-list mt-b-30">
					<div class="sparkline12-hd">
						<div class="main-sparkline12-hd">
							<h1>Add Order</h1> </div>
					</div>
					<div class="sparkline12-graph">
						<div class="input-knob-dial-wrap">
							<form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/add_order" enctype="multipart/form-data">
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="order_id">Order Number</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<input type="text" id="order_id" name="order_id" class="form-control" placeholder="Order Number" autocomplete="off" value="<?php if (isset($row['order_number'])) echo $row['order_number'] ?>" readonly/> 
                                        </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 clearfix"> </div>
									</div>
								</div>
								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="customer_name">Customer Name</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<input type="text" id="customer_name" name="customer_name" class="form-control validate[required] text-input" autocomplete="off" value="<?php if (isset($row['customer_name'])) echo $row['customer_name'] ?>" /> </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="l_mobile">Customer Mobile</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<input type="text" id="customer_mobile" name="customer_mobile" class="form-control validate[required] text-input" autocomplete="off" value="<?php if (isset($row['customer_mobile'])) echo $row['customer_mobile'] ?>" /> </div>
									</div>
								</div>

                                <div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="customer_address">Customer Address</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<input type="text" id="customer_address" name="customer_address" class="form-control validate[required] text-input" placeholder="Customer Address"  value="<?php if (isset($row['customer_address'])) echo $row['customer_address'] ?>" /> 
                                        </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 clearfix"> </div>
									</div>
								</div>

								<div class="form-group-inner">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="login2 pull-right pull-right-pro" for="a_name">Select Products</label>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <div class="autocomplete" >
                          <!-- <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Product Name" autocomplete="off" />  -->
                              <input id="myInput" style="width:270px" type="text" autocomplete="off" name="myCountry" placeholder="Product Name">
                          </div>
	                  </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <input id="add_quantity" class="form-control" type="text" name="add_quantity" placeholder="Qty">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <button id="add_button" class="form-control" type="text" id="add_button" name="add_button" onclick="return onAddProduct();" placeholder="Qty">Add</button>
                    </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 clearfix"> </div>
									</div>
								</div>

                                <div class="form-group-inner">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#No</th>
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Sub-Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="add_row">
                                                <?php $count = 0; if(isset($items)){
                                                          $count = 1;
                                                          foreach ($items as $value) {
                                                ?>
                                                    <tr id="row<?=  $count; ?>">
                                                        <td><?= $count?></td>
                                                        <td> 
                                                            <?=  $value['name'] ?>
                                                            <p><span style='color:red'><?php if(isset($value['inStock']) && $value['inStock'] == 'yes'){} else { echo "Item is out of stock";} ?></span></p>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="quantity" name="quantity<?=  $count; ?>" onkeyup="return onUpdateItemQty(this.value,<?=  $count; ?>,<?= $value['price']?>)" id="quantity<?= $count?>" value="<?= $value['quantity']?>" />
                                                        </td>
                                                        <td><?= $value['price'] ?></td>
                                                        <td>
                                                            <span name="item_amount<?= $count?>" id="item_amount<?= $count?>" ><?= $value['subtotal']?></span>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" name="remove<?= $count?>" id="remove<?= $count?>" onclick="return onDeleteItem(<?= $count?>)" >Delete</button>
                                                            <input type="hidden" value="<?=  $value['id']; ?>" name="added_product<?= $count?>" id="added_product<?= $count?>" />
                                                            
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="active" name="active<?= $count?>" id="active<?= $count?>" />
                                                <?php $count++; } } ?>
                                                </tbody>
                                            </table>
                                            
	                                    </div>
									</div>
								</div>
							
								<div class="form-group-inner">
									<div class="login-btn-inner">
										<div class="row">
											<div class="col-lg-2"></div>
											<div class="col-lg-9">
												<div class="login-horizental cancel-wp pull-left form-bc-ele">
                          <input id="total_count" type="hidden" name="total_count" value="<?= count($items) ?>">
													<button class="btn btn-info" type="submit" name="update" onclick="return onPlaceOrder();">Place Order</button>
													<a class="btn btn-default" href="<?= site_url();?>/view_orders">
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
	</div>
</div>
<!-- Advanced Form End-->

<style>
* {
  box-sizing: border-box;
}


/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

#myInput {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

#myInput[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

 .autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.quantity{
  width:70px;
  height:40px;
  text-align:center;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

<script>
function deleteimg(id) {
	// alert(id);
	$.ajax({
		type: "post",
		url: "<?php echo site_url('/deleteimg/') ?>",
		data: {
			id: id
		},
		datatype: "text",
		success: function(data) {
			if(data == 'success') {
				$('#delete' + id).hide();
			} else {}
		}
	});
}

</script>

<script>
actual_count = <?php echo $count-1; ?>;
counter = <?php echo $count-1; ?>;
productname = '';
product_id = 0;
var jsonObj;
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {

    val = this.value;
    parentNode = this.parentNode;
    id = this.id;
    if(val.length >= 3) {

        $.ajax({
            type: "post",
            url: "<?php echo site_url('/api_fetchProductsByName') ?>",
            data: {
                product_name: val
            },
            datatype: "text",
            success: function(data) {
                
                var a, b, i;
                
                myObj  = JSON.parse(data)
                jsonObj = myObj
                arr = [];
                product_ids = []
                //alert(myObj.data.length);

                j = 0;
                for (j = 0; j < myObj.data.length; ++j) {
                    arr[j] = myObj.data[j].p_name;
                    product_ids[j] = myObj.data[j].p_id;
                }

                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) { return false;}
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "" + arr[i].substr(0, val.length) + "";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + product_ids[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        
                        selectedValue = this.getElementsByTagName("input")[0].value;
                        name = '';
                        for (j = 0; j < myObj.data.length; ++j) {
                          if(selectedValue == myObj.data[j].p_id) {
                            name = myObj.data[j].p_name + '';
                          }
                        }
                       
                        productname = name;
                        product_id = selectedValue;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                        inp.value = productname;
                        $("#add_quantity").focus();  
                    });
                    a.appendChild(b);
                    
                }


            }
        });
    } else {
      closeAllLists();
    }


      
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}


/*An array containing all the country names in the world:*/
var countries = [];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);

function onUpdateItemQty(value, index, unitPrice){
    var subTotal = parseFloat(unitPrice)*value;

    subTotal = Math.round((subTotal + Number.EPSILON) * 100) / 100
    $('#item_amount'+index).html(subTotal);
}

function onDeleteItem(index){
  conf = confirm("Are you sure , you want to delete?");
  if(conf){
        $('#active'+index).val('deleted');
        $('#row'+index).remove();
        actual_count = actual_count - 1;
  }
  return conf;

}

function onAddProduct() {
  
  if (typeof selectedValue === "undefined" || $('#add_quantity').val() == '') {
        alert('Please fill information to add product');
        return false;
  }
  
  if(!checkProductExists(selectedValue)){
        for (j = 0; j < jsonObj.data.length; ++j) {
                if(selectedValue == jsonObj.data[j].p_id) {
                counter = counter + 1;
                actual_count = actual_count + 1;
                name = jsonObj.data[j].p_name;
                add_quantity = $('#add_quantity').val();
                subTotal = parseFloat(add_quantity)*parseFloat(jsonObj.data[j].price);
                $('#add_row').append('<tr id="row'+counter+'"><td>'+counter+'</td> '+
                                            '<td>'+jsonObj.data[j].p_name+'</td> '+
                                            '<td><input type="text" class="quantity" name="quantity'+counter+'" onkeyup="return onUpdateItemQty(this.value,'+counter+','+jsonObj.data[j].price+')" id="quantity'+counter+'" value="'+add_quantity+'" /></td> '+
                                            '<td>'+jsonObj.data[j].price+'</td> '+
                                            '<td><span name="item_amount'+counter+'" id="item_amount'+counter+'" >'+subTotal+'</span></td>'+
                                            '<td><button class="btn btn-danger" name="remove'+counter+'" id="reomve'+counter+'" onclick="return onDeleteItem('+counter+')" >Delete</button>'+
                                            '<input type="hidden" value="'+jsonObj.data[j].p_id+'" name="added_product'+counter+'" id="added_product'+counter+'" />'+
                                            '</td></tr>');
                    $('#add_row').append('<input type="hidden" value="active" name="active'+counter+'" id="active'+counter+'" />')
                
                }
        }

        $('#total_count').val(counter);
  } else {
      alert('Item already exists in the list');
  }

  return false;
}

function checkProductExists(id) {
    productExists = false;
    for(k = 1; k <= counter; k++){
        if($('#active'+k).val() == 'active' && $('#added_product'+k).val() == id){
            productExists = true;
            break;
        }
    }

    return productExists;
}

function onPlaceOrder(){
    conf = confirm("Are you sure , you want to delete?");
    if(conf) {
            if(actual_count == 0){
                alert('Please add items to place order');
            } else {
                return true;
            }
    }

    return false;
}
</script>

