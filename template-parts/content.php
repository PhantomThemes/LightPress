<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lightpress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<div class="content-post-bg">
	 <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><?php the_post_thumbnail(''); ?></a>
                <?php elseif(get_theme_mod('default_thumbnail') != '') : ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><img src="<?php echo esc_attr( get_theme_mod('default_thumbnail')); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive" /></a>
                <?php else : ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image"><img src="<?php echo get_template_directory_uri(); ?>/images/no-blog-thumbnail.jpg" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive" /></a>
              <?php endif; ?>  

    <div class="content-post-area">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt();?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lightpress' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lightpress_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</div>
</div>
</article><!-- #post-## -->
