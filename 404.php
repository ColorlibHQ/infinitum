<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="eightcol first clearfix" role="main">

						<article id="post-not-found" class="hentry clearfix">

							<header class="article-header">

								<div class="jumbotron">

									<h1><?php _e( 'Error 404 - Article Not Found', 'infinitum' ); ?></h1>

								</div>

							</header>

							<section class="entry-content">

								<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'infinitum' ); ?></p>

							</section>

							<section class="search">
								
								<div class="row">

									<div class="col-md-12">

										<p><?php get_search_form(); ?></p>

									</div>

								</div>

							</section>

							<footer class="article-footer">

									<p><?php _e( 'This is the 404.php template.', 'infinitum' ); ?></p>

							</footer>

						</article>

					</div>

				</div>

			</div>

<?php get_footer(); ?>