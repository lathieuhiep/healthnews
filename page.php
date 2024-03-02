<?php
get_header();

$basictheme_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$basictheme_class_elementor =   '';

if ( $basictheme_check_elementor ) :
    $basictheme_class_elementor =   ' site-container-elementor';
endif;
?>

    <main class="site-container<?php echo esc_attr( $basictheme_class_elementor ); ?>">
        <?php
        if ( $basictheme_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>
    </main>

<?php 

get_footer();