<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->config->item('site_name'); ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/font-awesome/css/font-awesome.min.css">		
		<!-- <link rel="stylesheet" href="../assets/css/yep-rtl.css"> -->
		
		<!-- Related css to this page -->	
		 <?php
        	if(isset($stylesheet) && !empty($stylesheet)){
				$i=0;
				foreach($stylesheet as $value){$i++;								
					$tab = ($i!=1)?"\t\t ":"";
					echo $tab.'<link rel="stylesheet" href="'.$this->config->item('site_url').$value.'">'."\n";
				}
			}
			if(isset($style) && !empty($style)){
				foreach($style as $value){
					echo $value;
				}
			}
		?>
        <!-- End Related css to this page -->	

		 <link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/css/dataTables.responsive.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/css/dataTables.tableTools.min.css">
		<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/css/dataTables.colVis.min.css">
                                    
		<!-- Yeptemplate css --><!-- Please use *.min.css in production -->
		<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/css/yep-style.css">
		<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/css/yep-vendors.css">

		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo $this->config->item('site_url') ?>assets/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo $this->config->item('site_url') ?>assets/img/favicon/favicon.ico" type="image/x-icon">
		<script> 
		var base_url = "<?php echo base_url();?>";
		var site_url = "<?php echo site_url('/');?>";
		var session_user_id = '<?php echo $this->session->userdata('user_id'); ?>';
        </script>
	</head>


	<body id="mainbody" >
		
		<div id="container" class="container-fluid skin-3" >
			<!-- Add Task in sidebar list modal -->
			<div class="modal fade" id="modal-add-task" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal">
							<div class="modal-header default">
								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myModalLabel1">
									Add Task
								</h4>
							</div>

							<div class="modal-body">
								<!-- Text input-->
								<div class="control-group">
								  	<label class="control-label" for="task-name">Task Name</label>
								  	<div class="controls">
								    	<input id="task-name" name="task-name" type="text" placeholder="" class="form-control">
								  	</div>
								</div>

								<!-- Textarea -->
								<div class="control-group">
								  	<label class="control-label" for="Description">Description</label>
								  	<div class="controls">                     
								    	<textarea id="Description" name="Description" class="form-control"></textarea>
								  	</div>
								</div>

								<!-- Text input-->
								<div class="control-group">
								  	<label class="control-label" for="owner">Owner</label>
								  	<div class="controls">
								    	<input id="owner" name="owner" type="text" placeholder="" class="form-control">
								    
								  	</div>
								</div>
							</div>
							<div class="modal-footer">
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>										
				</div>									
			</div>
			<!--./ Add Task in sidebar list modal -->
			
			<!-- Add Contact in sidebar list modal -->
			<div class="modal fade" id="modal-add-contact" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header default">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel2">
								Add Contact
							</h4>
						</div>
						<div class="modal-body">
							<!-- Text input-->
							<div class="control-group">
							  	<label class="control-label" for="name">Name</label>
							  	<div class="controls">
							    	<input id="name" name="name" type="text" placeholder="" class="form-control">
							  	</div>
							</div>

							<!-- Textarea -->
							<div class="control-group">
							  	<label class="control-label" for="Address">Address</label>
							  	<div class="controls">                     
							    	<textarea id="Address" name="Address" class="form-control"></textarea>
							  	</div>
							</div>

							<div class="control-group">
							  	<label class="control-label" for="Phone">Phone</label>
							  	<div class="controls">                     
							    	<input id="Phone" name="Phone" type="number" placeholder="" class="form-control">
							  	</div>
							</div>

							<!-- Text input-->
							<div class="control-group">
							  	<label class="control-label" for="owner">Email</label>
							  	<div class="controls">
							    	<input id="Email" name="Email" type="text" placeholder="" class="form-control">
							    
							  	</div>
							</div>
						</div>
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>										
				</div>									
			</div>
			
			<!--./ Add Contact in sidebar list modal -->