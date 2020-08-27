  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <div class="col-md-2"><h1>Orders Table(<span id="show_tablecount"><?= count($result);?></span>)<input type="hidden" id="tablecount" value="<?= count($result);?>"></h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>   

                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="login2 pull-right pull-right-pro" for="fk_shop_id"></label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <select id="" name="save_delivery_status" class="form-control" onchange="table_search(this.value);" style="width:300px;margin-left:150px;margin-bottom:-24px;" >
                        <option >Select Status</option>                        
                        <option value="2">Assigned Orders</option>  
                        <option value="3">Picked Orders</option>  
                        <option value="4">Completed Orders</option>
                        <option value="5">Cancelled Orders</option>                                               
                    </select>
                    
                    </div>
                </div>

                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control dt-tb">
                                    <option value="">Export Basic</option>
                                    <option value="all">Export All</option>
                                    <option value="selected">Export Selected</option>
                                </select>
                            </div>
                       
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
            data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th>Sr No</th>
                    <th>Order Id</th>
                    <th>User Name</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                   <th>Assign Order</th>
                                                         
                            <th>Action</th>
                          
                </tr>
            </thead>
            <tbody>
            <?php if(isset($result)){
                $count = 1;
                foreach ($result as $value) {
                $order_id = $value['order_id'];
               
            ?>
                <tr id="delete<?= $value['o_id']; ?>">
                    <td></td>
                    <td><?=  $count ?>
                       
                        <input type="hidden" id="customer_name_table<?=$order_id;?>" value="<?=$value['l_name'];?>">
                    </td>
                    <td> <?=  $value['order_id']; ?></td>
                    <td> <?=  $value['l_name']; ?></td>
                    <td> <?=  $value['o_amount']; ?></td>
                    <td> <?=  $value['o_quantity']; ?></td>
                   <td>
                    <?php if($value['status'] == 1){?>
                        <button type="button" class="btn btn-success" onclick="assign_delivery('<?= $order_id;?>');" >Assign Delivery</button>
                    <?php }else{?>
                        <button type="button" class="btn btn-primary" onclick="assign_delivery('<?= $order_id;?>')"; ><?php $status = array('0'=>'Deleted','1'=>'In Process','2'=>'Assigned','3'=>'Picked','4'=>'Delivered','5'=>'Cancelled'); echo $status[$value['status']]; ?></button>
                    <?php }?>
                        
                    </td>
               
                    <td>
                    <a href="<?= site_url(); ?>/view_order_details/<?= $value['order_id']; ?>"><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                    <?php if($_SESSION['all']['l_role'] == 'superadmin'){?>   
                <a onclick="deleterow(<?= $value['o_id']; ?>);"><button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a>
                <?php } ?>
                    </td>
                    
                </tr>
                <?php   $count++;    }}      ?>
            </tbody>
        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>  
      

         <div id="addmodal" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-1">
                        <h4 class="modal-title">Assign Order To Delivery Person</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/order_status_by_dperson" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group-inner">
                   
                                        
                    <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        Order Id:<h4 class="login2 pull-right pull-right-pro" id="order_id_modal" for="fk_shop_id"></h4>
                    </div>  
                    </div>
                    <div class="clerfix"></div>
                        <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                        Customer Name<h4 style="margin-left:55px;" class="login2 pull-right pull-right-pro" id="customer_name_modal" for="fk_shop_id"></h4>
                    </div>
                    </div>
                    <div class="clerfix"></div>
                    <input type="hidden" id="save_order_id_modal" name="save_order_id_modal" value="">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="login2 pull-right pull-right-pro" for="fk_shop_id">Select Delivery Person</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <select id="" name="save_delivery_status" class="form-control"  >
                        <option value="3">Picked</option>  
                        <option value="4">Delivered</option>  
                        <option value="5">Cancelled</option>                                  
                    </select>
                    
                    </div>
                </div>
    
                    </div>
                    </div>
                    <div class="modal-footer">
                    <div class="login-horizental cancel-wp pull-right form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Submit</button>
                        <button class="btn btn-white" data-dismiss="modal" type="button">Cancel</button>                                         
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>    
              
<script>
    function deleterow(id){
        // alert(id);
        var deleteid = 'o_id';
        var tdeletecolumn = 'o_delete';     
        var tablename = 'sale_order';      
        $.ajax({
            type: "post",
            url: "<?php echo site_url('/deleterow/') ?>",
            data: {id:id,deleteid:deleteid,tablename:tablename,tdeletecolumn:tdeletecolumn},
            datatype: "text",
            success: function(data){                
                if(data == 'success'){   
                    $("#tablecount").val($("#tablecount").val() - 1);
                    $("#show_tablecount").html($("#tablecount").val()); 
                    //alert(tablecount);               
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

    function table_search(order_status) {       
      
         config_url = "<?php echo site_url(); ?>";+"/view_orders_dperson?order_status"+order_status;
         url = config_url+"/view_orders_dperson?order_status="+order_status;
        // alert(url);    
         window.location = url;
    }

    function assign_delivery(order_id) {       
        $('#addmodal').modal('show');
        $('#order_id_modal').html(order_id); 
        $('#save_order_id_modal').val(order_id);     
        $('#customer_name_modal').html($("#customer_name_table"+order_id).val());        
    }
</script>
    
