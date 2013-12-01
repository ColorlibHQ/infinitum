<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-md-8 clearfix" role="main">
				
					<div class="page-header"><h1><span><?php _e("Search Results for","infinitum"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1></div>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							
							<header class="article-header">

								<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<p class="byline vcard"><?php
									printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'infinitum' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'infinitum' ) ), infinitum_get_the_author_posts_link(), get_the_category_list(', ') );
								?></p>

							</header>
						
							<section class="post_content">
								<?php the_excerpt('<span class="read-more">' . __("Read more on","infinitum") . ' "'.the_title('', '', false).'" &raquo;</span>'); ?>
						
							</section> 
							
							<footer class="article-footer">
							
							</footer> 
						
						</article> 
					
					<?php endwhile; ?>	
					
						<?php if (function_exists('infinitum_page_navi')) { ?>
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
									<h1><?php _e( 'Sorry, No Results.', 'infinitum' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Try your search again.', 'infinitum' ); ?></p>
								</section>
							</article>

					<?php endif; ?>
				
					</div> 
    			
    			<?php get_sidebar(); ?>
    
			</div>

<?php get_footer(); ?>