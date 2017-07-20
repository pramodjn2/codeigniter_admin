<?php $this->load->view('common/header');?>
<?php $this->load->view('common/admin_header'); ?>
<!-- sidebar menu -->
<?php $this->load->view('common/sidebar'); ?>
<!-- /end #sidebar -->

<div id="main" class="main">
  <div class="row"> 
    <!-- breadcrumb section -->
    <div class="ribbon">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url('Dashboard'); ?>">Home</a> </li>
      </ul>
    </div>
    <?php $this->load->view('common/message'); ?>
    <!-- main content -->
    <div id="content">
      <div id="sortable-panel" class="">
        <div id="titr-content" class="col-md-12">
          <h2><?php echo ucwords($title); ?></h2>
        </div>
        
        <!-- Admin over view .col-md-12 col-md-offset-3-->
        <div class="col-md-12">
          <div  class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title"> <i class="fa fa-edit"></i> <?php echo ucwords($title); ?>
                <div class="bars pull-right"> <a href="#"><i class="maximum fa fa-expand" data-toggle="tooltip" data-placement="bottom" title="Maximize"></i></a> <a href="#"><i class="minimize fa fa-chevron-down" data-toggle="tooltip" data-placement="bottom" title="Collapse"></i></a> </div>
              </div>
            </div>
            <div class="panel-body"> 
              
              <!-- middel content section -->
              <div class="row">
                <div class="panel-body">
                
                 
                    <div class="row">
                      
                      <div class="col-md-2">
                        <div class="form-group">
                          <ul id="sortable1" class="connectedSortable">
                          <?php if(!empty($menu_result)) {
							    foreach($menu_result as $key){  
							?>
                           <li data-article-id="<?php echo $key['page_id'];  ?>" class="ui-state-default"> 
                           <span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo ucwords($key['page_title']); ?></li>
                          
                          <?php 	} 
						  		}?>
                          </ul>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div class="form-group">
                          <ul id="sortable2" class="connectedSortable">
                           <?php foreach($result as $record): 
	
	?>
                            <li data-article-id="<?php echo $record['id'];  ?>" class="ui-state-default"> <span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo ucwords($record['page_title']); ?></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-7">
                        <p></p>
                      </div>
                      <div class="col-md-2"> <a href="<?php echo base_url('staticPages/menu');?>" class="btn btn-light-grey btn-block"> <i class="fa fa-arrow-circle-left"></i> <?php echo BACK; ?> 	 </a> </div>
                      <div class="col-md-3">
                        <button class="btn btn-success btn-block" type="button"  onclick="saveOrder('<?php echo $category_id; ?>');"> <?php echo UPDATE; ?> 	 <i class="fa fa-arrow-circle-right"></i> </button>
                        
                      </div>
                    </div>
                 
                 
                </div>
              </div>
              <!-- end #content --> 
            </div>
          </div>
        </div>
        <!-- end of admin over view --> 
      </div>
    </div>
  </div>
  <!-- end .row --> 
</div>
<!-- ./end #main  -->

<?php $this->load->view('common/footer_content');?>
<style>
  .ui-icon-arrowthick-2-n-s{ float:left !important; }
  #sortable1, #sortable2 {
    border: 1px solid #eee;
    width: 172px;
    min-height: 20px;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  }
  #sortable1 li, #sortable2 li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
  }
  </style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script>

 $( function() {
    $( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });
  
 function saveOrder(category_id){
    var articleorder="";
    $("#sortable1 li").each(function(i) {
        if (articleorder=='')
            articleorder = $(this).attr('data-article-id');
        else
            articleorder += "," + $(this).attr('data-article-id');
    });

  		var url = base_url+'staticPages/saveMenyOrder';  
	 	$.ajax({
			type: "POST",
			url: url,
			data: {'order': articleorder, 'category_id': category_id},
		})
		.done(function(result) {
			 alert('menu order update successfully');
		});	
		
		
		
}

  </script> 
<script type="text/javascript">
	$(document).ready(function() {
  
            var form = $('#form1');
            var errorHandler1 = $('.errorHandler', form);
            var successHandler1 = $('.successHandler', form);
            form.validate({
                errorElement: "span", // contain the error msg in a span tag
                errorClass: 'help-block',
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter($(element).closest('.form-group').children('div').children().last());
                    } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                        error.insertAfter($(element).closest('.form-group').children('div'));
                    } else {
                        error.insertAfter(element);
                        // for other inputs, just perform default behavior
                    }
                },
          ignore: "",
                rules: {
                    status: {
                        required: true
                    }
                  },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    successHandler1.hide();
                    errorHandler1.show();
                },
                highlight: function (element) {
                    $(element).closest('.help-block').removeClass('valid');
                    // display OK icon
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                    // add the Bootstrap error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error');
                    // set error class to the control group
                },
                success: function (label, element) {
                    label.addClass('help-block valid');
                    // mark the current input as valid and display OK icon
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                },
                submitHandler: function (form) {
                    successHandler1.show();
                    errorHandler1.hide();
                    // submit form
                     form.submit();
                }
            });
  });
</script>
<?php $this->load->view('common/footer');?>
