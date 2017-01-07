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

	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'muis' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
        
        /* Thumbnail support */
        add_theme_support( 'post-thumbnails' );
        
        /* Set-up menus */
        register_nav_menus( array(
            'primary'   => __( 'Top Right', 'muis' ),
            'secondary'   => __( 'Top Left', 'muis' ) ) );
          
        /**
          * Enable support for the following post formats:
          * aside, gallery, quote, image, and video
          */
        add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
    
	/**
          * Enable custom header in the customizer 
         */
        add_theme_support( 'custom-header', apply_filters( 'muis_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/images/header.jpg' ),
		'width'              => 1600,
		'height'             => 900,
		'flex-height'        => true,
		'video'              => false,
		'header-text'            => true,
                'wp-head-callback'   => 'muis_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/images/header.jpg',
			'thumbnail_url' => '%s/images/header.jpg',
			'description'   => __( 'Default Header Image', 'muis' ),
		),
	) );


        // Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

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

if ( ! function_exists( 'muis_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 * This function was kindly borrowed from the `twentyseventeen` theme
 */
function muis_header_style() {
	$header_text_color = get_header_textcolor();
	$header_text_bgcolor = get_theme_mod( 'header_text_bgcolor', 'blank' );

	// If no custom options for text are set, let's bail.
	// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style id="muis-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.header-text {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.header-text h1 {
			color: #<?php echo esc_attr( $header_text_color ); ?> !important;
		}
	<?php endif; 
		if( 'blank' === $header_text_bgcolor ) :
	?>
		.header-text h1 { background-color: transparent !important; }
	<?php	else: ?>
		.header-text h1 {
			background-color: <?php echo esc_attr( $header_text_bgcolor ); ?> !important;
		}

	<?php	endif; ?>
	</style>
	<?php
}
endif; 

if( !function_exists( 'muis_customize_register' ) ) :
    function muis_customize_register( $wp_customize ) {
        $wp_customize->add_setting( 'header_text_h1', array(
          'type' => 'theme_mod', // or 'option'
          'capability' => 'edit_theme_options',
          'default' => 'Hello, world!',
          'transport' => 'refresh', // or postMessage
          'sanitize_callback' => '',
          'sanitize_js_callback' => '', // Basically to_json.
        ) );
        
        $wp_customize->add_setting( 'header_text_bgcolor', array(
          'type' => 'theme_mod', // or 'option'
          'capability' => 'edit_theme_options',
          'default' => 'blank',
          'transport' => 'refresh', // or postMessage
          'sanitize_callback' => '',
          'sanitize_js_callback' => '', // Basically to_json.
        ) );
        
        $wp_customize->add_section( 'header_text', array(
            'title' => __( 'Header Text' ),
            'description' => __( 'Edit the text displayed in the frontpage header, if no widget is present' ),
            'priority' => 160,
            'capability' => 'edit_theme_options' 
        ) );
        $wp_customize->add_control( 'header_text_h1', array(
            'label' => __( 'Big head' ),
            'type' => 'textarea',
            'section' => 'header_text',
            ) );

	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'header_text_bgcolor', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Header Text Background Color' ),
	      'section' => 'colors',
	    )
	  )
	);
    }
    add_action( 'customize_register', 'muis_customize_register' );
endif;

?>
