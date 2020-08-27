  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        <div class="col-md-2"><h1>Advertisment Table(<span id="show_tablecount"><?= count($result);?></span>)<input type="hidden" id="tablecount" value="<?= count($result);?>"></h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                         
                    
                    <div class="add-product">
                        <a href="<?= site_url();?>/add_advertisment" style="top: 10px !important;">Add Advertisment</a>
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
                    <th>Short Name</th>
                    <th>Amount</th>
                    <!-- <th>Total Amount</th> -->
                    <th>Start Date</th>
                    <th>End Date</th>
                    
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($result)){
                $count = 1;
                foreach ($result as $value) {
                
            ?>
                <tr id="delete<?= $value['a_id']; ?>">
                    <td></td>
                    <td><?=  $count ?></td>
                    <td> <?=  $value['a_name']; ?></td>
                    <td> <?=  $value['a_amount']; ?></td>
                    <!-- <td> <?=  $value['a_total_amount']; ?></td>                                                 -->
                    <td> <?=  $value['a_start_date']; ?></td>
                    <td> <?=  $value['a_end_date']; ?></td>
                    <td> <?= $value['status']==1?'Active':'Deactive'; ?></td>
                    <td>
                    <a href="<?= site_url(); ?>/view_advertisment_details/<?= $value['a_id']; ?>"><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                    <?php if($_SESSION['all']['l_role'] == 'superadmin'){?>  
                    <a href="<?= site_url(); ?>/edit_advertisment/<?= $value['a_id']; ?>"><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <a onclick="deleterow(<?= $value['a_id']; ?>);"><button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a>
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
        var deleteid = 'a_id';
        var tdeletecolumn = 'a_delete';     
        var tablename = 'advertisment';      
        $.ajax({
            type: "post",
            url: "<?php echo site_url('/deleterow/') ?>",
            data: {id:id,deleteid:deleteid,tablename:tablename,tdeletecolumn:tdeletecolumn},
            datatype: "text",
            success: function(data){                
                if(data == 'success'){  
                    $("#tablecount").val($("#tablecount").val() - 1);
                    $("#show_tablecount").html($("#tablecount").val());                  
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
    
