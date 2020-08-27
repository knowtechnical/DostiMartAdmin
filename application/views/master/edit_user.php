<!-- Advanced Form Start -->
<div class="advanced-form-area mg-b-15">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list mt-b-30">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Edit User</h1>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="input-knob-dial-wrap">
                                <form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/edit_user/<?=$row['l_id']?>" enctype="multipart/form-data">
                                    <div class="form-group-inner">
                                    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label class="login2 pull-right pull-right-pro" for="l_name">Full Name</label>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="l_name" name="l_name" class="form-control" placeholder="Enter Full Name" value="<?php if (isset($row['l_name'])) echo $row['l_name'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group-inner">
                                    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label class="login2 pull-right pull-right-pro" for="l_mobile">Mobile</label>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="l_mobile" name="l_mobile" class="form-control" placeholder="Enter Mobile Number" value="<?php if (isset($row['l_mobile'])) echo $row['l_mobile'] ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group-inner">
                                    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label class="login2 pull-right pull-right-pro" for="l_email">Email</label>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="l_email" name="l_email" class="form-control" placeholder="Enter Email" value="<?php if (isset($row['l_email'])) echo $row['l_email'] ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group-inner">
                                    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label class="login2 pull-right pull-right-pro" for="l_password">Password</label>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="l_password" name="l_password" class="form-control" placeholder="Enter Password" value="<?php if (isset($row['l_password'])) echo $row['l_password'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label class="login2 pull-right pull-right-pro" for="l_role">Role</label>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <select id="l_role" name="l_role" class="form-control" >
                                                <option value="">Select Role</option>
                                                <option value="admin" <?= $row['l_role']== 'admin'?'selected':'';?>>Admin Role</option>
                                                <option value="vendor" <?= $row['l_role']== 'vendor'?'selected':'';?>>Vendor Role</option>
                                                <option value="delivery_person" <?= $row['l_role']== 'delivery_person'?'selected':'';?>>Delivery Person</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
									
									 <div class="form-group-inner">
                                    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label class="login2 pull-right pull-right-pro" for="fk_zone_id">Zone</label>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <select id="fk_zone_id" name="fk_zone_id" class="form-control validate[required] text-input" onchange="get_category_from_shop(this.value);" >
											<option value="">Select Zone</option>
											<?php foreach($zone as $shoprow){ ?>
											<option value="<?= $shoprow['z_id']; ?>"    <?= $row['fk_zone_id'] == $shoprow['z_id']?'selected':''; ?> ><?= $shoprow['z_name']; ?></option>
											<?php } ?>                
											</select>
											</div>
										</div>
									</div>

                                    <div class="form-group-inner">
                                        <div class="login-btn-inner">
                                            <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-9">
                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="update">Submit</button>
                                                        <a href="<?= site_url();?>/view_user"><button class="btn btn-white" type="button">Cancel</button></a>                                                     
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