<?php 
$this->load->view('common/header');

?>

<div class="container">
  <div class="row"> 
    <!-- Contenedor Principal -->
    <div class="comments-container">
      <h1><?php echo ucwords($result[0]['page_title']); ?> </h1>
      <p id="comment_message"><?php 
		  echo ucwords(html_entity_decode($result[0]['page_content'])); 
	  ?></p>
      
    </div>
  </div>
</div>
<br>
<?php $this->load->view('common/footer_content'); ?>

<?php 

$this->load->view('common/footer');
?>
