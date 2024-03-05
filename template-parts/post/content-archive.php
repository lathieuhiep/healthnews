<div class="site-container site-page-archive">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
				<?php if (have_posts()) : $post_count = $wp_query->post_count; ?>
                    <div class="post-list">
						<?php $i = 1; while (have_posts()) : the_post(); ?>

                        <?php if ( $i == 1 ) : ?>
                        <div class="featured-box">
                        <?php endif; ?>

                        <?php if ( 1 <= $i && $i <= 4  ) : ?>
                            <div class="item">
                                <div class="item__thumbnail">
                                    <?php
                                    the_post_thumbnail('large');

                                    if ( $i == 1 ) :
                                    ?>
                                        <h3 class="title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    <?php endif; ?>
                                </div>

                                <?php if ( $i != 1 ) : ?>
                                    <div class="item__content">
                                        <h3 class="title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $i == 4 || ( $i >= 1 && $post_count <= 4 ) ) : ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( $i == 5 ) : ?>
                            <div class="second-box">
                        <?php endif; ?>

                            <?php if ( $i > 4 ) : ?>
                                <div class="item">
                                    <div class="item__thumbnail">
                                        <?php the_post_thumbnail('large'); ?>
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
                            <?php endif; ?>

                        <?php if ( $i > 4 && $i == $post_count ) : ?>
                            </div>
                        <?php endif; ?>

						<?php $i++; endwhile; wp_reset_postdata(); ?>
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