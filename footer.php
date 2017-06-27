<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lightpress
 */

?>


	</div><!-- #content -->

</div><!-- #page -->

<div id="secondary" class="widget-area clearfix" role="complementary">
	<?php dynamic_sidebar( 'footer' ); ?>
</div><!-- #secondary -->

<footer class="clearfix">

	<section class="footer-info">
		<div class="container">
			<div class="pull-left"><?php echo __('Developed by','lightpress'); ?> <a href="http://phantomthemes.com"><?php echo __('Phantom Themes','lightpress'); ?></a> | <?php echo bloginfo(); ?> <?php echo __('All Rights Reserved.','lightpress'); ?></div>
			<div class="pull-right"><?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?></div>
    	</div>
	</section>


		</footer>



<?php wp_footer(); ?>

</body>
</html>
