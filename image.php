<?php
/**
 * The WordPress template hierarchy first checks for any
 * MIME-types and then looks for the attachment.php file.
 *
 * @link codex.wordpress.org/Template_Hierarchy#Attachment_display 
 */ 

get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-md-8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header> 
							
							<div class="page-header"><h1 class="single-title" itemprop="headline"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h1></div>
							
							<p class="meta"><span class="glyphicon glyphicon-time"></span> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></time> <span class="glyphicon glyphicon-user"></span> <?php the_author_posts_link(); ?> <span class="glyphicon glyphicon-folder-open"></span> <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							
							<!-- To display current image in the photo gallery -->
							<div class="attachment-img">
							      <a href="<?php echo wp_get_attachment_url($post->ID); ?>">
							      							      
							      <?php 
							      	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
							       
								      if ($image) : ?>
								          <img src="<?php echo $image[0]; ?>" alt="" />
								      <?php endif; ?>
							      
							      </a>
							</div>
							
							<!-- To display thumbnail of previous and next image in the photo gallery -->
							<ul id="gallery-nav" class="clearfix">
								<li class="next pull-left"><?php next_image_link() ?></li>
								<li class="previous pull-right"><?php previous_image_link() ?></li>
							</ul>
							
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","infinitum") . ':</span> ', ' ', '</p>'); ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
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
				
				<div id="sidebar1" class="col-md-4 sidebar" role="complementary">
				
					<?php if ( !empty($post->post_excerpt) ) { ?> 
					<p class="alert alert success"><?php echo get_the_excerpt(); ?></p>
					<?php } ?>
								
					<!-- Using WordPress functions to retrieve the extracted EXIF information from database -->
					<div class="well">
					
						<h3><?php _e("Image metadata","infinitum"); ?></h3>
					
					   <?php
					      $imgmeta = wp_get_attachment_metadata( $id );
					
					// Convert the shutter speed retrieve from database to fraction
					      if ((1 / $imgmeta['image_meta']['shutter_speed']) > 1)
					      {
					         if ((number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1)) == 1.3
					         or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.5
					         or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.6
					         or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 2.5){
					            $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
					         }
					         else{
					           $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
					         }
					      }
					      else{
					         $pshutter = $imgmeta['image_meta']['shutter_speed'] . " seconds";
					       }
					
					// Start to display EXIF and IPTC data of digital photograph
					       if ( $imgmeta['image_meta']['created_timestamp'] ) { 
					           echo __("Date Taken","infinitum") . ": " . date("d-M-Y H:i:s", $imgmeta['image_meta']['created_timestamp'])."<br />"; }
					       if ( $imgmeta['image_meta']['copyright'] ) { 
					           echo __("Copyright","infinitum") . ": " . $imgmeta['image_meta']['copyright']."<br />"; }
					       if ( $imgmeta['image_meta']['credit'] ) { 
					           echo __("Credit","infinitum") . ": " . $imgmeta['image_meta']['credit']."<br />"; }
					       if ( $imgmeta['image_meta']['title'] ) { 
					           echo __("Title","infinitum") . ": " . $imgmeta['image_meta']['title']."<br />"; }
					       if ( $imgmeta['image_meta']['caption'] ) { 
					           echo __("Caption","infinitum") . ": " . $imgmeta['image_meta']['caption']."<br />"; }
					       if ( $imgmeta['image_meta']['camera'] ) { 
					           echo __("Camera","infinitum") . ": " . $imgmeta['image_meta']['camera']."<br />"; }
					       if ( $imgmeta['image_meta']['focal_length'] ) { 
					           echo __("Focal Length","infinitum") . ": " . $imgmeta['image_meta']['focal_length']."mm<br />"; }
					       if ( $imgmeta['image_meta']['aperture'] ) { 
					           echo __("Aperture","infinitum") . ": f/" . $imgmeta['image_meta']['aperture']."<br />"; }
					       if ( $imgmeta['image_meta']['iso'] ) { 
					           echo __("ISO","infinitum") . ": " . $imgmeta['image_meta']['iso']."<br />"; }
					       if ( $pshutter ) { 
					           echo __("Shutter Speed","infinitum") . ": " . $pshutter . "<br />"; }
					   ?>
					</div>
					
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>