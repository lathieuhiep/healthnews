<?php
$sidebar = basictheme_get_option('opt_post_cat_sidebar_position', 'right');
$per_row = basictheme_get_option('opt_post_cat_per_row', '2');

$class_col_content = basictheme_col_use_sidebar($sidebar, 'sidebar-main');

$grid_col = 'grid-col-' . $per_row;
if ( $sidebar !== 'hide' ) {
    $grid_col = 'grid-sidebar-col-' . $per_row;
}
?>

<div class="site-container archive-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php if ( have_posts() ) : ?>
                    <div class="content-archive-post <?php echo esc_attr( $grid_col ); ?>">
		                <?php
		                while ( have_posts() ) :
			                the_post();
                        ?>
                            <div class="item">
                                <div class="item__content">
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							                <?php if (is_sticky() && is_home()) : ?>
                                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
							                <?php
							                endif;

							                the_title();
							                ?>
                                        </a>
                                    </h2>

                                    <div class="post-thumbnail">
						                <?php the_post_thumbnail('large'); ?>
                                    </div>

					                <?php basictheme_post_meta(); ?>

                                    <div class="post-desc">
                                        <p>
							                <?php
							                if (has_excerpt()) :
								                echo esc_html(get_the_excerpt());
							                else:
								                echo wp_trim_words(get_the_content(), 30, '...');
							                endif;
							                ?>
                                        </p>

                                        <a href="<?php the_permalink(); ?>" class="text-read-more">
							                <?php esc_html_e('Read more', 'basictheme'); ?>
                                        </a>

						                <?php basictheme_link_page(); ?>
                                    </div>
                                </div>
                            </div>
		                <?php
		                endwhile;
		                wp_reset_postdata();
		                ?>
                    </div>
                <?php
	                basictheme_pagination();
                else:
	                if ( is_search() ) :
		                get_template_part('template-parts/post/content', 'no-data');
	                endif;
                endif;
                ?>
            </div>

            <?php
            if ( $sidebar !== 'hide' ) :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>