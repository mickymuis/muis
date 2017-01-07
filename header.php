<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
        <?php wp_head(); ?>
    </head>
<body>
        <span id="menu-button">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </span>
	
        <header id="masthead" class="site-header" role="banner">
		<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
		<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
			<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_id' => 'top-main-menu', 'fallback_cb' => false)); ?>
			<?php wp_nav_menu(array('theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'container_id' => 'top-right-menu', 'fallback_cb' => false)); ?>
		</nav>
	</header><!-- #masthead -->

<?php if( is_home() ) : ?>
    <div id="custom-header-media" class="custom-header-media">
       <?php the_custom_header_markup(); ?> 
    </div>
    <div id="header-widget">
        <div id="header-widget-contents" class="header-contents-outer fluid-outer">
            <div class="header-contents-inner fluid-inner">
            <?php 
                if( is_active_sidebar( 'fw-header' ) ) 
                    dynamic_sidebar( 'fw-header' );
                else{
            ?>
                    <span class="header-text"><h1><?php echo get_theme_mod( 'header_text_h1', '' ); ?></h1></span>
            <?php } ?>
            </div>
        </div>
    </div>
<?php endif; ?>

