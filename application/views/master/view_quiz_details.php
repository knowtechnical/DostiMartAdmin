<!-- Advanced Form Start -->
<div class="advanced-form-area mg-b-15">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list mt-b-30">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Quiz Details</h1>
                                </div>
                            </div>
                         
                            <div class="sparkline12-graph">
                                <div class="input-knob-dial-wrap">
<form class="form-horizontal style-form" method="POST" action="<?= site_url();?>/edit_quiz/<?= $this->uri->segment(2, 0);?>" enctype="multipart/form-data">
   <div class="" style="pointer-events: none;cursor: default; ">
   <div class="form-group-inner">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="q_name">Quiz Name</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="q_name" name="q_name" class="form-control" placeholder="Enter Quiz Name" value="<?php if (isset($row['q_name'])) echo $row['q_name'] ?>" value="<?php if (isset($row['q_name'])) echo $row['q_name'] ?>" />
            </div>
        </div>
    </div> 
    
    <div class="form-group-inner">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label class="login2 pull-right pull-right-pro" for="q_quantity">Start Date</label>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <input type="text"  id="date1" name="q_start_date" class="form-control date1" placeholder="Choose Date" value="<?php if (isset($row['q_start_date'])) echo $row['q_start_date'] ?>" value="<?php if (isset($row['q_start_date'])) echo $row['q_start_date'] ?>" />
            </div>
        </div>
    </div>

    <div class="multi-field-wrapper">
    <div class="multi-fields">
    <div class="multi-field">
     
            <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="login2 pull-right pull-right-pro" for="q_question">Quesion</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text"  id="q_question" name="q_question" class="form-control" placeholder="Enter Question" value="<?php if (isset($row['q_question'])) echo $row['q_question'] ?>" />
                </div>
            </div>
            </div>
            <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="login2 pull-right pull-right-pro" for="q_op1">Option 1</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text"  id="q_op1" name="q_op1" class="form-control" placeholder="Enter Option 1" value="<?php if (isset($row['q_op1'])) echo $row['q_op1'] ?>" />
                </div>
            </div>
            </div>
            <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="login2 pull-right pull-right-pro" for="q_op2">Option 2</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text"  id="q_op2" name="q_op2" class="form-control" placeholder="Enter Option 2" value="<?php if (isset($row['q_op2'])) echo $row['q_op2'] ?>" />
                </div>
            </div>
            </div>
            <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="login2 pull-right pull-right-pro" for="q_op3">Option 3</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text"  id="q_op3" name="q_op3" class="form-control" placeholder="Enter Option 3" value="<?php if (isset($row['q_op3'])) echo $row['q_op3'] ?>" />
                </div>
            </div>
            </div>
            <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="login2 pull-right pull-right-pro" for="q_op4">Option 4</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="text"  id="q_op4" name="q_op4" class="form-control" placeholder="Enter Option 4"  value="<?php if (isset($row['q_op4'])) echo $row['q_op4'] ?>"/>
                </div>
            </div>
            </div>
            <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="login2 pull-right pull-right-pro" for="q_answer">Answer</label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <select  id="q_answer" name="q_answer" class="form-control" >
                    <option value="1" <?= $row['q_answer']=='1'?'selected':'';?> >Option 1</option>
                    <option value="2" <?= $row['q_answer']=='2'?'selected':'';?>>Option 2</option>
                    <option value="3" <?= $row['q_answer']=='3'?'selected':'';?> >Option 3</option>
                    <option value="4" <?= $row['q_answer']=='4'?'selected':'';?> >Option 4</option>
                </select>
                </div>
            </div>
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
                        <a href="<?= site_url();?>/view_quiz"><button class="btn btn-white" type="button">Cancel</button></a>                                                     
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
        

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
        $('.multi-field-wrapper').each(function () {
            var $wrapper = $('.multi-fields', this);
            $(".add-field", $(this)).click(function (e) {
                $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            });
            $('.multi-field .remove-field', $wrapper).click(function () {
                if ($('.multi-field', $wrapper).length > 1)
                    $(this).parent('.multi-field').remove();
            });
        });
</script>