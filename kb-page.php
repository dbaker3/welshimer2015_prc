<?php
/**
Template Name: KB Page
This template provides a method for presenting pages only to logged in users.
header.php detects if this template is used, and if so, displays headers, menus,
and styling differently.
*/

if (!is_client_local() ) {
   header( 'Location:' . site_url());
   exit;
}

if (is_user_logged_in() ) { 

   get_header(); 
   wp_enqueue_style('kbstyle', get_template_directory_uri() . '/kbstyle.css');
   
   ?>

   <div id="primary" class="site-content">
	   <div id="content" role="main">
	   	<?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
	   		<?php comments_template( '', true ); ?>
	   		<?php endwhile; // end of the loop. ?>
	   </div><!-- #content -->
   </div><!-- #primary .site-content -->

   <?php get_footer(); 

}
else { ?>
   <?php header( 'Location:' . wp_login_url(get_permalink()) ); ?>
<?php }


/* Returns True if client is on same network (1st octet) as server */
function is_client_local() {
   if (isset($_SERVER['SERVER_ADDR'])) {
      $server_addr = $_SERVER['SERVER_ADDR'];
   }
   elseif (isset($_SERVER['LOCAL_ADDR'])) {
      $server_addr = $_SERVER['LOCAL_ADDR'];
   }
   elseif (is_numeric(substr(gethostbyname($_SERVER['SERVER_NAME']),0,3))) {
      $server_addr = gethostbyname($_SERVER['SERVER_NAME']);
   }
   
   $client_octets = explode(".", $_SERVER['REMOTE_ADDR']);
   $server_octets = explode(".", $server_addr);
   
   if ($client_octets[0] === $server_octets[0]) {
      return true;
   }
   else {
      return false;
   }
}