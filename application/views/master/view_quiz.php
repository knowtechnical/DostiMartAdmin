  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        <div class="col-md-2"><h1>Quiz Table(<span id="show_tablecount"><?= count($result);?></span>)<input type="hidden" id="tablecount" value="<?= count($result);?>"></h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
							   <div class="row ">	
								<a href="<?= site_url();?>/add_quiz"><button class="btn btn-info" style="margin-left:190px;background: #006DF0;" >Add Quiz</button></a>					  
								<a class="Primary mg-b-10" href="#" data-toggle="modal" data-target="#addmodal"><button class="btn btn-info" style="background: #006DF0;">Add Text</button></a>						   
							</div>
                            <div class="clearfix"></div>
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
                    <th>Quiz Name</th>
                    <th>Start Date</th>
                    <th>Show Winner</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($result)){
                $count = 1;
                foreach ($result as $value) {
                
            ?>
                <tr id="delete<?= $value['q_id']; ?>">
                    <td></td>
                    <td><?=  $count ?></td>
                    <td> <?=  $value['q_name']; ?></td>
                    <td> <?=  $value['q_start_date']; ?></td>    
                    <td>  <button class="btn btn-sm btn-success winner<?= $value['q_id'];?>" type="button" onclick="select_winner(<?= $value['q_id'];?>)" ><?= $value['q_winning_status']=='0'?"Select Winner":$value['l_name'];?></button></td>                
                    <td> <?= $value['status']==1?'Active':'Deactive'; ?></td>
                    <td>
                    <a href="<?= site_url(); ?>/view_quiz_details/<?= $value['q_id']; ?>"><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                   <?php if($_SESSION['all']['l_role'] == 'superadmin'){?>  
                    <a href="<?= site_url(); ?>/edit_quiz/<?= $value['q_id']; ?>"><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <a onclick="deleterow(<?= $value['q_id']; ?>);"><button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a>
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
                        <h4 class="modal-title">Add Text</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/add_text" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group-inner">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label class="login2 pull-right pull-right-pro" for="b_name">Add Text</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="add_text" name="add_text" class="form-control validate[required] text-input" placeholder="Enter Text" value="<?php if (isset($add_text['add_text'])) echo $add_text['add_text'] ?>"/>
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
        var deleteid = 'q_id';
        var tdeletecolumn = 'q_delete';     
        var tablename = 'quiz';      
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

    function select_winner(id){
        alert(id);            
        $.ajax({
            type: "post",
            url: "<?php echo site_url('/select_winner/') ?>",
            data: {quiz_id:id},
            datatype: "text",
            success: function(data){
                console.log(data);                
                if(data == 'Success'){ 
                    $(".winner"+id).removeAttr("onclick");
                    $(".winner"+id).html("Jivan Borole");
                }else{                    
                    alert(2222);
                }            
            }
        });
    }
</script>
    
