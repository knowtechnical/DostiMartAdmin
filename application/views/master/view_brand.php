  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        <div class="col-md-2"><h1>Brand Table(<span id="show_tablecount"><?= count($result);?></span>)<input type="hidden" id="tablecount" value="<?= count($result);?>"></h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                         
                    
        <div class="add-product">
        <a class="Primary mg-b-10" href="#" data-toggle="modal" data-target="#addmodal">Add Brand</a>
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
                    data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th>Sr No</th>
                            <th>Name</th> 
                            <th>Status</th>  
                                                                     
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($result)){
                        $count = 1;
                        foreach ($result as $value) {
                        
                    ?>
                        <tr id="delete<?= $value['b_id']; ?>">
                            <td></td>
                            <td><?=  $count ?></td>
                            <td style="overflow-wrap: break-word; word-wrap: break-word;"><p class="<?= 'rowbrandname'.$value['b_id'];?>"> <?=  $value['b_name']; ?></p><input type="hidden" id="<?= 'rowbrand'.$value['b_id'];?>" value="<?= $value['b_name'];?>"></td>
                            <td> <?= $value['status']==1?'Active':'Deactive'; ?></td>
                          
                            <td>
                            <a class="Primary mg-b-10" href="#" data-toggle="modal" data-target="#editmodal" onclick="editbrandgetname(<?= $value['b_id'];?>);"><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <a onclick="deleterow(<?= $value['b_id']; ?>);"><button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a>
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
                        <h4 class="modal-title">Add Brand</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/view_brand" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group-inner">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="login2 pull-right pull-right-pro" for="b_name">Brand Name</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="b_name" name="b_name" class="form-control validate[required] text-input" placeholder="Enter Brand Name" />
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
      
        <div id="editmodal" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-1">
                        <h4 class="modal-title">Edit Brand</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/view_brand" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group-inner">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="login2 pull-right pull-right-pro" for="editbrand_name">Brand Name</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="editbrand_name" name="b_name" class="form-control validate[required] text-input" placeholder="Enter Brand Name" />
                                <input type="hidden" id="editbrand_id" name="" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <div class="login-horizental cancel-wp pull-right form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" type="button" name="update" onclick="edit_table(this.value);">Update</button>
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
        var deleteid = 'b_id';
        var tdeletecolumn = 'b_delete';     
        var tablename = 'brand';      
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

    function editbrandgetname(id){
        $('#editbrand_name').val($('#rowbrand'+id).val());
        $('#editbrand_id').val(id);
    }

    function edit_table(){

        
        var id = $('#editbrand_id').val();
        var editid = 'b_id';         
        var tablename = 'brand';  
        var b_name = $('#editbrand_name').val();
        
        $.ajax({
            type: "post",
            url: "<?php echo site_url('/edit_table/') ?>",
            data: {id:id,editid:editid,tablename:tablename,b_name:b_name},
            datatype: "text",
            success: function(data){                
                if(data == 'success'){ 
                    $('#editmodal').modal('hide');    
                    $('#rowbrand'+id).val(b_name);    
                    $('.rowbrandname'+id).text(b_name);               
                   $("#responsemsg").addClass("hide_respons");                   
                    $('#responsemsg').show();
                    $('#responsemsg').html('Updated Sucessfully.');

                }else{                    
                    $("#responsemsg").addClass("hide_respons");
                    $('#responsemsg').show();
                    $('#responsemsg').html('Error!');
                }            
            }
        });
    }
</script>
    
</script>
           