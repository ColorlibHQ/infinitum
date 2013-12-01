<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-md-8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
							<header class="article-header">

								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

							</header>
					
							<section class="post_content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
						
							</section> 

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'infinitum' ) . '</span> ', ', ', '' ); ?>

								</footer>
						
								<?php comments_template(); ?>

						</article> 

						<?php endwhile; ?>		
					
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