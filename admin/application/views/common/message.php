
<div class="col-md-12">
  <div class="form-group"> 
    <?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success')?></div>
   <?php 
   $this->session->set_flashdata('success', '');
   } ?>
   
   
   <?php if($this->session->flashdata('error')){ ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error')?></div>
   <?php 
    $this->session->set_flashdata('error', '');
     } ?>
   
   
   <?php if($this->session->flashdata('warning')){ ?>
    <div class="alert alert-warning"><?php echo $this->session->flashdata('warning')?></div>
   <?php 
   $this->session->set_flashdata('warning', '');
   } ?>
   
    
   
    
  </div>
</div>
