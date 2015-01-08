<?php
/**
Template Name: Blog Home Page
 */
get_header(); ?>

		<div id="primary" class="site-content">
      
         <div id="blog-sidebar">
            <h4>Blog Search</h4>
            <form id="blog-search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
               <label for="s" class="assistive-text"><?php _e( 'Search', 'welshimer2013' ); ?></label>
               <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'welshimer2013' ); ?>" />
               <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'welshimer2013' ); ?>" />
            </form>
            <h4>Recent Posts</h4>
            <ul id="blog-recent">
            <?php $recent_posts = wp_get_recent_posts( array('numberposts' => 3) );
            foreach( $recent_posts as $recent ){
               echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
            } ?>
            </ul>
            <h4>Archives</h4>
            <select id="blog-archives" name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
               <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
               <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
            </select>
            <h4>Categories</h4>
            <select id="blog-categories" onchange='document.location.href=this.options[this.selectedIndex].value;'>
               <option value=""><?php echo esc_attr( __( 'Select Category' ) ); ?></option> 
               <?php
                  $categories = get_categories(array('hide_empty' => 0, 'name' => 'category_parent', 'orderby' => 'name',  'hierarchical' => true, 'show_option_none' => __('None')));
                  foreach ($categories as $category) {
                     	$option = '<option value="/category/archives/'.$category->category_nicename.'">';
                        $option .= $category->cat_name;
                     	$option .= ' ('.$category->category_count.')';
                     	$option .= '</option>';
                     	echo $option;
                  }
               ?>
            </select>
         </div>

      
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>

