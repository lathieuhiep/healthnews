<div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="site-page-content">
            <?php
            the_content();
            healthnews_link_page();
            ?>
        </div>
    <?php
	    get_template_part( 'components/inc','comment-form' );
    endwhile;
    ?>
</div>