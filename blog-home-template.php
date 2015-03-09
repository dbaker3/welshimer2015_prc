<?php
/**
Template Name: Blog Home Page
 */
get_header(); 
include TEMPLATEPATH."/inc/blog-sidebar.php" ?>

		<div id="primary" class="site-content">
         <div id="content" role="main">

         <?php $wp_query = new WP_Query(); $wp_query->query('showposts=5' . '&paged='.$paged); ?>
         <?php global $more; $more = 0; ?>

			<?php if ( have_posts() ) : ?>
            <div id="blog-head">
               <h1>Milligan Library Life</h1>
               <p>by the staff of P.H. Welshimer Memorial Library</p>
            </div>
<div id="blog-content">
				<?php welshimer2013_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
                  
                  get_template_part( 'content', get_post_format() ); 
					?>
               <hr>
				<?php endwhile; ?>

				<?php welshimer2013_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>
</div>
			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>

