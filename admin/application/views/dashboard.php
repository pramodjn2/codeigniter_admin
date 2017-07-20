<?php $this->load->view('common/header');?>
<?php $this->load->view('common/admin_header'); ?>
<!-- sidebar menu -->
<?php $this->load->view('common/sidebar'); ?>
<!-- /end #sidebar -->
<!-- main content  -->

<div id="main" class="main">
  <div class="row"> 
    <!-- breadcrumb section -->
    <div class="ribbon">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url('Dashboard'); ?>">Home</a> </li>
      </ul>
    </div>
    
    <!-- main content -->
    <div id="content">
      <div id="sortable-panel" class="">
        <div id="titr-content" class="col-md-12">
          <h2>Dashboard</h2>
        </div>
        
        <!-- Admin over view .col-md-12 -->
        <div class="col-md-12 ">
          <div  class="panel panel-default">
            <div class="panel-body"> <i class="glyphicon glyphicon-stats"></i> <b>Dashboard</b>
              <hr>
              <div class="row"> 
                <!-- progress section -->
                <div class="panel-body">
                  <table id="example1" class="table table-striped table-bordered width-100 cellspace-0" >
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Mobile No</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                                                if($rescuresult){ 
                                                   foreach($rescuresult as $val){
                                                   	$id = safe_b64encode($val["id"]); 
										        ?>
                      <tr>
                        <td><?php echo $val['name'].' '.$val['surName']; ?></td>
                        <td><?php echo $val['address']; ?></td>
                        <td><?php echo $val['mobileNo']; ?></td>
                        <td><div class=" action-buttons"> <a class="blue" href="<?php echo base_url('Dashboard/userRescueUpdate/' .$id) ?>"> <?php echo UPDATE; ?></a> 
                            
                            <!-- <a class="green" href="#">
																<i class=" fa fa-pencil bigger-130"></i>
															</a>

															<a class="red" href="#">
																<i class=" fa fa-trash-o bigger-130"></i>
															</a> --> 
                          </div></td>
                      </tr>
                      <?php } 
										       } ?>
                    </tbody>
                  </table>
                </div>
                <!-- ./preogress section --> 
                
              </div>
            </div>
          </div>
          <!-- end panel --> 
        </div>
        <!-- /end Admin over view .col-md-12 --> 
        
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end #content --> 
  </div>
  <!-- end .row --> 
</div>
<!-- ./end #main  -->

<?php $this->load->view('common/footer_content');?>
<script type="text/javascript">
	 $('#example1').dataTable({
		    	responsive: true
		    });
</script>
<?php $this->load->view('common/footer');?>
