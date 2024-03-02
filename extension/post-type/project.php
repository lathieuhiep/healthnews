<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'healthnews_create_project', 10);

function healthnews_create_project() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dự án', 'post type general name', 'healthnews' ),
        'singular_name'         =>  _x( 'Dự án', 'post type singular name', 'healthnews' ),
        'menu_name'             =>  _x( 'Dự án', 'admin menu', 'healthnews' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dự án', 'add new on admin bar', 'healthnews' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dự án', 'healthnews' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dự án', 'healthnews' ),
        'edit_item'             =>  esc_html__( 'Sửa Dự án', 'healthnews' ),
        'new_item'              =>  esc_html__( 'Dự án mới', 'healthnews' ),
        'view_item'             =>  esc_html__( 'Xem dự án', 'healthnews' ),
        'all_items'             =>  esc_html__( 'Tất cả dự án', 'healthnews' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm dự án', 'healthnews' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'healthnews' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'healthnews' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-open-folder',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'du-an' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('healthnews_project', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục dự án', 'taxonomy general name', 'healthnews' ),
        'singular_name'     => _x( 'Danh mục dự án', 'taxonomy singular name', 'healthnews' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'healthnews' ),
        'all_items'         => __( 'Tất cả danh mục', 'healthnews' ),
        'parent_item'       => __( 'Danh mục cha', 'healthnews' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'healthnews' ),
        'edit_item'         => __( 'Sửa', 'healthnews' ),
        'update_item'       => __( 'Cập nhật', 'healthnews' ),
        'add_new_item'      => __( 'Thêm mới', 'healthnews' ),
        'new_item_name'     => __( 'Tên mới', 'healthnews' ),
        'menu_name'         => __( 'Danh mục', 'healthnews' ),
    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'danh-muc-du-an' ),
    );

    register_taxonomy( 'healthnews_project_cat', array( 'healthnews_project' ), $taxonomy_args );
    /* End taxonomy */

}