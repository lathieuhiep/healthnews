<?php
$new_post_ids = get_query_var('new_post_ids');
$categories = healthnews_get_option('opt_tpl_home_list_category');

if ( empty($categories) ) {
	return;
}
?>

<div class="list-categories">
	<?php
	foreach ($categories as $category) :
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 5,
			'orderby' => 'id',
			'order' => 'desc',
			'cat' => $category,
			'post__not_in' => $new_post_ids,
			'ignore_sticky_posts' => 1,
		);

		$query = new WP_Query($args);

	    if ($query->have_posts()) :
		    $category_name = get_cat_name($category);
    ?>
	    <div class="item-cate">
		    <h3 class="cat-name">
			    <a href="<?php echo esc_url( get_category_link($category) ); ?>"><?php echo esc_html( $category_name ); ?></a>
		    </h3>

		    <div class="grid-layout">
			    <?php
			    $i = 1;
			    while ($query->have_posts()): $query->the_post();
				    $count = $query->post_count;
                ?>
				    <div class="item-post">
					    <div class="thumbnail">
						    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							    <?php
							    if (has_post_thumbnail()) :
								    the_post_thumbnail('large');
							    else:
								    ?>
								    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/no-image.png')) ?>"
								         alt="<?php the_title(); ?>"/>
							    <?php endif; ?>
						    </a>
					    </div>

					    <h2 class="title">
						    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							    <?php the_title(); ?>
						    </a>
					    </h2>

					    <?php if (  $i == 1 ) : ?>
						    <div class="content">
							    <p>
								    <?php
								    if (has_excerpt()) :
									    echo esc_html(wp_trim_words(get_the_excerpt(), 45, '...'));
								    else:
									    echo esc_html(wp_trim_words(get_the_content(), 45, '...'));
								    endif;
								    ?>
							    </p>
						    </div>
					    <?php endif; ?>
				    </div>
                <?php
				    $i++;
                endwhile;
			    wp_reset_postdata();
				?>
		    </div>
	    </div>
	<?php
	    endif;
	endforeach;
	?>
</div>
