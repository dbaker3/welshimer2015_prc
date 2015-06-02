<?php
/**
 * The Header for our theme.
 * Checks if page is using kb-page template and displays different content if true
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'welshimer2013' ), max( $paged, $page ) );

	?></title>

   <link rel="apple-touch-icon" type="image/png" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-57x57.png">
   <link rel="apple-touch-icon" type="image/png" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-114x114.png">
   <link rel="apple-touch-icon" type="image/png" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-72x72.png">
   <link rel="apple-touch-icon" type="image/png" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-144x144.png">
   <link rel="apple-touch-icon" type="image/png" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-60x60.png">
   <link rel="apple-touch-icon" type="image/png" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-120x120.png">
   <link rel="apple-touch-icon" type="image/png" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-76x76.png">
   <link rel="apple-touch-icon" type="image/png" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-152x152.png">
   <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicons/apple-touch-icon-180x180.png">
   <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-192x192.png" sizes="192x192">
   <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-160x160.png" sizes="160x160">
   <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-96x96.png" sizes="96x96">
   <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-16x16.png" sizes="16x16">
   <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicons/favicon-32x32.png" sizes="32x32">
   <meta name="msapplication-TileColor" content="<?php echo get_template_directory_uri(); ?>/#ffffff">
   <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/favicons/mstile-144x144.png">

   <link rel="profile" href="http://gmpg.org/xfn/11" />
   <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 7]>
	<link href="<?php echo get_template_directory_uri(); ?>/ie6.css" media="screen, projection" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body <?php body_class(); ?>>
	<div id="mobile-menu-wrapper">
		<button id="menu-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="primary-menu" class="menu-text">
		<div id="topbar"></div>
      <nav role="navigation" class="main-navigation">
		<h1 class="assistive-text"><?php _e( 'Menu', 'welshimer2013' ); ?></h1>
		<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'welshimer2013' ); ?>"><?php _e( 'Skip to content', 'welshimer2013' ); ?></a></div>

      <?php // Show kb menu if using kb-page template
      if (is_page_template('kb-page.php')) {      
         wp_nav_menu( array( 'theme_location' => 'kb' ) );
      }
      else {
         wp_nav_menu( array( 'theme_location' => 'primary' ) ); 
      } ?>
			<div class="social-menu">
				<ul>
					<li><a href="https://library.milligan.edu/blog"></a></li><!--Library Blog-->
					<li><a href="https://twitter.com/intent/user?screen_name=MilliganLibrary" target="_blank"></a></li><!--Twitter-->
					<li><a href="https://www.facebook.com/milligancollegelibrary" target="_blank"></a></li><!--Facebook-->
				</ul>
			</div>
		</nav>
	</div><!-- #primary-navigation-->
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<nav class="secondary-menu menu-text"><div class="secondary-menu-main"><?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?></div><div class="secondary-menu-select"><select title="Milligan Links"><option>Go to...</option></select></div></nav>
		<div id="hgroup">
         <?php if (is_page_template('kb-page.php')) { ?>
            <h4 class="milligan-logo"><a href="<?php echo home_url( '/kb' ); ?>" title="<?php bloginfo( 'description' ); ?>">P.H. Welshimer Memorial Library KB</a></h4>
         <?php }
         else { ?>
            <h4 class="milligan-logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/milligan.png" alt="Milligan" /></a></h4>
            <h4 class="welshimer-logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>">P.H. Welshimer Memorial Library</a></h4>
            <!--<img src="<?php bloginfo( 'template_url' ); ?>/images/pr_compliant.png" style="position:absolute;left:-13em;top:0em;width:134px;" />-->
         <?php } ?>
         
         <!--
			<h4 class="milligan-logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/milligan-logo.png" /></a></h4>
         -->
		</div> <!-- #hgroup -->
	</header><!-- #masthead .site-header -->

	<div id="main">
