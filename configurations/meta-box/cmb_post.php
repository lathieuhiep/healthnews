<?php
add_action('cmb2_admin_init', 'healthnews_post_meta_boxes');
function healthnews_post_meta_boxes(): void {
    $cmb = new_cmb2_box(array(
        'id' => 'healthnews_cmb_post',
        'title' => esc_html__('Option metabox', 'healthnews'),
        'object_types' => array('post'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field( array(
        'id'   => 'healthnews_cmb_post_title',
        'name' => esc_html__( 'Test Title', 'healthnews' ),
        'type' => 'title',
        'desc' => esc_html__( 'This is a title description', 'healthnews' ),
    ) );
}