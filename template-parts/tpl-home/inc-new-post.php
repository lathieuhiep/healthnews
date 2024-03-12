<?php
$new_post_ids = array();
$order_by = healthnews_get_option('opt_tpl_home_new_posts_order_by');
$order = healthnews_get_option('opt_tpl_home_new_posts_order');

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 15,
	'orderby' => $order_by,
	'order' => $order,
	'ignore_sticky_posts' => 1,
);

$query = new WP_Query($args);

if ( $query->have_posts() ) :
?>
	<div class="new-posts mb-5">
		<?php
		$i = 1;
		while ($query->have_posts()):
			$query->the_post();
			$count = $query->post_count;
			$new_post_ids[] = get_the_ID();
			?>

			<?php if ( $i == 1 ) : ?>
			<!-- post featured -->
			<div class="new-posts__featured">
				<div class="item">
					<div class="item__thumbnail">
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

					<h2 class="item__title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>

					<div class="item__content">
						<p>
							<?php
							if (has_excerpt()) :
								echo esc_html(wp_trim_words(get_the_excerpt(), 50, '...'));
							else:
								echo esc_html(wp_trim_words(get_the_content(), 50, '...'));
							endif;
							?>
						</p>
					</div>
				</div>
			</div>
		<?php endif; ?>

			<?php if ( $i == 2 ) : ?>
			<!-- post list -->
			<div class="new-posts__list scrollbar-inner">
		<?php endif; ?>

			<?php if ( $i >= 2 && $i <= 11  ) : ?>
			<div class="item">
				<h2 class="item__title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>
		<?php endif; ?>

			<?php if ( $i == 11 || ( $i > 2 && $count <= 11 && $i == $count)  ) : ?>
			</div>
		<?php endif; ?>

			<?php if ( $i == 12 ) : ?>
			<!-- post grid -->
			<div class="new-posts__grid">
		<?php endif; ?>

			<?php if ( $i >= 12 ) : ?>
			<div class="item">
				<div class="item__thumbnail">
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

				<h2 class="item__title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>
		<?php endif; ?>

			<?php if ( ($i > 12 && $i == $count ) || ( $i == 12 && $count == 12 ) ) : ?>
			</div>
		<?php endif; ?>

			<?php
			$i++;
		endwhile;
		wp_reset_postdata();

		set_query_var('new_post_ids', $new_post_ids);
		?>
	</div>
<?php endif; ?>