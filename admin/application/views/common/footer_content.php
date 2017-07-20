<!-- footer -->
			<div class="page-footer">				
				<div class="col-xs-12 col-sm-12 text-center">
					<strong class=""><a href="#"><?php echo  $this->config->item('site_name');  ?></a> © 2017</strong>
					
				</div>			
			</div>
			<!-- /footer -->
		</div>


<!-- General JS script library-->
		<!-- <script type="text/javascript" src="<?php echo base_url('assets/vendors/jquery/jquery.min.js'); ?>"></script> -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

		
		
		<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-ui/js/jquery-ui.min.js"></script>	
		<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>						
		<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-searchable/js/jquery.searchable.min.js"></script>									
		<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-fullscreen/js/jquery.fullscreen.min.js"></script>																		
		
		<!-- Yeptemplate JS Script --><!-- Please use *.min.js in production -->
		<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/js/yep-script.js"></script>	
        
        
        <script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/js/jquery.dataTables.min.js"></script>	
        <script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/js/dataTables.bootstrap.min.js"></script>	
        <script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/js/dataTables.responsive.min.js"></script>	
        <script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-datatables/js/dataTables.tableTools.min.js"></script>	
        
        <!-- jquery validation js script file -->
        <script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-validation/js/jquery.validate.min.js"></script>
          <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=o071gjf9aj18fw3ui42pi1ftkcd0pr16z8xudrgimdfpwoij"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/js/custom_tinymcs.js"></script>   

		<!-- Related JavaScript Library to This Pagee -->
        <?php 
        	if(isset($javascript) && !empty($javascript)){
				$i=0;
				foreach($javascript as $value){$i++;
					$tab = ($i!=1)?"\t\t ":"";
					echo $tab.'<script src="'.$this->config->item('site_url').$value.'" type="text/javascript"></script>'."\n";
				}
			}
			if(isset($script) && !empty($script)){
				foreach($script as $value){
					echo $value;
				}
			}
		?>	

		<!-- End Related JavaScript Library to This Pagee -->
		<script type="text/javascript">
			
			function notifiction_read(id,url){
	          var jqxhr =
				$.ajax({
					url: base_url+"ajax/notification_unread",
					type : "POST",
					data: {
						id : id,
						url : url
					}
				})
				.done (function(data) {
					$(location).attr('href', url);
				})
				.fail (function()  { 
					alert("Error "); 
				});	
			}
		</script>


		