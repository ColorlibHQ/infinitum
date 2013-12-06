<?php get_header(); ?>
			
			<?php
				$blog_hero = of_get_option('blog_hero');
				if ($blog_hero){
			?>
			<div class="clearfix row">
				<div class="jumbotron">
				
					<h1><?php bloginfo('title'); ?></h1>
					
					<p><?php bloginfo('description'); ?></p>
				
				</div>
			</div>
			<?php
				}
			?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-md-8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'infinitum-featured' ); ?></a>	
							
							<div class="page-header"><h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2></div>
													
							<p class="meta"><span class="glyphicon glyphicon-time"></span> <?php the_date(); ?> <span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?> <span class="glyphicon glyphicon-folder-open"></span> <?php the_category(', '); ?>.</p>

						</header> <!-- end article header -->
					
						<section class="post_content clearfix">
							<?php the_content( __("Read more &raquo;","infinitum") ); ?>
						</section> <!-- end article section -->
						
						<footer>

						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
						<?php endwhile; ?>

								<?php if ( function_exists( 'infinitum_page_navi' ) ) { ?>
										<?php infinitum_page_navi(); ?>
								<?php } else { ?>
										<nav class="wp-prev-next">
												<ul class="clearfix">
													<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'infinitum' )) ?></li>
													<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'infinitum' )) ?></li>
												</ul>
										</nav>
								<?php } ?>

						<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'infinitum' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'infinitum' ); ?></p>
										</section>
									</article>

						<?php endif; ?>

					</div>

					<?php get_sidebar(); ?>
    
			</div>

<?php get_footer(); ?>