<?php
/**
Template Name: Canvas Searchbox
 */
?>
<html>
   <head>
      <script type='text/javascript' src='https://library.milligan.edu/wp-includes/js/jquery/jquery.js'></script>
      <link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.1.1' type='text/css' media='all' />
      <script type='text/javascript' src='https://library.milligan.edu/wp-content/plugins/phw-searchbox/searchbox.js'></script>
      <script type='text/javascript' src='https://library.milligan.edu/wp-content/plugins/phw-searchbox/topics.js'></script>
      <link rel='stylesheet' id='searchboxcss-css'  href='https://library.milligan.edu/wp-content/plugins/phw-searchbox/searchbox.css' type='text/css' media='all' />
      <script type='text/javascript' src='https://support.ebscohost.com/eit/scripts/ebscohostsearch.js'></script>
      <style>
          html {font-family:"Open Sans";}
          .entry-title {display:none;}
          .tab-links li {width:16.61%;}
      </style>  
   </head>
   <body>
      <div id="primary" class="site-content">
         <div id="content" role="main">
            <?php while ( have_posts() ) : the_post(); ?>
               <?php get_template_part( 'content', 'page' ); ?>
            <?php endwhile; // end of the loop. ?>
         </div><!-- #content -->
      </div><!-- #primary .site-content -->
   </body>
</html>
