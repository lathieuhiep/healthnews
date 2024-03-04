<?php
$sticky_menu = healthnews_get_option( 'opt_menu_sticky', '1' );
$logo = healthnews_get_option( 'opt_general_logo' );
$hotline = healthnews_get_opt_contact_hotline();
$email = healthnews_get_opt_contact_email();
$link_facebook = healthnews_get_opt_link_facebook();
?>

<header class="global-header">
    <div class="container">
        <div class="grid-layout">
            <div class="logo">
                <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo['id'] ) ) :
                        echo wp_get_attachment_image( $logo['id'], 'full' );
                    else :
                        ?>

                        <img class="logo-default"
                             src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>"
                             alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

                    <?php endif; ?>
                </a>

                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu"
                        aria-controls="site-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </div>

            <div class="contact">
                <a class="item" href="tel:<?php echo esc_attr(healthnews_preg_replace_ony_number($hotline)); ?>">
                    <strong><?php esc_html_e('Đường dây nóng:', 'healthnews'); ?></strong>
                    <strong><?php echo esc_html($hotline); ?></strong>
                </a>

                <a class="item" href="mailto:<?php echo esc_attr($email); ?>">
                    <strong><?php esc_html_e('Email:', 'healthnews'); ?></strong>
                    <strong><?php echo esc_html($email); ?></strong>
                </a>
            </div>
        </div>
    </div>
</header>

<nav class="nav-primary <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <div class="container">
        <div id="primary-menu" class="primary-menu collapse navbar-collapse d-lg-block">
            <?php
            if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => false,
                ) );
            else:
                ?>
                <ul class="main-menu">
                    <li>
                        <a href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
                            <?php esc_html_e( 'ADD TO MENU', 'healthnews' ); ?>
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="header-action-box">
    <div class="container">
        <div class="grid-layout d-flex justify-content-between align-items-center">
            <div class="item"></div>

            <div class="item right-box d-flex align-items-center">
                <a class="link-facebook d-inline-block me-3" href="<?php echo esc_url($link_facebook); ?>" target="_blank">
                    <i class="fa-brands fa-square-facebook"></i>
                </a>

	            <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>