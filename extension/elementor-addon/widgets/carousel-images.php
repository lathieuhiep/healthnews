<?php

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class BasicTheme_Elementor_Carousel_Images extends Widget_Base {

	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'healthnews-carousel-images';
	}

	public function get_title(): string {
		return esc_html__( 'Carousel Images', 'healthnews' );
	}

	public function get_icon(): string {
		return 'eicon-slider-album';
	}

	public function get_style_depends(): array {
		return [ 'owl.carousel' ];
	}

	protected function _register_controls(): void {

		// Section carousel images
		$this->start_controls_section(
			'section_carousel_images',
			[
				'label' => __( 'Carousel Images', 'healthnews' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Name', 'healthnews' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title #1' , 'healthnews' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Choose Image', 'healthnews' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_link',
			[
				'label' => esc_html__( 'Link', 'healthnews' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'healthnews' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'healthnews' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'healthnews' ),
					],
					[
						'list_title' => __( 'Title #2', 'healthnews' ),
					],
                    [
                        'list_title' => __( 'Title #3', 'healthnews' ),
                    ],
                    [
                        'list_title' => __( 'Title #4', 'healthnews' ),
                    ],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// Content additional options
		$this->start_controls_section(
			'content_additional_options',
			[
				'label' => __( 'Options', 'healthnews' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'loop',
			[
				'type'          =>  Controls_Manager::SWITCHER,
				'label'         =>  esc_html__('Loop Slider ?', 'healthnews'),
				'label_off'     =>  esc_html__('No', 'healthnews'),
				'label_on'      =>  esc_html__('Yes', 'healthnews'),
				'return_value'  =>  'yes',
				'default'       =>  'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'         =>  esc_html__('Autoplay?', 'healthnews'),
				'type'          =>  Controls_Manager::SWITCHER,
				'label_off'     =>  esc_html__('No', 'healthnews'),
				'label_on'      =>  esc_html__('Yes', 'healthnews'),
				'return_value'  =>  'yes',
				'default'       =>  'no',
			]
		);

		$this->add_control(
			'nav',
			[
				'label'         =>  esc_html__('Nav Slider', 'healthnews'),
				'type'          =>  Controls_Manager::SWITCHER,
				'label_on'      =>  esc_html__('Yes', 'healthnews'),
				'label_off'     =>  esc_html__('No', 'healthnews'),
				'return_value'  =>  'yes',
				'default'       =>  'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label'         =>  esc_html__('Dots Slider', 'healthnews'),
				'type'          =>  Controls_Manager::SWITCHER,
				'label_on'      =>  esc_html__('Yes', 'healthnews'),
				'label_off'     =>  esc_html__('No', 'healthnews'),
				'return_value'  =>  'yes',
				'default'       =>  'yes',
			]
		);

		$this->end_controls_section();

		// Content additional options
		$this->start_controls_section(
			'content_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'healthnews' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'loop',
			[
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Loop Slider ?', 'healthnews' ),
				'label_off'    => esc_html__( 'No', 'healthnews' ),
				'label_on'     => esc_html__( 'Yes', 'healthnews' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay?', 'healthnews' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => esc_html__( 'No', 'healthnews' ),
				'label_on'     => esc_html__( 'Yes', 'healthnews' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'nav',
			[
				'label'        => esc_html__( 'Nav Slider', 'healthnews' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'healthnews' ),
				'label_off'    => esc_html__( 'No', 'healthnews' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => esc_html__( 'Dots Slider', 'healthnews' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'healthnews' ),
				'label_off'    => esc_html__( 'No', 'healthnews' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'margin_item',
			[
				'label'   => esc_html__( 'Space Between Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 20,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'min_width_1200',
			[
				'label'     => esc_html__( 'Min Width 1200px', 'healthnews' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item',
			[
				'label'   => esc_html__( 'Number of Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'min_width_992',
			[
				'label'     => esc_html__( 'Min Width 992px', 'healthnews' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_992',
			[
				'label'   => esc_html__( 'Number of Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'min_width_768',
			[
				'label'     => esc_html__( 'Min Width 768px', 'healthnews' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_768',
			[
				'label'   => esc_html__( 'Number of Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'min_width_568',
			[
				'label'     => esc_html__( 'Min Width 568px', 'healthnews' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_568',
			[
				'label'   => esc_html__( 'Number of Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_568',
			[
				'label'   => esc_html__( 'Space Between Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 15,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'max_width_567',
			[
				'label'     => esc_html__( 'Max Width 567px', 'healthnews' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_567',
			[
				'label'   => esc_html__( 'Number of Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_567',
			[
				'label'   => esc_html__( 'Space Between Item', 'healthnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

		// Section style
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'healthnews' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Dots Color', 'healthnews' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-carousel-images .owl-carousel .owl-dots .owl-dot span' => 'background-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'dots',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'dots_color_hover',
			[
				'label' => esc_html__( 'Dots Color Hover', 'healthnews' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-carousel-images .owl-carousel .owl-dots .owl-dot.active span, {{WRAPPER}} .element-carousel-images .owl-carousel .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'dots',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$data_settings_owl = [
			'loop'       => ( 'yes' === $settings['loop'] ),
			'nav'        => ( 'yes' === $settings['nav'] ),
			'dots'       => ( 'yes' === $settings['dots'] ),
			'margin'     => $settings['margin_item'],
			'autoplay'   => ( 'yes' === $settings['autoplay'] ),
			'responsive' => [
				'0' => array(
					'items'  => $settings['item_567'],
					'margin' => $settings['margin_item_567']
				),

				'576' => array(
					'items'  => $settings['item_568'],
					'margin' => $settings['margin_item_568']
				),

				'768' => array(
					'items' => $settings['item_768']
				),

				'992' => array(
					'items' => $settings['item_992']
				),

				'1200' => array(
					'items' => $settings['item']
				),
			],
		];
		?>

        <div class="element-carousel-images">
            <div class="custom-owl-carousel owl-carousel owl-theme" data-settings-owl='<?php echo wp_json_encode( $data_settings_owl ) ; ?>'>
				<?php
				foreach ( $settings['list'] as $index => $item ) :
					$image_id = $item['list_image']['id'];
					$url = $item['list_link']['url'];

                ?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
	                    <?php
                        echo wp_get_attachment_image( $image_id, 'full' );

	                    if ( $url ) :
	                        $link_key = 'link_' . $index;
	                        $this->add_link_attributes( $link_key, $item['list_link'] );
                        ?>

                            <a class="item__link" <?php echo $this->get_render_attribute_string( $link_key ); ?>></a>

						<?php endif; ?>
                    </div>

				<?php endforeach; ?>
            </div>
        </div>

		<?php
	}
}