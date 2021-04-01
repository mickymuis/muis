<div class="fluid-outer site-footer-border">
<div class="fluid-inner">
<footer id="footer" class="site-footer">
    <div class="footer-left">
        <?php
        if( is_active_sidebar( 'footer-1' ) )
            dynamic_sidebar( 'footer-1' );
        ?>
    </div>

    <div class="footer-left">
        <?php
        if( is_active_sidebar( 'footer-2' ) )
            dynamic_sidebar( 'footer-2' );
        ?>
    </div>
    
    <div class="footer-right">
        <?php
        if( is_active_sidebar( 'footer-4' ) )
            dynamic_sidebar( 'footer-4' );
        ?>
    </div>

    <div class="footer-right">
        <?php
        if( is_active_sidebar( 'footer-3' ) )
            dynamic_sidebar( 'footer-3' );
        ?>
    </div>
    <div class="colophon">
        &copy; 2021
    </div>


</footer>

</div></div>
<?php wp_footer(); ?>
</body>
</html>
