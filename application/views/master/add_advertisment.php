<!-- Advanced Form Start -->
<div class="advanced-form-area mg-b-15">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list mt-b-30">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Add Advertisment</h1>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="input-knob-dial-wrap">
<form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/add_advertisment" enctype="multipart/form-data">
<div class="form-group-inner">
    <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_quantity">Start Date</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <input type="text"  id="date1" name="a_start_date" class="form-control date1" placeholder="Choose Date" autocomplete="on" />
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_quantity">End Date</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <input type="text"  id="date2" name="a_end_date" class="form-control date2" placeholder="Choose Date" autocomplete="on" />
            </div>           
        </div>
    </div>
   
   <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_name">Product Name</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="a_name" name="a_name" class="form-control" placeholder="Enter Short Name" />
            </div>
        </div>
    </div> 
<!--
    <div class="form-group-inner">
    <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_page">Select page</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <select  id="a_page" name="a_page" class="form-control" />
                <option>Select Page</option>
                <option value="home" data-amt="300">Home</option>
                <option value="category" data-amt="200">Category</option>
                <option value="order" data-amt="100">Order</option>
            </select>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_position">Select Position</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <select  id="a_position" name="a_position" class="form-control" />
                <option>Select Position</option>
                <option value="top" data-amt="300">Top Of Page</option>
                <option value="middle" data-amt="200">Top Of Middle</option>
                <option value="bottom" data-amt="100">Top Of Bottom</option>
            </select>
            </div>           
        </div>
    </div>
	-->
    
    

    <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
           
                <label class="login2 pull-right pull-right-pro" for="a_amount">Amount</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="number" id="a_amount" name="a_amount" class="form-control"  onkeydown="javascript: return event.keyCode == 69 ? false : true"  placeholder="Enter Amount" />
            </div>
        </div>
    </div>

    <!--<div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
           
                <label class="login2 pull-right pull-right-pro" for="output">Total Amount</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <input type="number" id="a_total_amount" name="a_total_amount" readonly class="form-control"  />
                <input type="hidden" id="output" name="output" class="form-control" value="1" />
            </div>
        </div>
    </div>-->

    
    <div class="form-group-inner after-add-more">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_quantity">Image</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="uploaded_file[]" class="form-control" placeholder="Enter Name Here">
			<br>
			<select class="form-control" style="margin-top: 20px;" name="uploaded_file_position[]">
				<option>Select Position</option>
                <option value="top" data-amt="300">Top Of Page</option>
                <option value="middle" data-amt="200">Middle Of Page</option>
                <option value="bottom" data-amt="100">Bottom Of Page</option>
			</select>
			<div class="input-group-btn"> 
            <button class="btn btn-success add-more add_more_count" type="button"><i class="glyphicon glyphicon-plus"></i> </button>
            </div>
          </div>
            </div>
        </div>
    </div> 

    <div class="form-group-inner">
        <div class="login-btn-inner">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-9">
                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Submit</button>
                        <a href="<?= site_url();?>/view_advertisment"><button class="btn btn-white" type="button">Cancel</button></a>                                                     
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
        <div class="form-group-inner copy hide">
    <div class="row control-group">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="a_quantity">Image</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class=" input-group" style="margin-top:10px">
            <input type="file" name="uploaded_file[]" class="form-control" placeholder="Enter Name Here">
			<br>
			<select class="form-control  addmorepostion" style="margin-top: 20px;" name="uploaded_file_position[]">
				<option>Select Position</option>
                <option value="top" data-amt="300">Top Of Page</option>
                <option value="middle" data-amt="200">Middle Of Page</option>
                <option value="bottom" data-amt="100">Bottom Of Page</option>
			</select>
            <div class="input-group-btn"> 
              <button class="btn btn-danger remove remove_more" type="button" id="remove_more" onclick="myFunction()"><i class="glyphicon glyphicon-remove"></i> </button>
            </div>
          </div>
            </div>
        </div>
    </div>

    <script>
  
    </script>