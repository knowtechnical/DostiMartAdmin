 
  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <div class="col-md-2"><h1>Product Table(<?= count($result);?>)</h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                         
                   
                    <div class="add-product">
                        <a href="<?= site_url();?>/add_product" style="top: 10px !important;">Add Product</a>
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
                    <th data-sortable="true" data-field="category">Category</th>
                    <th data-sortable="true" data-field="sub_category">Sub-Category</th>
                    <th data-sortable="true" data-field="name">Name</th>
                    <th data-sortable="true" data-field="mrp">MRP</th>
                    <th data-sortable="true" data-field="selling_price">Selling Price</th>
                    <th data-sortable="true" data-field="quantity">Quantity</th>
                    <th data-sortable="true" data-field="discount_rate">Discount Rate(%)</th>
                    <th data-sortable="true" data-field="profile_margin">Profit Margin(%)</th>
                  
                    <th>Action</th>
                           
                </tr>
            </thead>
            <tbody>
            <?php if(isset($result)){
                $count = 1;
                foreach ($result as $value) {
                
            ?>
                <tr id="delete<?= $value['p_id']; ?>">
                    <td></td>
                    <td><?=  $count ?></td>
                    <td> <?=  $value['c_name']; ?></td>
                    <td> <?=  $value['s_name']; ?></td>
                    <td>  <?= " ".$value['p_name']." (".$value['brand_name'].") - ".$value['p_quantity_description']; ?></td>  
                    <td> <?=  $value['p_market_amount']; ?></td>                                              
                    <td> <?=  $value['p_amount']; ?></td>
                     <?php  
                            if($value['p_quantity'] <= 2) {
                                    echo "<td class='red-box'>".$value['p_quantity']."</td>";
                            } else {
                                echo "<td>".$value['p_quantity']."</td>";
                            }
                     ?>
                    <td> <?=  $value['discount_rate']; ?></td>
                    <td> <?=  $value['profile_margin']; ?></td>
                    <td>
                    <a href="<?= site_url(); ?>/view_product_details/<?= $value['p_id']; ?>">
                        <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-info-circle" aria-hidden="true"></i>
                    </button>
                    <?php if($_SESSION['all']['l_role'] == 'superadmin'  ||  $_SESSION['all']['l_role'] == 'admin' || $_SESSION['all']['l_role'] == 'vendor'){?>     
                        <a href="<?= site_url(); ?>/edit_product/<?= $value['p_id']; ?>">
                            <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </a>
                         
                    <?php } ?>
                    <?php if($_SESSION['all']['l_role'] == 'superadmin'){?>   
                        <a onclick="return deleterow(<?= $value['p_id']; ?>);">
                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>
                        </a>
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
              
<script>
    function deleterow(id){
        // alert(id);
        conf = confirm('Are you sure , you want to delete?');
        if(conf) {
            var deleteid = 'p_id';
            var tdeletecolumn = 'p_delete';     
            var tablename = 'product';      
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
    }
</script>
    
