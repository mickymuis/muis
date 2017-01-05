
<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */

global $row_alt;
?>

<div class="entry fluid-outer <?php if( $row_alt ) echo 'row-alt'; else echo 'row-pri'; ?>"> 
<div class="fluid-inner">

<div class="entry-container <?php if( is_single() && is_active_sidebar( 'sidebar' ) ) echo 'left-floater'; ?>" <?php if( is_single() ) echo 'id="main"'; ?> >
<header class="entry-header">
	<?php
        the_date();
	if (is_single()) the_title('<h1 class="entry-title">', '</h1>');
	else the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h1>');
	?>
</header><!--

-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_search()): ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else: ?>
	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(array(
			'before' => '<div class="page-links"><span class="page-links-title">'.__('Pages:', 'muis').'</span>',
			'after' => '</div>',
			'link_before' => '<span>',
			'link_after' => '</span>',
		));
		?>
                
	</div><!-- .entry-content -->
	<?php endif; ?>
</article>
</div>

<?php if( is_single() && is_active_sidebar( 'sidebar' ) ) : ?>

<div class="sidebar-container right-floater" id="sidebar">
    <?php dynamic_sidebar( 'sidebar' ); ?>
</div>

<?php endif; ?>

</div></div>
