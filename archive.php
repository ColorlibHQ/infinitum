<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="clearfix row">

						<div id="main" class="col-md-8 clearfix" role="main">

							<?php if (is_category()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Categorized:', 'infinitum' ); ?></span> <?php single_cat_title(); ?>
								</h1>

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Tagged:', 'infinitum' ); ?></span> <?php single_tag_title(); ?>
								</h1>

							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
								<h1 class="archive-title h2">

									<span><?php _e( 'Posts By:', 'infinitum' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Daily Archives:', 'infinitum' ); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Monthly Archives:', 'infinitum' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Yearly Archives:', 'infinitum' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							<?php } ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									
									<p class="meta"><span class="glyphicon glyphicon-time"></span> <?php the_date(); ?> <span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?> <span class="glyphicon glyphicon-folder-open"></span> <?php the_category(', '); ?>.</p>

								</header>

								<section class="entry-content clearfix">

									<?php the_post_thumbnail( 'infinitum-featured' ); ?>

									<?php the_excerpt(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

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

			</div>

<?php get_footer(); ?>