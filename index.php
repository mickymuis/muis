<?php get_header();?>

<div id="main-content">

<?php
global $last_id ;
global $next_id;
global $row_alt;

while( have_posts() ) : the_post();
    if( empty( $last_id ) ) {
        if( !is_active_sidebar( 'fw-header' ) || is_single() )
            echo '<div class="first-post-spacer"></div>';
    
    }
    $next_post =get_adjacent_post();
    if( !empty( $next_post ) )
        $next_id =$next_post->ID;
    
    $prev_post =get_adjacent_post( true, '', false );
    if( !empty( $prev_post ) )
        $last_id =$prev_post->ID;

    if( has_post_format( 'image' ) && !is_search() ) {
        get_template_part( 'content', 'image' );
    }
    else {
        get_template_part( 'content', null );
    }
    $row_alt =!$row_alt;
endwhile;

if( is_single() )
    muis_post_nav();
else {
    muis_paging_nav(); ?>
    <div id="infinite-loader"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
    <span class="screen-reader-text">Loading...</span></div>
    <?php
}?>

</div> <!-- #main-content -->

<?php get_footer(); ?>
