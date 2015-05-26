<?php
/**
Template Name: Canvas Searchbox 
*/


get_header();
wp_dequeue_script("iframenonewtab");
?>

<style>
   html {margin-top: 0 !important;}
   body {background-image: none;}
   #wpadminbar, #masthead, #primary-menu, .entry-title, #mobile-menu-wrapper, footer {display:none !important;}
   .site-content {min-height: 0 !important;}
</style>

      <div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('body-text'); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">

						<?php the_content(); ?>
						
						<div style="float: right; position: relative; top: -12em; right: 14em;">
							<h1 class="chat-icon">Need Help?</h1>
							<div class="needs-js">
								Chat service is unavailable. Please ensure that <a href="http://enable-javascript.com/">Javascript is enabled</a>
							</div>
						</div>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'welshimer2013' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'welshimer2013' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->
<?php get_footer() ?>
