<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class healthnews_most_viewed_post_widget extends WP_Widget {
	/* Widget setup */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'most-viewed-post-widget',
			'description' => esc_html__( 'A widget show post', 'healthnews' ),
		);

		parent::__construct( 'most-viewed-post-widget', 'My Theme: Bài viết xem nhiều nhất', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$limit   = $instance['number'] ?? 8;

		$post_arg = array(
			'post_type'           => 'post',
			'posts_per_page'      => $limit,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
		);

		$post_query = new WP_Query( $post_arg );

		if ( $post_query->have_posts() ) :

			?>
			<ul class="most-viewed-post-widget__list">
				<?php
				while ( $post_query->have_posts() ) :
					$post_query->the_post();
				?>
					<li class="title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
							<?php the_title(); ?>
						</a>
					</li>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</ul>
		<?php
		endif;

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ) {
		$defaults = array(
			'title' => esc_html__('Đọc nhiều', 'healthnews'),
			'order' => 'DESC'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 8;
		$order      = $instance['order'];
		$order_by   = $instance['order_by'] ?? 'ID';

		$terms = get_terms( array(
			'taxonomy' => 'category',
			'orderby'  => 'id'
		) );

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'healthnews' ); ?>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
		</p>

		<!-- Start Order -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
				<?php esc_html_e( 'Order:', 'healthnews' ); ?>
			</label>

			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
			        name="<?php echo $this->get_field_name( 'order' ) ?>" class="widefat">
				<option value="ASC" <?php echo ( $order == 'ASC' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'ASC', 'healthnews' ); ?>
				</option>

				<option value="DESC" <?php echo ( $order == 'DESC' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'DESC', 'healthnews' ); ?>
				</option>
			</select>
		</p>

		<!-- Start OrderBy -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
				<?php esc_html_e( 'Order:', 'healthnews' ); ?>
			</label>

			<select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"
			        name="<?php echo $this->get_field_name( 'order_by' ) ?>" class="widefat">
				<option value="ID" <?php echo ( $order_by == 'ID' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'ID', 'healthnews' ); ?>
				</option>

				<option value="date" <?php echo ( $order_by == 'date' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Date', 'healthnews' ); ?>
				</option>

				<option value="title" <?php echo ( $order_by == 'title' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Title', 'healthnews' ); ?>
				</option>

				<option value="rand" <?php echo ( $order_by == 'rand' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Rand', 'healthnews' ); ?>
				</option>
			</select>
		</p>

		<!-- Start Number Post Show -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php esc_html_e( 'Number of posts to show:', 'healthnews' ); ?>
			</label>

			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
			       value="<?php echo esc_attr( $number ); ?>" size="3"/>
		</p>

		<?php

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['order']      = $new_instance['order'];
		$instance['order_by']   = $new_instance['order_by'];
		$instance['number']     = (int) $new_instance['number'];

		return $instance;
	}

}

// Register widget
function healthnews_most_viewed_post_widget_register() {
	register_widget( 'healthnews_most_viewed_post_widget' );
}

add_action( 'widgets_init', 'healthnews_most_viewed_post_widget_register' );