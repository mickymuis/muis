<?php
/* Template for image-class posts */

global $last_id;
global $next_id;

/* lets the user specify a background color for the post by adding its value as a meta tag */
$background_color ="#ffffff";
$bgcolor_metatag =get_post_meta( $post->ID, 'background_color', true );
if( !empty( $bgcolor_metatag ) )
    $background_color =esc_attr( $bgcolor_metatag );
$frame_color =esc_attr( get_post_meta( $post->ID, 'frame_color', true ) );
?>

<div class ="entry gallery-backdrop" style="background-color: <?php echo $background_color;?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="gallery-image" <?php if( !empty( $frame_color ) ) echo "style=\"background-color: $frame_color;\"";?> >
            <a href="<?php echo esc_url(wp_get_shortlink( $post->ID ));?>#main" rel="bookmark">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
<?php if( !is_single() ) : ?>
        <div class="gallery-label">
        <?php the_title( '<h1>', '</h1>' );
        the_excerpt();?>
        </div>
        <div class="gallery-next-button button-link">
            <a><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>
        </div>
        <div class="gallery-prev-button button-link">
            <a><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>
        </div>
<?php endif; ?>
    </article>
</div>

<?php if( is_single() ): ?>

<div class="fluid-outer row-pri">
<div class="fluid-inner">
<div class="entry-container <?php if( is_active_sidebar( 'sidebar' ) ) echo 'left-floater'; ?>" id="main">
<div class="post-inner">

<header class="entry-header">
    <?php the_title( '<h1>', '</h1>' ); ?>
</header>

<article>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>

</div></div>

<?php if( is_active_sidebar( 'sidebar' ) ) : ?>
<div class="sidebar-container right-floater" id="sidebar">
    <?php dynamic_sidebar( 'sidebar' ); ?>
</div>
<?php endif; ?>

</div></div>

<?php endif; ?>

