
<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid" id="print_view">
            <button class="btn btn-primary" id="print_view" onclick="return onPrint();">Print</button>
            </div>
            <div class="container-fluid" id="print_view">
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="table_preview">
                   
                        <div class="profile-info-inner">
                        <center><h1> DostiMart </h1>
                        <p style="margin:0px;">
                            801 Yasrab Society, Inayat Nagar, Near star water plant, 431401, Parbhani
                            <p style="margin:0px;">+91-9422917079</p>
                        </p>
                        </center>
                        <table class="table table-bordered" >
                            <tbody>
                                <tr>
                                    <td><strong>Order Date</strong></td>
                                    <td><?php if (isset($result[0]['o_date'])) echo $result[0]['o_date'] ?></td>
                                    
                                    <td><strong>Order ID</strong></td>
                                    <td><?php if (isset($result[0]['order_number'])) echo $result[0]['order_number'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Delivery Mode</strong></td>
                                    <td><?php if (isset($result[0]['delivery_mode'])) echo $result[0]['delivery_mode'] ?></td>
                                    
                                    <td><strong>Customer Name</strong></td>
                                    <td><?php if (isset($result[0]['l_name'])) echo $result[0]['l_name'] ?></td>    
                                </tr>
                                <tr>
                                    <td><strong>Customer Mobile</strong></td>
                                    <td><?php if (isset($result[0]['customer_mobile'])) echo $result[0]['customer_mobile'] ?></td>

                                    <td><strong>Customer Address</strong></td>
                                    <td><?php if (isset($result[0]['house_no'])) 
                                                    echo $result[0]['house_no']." ".$result[0]['street_address'].", ".$result[0]['apartment_name'].", ".$result[0]['landmark'].", ".$result[0]['pincode'].", ".$result[0]['city']
                                        ?>                
                                    </td>   
                                </tr>
                            </tbody>    
                        </table>

                        <h1>Product Items</h1>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th>Product Name</th>
                                    <th>MRP</th>
                                    <th>Qty</th>
                                    <th>Disc.</th>
                                    <th>DM Rate</th>
                                    <th>Amount</th>
                                    
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
                                                    <td> <?= " ".$value['product_name']." - ".$value['p_quantity_description']."<strong> (".$value['brand_name'].")</strong>  "; ?></td> 
                                                    <td> <?=  $value['mrp']; ?></td>                  
                                                    <td> <?=  $value['p_quantity']; ?></td>
                                                    <td> <?=  $value['discount_amount']; ?></td> 
                                                    <td> <?=  $value['p_amount']; ?></td> 
                                                    <td> <?=  $value['item_total_amount']; ?></td> 
                                                     
                                                   
                                                </tr>
        
                                <?php           $count++;
                                            }
                                        }
                                ?>
                                <tr>
                                    <td colspan=6>Total Amount</td>
                                    <td><?php if (isset($result[0]['order_items_total_amount'])) echo $result[0]['order_items_total_amount'] ?></td>
                                </tr>
                                <?php if(isset($result[0]['delivery_mode']) && $result[0]['delivery_mode'] == 'PickUp'){ ?>
                                <tr>
                                    <td colspan=6>PickUp Discount</td>
                                    <td>-<?php if (isset($result[0]['pickup_discount_amount'])) echo number_format((float)$result[0]['pickup_discount_amount'], 2, '.', ''); ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan=6>Delivery Charges</td>
                                    <td><?php if (isset($result[0]['order_delivery_charge_amount'])) echo number_format((float)$result[0]['order_delivery_charge_amount'], 2, '.', ''); ?></td>
                                </tr>
                                <tr>
                                        <td colspan=6><strong>Amount Payable</strong></td>
                                        <td><strong><?php if (isset($result[0]['order_total_amount'])) echo round($result[0]['order_total_amount']); ?></strong></td>
                                </tr>
                                 <tr>
                                        <td colspan=7>
                                        <span style='font-family:"Comic Sans MS", cursive, sans-serif'>
                                            You have saved
                                            <?php if (isset($result[0]['order_savings_amount'])) echo number_format((float)$result[0]['order_savings_amount'], 2, '.', ''); ?>
                                        </span>
                                       </td>
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
    
    function onDeleteItem(){
        cs = confirm('Are you sure, you want to delete?');
        
        return cs;
    }
</script>
                   
 