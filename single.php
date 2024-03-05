<?php
get_header();

$sidebar = healthnews_get_option('opt_post_single_sidebar_position', 'right');
$class_col_content = healthnews_col_use_sidebar( $sidebar, 'sidebar-single' );

get_template_part( 'components/inc', 'breadcrumbs' );
?>

<div class="site-container single-post-warp">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();
	                healthnews_update_post_views_count();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>
            </div>

            <?php
            if ( $sidebar !== 'hide' && is_active_sidebar( 'sidebar-single' ) ) :
	            get_sidebar('single');
            endif;
            ?>
        </div>

        <?php
        $show_related = healthnews_get_option('opt_post_single_related', '1');

        if ( $show_related == '1' ) :
	        get_template_part( 'template-parts/post/inc','related-post' );
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>

