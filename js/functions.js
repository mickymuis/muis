/**
 * Muis - Theme functions file
 *
 * @package Muis
 */
var _window = jQuery(window);
var _document = jQuery(document);
var _body = jQuery('body');


var _navbar_visible_area =100;
var _tablet_width = 950;
var _smallscreen_width = 481;
var _gallery_image_height_factor =0.75;
var _gallery_image_width_factor =0.9;
var _gallery_image_border =20;
var _ajax_loader_edge =150;

var _vmin =function() {
    if( _window.height() < _window.width() )
        return _window.height();
    else
        return _window.width();
};

var _vmax =function() {
    if( _window.height() > _window.width() )
        return _window.height();
    else
        return _window.width();
};

( function($) { 

    // Custom frontpage header
    var header = {
        widget_el: false,
        widget_content_el: false,
        media_el: false,
        font_size_vmax: 0.04,
        init: function() {
            this.widget_el =$('#header-widget');
            this.widget_content_el =this.widget_el.find( '#header-widget-contents' );
            this.media_el =$('#custom-header-media');
            if( this.widget_el.length == 1 && this.media_el.length == 1 ) {
                _window.on( 'ready load resize', this.update );
            }
        },
        update: function() { 
            var mediaHeight =header.media_el.height();
            header.widget_el.css( 'height', mediaHeight + 'px' );
            if( header.widget_content_el.length == 1 ) {

                var text_el =header.widget_content_el.find( '.header-text h1' );
                if( text_el.length == 1 ) {
                    text_el.css( 'font-size', Math.round( _vmax() * header.font_size_vmax ) + 'px' );
                }

                var contentHeight =header.widget_content_el.height();
                if( contentHeight < mediaHeight )
                    header.widget_content_el.css( 'margin-top', Math.round( mediaHeight / 2 - contentHeight / 2 ) );
                else
                    header.widget_content_el.css( 'margin-top', '0' );
            }
        }
    };
    header.init();

    // Navbar
    var navbar = {
        header: false,
        menu_button: false,
        init: function() {
            this.header =$('#masthead');
            if( this.header.length == 1 ) {
                _window.on( 'ready load resize', this.update );
                _window.on( 'scroll.fixed', navbar.scroll );
            }
            this.menu_button =$('#menu-button');
            if( this.menu_button.length == 1 ) {
                this.menu_button.on( 'click', function() { navbar.header.fadeIn( 'fast' ); } );
            }
        },
        update: function() {
            // Make room for the admin panel
            var wpadmin =$('#wpadminbar');
            if( wpadmin.length == 1 ) {
                navbar.header.css( 'top', wpadmin.height() + 'px' ); 
            }
            else {
                navbar.header.css( 'top', '0' );
            }

            if( _window.width() < _tablet_width ) {
                navbar.header.hide();
            }
            navbar.scroll();

        },
        scroll: function() {
            if( _window.width() < _tablet_width ) {
                navbar.header.fadeOut( 'fast' );
            }
            else if( _window.scrollTop() > _navbar_visible_area && navbar.header.css( 'display' ) !== 'none' ) {
                navbar.header.fadeOut( 'fast' );
            } else if( _window.scrollTop() <= _navbar_visible_area && navbar.header.css( 'display' ) === 'none' ) {
                navbar.header.fadeIn( 'fast' );
            }
        }


    };
    navbar.init();

    // Sidebar
    var sidebar = {
        el: false,
        main: false,
        default_width: false,
        init: function() {
            this.el =$('#sidebar');
            this.main =$('#main');
            if( this.el.length == 1 && this.main.length == 1 ) {
                this.default_width =this.main.css( 'width' );
                _window.on( 'load ready resize', this.update );
            }
        },
        update: function() {
            if( _window.width() < _tablet_width ) {
                sidebar.el.hide();
                sidebar.main.css( 'width', '100%' );
            }
            else {
                sidebar.main.css( 'width', sidebar.default_width );
                sidebar.el.show();
            }

        }
    };
    sidebar.init();

    // Gallery mode - enables if posts of the image-class are shown
    var gallery = {
        images: false,
        init: function() {
            /*this.update();
            if( this.images.length > 0 ) {
                this.update();*/
                _window.on( 'ready load resize', gallery.update );
            //}
        },
        update: function() {
            gallery.images =$('.gallery-backdrop');
            var winWidth =_window.width();
            var winHeight =_window.height();
            
            // Center every image and make the backdrop window-sized
            var previous =null;
            gallery.images.each( function(index) {
                var backdrop =$(this);
                backdrop.css( 'width', winWidth + 'px' );
                backdrop.css( 'height', winHeight + 'px' );
                var container =backdrop.find('.gallery-image');
                if( container.length == 0 )
                    return;
                var image =container.find('img').first();
                
                // Scale image depending on image and window width-height ratio
                if( image.height() / image.width() < winHeight / winWidth ) {
                    image.css( 'height', 'auto' );
                    if( winWidth < _smallscreen_width )
                        image.css( 'width', winWidth + 'px' );
                    else
                        image.css( 'width', Math.round( winWidth * _gallery_image_width_factor ) + 'px' );
                    if( image.height() <= 0 ) 
                        return;
                } else {
                    image.css( 'width', 'auto' );
                    image.css( 'height', Math.round( winHeight * _gallery_image_height_factor ) + 'px' );
                    if( image.width() <= 0 )
                        return;
                }

                /*container.css( 'margin-top', -Math.round( container.height() / 2 ) + 'px' );
                container.css( 'margin-left', -Math.round( container.width() / 2 ) + 'px' );*/
                container.css( 'margin-top', -Math.round( image.height() / 2 + _gallery_image_border ) + 'px' );
                container.css( 'margin-left', -Math.round( image.width() / 2 + _gallery_image_border ) + 'px' );
                
                image.fadeIn( 'fast' );

                // Fix the 'prev image' button
                var prev_top =previous != null ? previous.position().top : 0;
                var prev_bttn =backdrop.find( '.gallery-prev-button' );
                prev_bttn.off( 'click' );
                prev_bttn.on( 'click', function(e) {
                            e.preventDefault();
                            $('html,body').animate( { scrollTop: prev_top }, 400 );
                        } );

                // Now fix the 'next image' button
                
                var next_bttn =backdrop.find( '.gallery-next-button' );
                next_bttn.off( 'click' );

                if( index == gallery.images.length - 1 ) {
                    next_bttn.on( 'click', function(e) {
                                e.preventDefault();
                                var link =$(this);
                                link.off( 'click' );
                                $("html, body").animate( { scrollTop: _document.height() - _window.height() }, 400 );
                                loading.forceLoad( true );
                            } );
                }
                else {
                    next_bttn.on( 'click', function(e) {
                                e.preventDefault();
                                $("html, body").animate( { scrollTop: backdrop.position().top + backdrop.height() }, 400 );
                            } );
            
                }

                previous =backdrop;
            } );
        }

    };
    gallery.init();
    // Infinite loading for index page
    var loading = {
        start_from: _ajax_loader_edge,
        el: false,
        nav: false,
        loader: false,
        enabled: false,
        ajax: false,
        init: function() {
            this.el = $('.paging-navigation a');
            if (this.el.length == 1) {
                this.nav = this.el.parent();
                this.loader = $('#infinite-loader');
                this.enabled =true;
                _window.on('ready load resize scroll.loading', loading.process);
            }
        },
        process: function() {
            if (loading.enabled && !loading.ajax) {
                if (_window.scrollTop() > (_document.height() - _window.height()) - loading.start_from) {
                    loading.load(false);
                }
            }
        },
        forceLoad: function() { 
            if (loading.enabled && !loading.ajax) {
                loading.load(true);
            }
        },
        load: function( focus ) {
                loading.loader.addClass('active');
                loading.ajax = true;
                $.ajax({
                    type: 'GET',
                    url: loading.el.attr('href'),
                    dataType: 'html',
                    success: function(response) {
                        var html = $(response);
                        var next_link = html.find('.paging-navigation a');
                        var items = html.find('.entry');
                        items.each(function() {
                            var $entry =$(this);
                            $entry.insertBefore(loading.nav);
                            var $gimage =$entry.find( '.gallery-image img' );
                            // Lazy loading can prevent the load event from being triggered, so we disable it for the gallery images
                            $gimage.attr('loading', 'eager' );
                            if( $gimage.length == 1 ) {
                                $gimage.one( 'load', function() {
                                    gallery.update();
                                    $entry.hide();
                                    $entry.fadeIn('slow');
                                } );
                            }
                        });
                        if (next_link.length == 1) {
                            loading.el.attr('href', next_link.attr('href'));
                            loading.ajax = false;
                        }
                        else {
                            _window.off('scroll.loading');
                        }
                        loading.loader.removeClass('active');
                        // Optionally, scroll to the first new element
                        if( focus ) {
                            var first_item =items.first();
                            $("html, body").animate( { scrollTop: first_item.position().top }, 400 );
                        }
                    }
                });
            }
        
    };
    loading.init();

})( jQuery );
