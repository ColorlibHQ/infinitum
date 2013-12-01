		</div>

			<footer class="footer-outer" role="contentinfo">
			
				<div id="footer-widgets" class="container">

					<?php if( is_front_page()): ?>
	    				<!-- Do Nothing -->
					<?php else: ?>
	     		      <div id="widget-footer" class="col-md-12 clearfix row">
			          	
			          	<div class="col-md-4">
			          		<?php dynamic_sidebar( 'footer1' ); ?>
			          	</div>

			          	<div class="col-md-4">
							<?php dynamic_sidebar( 'footer2' ); ?>
						</div>

						<div class="col-md-4">
							<?php dynamic_sidebar( 'footer3' ); ?>
						</div>

			          </div>
					<?php endif; ?>

				</div>
					
					<div class="row" id="copyright">
				
						<div class="container">
						
							<nav role="navigation">
								<?php infinitum_footer_links(); ?>
							</nav>

						<div class="col span_7 col_last">
							<p class="source-org copyright"><?php echo of_get_option( 'custom_footer_text', 'infinitum' ); ?> 

								<?php do_action( 'infinitum_footer' ); ?>

							</p>
						</div>
					</div>
				</div>
			</footer>

		<?php wp_footer(); ?>

	</body>

</html>