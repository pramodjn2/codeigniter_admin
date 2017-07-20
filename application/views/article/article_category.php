<?php 
$this->load->view('common/header');

?>

<div class="container">
  <div class="row"> 
    <!-- Contenedor Principal -->
    <div class="comments-container">
      <h1><?php echo ucwords($category[0]['title']); ?> </h1>
      <h3> <?php echo ucwords($category[0]['description']); ?> </h3>
    </div>
    <hr>
    <?php foreach($article as $key){ 
	
	 $article_img = image_check($key['article_img'],ARTICLE);
				 $user_img = image_check($key['picture_url'],USER_IMAGE);
				
				 $article_seo_url = seo_friendly_urls($key['article_title'],$key['id']);
				 $category_seo_url = seo_friendly_urls($key['cat_title'],$key['category_id']);
	?>
    <div class="col-md-4">
    <div class="article-box clearfix">
            <div class="article-thmb col-md-5 col-sm-4 col-xs-12 no-padding"> <a href="<?php echo base_url('article/detail/'.$article_seo_url); ?>"> <img alt="<?php echo $key['article_img']; ?>" src="<?php echo $article_img; ?>"> </a>
              <?php  if($key['isFeatures'] == 'Yes' ){ ?>
              <div class="new-arcticle"> <img src="<?php echo base_url('assets/images/new-arctile.png'); ?>"> </div>
              <?php } ?>
            </div>
            <div class="acol-md-7 col-sm-8 col-xs-12">
              <div class="date-cat-box"> <span class="article-cat"> <a href="<?php echo base_url('article/category/'.$category_seo_url); ?>"> <?php echo ucwords($key['cat_title']); ?> </a> </span> <span class="article-date"><?php echo convert_datetime($key['published_on'],' '); ?></span> </div>
              <div class="article-heading">
                <h3> <a href="<?php echo base_url('article/detail/'.$article_seo_url); ?>"> <?php echo ucwords($key['article_title']); ?> </a> </h3>
              </div>
              <div class="article-footer clearfix">
                <div class="article-blogger fl"> <span class="blogger-thmb"> <img class="img-responsive img-circle" src="<?php echo $user_img; ?>" alt="<?php echo ucwords($key['first_name'].' '.$key['last_name']); ?>" style="height: 29px; width: 29px;"> </span> <span class="blogger-name"> <?php echo ucwords($key['first_name'].' '.$key['last_name']); ?></span> </div>
                <div class="article-socail fr"> <a href="javascript:void(0);" onClick="article_likes('<?php echo $key['id']; ?>');"><i class="fa fa-heart" aria-hidden="true"></i> <span id="article_like_<?php echo $key['id']; ?>">
                  <?php if($key['likes']) { echo '+'.$key['likes']; } ?>
                  </span> </a> <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a> </div>
              </div>
            </div>
       </div>   
    </div>
    <?php } ?>
    
  </div>
</div>
<br>
<?php $this->load->view('common/footer_content'); ?>
<?php 

$this->load->view('common/footer');
?>
