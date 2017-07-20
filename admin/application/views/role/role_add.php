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
          <h2><?php echo ucwords($title);?></h2>
        </div>

      <!-- Admin over view .col-md-12 col-md-offset-3-->
        <div class="col-md-12">
          <div  class="panel panel-default">


          <div class="panel-heading">
          <div class="panel-title"> <i class="fa fa-edit"></i> <?php echo ucwords($title);?>
            <div class="bars pull-right"> <a href="#"><i class="maximum fa fa-expand" data-toggle="tooltip" data-placement="bottom" title="Maximize"></i></a> <a href="#"><i class="minimize fa fa-chevron-down" data-toggle="tooltip" data-placement="bottom" title="Collapse"></i></a> </div>
          </div>
        </div>
            <div class="panel-body"> 

<!-- middel content section --> 
             <div class="row"> 
				<div class="panel-body">
					<form action="" role="form" id="form1" novalidate method="post">
						<div class="row">
							
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">
										Role <span class="symbol required" aria-required="true"></span>
									</label>
									<input type="text" placeholder="Insert your role" class="form-control" id="role" name="role">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-7">
						<p></p>
						</div>
							<div class="col-md-2">
							  <a href="<?php echo base_url('User/role');?>" class="btn btn-light-grey btn-block">								
									<i class="fa fa-arrow-circle-left"></i> <?php echo BACK; ?>  							
							  </a>
							</div>
							<div class="col-md-3">
							  <a href="<?php echo base_url('User/addRole');?>">
								<button class="btn btn-success btn-block" type="submit">
									<?php echo SAVE; ?>  <i class="fa fa-arrow-circle-right"></i>
								</button>
							  </a>
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
		                role: {
		                    minlength: 2,
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
