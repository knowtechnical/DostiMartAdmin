  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        <div class="col-md-4"><h1>Push Notification Table(<span id="show_tablecount"><?= count($result);?></span>)<input type="hidden" id="tablecount" value="<?= count($result);?>"></h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                         
                    
        <div class="add-product">
        <a class="Primary mg-b-10" href="#" data-toggle="modal" data-target="#addmodal">Sned Notification</a>
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
                            <th>Zone</th> 
                            <th>Title</th>  
                                                                     
                            <th>Message</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($result)){
                        $count = 1;
                        foreach ($result as $value) {
                        
                    ?>
                        <tr id="delete<?= $value['pn_id']; ?>">
                            <td></td>
                            <td><?=  $count ?></td>
                           <td> <?= $value['z_name']; ?></td>
						   <td> <?= $value['title']; ?></td>
						   <td> <?= $value['message']; ?></td>                 
                           
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
                        <h4 class="modal-title">Send Notification</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/view_pushnotification" enctype="multipart/form-data">
                    <div class="modal-body">
                   
					
					 <div class="form-group-inner">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="login2 pull-right pull-right-pro" for="fk_zone_id">Select Zone</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <select id="fk_zone_id" name="fk_zone_id" class="form-control validate[required] text-input">
									<option value="">Select Shop</option>
									<?php foreach($zone as $shoprow){ ?>
									<option value="<?= $shoprow['z_id']; ?>" ><?= $shoprow['z_name']; ?></option>
									<?php } ?>                
								</select>
                            </div>
                        </div>
                    </div>
					
					 <div class="form-group-inner">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="login2 pull-right pull-right-pro" for="title">Title</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="title" name="title" class="form-control validate[required] text-input" placeholder="Enter Title Name" />
                            </div>
                        </div>
                    </div>
					
					 <div class="form-group-inner">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="login2 pull-right pull-right-pro" for="message">Message</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="message" name="message" class="form-control validate[required] text-input" placeholder="Enter Message Name" />
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
           