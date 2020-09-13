<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">

                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <div class="col-md-2"><h1>Purchase List(<?= count($purchaseList);?>)</h1></div>
                            <div class="col-md-6"><center><h1><span id="responsemsg" style="color:green;" >
                            <?php if(isset($_SESSION['responsemsg'])){echo $_SESSION['responsemsg'];unset($_SESSION['responsemsg']);}?>
                            </span></center></h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>       
                
                    <div class="add-product">
                        <a href="<?= site_url();?>/add_purchase" style="top: 10px !important;">Add Purchase</a>
                    </div>
                    <br>
                    <!-- Purchase Table -->
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">

                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                    data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th>Sr No</th>
                                            <th data-sortable="true" data-field="bill_date">Bill Date</th>
                                            <th data-sortable="true" data-field="bill_no">Bill No</th>
                                            <th data-sortable="true" data-field="name">Supplier Name</th>
                             
                                        
                                            <th>Action</th>
                                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($purchaseList)){
                                        $count = 1;
                                        foreach ($purchaseList as $value) {
                                        
                                    ?>
                                        <tr id="delete<?= $value['id']; ?>">
                                            <td></td>
                                            <td><?=  $count ?></td>
                                            <td> <?=  $value['bill_date']; ?></td>
                                            <td> <?=  $value['bill_no']; ?></td>
                                            <td> <?=  $value['name']; ?></td>
                                            <td>
                                            <a href="<?= site_url(); ?>/view_purchase_details/<?= $value['id']; ?>">
                                                <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </button>
                                            <?php if($_SESSION['all']['l_role'] == 'superadmin'  ||  $_SESSION['all']['l_role'] == 'admin' || $_SESSION['all']['l_role'] == 'vendor'){?>     
                                                <a href="<?= site_url(); ?>/edit_purchase/<?= $value['id']; ?>">
                                                    <button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
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