<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
?>

<article class="em-page-wrap">
  <section class="em-artical-wrap">
    <div class="container">
      <div class="wrap">
        <div class="logo"> <img src="<?php echo base_url('assets/images/404.png'); ?>"/>
          <div class="sub">
            <p><a href="<?php echo base_url(); ?>">Go Back to Home</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</article>
<?php $this->load->view('common/footer_content'); ?>
<?php $this->load->view('common/footer'); ?>
