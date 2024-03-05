<?php get_header(); ?>

<div class="site-container site-page-search">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8">
				<?php if (have_posts()) : ?>
					<div class="post-list">
						<?php while (have_posts()) : the_post(); ?>
						<div class="item">
							<div class="item__thumbnail">
								<?php the_post_thumbnail('medium'); ?>
							</div>

							<div class="item__content">
								<h3 class="title">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<p class="desc">
									<?php
									if (has_excerpt()) :
										echo esc_html(get_the_excerpt());
									else:
										echo wp_trim_words(get_the_content(), 30, '...');
									endif;
									?>
								</p>
							</div>
						</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php
					healthnews_pagination();
				endif;
				?>
				<div class="post-list">

				</div>
			</div>

			<?php if( is_active_sidebar( 'sidebar-single' ) ): ?>
				<aside class="col-12 col-md-4 site-sidebar site-sidebar-single">
					<?php dynamic_sidebar( 'sidebar-single' ); ?>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();