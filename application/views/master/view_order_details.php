
<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid" id="print_view">
                    <p>
                        <button class="btn btn-primary" onclick="return onPrint();">Print</button>
                        <a   href="<?= site_url(); ?>/edit_order/<?= $this->uri->segment(2, 0); ?>" class="btn btn-info" >Add Product</a>
                        <button class="btn btn-danger" >Cancel Order</button>
                    </p>
            </div>
            <div class="container-fluid" id="print_view">
                <div class="row">
            
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="table_preview">
                        <div class="profile-info-inner">
                        <h1>Order Details</h1>
                   
                        <table class="table table-bordered" >
                            <tbody>
                            <tr>
                                <td><strong>Order Date</strong></td>
                                <td><?php if (isset($result[0]['o_date'])) echo $result[0]['o_date'] ?></td>
                                 
                            </tr>
                            <tr>
                                <td><strong>Order ID</strong></td>
                                <td><?php if (isset($result[0]['order_number'])) echo $result[0]['order_number'] ?></td>
                                 
                            </tr>
                            <tr>
                                <td><strong>Delivery Mode</strong></td>
                                <td><?php if (isset($result[0]['delivery_mode'])) echo $result[0]['delivery_mode'] ?></td>
                                 
                            </tr>
                            <tr>
                                <td><strong>Customer Name</strong></td>
                                <td><?php if (isset($result[0]['l_name'])) echo $result[0]['l_name'] ?></td>    
                            </tr>
                            <tr>
                                <td><strong>Customer Mobile</strong></td>
                                <td><?php if (isset($result[0]['customer_mobile'])) echo $result[0]['customer_mobile'] ?></td>    
                            </tr>
                            <tr>
                                <td><strong>Customer Address</strong></td>
                                <td><?php if (isset($result[0]['customer_address'])) echo $result[0]['customer_address'] ?></td>    
                            </tr>
                            <tr>
                                <td><strong>Order Status</strong></td>
                                <td><?php if (isset($result[0]['ostatus'])) echo $result[0]['ostatus'] ?></td>
                                 
                            </tr>
                      
                            
                            </tbody>
                         </table>

                        <h1>Product Items</h1>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>MRP</th>
                                    <th>Discount</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php   $totalamountoffer= 0;
                                        $totalamount=0; 
                                        if(isset($result)){
                                            $count = 1;
                                            foreach ($result as $value) {  
                                           
                                ?>
                                
                                                <tr>
                                                    <td> <?=  $count; ?></td>    
                                                    <td> <?=  $value['product_name']; ?></td>                                                
                                                    <td> <?=  $value['p_quantity']; ?></td>
                                                    <td> <?=  $value['mrp']; ?></td>
                                                    <td> <?=  $value['discount_amount']; ?></td>       
                                                    <td> <?=  $value['item_total_amount']; ?></td> 
                                                    <td> 
                                                    <button class="btn btn-danger" name="remove<?= $count?>" id="remove<?= $count?>" onclick="return onDeleteItem(<?= $count?>)" >Delete</button>
                                                    </td>   
                                                   
                                                </tr>
        
                                <?php           $count++;
                                            }
                                        }
                                ?>
                                <tr>
                                    <td colspan=5>Total Amount</td>
                                    <td><?php if (isset($result[0]['order_items_total_amount'])) echo $result[0]['order_items_total_amount'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan=5>PickUp Discount</td>
                                    <td><?php if (isset($result[0]['pickup_discount_amount'])) echo number_format((float)$result[0]['pickup_discount_amount'], 2, '.', ''); ?></td>
                                </tr>
                                <tr>
                                    <td colspan=5>Delivery Charges</td>
                                    <td><?php if (isset($result[0]['order_delivery_charge_amount'])) echo number_format((float)$result[0]['order_delivery_charge_amount'], 2, '.', ''); ?></td>
                                </tr>
                                <tr>
                                        <td colspan=5><strong>Amount Payable</strong></td>
                                        <td><strong><?php if (isset($result[0]['order_total_amount'])) echo number_format((float)$result[0]['order_total_amount'], 2, '.', ''); ?></strong></td>
                                </tr>
                            </tbody>
                         </table>

                            <div class="profile-img">
                                <!-- <img src="<?php //echo base_url(); ?>assets/img/profile/1.jpg" alt=""  style="height:300px;" /> -->
                                <div class="container">
                                    <input id="fetch_caculated_offer_amount_on_order" value="<?= $totalamountoffer;?>" hidden>
                                    <input id="fetch_offer_amount_on_order" value="<?= $totalamount;?>" hidden> 
                                </div>
                            </div>
                    </div>
                    </div>
                        </div>
                    </div>
                    </div>
                    </div>

                    </div>


                  <!---START MODAL---->
                    <div id="assign_offer" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-1">
                        <h4 class="modal-title">Assign Offer</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/assign_offer" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group-inner"> 
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="m_order_id">Order Id</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <input type="text" class="form-control" id="m_order_id"  name="m_order_id" value="" readonly>                    
                                </div>
                            </div>
                            <div class="clerfix"></div><br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="m_product_name">Product Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <input type="text" class="form-control" id="m_product_name" value="" readonly>  
                                        <input type="hidden" class="form-control" id="m_product_id"  name="m_product_id" value="" readonly>                   
                                </div>
                            </div>
                            <div class="clerfix"></div><br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="m_product_amount">Product Amount</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <input type="text" class="form-control" id="m_product_amount" name="m_product_amount" value="" readonly>                    
                                </div>
                            </div>
                            <div class="clerfix"></div><br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="m_offer_amount">Offer Amount</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <input type="text" class="form-control" id="m_offer_amount" name="m_offer_amount" value="" >                    
                                </div>
                            </div>
                            <div class="clerfix"></div><br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro" for="m_offer_details">Offer Details</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <textarea class="form-control" id="m_offer_details" name="m_offer_details"></textarea>                    
                                </div>
                            </div>
                            <div class="clerfix"></div>

                    </div>
                    </div>
                    <div class="modal-footer">
                    <div class="login-horizental cancel-wp pull-right form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Submit</button>
                        <button class="btn btn-white" data-dismiss="modal" type="button">Close</button>                                         
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>    


        <!---END MODAL---->

        <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
                    <script>

jQuery(document).ready(function($) {
    $('#display_caculated_offer_amount_on_order').html($('#fetch_caculated_offer_amount_on_order').val());  
    $('#display_offer_amount_on_order').html($('#fetch_offer_amount_on_order').val());  
});
  

    function assign_offer(order_id,product_id,product_name,amount) {     
    //   alert(order_id); alert(product_id);    
    //alert(amount);  
        $('#assign_offer').modal('show');
        $('#m_order_id').val(order_id);  
        $('#m_product_name').val(product_name); 
        $('#m_product_id').val(product_id); 
        $('#m_product_amount').val(amount); 
    }

    function onPrint(){


        var divToPrint=document.getElementById("table_preview");
        newWin= window.open("");
        newWin.document.write('<html><head><title></title>');
        newWin.document.write('<style>table, td, th {  border: 1px solid #ddd;  text-align: left; } ');
        newWin.document.write('table { border-collapse: collapse; width: 100%;} ');
        newWin.document.write('th, td {padding: 10px;}');
        newWin.document.write('</style>');
        newWin.document.write('</head><body >');
        newWin.document.write(divToPrint.innerHTML);
       // newWin.document.write('<table><tr><th>Hello</th><th>Hello2</th></tr><tr><td>Hello</th><td>Hello2</td></tr></table>');
        newWin.document.write('</body></html>');
        newWin.print();
        newWin.close();

        return false;
    }
</script>
                   
 