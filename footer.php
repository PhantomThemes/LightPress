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

<!-- footer start -->
<footer class="clearfix">
	<section class="footer-info">
		<div class="container">
    		<p class="float-left"><?php echo __('Developed by','lightpress'); ?> <a href="https://phantomthemes.com"><?php echo __('Phantom Themes','lightpress'); ?></a> | <?php echo bloginfo(); ?> <?php echo __('All Rights Reserved.','lightpress'); ?></p>
			<div class=" float-lg-right float-xl-right">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
			</div>
    	</div>
	</section>
</footer>
<!-- footer end -->

<?php wp_footer(); ?>

</body>
</html>
