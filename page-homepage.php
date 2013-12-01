<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-md-12 clearfix" role="main">

					<?php

					$use_carousel = of_get_option('showhidden_slideroptions');
      				if ($use_carousel) {

					?>

					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

					    <!-- Carousel items -->
					    <div class="carousel-inner">

					    	<?php
							global $post;
							$tmp_post = $post;
							$show_posts = of_get_option('slider_options');
							$args = array( 'numberposts' => $show_posts ); // set this to how many posts you want in the carousel
							$myposts = get_posts( $args );
							$post_num = 0;
							foreach( $myposts as $post ) :	setup_postdata($post);
								$post_num++;
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'infinitum-featured-carousel' );
							?>

						    <div class="<?php if($post_num == 1){ echo 'active'; } ?> item">
						    	
						    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'infinitum-featured-carousel' ); ?></a>

							   	<div class="carousel-caption">

					                <h4 class="slider-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					                <div class="caoption-text">
					                	<?php
					                		$excerpt_length = 150; // length of excerpt to show (in characters)
					                		$the_excerpt = get_the_excerpt(); 
					                		if($the_excerpt != ""){
					                			$the_excerpt = substr( $the_excerpt, 0, $excerpt_length );
					                			echo $the_excerpt . '... ';
					                	?>
					                	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="btn btn-xs btn-primary">Read more</a>
					                	<?php } ?>
					                </div>

				                </div>
						    </div>

						    <?php endforeach; ?>
							<?php $post = $tmp_post; ?>

					    </div>

					 	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
					  	</a>
						<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					 		<span class="glyphicon glyphicon-chevron-right"></span>
					  	</a>
				    </div>

				    <?php } // ends the if use carousel statement ?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					
						<header>

							<?php if (has_post_thumbnail( $post->ID ) ): ?>
									<?php $background_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'infinitum-featured-home' );
									$image = $background_image[0]; ?>
								<?php else : ?>
							<?php endif; ?>
						
							<div class="jumbotron" style="background-image: url('<?php echo $background_image[0]; ?>'); background-repeat: no-repeat; background-position: center;">

								<?php echo get_post_meta($post->ID, 'custom_tagline' , true);?>
							
							</div>

						</header>
						
						<section class="row post_content">
						
							<div class="col-md-12">
						
								<?php the_content(); ?>
								
									<div class="col-md-4 home-widget">
										<?php dynamic_sidebar('home1'); ?>
									</div>

									<div class="col-md-4 home-widget">	
										<?php dynamic_sidebar('home2'); ?>
									</div>	
									
									<div class="col-md-4 home-widget">
										<?php dynamic_sidebar('home3');  ?>
									</div>

							</div>
							
													
						</section> <!-- end article header -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","infinitum") . ': ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "infinitum"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "infinitum"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>