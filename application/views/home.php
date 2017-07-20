<?php 
$this->load->view('common/header');
$this->load->view('common/carousel_slider');
?>

<article class="em-page-wrap">
  <section class="em-artical-wrap">
    <div class="container">
      <div class="em-heading-wrap clearfix">
        <h2 class="fl em-heading"> Popular on EM </h2>
        <a class="fr more-link"> View More... </a> </div>
      <div class="row">
        <?php if(!empty($article)){
		  $i = 1;
		     foreach($article as $key){
				 $article_img = image_check($key['article_img'],ARTICLE);
				 $user_img = image_check($key['picture_url'],USER_IMAGE);
				
				 $article_seo_url = seo_friendly_urls($key['article_title'],$key['id']);
				 $category_seo_url = seo_friendly_urls($key['cat_title'],$key['category_id']);
				 
				 if($i == 1){
		  ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="featured-article-box article-box">
            <div class="article-thmb"> <a href="<?php echo base_url('article/detail/'.$article_seo_url); ?>"> <img alt="<?php echo $key['article_img']; ?>" src="<?php echo $article_img; ?>"> </a>
              <?php  if($key['isFeatures'] == 'Yes' ){ ?>
              <div class="new-arcticle"> <img src="<?php echo base_url('assets/images/new-arctile.png'); ?>"> </div>
              <?php } ?>
            </div>
            <div class="article-content">
              <div class="date-cat-box"> <span class="article-cat"> <a href="<?php echo base_url('article/category/'.$category_seo_url); ?>"> <?php echo ucwords($key['cat_title']); ?> </a> </span> <span class="article-date"><?php echo convert_datetime($key['published_on'],' '); ?></span> </div>
              <div class="article-heading">
                <h3> <a href="<?php echo base_url('article/detail/'.$article_seo_url); ?>"> <?php echo ucwords($key['article_title']); ?> </a> </h3>
              </div>
              <div class="article-disc"><?php echo ucwords($key['article_content']); ?></div>
              <div class="article-footer clearfix">
                <div class="article-blogger fl"> <span class="blogger-thmb"> <img src="<?php echo $user_img; ?>" alt="<?php echo ucwords($key['first_name'].' '.$key['last_name']); ?>" style="height: 29px; width: 29px;"> </span> <span class="blogger-name"> <?php echo ucwords($key['first_name'].' '.$key['last_name']); ?> </span> </div>
                <div class="article-socail fr"> <a href="javascript:void(0);" onClick="article_likes('<?php echo $key['id']; ?>');"><i class="fa fa-heart" aria-hidden="true"></i> <span id="article_like_<?php echo $key['id']; ?>">
                  <?php if($key['likes']) { echo '+'.$key['likes']; } ?>
                  </span> </a> <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a> </div>
              </div>
            </div>
          </div>
        </div>
        <?php }else{ 
		 if($i == 2){
			echo '<div class="col-md-8 col-sm-8 col-xs-12 no-padding">'; 
		 }
		?>
        <div class="col-md-6 col-sm-6 col-xs-12 article-horizontal-block">
          <div class="article-box clearfix">
            <div class="article-thmb col-md-5 col-sm-4 col-xs-12 no-padding"> <a href="<?php echo base_url('article/detail/'.$article_seo_url); ?>"> <img alt="<?php echo $key['article_img']; ?>" src="<?php echo $article_img; ?>"> </a>
              <?php  if($key['isFeatures'] == 'Yes' ){ ?>
              <div class="new-arcticle"> <img src="<?php echo base_url('assets/images/new-arctile.png'); ?>"> </div>
              <?php } ?>
            </div>
            <div class="article-content col-md-7 col-sm-8 col-xs-12">
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
          <!-- End Of .article-box --> 
        </div>
        <!-- End Of .article-horizontal-block -->
        
        <?php } 
	   
		$i++; } 
		   } ?>
      </div>
    </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12"> <a href="javascript:void(0);" onClick="article_share(1,'twitter');"> <img alt="twitter" src="<?php echo base_url('assets/images/twitter.png') ?>" width="50px" height="auto"> </a> <a href="javascript:void(0);" onClick="article_share(1,'facebook');"> <img alt="facebook" src="<?php echo base_url('assets/images/facebook.png') ?>" width="50px" height="auto"> </a> <a href="javascript:void(0);" onClick="article_share(1,'googleplus');"> <img alt="googleplus" src="<?php echo base_url('assets/images/googleplus.png') ?>" width="50px" height="auto"> </a> <a href="javascript:void(0);" onClick="article_share(1,'linkedin');"> <img alt="linkedin" src="<?php echo base_url('assets/images/linkedin.png') ?>" width="50px" height="auto"> </a> </div>
  </section>
</article>
<?php $this->load->view('common/footer_content'); ?>
<script>
$(document).ready(function(){
  $('.tooltip-demo.well').tooltip({
  selector: "a[rel=tooltip]"
});
});

</script>
<?php $this->load->view('common/footer'); ?>
