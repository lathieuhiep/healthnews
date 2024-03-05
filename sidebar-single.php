<?php if( is_active_sidebar( 'sidebar-single' ) ): ?>

    <aside class="<?php echo esc_attr( healthnews_col_sidebar() ); ?> site-sidebar site-sidebar-single order-1">
        <?php dynamic_sidebar( 'sidebar-single' ); ?>
    </aside>

<?php endif; ?>