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
                  <form action="<?php echo base_url('staticPages/addSlider'); ?>" role="form" id="form1" novalidate method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <?php if(!empty($message)){ ?>
                          <div class="alert alert-danger"> <?php echo $message;  ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label"> Text Position <span class="symbol required" aria-required="true"></span> </label>
                          <select class="form-control" name="position" id="position" >
                            <?php $position = array('left_top' => 'Left Top','left_bottom' => 'Left Bottom','right_top' => 'Right Top','right_bottom' => 'Right Bottom');
									
									    foreach($position as $key => $val){ 
										  ?>
                            <option value="<?php echo $key; ?>"><?php echo ucfirst($val); ?></option>
                            <?php }
									
									 ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label class="control-label"> Title <span class="symbol required" aria-required="true"></span> </label>
                          <input type="text" placeholder="Insert title" class="form-control" id="title" name="title">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"> Description <span class="symbol required" aria-required="true"></span> </label>
                          <input type="text" placeholder="Insert Description" class="form-control" id="description" name="description">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"> Image Upload <span class="symbol required" aria-required="true"></span> </label>
                          <input type="file" class="form-control" id="img" name="img" style="height: 100%;" accept="image/*">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label"> Status <span class="symbol required" aria-required="true"></span> </label>
                          <select class="form-control" name="status" id="status" >
                            <?php echo status(); ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-7">
                        <p></p>
                      </div>
                      <div class="col-md-2"> <a href="<?php echo base_url('staticPages/slider');?>" class="btn btn-light-grey btn-block"> <i class="fa fa-arrow-circle-left"></i> <?php echo BACK; ?> 	 </a> </div>
                      <div class="col-md-3"> 
                        <button class="btn btn-success btn-block" type="submit"> <?php echo SAVE; ?> 	 <i class="fa fa-arrow-circle-right"></i> </button>
                         </div>
                    </div>
                  </form>
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
<script type="text/javascript">
	/* $('#example1').dataTable({
		    	responsive: true
		    });*/
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
		                img: {
		                     required: true
		                },
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
