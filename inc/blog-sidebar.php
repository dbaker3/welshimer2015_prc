         <div id="blog-sidebar">
            <div id="sidebar-logo">
               <img alt="It's your library and so much more!" src="http://library.milligan.edu/wp-content/uploads/2014/10/itsyourlibrary600.png" />
            </div>
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
