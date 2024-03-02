<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>

<div class="global-footer__nav">
    <div class="container">
        <div class="grid-layout">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-menu',
                'container' => false,
            ) );
            ?>

            <div class="action-box">
                <a class="btn-back-top" href="#">
                    <i class="fa-solid fa-chevron-up"></i>

                    <span class="txt"><?php esc_html_e('Về đầu trang', 'healthnews'); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
endif;