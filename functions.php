<?php
/**
  * Muis - functions
  *
  * @package Muis
  */

/*if( !isset( $content_width ) ) 
    $content_width =1000;*/

if( !function_exists( 'muis_setup' ) ) :

    /**
     * General Wordpress theme setup
     */
    function muis_setup() {

        add_theme_support( 'post-thumbnails' );
        register_nav_menus( array(
            'primary'   => __( 'Top Right', 'muis' ),
            'secondary'   => __( 'Top Left', 'muis' ) ) );
          
        /**
          * Enable support for the following post formats:
          * aside, gallery, quote, image, and video
          */
        add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
    

    }
add_action( 'after_setup_theme', 'muis_setup' );
endif;

if( !function_exists( 'muis_scripts' ) ) :
    /**
     * Configures scripts and stylesheets
     */
    function muis_scripts() {
        /** Enable the core javascript file */

        wp_enqueue_script( 'functions', get_template_directory_uri() . '/js/functions.js', array ( 'jquery' ), 1.0, true);
        wp_enqueue_style( 'style', get_stylesheet_uri() );
        
    }
add_action( 'wp_enqueue_scripts', 'muis_scripts' );
endif;

if( !function_exists( 'muis_widgets_init' ) ) :
    /**
     * Registers widget locations
     */
    function muis_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Sidebar', 'muis' ),
            'id'            => 'sidebar',
            'before_widget' => '<aside id="%1$s" class="sidebar-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ) );
        
        register_sidebar( array(
            'name'          => __( 'Full Width Header', 'muis' ),
            'id'            => 'fw-header',
            'before_widget' => '<div id="%1$s" class="fw-header %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h1 class="fw-header-tile">',
            'after_title'   => '</h1>'
        ) );
        
        register_sidebar( array(
            'name'          => __( 'Footer One', 'muis' ),
            'id'            => 'footer-1',
            'before_widget' => '<aside id="%1$s" class="sidebar-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ) );
        
        register_sidebar( array(
            'name'          => __( 'Footer Two', 'muis' ),
            'id'            => 'footer-2',
            'before_widget' => '<aside id="%1$s" class="sidebar-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ) );
        register_sidebar( array(
            'name'          => __( 'Footer Three', 'muis' ),
            'id'            => 'footer-3',
            'before_widget' => '<aside id="%1$s" class="sidebar-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ) );
        register_sidebar( array(
            'name'          => __( 'Footer Four', 'muis' ),
            'id'            => 'footer-4',
            'before_widget' => '<aside id="%1$s" class="sidebar-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ) );
     
    }
add_action( 'widgets_init', 'muis_widgets_init' );
endif;

if (!function_exists('muis_paging_nav')):
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
    function muis_paging_nav() {
    // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>

        <nav class="navigation paging-navigation" role="navigation">
            <?php next_posts_link(); ?>
        </nav>

        <?php
    }
endif;

if (!function_exists('muis_post_nav')):
    /**
    * Display navigation to next/previous post when applicable.
    */
    function muis_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }

        ?>
        <nav class="navigation post-navigation fluid-outer" role="navigation">
        <h1 class="screen-reader-text"><?php _e('Post navigation', 'muis'); ?></h1>

        <div class="nav-links fluid-inner">
            <?php
            if (is_attachment()):
                previous_post_link('%link', __('<span class="meta-nav"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> %title</span>', 'muis'));
            else:
                next_post_link('%link', __('<span class="meta-nav">%title <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>', 'muis'));
                previous_post_link('%link', __('<span class="meta-nav"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> %title</span>', 'muis'));
            endif;
            ?>
        </div>
        <!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }
endif;

if( !function_exists( 'more_posts' ) ) :
    function more_posts() {
        global $wp_query;
        return $wp_query->current_post + 1 < $wp_query->post_count;
    }
endif;

?>
