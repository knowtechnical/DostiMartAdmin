
        <?php  $this->db->where('l_id',$this->uri->segment(2, 0));$query = $this->db->get('login');$user = $query->result();?>
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="profile-info-inner">
                            <div class="profile-img">
                                <img src="<?php echo base_url(); ?>assets/img/profile/1.jpg" alt="" />
                            </div>
                            <div class="profile-details-hr">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                       
                                            <p><b>Name</b><br /> <?php if (isset($user[0]->l_name)) echo $user[0]->l_name; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>Role</b><br /> <?php if (isset($user[0]->l_role)) echo strtoupper($user[0]->l_role); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Email ID</b><br /><?php if (isset($user[0]->l_email)) echo $user[0]->l_email; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>Phone</b><br /><?php if (isset($user[0]->l_mobile)) echo $user[0]->l_mobile; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="address-hr">
                                            <p><b>Address</b><br /><?php if (isset($user[0]->l_address)) echo $user[0]->l_address; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <h3>500</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <h3>900</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <h3>600</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#show_orders">Show Orders</a></li>                               
                                <li><a href="#quiz_winner">Quiz Winner</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                                <div class="product-tab-list tab-pane fade active in" id="show_orders">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
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
                    <th>Category</th>
                    <th>Shop</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    
                    <th>Status</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($result)){$count = 1;foreach ($result as $value) {?>
                <tr>
                    <td></td>
                    <td><?=  $count ?></td>
                    <td> <?=  $value['category_name']; ?></td>
                    <td> <?=  $value['shop_name']; ?></td>
                    <td> <?=  $value['product_name']; ?></td>                                                
                    <td> <?=  $value['p_amount']; ?></td>
                    <td> <?=  $value['p_quantity']; ?></td>
                    <td> <?= $value['ostatus']==1?'Active':'Deactive'; ?></td>
                    <td> <?=  $value['order_status']; ?></td>                
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


                                <div class="product-tab-list tab-pane fade active in" id="quiz_winner">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>