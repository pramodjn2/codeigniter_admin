<?php 
$this->load->view('common/header');

?>

<div class="container">
  <div class="row"> 
    <!-- Contenedor Principal -->
    <div class="comments-container">
    
  	<?php 
          $banner_img = image_check($result[0]['banner_img'],ARTICLE);
		  $article_img = image_check($result[0]['article_img'],ARTICLE);
		  
		   $category_seo_url = seo_friendly_urls($result[0]['cat_title'],$result[0]['category_id']);
        
		// if($result[0]['banner_display_mode'] == 'No'){
		?>
           <p>
           <img src="<?php echo $banner_img; ?>" height="200" width="200" alt="banner image">
           </p>
           <?php //} ?>
      <h1><?php echo ucwords($result[0]['article_title']); ?> </h1>
      <h3> <a href="<?php echo base_url('article/category/'.$category_seo_url); ?>" ><?php echo ucwords($result[0]['cat_title']); ?> </a></h3>
      <p id="comment_message">
        <?php 
		  echo ucwords(html_entity_decode($result[0]['article_content'])); 
	  ?>
      </p>
      
      
        <p>
        <img src="<?php echo $article_img; ?>" height="200" width="200" alt="<?php echo $article_img; ?>">
        </p>
           
        <?php  $user_img = image_check($result[0]['picture_url'],USER_IMAGE); ?>
      <p> <?php echo convert_datetime($result[0]['published_on'], ' '); ?>  </p>
      <p><a href="">
      <img src="<?php echo $user_img; ?>" height="50" width="50" alt="<?php echo ucwords($result[0]['first_name']); ?>">
      </a><b> <?php echo ucwords($result[0]['first_name'].' '.$result[0]['last_name']); ?></b>   </p>
      
        <p>Likes :- <?php echo $result[0]['likes']; ?>  </p>
      <p>Comment :- <?php echo $result[0]['article_comment']; ?>  </p>
    </div>
  </div>
</div>
<br>
<?php $this->load->view('common/footer_content'); ?>
<?php 

$this->load->view('common/footer');
?>
