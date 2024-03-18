<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NBLR6YNT0R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NBLR6YNT0R');
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
if ( !is_404() ) :
	get_template_part('components/inc','header');
endif;
?>

<!--Start Sticky Footer-->
<div class="sticky-footer">


