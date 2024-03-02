<?php
/**
 * Widget Name: Social Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class basictheme_social_widget extends WP_Widget {
	/* Widget setup */
    public function __construct() {
        $basictheme_social_widget_ops = array(
            'classname'     =>  'social-widget',
            'description'   =>  esc_html__( 'A widget that displays your social icons', 'basictheme' ),
        );

        parent::__construct( 'social-widget', 'My Theme: Social Icons', $basictheme_social_widget_ops );
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
    ?>
        <div class="social-widget">
            <?php basictheme_get_social_url(); ?>
        </div>
    <?php

        echo $args['after_widget'];
	}

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
	function form( $instance ) {
		$defaults = array(
            'title' => esc_html__('Subscribe & Follow', 'basictheme')
        );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Title:', 'basictheme' ); ?>
            </label>

			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
            <?php esc_html_e( 'Note: Set your social links in the basictheme Options', 'basictheme' ); ?>
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

        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }
}

// Register social widget
function basictheme_social_widget_register(): void {
    register_widget( 'basictheme_social_widget' );
}

add_action( 'widgets_init', 'basictheme_social_widget_register' );