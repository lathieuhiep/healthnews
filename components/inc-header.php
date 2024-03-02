<?php
$sticky_menu = healthnews_get_option( 'opt_menu_sticky', '1' );
$logo = healthnews_get_option( 'opt_general_logo' );
$cart = healthnews_get_option( 'opt_menu_cart', '1' );
?>
<header class="global-header <?php echo esc_attr( $sticky_menu == '1' ? 'active-sticky-nav' : '' ); ?>">
    <nav class="site-navigation container">
        <div class="site-navigation__logo">
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

        <div id="primary-menu" class="site-navigation__menu collapse navbar-collapse d-lg-block">
			<?php
			if ( has_nav_menu( 'primary' ) ) :
				wp_nav_menu( array(
					'theme_location' => 'primary',
                    'menu_class' => 'd-lg-flex justify-content-lg-end',
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

		<?php if ( class_exists( 'Woocommerce' ) && $cart == '1' && ! is_cart() && ! is_checkout() ) : ?>
            <div class="site-navigation__cart d-flex align-items-center">
				<?php
				do_action( 'healthnews_woo_shopping_cart' );

				the_widget( 'WC_Widget_Cart', '' );
				?>
            </div>
		<?php endif; ?>
    </nav>
</header>