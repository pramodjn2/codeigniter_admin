/* article likes */
var article_likes = function(article_id) {
	 var url = base_url+'ajax/article_like';  
	 	$.ajax({
			type: "POST",
			url: url,
			data: {'article_id': article_id},
		})
		.done(function(result) {
			var result_data = JSON.parse(result);
		   
			var result_class = result_data.class;
            var result_message = result_data.message;
			var total_likes = '+'+result_data.totalLikes;
            var data = '<div class="'+result_class+'">'+result_message+'</div>';
			
			if( parseInt(result_data.success) == 1 ) {
				if( result_data.action == 'LIKE_SUBMITTED' ) {
					$('#article_like_'+article_id).html(total_likes)
				} else if( result_data.action == 'LIKE_REMOVED' ) {
					$('#article_like_'+article_id).html(total_likes)
				}
			} 
		});	
};	


/* article share */
var article_share = function(article_id,type) {
	 var url = base_url+'ajax/article_share';  
	 	$.ajax({
			type: "POST",
			url: url,
			data: {'article_id': article_id,'type': type},
		})
		.done(function(result) {
			var result = JSON.parse(result);
			if( parseInt(result.success) == 1 ) {
				var id = result.id;
				var title = result.title;
				var summary = result.summary;
				var url = result.url;
				var image = result.image;
				
				var left  = ($(window).width()/2)-(900/2);
                var top   = ($(window).height()/2)-(600/2);
	
				if(type == 'twitter'){
				       popup = window.open ("http://twitter.com/share?text="+summary+"&hashtags="+title+"&url="+url, "popup", "width=900, height=600, top="+top+", left="+left);	
				
				}else if(type == 'facebook'){
					window.open('http://www.facebook.com/sharer.php?s=100&amp;p[url]='+url,"popup", "width=900, height=600, top="+top+", left="+left);
			
				}else if(type == 'googleplus'){
					popup = window.open ("https://plus.google.com/share?url="+url, "popup", "width=900, height=600, top="+top+", left="+left);
			
				}else if(type == 'linkedin'){
					popup = window.open ("https://www.linkedin.com/shareArticle?mini=true&source=MI&title="+title+"&summary="+summary+"&url="+url+"&image="+image, "popup", "width=900, height=600, top="+top+", left="+left);
			
				}
				
			}
		});	
};	
