<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class BasicTheme_Elementor_Post_Grid extends Widget_Base
{

    public function get_categories(): array {
        return array('my-theme');
    }

    public function get_name(): string {
        return 'basictheme-post-grid';
    }

    public function get_title(): string {
        return esc_html__('Posts Grid', 'basictheme');
    }

    public function get_icon(): string {
        return 'eicon-gallery-grid';
    }

    protected function register_controls(): void {

        // Content query
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Query', 'basictheme'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label' => esc_html__('Select Category', 'basictheme'),
                'type' => Controls_Manager::SELECT2,
                'options' => basictheme_check_get_cat('category'),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of Posts', 'basictheme'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 100,
                'step' => 1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => esc_html__('Order By', 'basictheme'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => esc_html__('Post ID', 'basictheme'),
                    'author' => esc_html__('Post Author', 'basictheme'),
                    'title' => esc_html__('Title', 'basictheme'),
                    'date' => esc_html__('Date', 'basictheme'),
                    'rand' => esc_html__('Random', 'basictheme'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'basictheme'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'basictheme'),
                    'DESC' => esc_html__('Descending', 'basictheme'),
                ],
            ]
        );

        $this->end_controls_section();

        // Content layout
        $this->start_controls_section(
            'content_layout',
            [
                'label' => esc_html__('Layout Settings', 'basictheme'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label' => esc_html__('Column', 'basictheme'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    1 => esc_html__('1 Column', 'basictheme'),
                    2 => esc_html__('2 Column', 'basictheme'),
                    3 => esc_html__('3 Column', 'basictheme'),
                    4 => esc_html__('4 Column', 'basictheme'),
                ],
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Show excerpt', 'basictheme'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__('Yes', 'basictheme'),
                        'icon' => 'eicon-check',
                    ],

                    'hide' => [
                        'title' => esc_html__('No', 'basictheme'),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => esc_html__('Excerpt Words', 'basictheme'),
                'type' => Controls_Manager::NUMBER,
                'default' => '10',
                'condition' => [
                    'show_excerpt' => 'show',
                ],
            ]
        );

        $this->end_controls_section();

        // Style title
        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__('Title', 'basictheme'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'basictheme'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post__title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'basictheme'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post__title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-post__title',
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => esc_html__('Title Alignment', 'basictheme'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'basictheme'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'basictheme'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'basictheme'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'basictheme'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__title' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        // Style excerpt
        $this->start_controls_section(
            'style_excerpt',
            [
                'label' => esc_html__('Excerpt', 'basictheme'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'show',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Color', 'basictheme'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .element-post-grid .item-post .item-post__content p',
            ]
        );

        $this->add_control(
            'excerpt_alignment',
            [
                'label' => esc_html__('Excerpt Alignment', 'basictheme'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'basictheme'),
                        'icon' => 'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' => esc_html__('Center', 'basictheme'),
                        'icon' => 'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' => esc_html__('Right', 'basictheme'),
                        'icon' => 'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' => esc_html__('Justified', 'basictheme'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .element-post-grid .item-post .item-post__content p' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();
        $cat_post = $settings['select_cat'];
        $limit_post = $settings['limit'];
        $order_by_post = $settings['order_by'];
        $order_post = $settings['order'];

        // Query
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $limit_post,
            'orderby' => $order_by_post,
            'order' => $order_post,
            'cat' => $cat_post,
            'ignore_sticky_posts' => 1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :

            ?>

            <div class="element-post-grid">
                <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-<?php echo esc_attr( $settings['column_number'] ); ?>">
                    <?php while ($query->have_posts()): $query->the_post(); ?>

                        <div class="col">
                            <div class="item-post">
                                <div class="item-post__thumbnail">
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

                                <h2 class="item-post__title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <?php if ($settings['show_excerpt'] == 'show') : ?>

                                    <div class="item-post__content">
                                        <p>
                                            <?php
                                            if (has_excerpt()) :
                                                echo esc_html(wp_trim_words(get_the_excerpt(), $settings['excerpt_length'], '...'));
                                            else:
                                                echo esc_html(wp_trim_words(get_the_content(), $settings['excerpt_length'], '...'));
                                            endif;
                                            ?>
                                        </p>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>

        <?php

        endif;
    }

}