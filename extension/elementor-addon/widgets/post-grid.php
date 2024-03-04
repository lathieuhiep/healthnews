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
        return 'healthnews-post-grid';
    }

    public function get_title(): string {
        return esc_html__('Posts Grid', 'healthnews');
    }

    public function get_icon(): string {
        return 'eicon-gallery-grid';
    }

    protected function register_controls(): void {

        // Content query
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Query', 'healthnews'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label' => esc_html__('Select Category', 'healthnews'),
                'type' => Controls_Manager::SELECT2,
                'options' => healthnews_check_get_cat('category'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Number of Posts', 'healthnews'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 1,
                'max' => 100,
                'step' => 1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => esc_html__('Order By', 'healthnews'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => esc_html__('Post ID', 'healthnews'),
                    'author' => esc_html__('Post Author', 'healthnews'),
                    'title' => esc_html__('Title', 'healthnews'),
                    'date' => esc_html__('Date', 'healthnews'),
                    'rand' => esc_html__('Random', 'healthnews'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'healthnews'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'healthnews'),
                    'DESC' => esc_html__('Descending', 'healthnews'),
                ],
            ]
        );

        $this->end_controls_section();

        // Style title
        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__('Title', 'healthnews'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'healthnews'),
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
                'label' => esc_html__('Color Hover', 'healthnews'),
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
                'label' => esc_html__('Title Alignment', 'healthnews'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'healthnews'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'healthnews'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'healthnews'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'healthnews'),
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
                'label' => esc_html__('Excerpt', 'healthnews'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'show',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Color', 'healthnews'),
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
                'label' => esc_html__('Excerpt Alignment', 'healthnews'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'healthnews'),
                        'icon' => 'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' => esc_html__('Center', 'healthnews'),
                        'icon' => 'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' => esc_html__('Right', 'healthnews'),
                        'icon' => 'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' => esc_html__('Justified', 'healthnews'),
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

    protected function render() {

        $settings = $this->get_settings_for_display();
        $cat_post = $settings['select_cat'];
        $limit_post = $settings['limit'];
        $order_by_post = $settings['order_by'];
        $order_post = $settings['order'];

        if ( empty( $cat_post ) ) {
            return;
        }

	    $category_name = get_cat_name($cat_post);

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
                <h3 class="cat-name">
                    <a href="<?php echo esc_url( get_category_link($cat_post) ); ?>"><?php echo esc_html( $category_name ); ?></a>
                </h3>

                <div class="grid-layout">
                    <?php
                    $i = 1;
                    while ($query->have_posts()): $query->the_post();
	                    $count = $query->post_count;
                    ?>

                    <?php if ( $i == 1 ) : ?>
                        <div class="item item-featured">
                            <div class="post">
                                <div class="post__thumbnail">
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

                                <h2 class="post__title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="post__content">
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
                        <div class="item item-list">
                    <?php endif; ?>

                    <?php if ( $i >= 2 ) : ?>
                        <div class="post">
                            <div class="post__thumbnail">
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

                            <h2 class="post__title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <?php if ($i == $count): ?>
                        </div>
                    <?php endif; ?>

                    <?php $i++; endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>

        <?php

        endif;
    }

}