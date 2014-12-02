<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer widget-text" role="contentinfo">
      <div class="footer-column">
      <div class="footer-logo"><a href="http://www.milligan.edu" target="_blank">&#xe601;</a></div>
      <div class="site-info">
			<?php do_action( 'welshimer2013_credits' ); ?>
         ©2014 Milligan College. All Rights Reserved.
		</div><!-- .site-info -->
      </div>
      <div class="footer-column">
         <p>200 Blowers Blvd., Milligan College, TN 37682</p>
         <p>423.461.8703 | <a href="mailto:<?php echo antispambot('library@milligan.edu') ?>"><?php echo antispambot('library@milligan.edu') ?></a></p>
         <p><a href="http://www.milligan.edu/wp-content/uploads/2014/08/CampusMap.pdf" target="_blank">Campus Map</a> | <a href="http://www.milligan.edu/visit" target="_blank">Directions &amp; Accommodations</a></p>
      </div>
      <div class="footer-column">
         <p><a href="http://www.milligan.edu/about" target="_blank">About Milligan</a></p>
         <p><a href="http://www.milligan.edu/employment" target="_blank">Careers at Milligan</a></p>
         <p><a href="http://www.milligan.edu/advancement" target="_blank">Give to Milligan</a></p>
      </div>      
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>
<?php do_action( 'footer_scripts' ); ?>

<noscript><div class="foot-noscript"><p>Some features may not work properly (or at all!) with Javascript disabled or in some older browsers. (<a target="_blank" href="http://enable-javascript.com/">How can I fix this?</a>)</p><p class="old-ie-nojs">Yowza. It's worse than we thought. This site REALLY isn't going to work very well with your current setup. You should probably upgrade your browser.</p></div></noscript>
</body>
</html>