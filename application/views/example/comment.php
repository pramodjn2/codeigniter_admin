<?php 
$this->load->view('common/header');

?>

<div class="container">
  <div class="row"> 
    <!-- Contenedor Principal -->
    <div class="comments-container">
      <h1>Comentarios </h1>
      <p id="comment_message"></p>
      <ul id="comments-list" class="comments-list">
      
      
<li id="comments_<?php echo $article_id; ?>">
  <p  id="comments_box<?php echo $article_id; ?>">
    <textarea name="comment_text_0" id="comment_text_0" role="10" cols="70"></textarea>
    <a class="btn btn-success" onClick="comment_post('<?php echo $article_id; ?>',0);" href="javascript:void(0);" >Post</a></p>
    
      <ul id="reply_list_0"></ul>
</li>



        <?php 
		function comment_check($comment_id,$user_comment_like){
		 if(in_array($comment_id, $user_comment_like)){
		 	return true;
		  }else{
		 	return false;
		  }
		}
  
		if(!empty($comment)){
			   foreach($comment as $key){
				   $user_img = image_check($key['picture_url'],USER_IMAGE);
				   
				   $icon = 'fa-heart-o';
				   $like_condition = comment_check($key['id'],$user_comment_like);
				   if($like_condition){
					$icon = 'fa-heart';   
				   }
			 ?>
        <li id="comments_<?php echo $key['id']; ?>">
          <div class="comment-main-level"> 
            <!-- Avatar -->
            <div class="comment-avatar"><img src="<?php echo $user_img; ?>" alt=""></div>
            <!-- Contenedor del Comentario -->
            <div class="comment-box">
              <div class="comment-head">
                <h6 class="comment-name"><a href="http://creaticode.com/blog"><?php echo ucfirst($key['sender_name']); ?></a></h6>
                <span><?php echo ago($key['created_dt']); ?></span> <i class="fa fa-reply"></i> <i id="heart_<?php echo $key['id']; ?>" class="fa <?php echo $icon; ?>" title="<?php echo $key['likes']; ?> user likes" onClick="article_likes('<?php echo $key['id']; ?>');">&nbsp;
                <p id="like_count_<?php echo $key['id']; ?>"><?php echo $key['likes']; ?></p>
                </i> </div>
              <div class="comment-content"> <?php echo $key['comment']; ?> </div>
            </div>
          </div>
          <!-- children comment -->
          <ul class="comments-list reply-list" id="reply_list_<?php echo $key['id']; ?>">
            <?php  
				    $children_result = get_children_comment($key['id']); 
				      if(!empty($children_result)){
						  foreach($children_result as $val){
							   $user_img = image_check($val['picture_url'],USER_IMAGE);
							  
				   $icon = 'fa-heart-o';
				   $like_condition = comment_check($val['id'],$user_comment_like);
				   if($like_condition){
					$icon = 'fa-heart';   
				   }
				?>
            <li id="comments_<?php echo $val['id']; ?>"> 
              <!-- Avatar -->
              <div class="comment-avatar"><img src="<?php echo $user_img; ?>" alt=""></div>
              <!-- Contenedor del Comentario -->
              <div class="comment-box">
                <div class="comment-head">
                  <h6 class="comment-name"><a href="http://creaticode.com/blog"><?php echo $val['sender_name']; ?></a></h6>
                  <span><?php echo ago($val['created_dt']); ?></span> <i class="fa fa-reply"></i> <i id="heart_<?php echo $val['id']; ?>" class="fa <?php echo $icon; ?>" title="<?php echo $val['likes']; ?> user likes" onClick="article_likes('<?php echo $val['id']; ?>');">&nbsp;
                  <p id="like_count_<?php echo $val['id']; ?>"><?php echo $val['likes']; ?></p>
                  </i> </div>
                <div class="comment-content"> <?php echo $val['comment']; ?> </div>
              </div>
            </li>
            <?php } 
			   } ?>
          </ul>
          <p  id="comments_box<?php echo $key['id']; ?>">
            <textarea name="comment_text_<?php echo $key['id']; ?>" id="comment_text_<?php echo $key['id']; ?>" role="10" cols="70"></textarea>
            <a class="btn btn-success" onClick="comment_post('<?php echo $key['article_id']; ?>','<?php echo $key['id']; ?>');" href="javascript:void(0);" >Post</a></p>
        </li>
        <?php }
		} ?>
      </ul>
    </div>
  </div>
</div>
<br>
<?php $this->load->view('common/footer_content'); ?>
<script>
var base_url = '<?php echo base_url(); ?>';


function comment_post(article_id,comment_id = null){
	//alert(comment_id+'--'+article_id); return false;
	var comment = $('#comment_text_'+comment_id).val();
	 var url = base_url+'ajax/comment_post';  
	 	$.ajax({
			type: "POST",
			url: url,
			data: {'article_id': article_id, 'comment_id': comment_id, 'comment': comment},
		})
		.done(function(result) {
			$('#reply_list_'+comment_id).append(result); 
		});	
}	



function article_likes(comment_id){
	//alert(id);
  	 var url = base_url+'ajax/comment_like';  
	 	$.ajax({
			type: "POST",
			url: url,
			data: {'comment_id': comment_id},
		})
		.done(function(result) {
			var result_data = JSON.parse(result);
		   
			
			var result_class = result_data.class;
            var result_message = result_data.message;
			var total_likes = result_data.totalLikes;
            var data = '<div class="'+result_class+'">'+result_message+'</div>';
			$('#like_count_'+comment_id).html(total_likes);
			$('#comment_message').html(data); 
			

			if( parseInt(result_data.success) == 1 ) {
				if( result_data.action == 'LIKE_SUBMITTED' ) {
					$('#heart_'+comment_id).removeClass('fa-heart-o');
					$('#heart_'+comment_id).addClass('fa-heart');
				} else if( result_data.action == 'LIKE_REMOVED' ) {
					$('#heart_'+comment_id).addClass('fa-heart-o');
					$('#heart_'+comment_id).removeClass('fa-heart');
				}
			} 
		});	
}	

</script>
<style type="text/css">
/** ====================
 * Lista de Comentarios
 =======================*/
.comments-container {
	margin: 60px auto 15px;
	width: 768px;
}

.comments-container h1 {
	font-size: 36px;
	color: #283035;
	font-weight: 400;
}

.comments-container h1 a {
	font-size: 18px;
	font-weight: 700;
}

.comments-list {
	margin-top: 30px;
	position: relative;
}

/**
 * Lineas / Detalles
 -----------------------*/
.comments-list:before {
	content: '';
	width: 2px;
	height: 100%;
	background: #c7cacb;
	position: absolute;
	left: 32px;
	top: 0;
}

.comments-list:after {
	content: '';
	position: absolute;
	background: #c7cacb;
	bottom: 0;
	left: 27px;
	width: 7px;
	height: 7px;
	border: 3px solid #dee1e3;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}

.reply-list:before, .reply-list:after {display: none;}
.reply-list li:before {
	content: '';
	width: 60px;
	height: 2px;
	background: #c7cacb;
	position: absolute;
	top: 25px;
	left: -55px;
}


.comments-list li {
	margin-bottom: 15px;
	display: block;
	position: relative;
}

.comments-list li:after {
	content: '';
	display: block;
	clear: both;
	height: 0;
	width: 0;
}

.reply-list {
	padding-left: 88px;
	clear: both;
	margin-top: 15px;
}
/**
 * Avatar
 ---------------------------*/
.comments-list .comment-avatar {
	width: 65px;
	height: 65px;
	position: relative;
	z-index: 99;
	float: left;
	border: 3px solid #FFF;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	overflow: hidden;
}

.comments-list .comment-avatar img {
	width: 100%;
	height: 100%;
}

.reply-list .comment-avatar {
	width: 50px;
	height: 50px;
}

.comment-main-level:after {
	content: '';
	width: 0;
	height: 0;
	display: block;
	clear: both;
}
/**
 * Caja del Comentario
 ---------------------------*/
.comments-list .comment-box {
	width: 680px;
	float: right;
	position: relative;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	box-shadow: 0 1px 1px rgba(0,0,0,0.15);
}

.comments-list .comment-box:before, .comments-list .comment-box:after {
	content: '';
	height: 0;
	width: 0;
	position: absolute;
	display: block;
	border-width: 10px 12px 10px 0;
	border-style: solid;
	border-color: transparent #FCFCFC;
	top: 8px;
	left: -11px;
}

.comments-list .comment-box:before {
	border-width: 11px 13px 11px 0;
	border-color: transparent rgba(0,0,0,0.05);
	left: -12px;
}

.reply-list .comment-box {
	width: 610px;
}
.comment-box .comment-head {
	background: #FCFCFC;
	padding: 10px 12px;
	border-bottom: 1px solid #E5E5E5;
	overflow: hidden;
	-webkit-border-radius: 4px 4px 0 0;
	-moz-border-radius: 4px 4px 0 0;
	border-radius: 4px 4px 0 0;
}

.comment-box .comment-head i {
	float: right;
	margin-left: 14px;
	position: relative;
	top: 2px;
	color: #A6A6A6;
	cursor: pointer;
	-webkit-transition: color 0.3s ease;
	-o-transition: color 0.3s ease;
	transition: color 0.3s ease;
}

.comment-box .comment-head i:hover {
	color: #03658c;
}

.comment-box .comment-name {
	color: #283035;
	font-size: 14px;
	font-weight: 700;
	float: left;
	margin-right: 10px;
}

.comment-box .comment-name a {
	color: #283035;
}

.comment-box .comment-head span {
	float: left;
	color: #999;
	font-size: 13px;
	position: relative;
	top: 1px;
}

.comment-box .comment-content {
	background: #FFF;
	padding: 12px;
	font-size: 15px;
	color: #595959;
	-webkit-border-radius: 0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;
}

.comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {color: #03658c;}
.comment-box .comment-name.by-author:after {
	content: 'autor';
	background: #03658c;
	color: #FFF;
	font-size: 12px;
	padding: 3px 5px;
	font-weight: 700;
	margin-left: 10px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
	.comments-container {
		width: 480px;
	}

	.comments-list .comment-box {
		width: 390px;
	}

	.reply-list .comment-box {
		width: 320px;
	}
}
</style>
<?php 

$this->load->view('common/footer');
?>
