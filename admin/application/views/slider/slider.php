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
    <?php $this->load->view('common/message'); ?>
    <!-- main content -->
    <div id="content">
      <div id="sortable-panel" class="">
        <div id="titr-content" class="col-md-12">
          <h2><?php echo ucwords($title);?></h2>
          <h5>&nbsp;</h5>
          <div class="actions"> <a href="<?php echo base_url('staticPages/addSlider');?>" class="btn btn-success  has-ripple"> <?php echo ADD_NEW; ?></a> </div>
        </div>
        
        <!-- Admin over view .col-md-12 -->
        <div class="col-md-12 ">
          <div  class="panel panel-default">
            <div class="panel-body"> <i class="glyphicon glyphicon-stats"></i> <b><?php echo ucwords($title);?>
              <hr>
              <div class="row"> 
                <!-- progress section -->
                <div class="panel-body">
                  <table id="example1" class="table table-striped table-bordered width-100 cellspace-0" >
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                     <tfoot>
                      <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    
                    
                    <tbody>
                      <?php 
          						if($result){ 
          						   foreach($result as $val){
              							$id = safe_b64encode($val["id"]); 
                            $img = image_check($val['img_name'],SLIDER);
          					 ?>
                      <tr>
                        <td><img src="<?php echo $img; ?>" alt="<?php echo $val['img_name']; ?>" style="height:150px; width:200px;"></td>
                        <td><?php echo $val['title']; ?></td>
                        <td><?php echo $val['description']; ?></td>
                        <td><?php echo $val['status']; ?></td>
                        <td><a href="<?php echo base_url('staticPages/editSlider/'.$id);?>" class="blue"> Edit</a></td>
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
