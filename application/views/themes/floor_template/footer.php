 
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <!-- <p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery
		============================================ -->
    
    <!-- bootstrap JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/counterup/waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/counterup/counterup-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/tableExport.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/data-table-active.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table-editable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-editable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/colResizable-1.5.source.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/data-table/bootstrap-table-export.js"></script>

      <!-- summernote JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/summernote/summernote.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/summernote/summernote-active.js"></script>

  <!-- validationEngine JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/metisMenu/metisMenu-active.js"></script>
    <!-- lightslider JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/lightslider.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sparkline/sparkline-active.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css">
    <!-- calendar JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/calendar/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/calendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/tawk-chat.js"></script> -->
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
			$(document).ready(function() {
        $(".font-lato").css({"display": "none"});
      
        $('#fk_category_id').multiselect({
nonSelectedText: 'Select Category'
});

            setTimeout(function() {            
              $('#responsemsg,.hide_respons').hide();
            }, 3000);

            jQuery(".style-form").validationEngine();

            $(".add-more").click(function(){ 
              var html = $(".copy").html();
              $(".after-add-more").after(html);
            });

          $("body").on("click",".remove",function(){ 
              $(this).parents(".control-group").remove();
          });

          

			});

    // $('.add_more_count').click(function() {      
    //     var a_amount = $('#a_amount').val();
    //     var output = $('#output').val();
    //     $('#output').val(parseInt(output) + 1);
    //     var plus_output = parseInt(output) + 1;        
    //     $('#a_total_amount').val(parseInt(plus_output) * parseInt(a_amount));      
    // });

    

    // function myFunction() {         
    //     var a_amount = $('#a_amount').val();
    //     var output = $('#output').val();
    //     $('#output').val(parseInt(output) - 1);
    //     var plus_output = parseInt(output) - 1;        
    //     $('#a_total_amount').val(parseInt(plus_output) * parseInt(a_amount));      
    // }
			
$('.date1,.date2').datepicker({
    changeMonth: true,
    changeYear: true, 
    dateFormat: "dd-mm-yy",
});

$( document ).ready(function() {
      get_notification();
      get_home_type();
      
});

        setInterval(function () {
          $.ajax({
            type: "post",
            url: "<?php echo site_url('/get_notification/') ?>",
            //: 'fk_shop_id=' + fk_shop_id,
            datatype: "text",
            success: function (data) {
               // alert(data);
              //   $(".shownoti").html(data);
              count = parseInt(data);
              if(count == previous_count){
                
              } else {
                var audio = new Audio("<?php echo base_url(); ?>assets/audio/ding-sound-effect_2.mp3");
                audio.play();
              }

              $(".show_count").html(data);
              previous_count = count;
                
            }
        });
}, 5000);

  previous_count = 0;
  function get_notification() {

    $.ajax({
            type: "post",
            url: "<?php echo site_url('/get_notification/') ?>",
            //: 'fk_shop_id=' + fk_shop_id,
            datatype: "text",
            success: function (data) {
               // alert(data);
             //   $(".shownoti").html(data);
              $(".show_count").html(data);
              count = parseInt(data);
              previous_count = count;
            }
        });
    }

    function get_notification_list() {
    $.ajax({
            type: "post",
            url: "<?php echo site_url('/get_notification_list/') ?>",
            //: 'fk_shop_id=' + fk_shop_id,
            datatype: "text",
            success: function (data) {
                //alert(data);
               // console.log(data);
                $(".get_notification_list").html(data);
            }
        });
    }

   

    function set_home_type(home_type) {
     // alert(home_type);
        $.ajax({
            type: "post",
            url: "<?php echo site_url('/set_home_type/') ?>",
            data: 'home_type=' + home_type,
            datatype: "text",
            success: function (data) {       
             // alert(data);
               // $("#home_type").html(data);
            }
        });
    }

    

    function get_home_type() {
      
    $.ajax({
            type: "post",
            url: "<?php echo site_url('/get_home_type/') ?>",
            //: 'fk_shop_id=' + fk_shop_id,
            datatype: "text",
            success: function (data) {
               // alert(data);
                $("#home_type").val(data);
            }
        });
    }

	</script>
</body>

</html>