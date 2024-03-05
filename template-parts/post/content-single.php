<?php
$categories = get_the_category(get_the_ID());
?>

<div id="post-<?php the_ID() ?>" class="single-post-content">
    <?php if ( !empty($categories) ) : ?>
        <h2 class="cate-name">
		    <?php echo esc_html($categories[0]->name); ?>
        </h2>
    <?php endif; ?>

    <h1 class="single-post-content__title">
		<?php the_title(); ?>
    </h1>

	<?php healthnews_post_meta(); ?>

    <div class="single-post-content__detail">
		<?php
		the_content();

		healthnews_link_page();
		?>
    </div>

    <div class="single-post-content__tax">
		<?php if( get_the_category() ): ?>
            <p class="post-category">
				<?php
				esc_html_e('Category: ','healthnews');
				the_category( ', ' );
				?>
            </p>
		<?php
		endif;

		if( get_the_tags() ):
        ?>
            <p class="post-tag">
				<?php
				esc_html_e( 'Tag: ','healthnews' );
				the_tags('',', ');
				?>
            </p>
		<?php endif; ?>
    </div>
</div>

<?php
get_template_part( 'components/inc','comment-form' );