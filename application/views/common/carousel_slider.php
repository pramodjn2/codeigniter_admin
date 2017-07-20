    <div class="slider-wrap">
				<div class="slider-block">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							
                            <?php    $where = "where status = 'Active' ORDER BY id DESC";
						  			 $carousel_slider = $this->Common->select('manage_carousel_slider',$where);
									 if(!empty($carousel_slider)){
										 $i=1;
										 foreach($carousel_slider as $key){
											  $img = image_check($key['img_name'],SLIDER);
						   ?>
                            <div class="item <?php if($i == 1){ echo 'active'; } ?>">
								<img src="<?php echo $img; ?>" alt="<?php echo $key['img_name']; ?>">
								<div class="carousel-caption slider-content">
									<h2> <?php echo ucwords($key['title']); ?> </h2>
                                    <p><?php echo ucwords($key['description']); ?></p>
									<div class="slider-btn-box">
										<a class="em-primary-btn" href="#">Read More...</a> 
									</div>
								</div>
							</div>
                            
                            <?php $i++; } 
							} ?>
                            
							
							
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
			<!-- ,slider-wrap -->
