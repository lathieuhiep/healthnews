<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'basictheme_create_project', 10);

function basictheme_create_project() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dự án', 'post type general name', 'basictheme' ),
        'singular_name'         =>  _x( 'Dự án', 'post type singular name', 'basictheme' ),
        'menu_name'             =>  _x( 'Dự án', 'admin menu', 'basictheme' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dự án', 'add new on admin bar', 'basictheme' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dự án', 'basictheme' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dự án', 'basictheme' ),
        'edit_item'             =>  esc_html__( 'Sửa Dự án', 'basictheme' ),
        'new_item'              =>  esc_html__( 'Dự án mới', 'basictheme' ),
        'view_item'             =>  esc_html__( 'Xem dự án', 'basictheme' ),
        'all_items'             =>  esc_html__( 'Tất cả dự án', 'basictheme' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm dự án', 'basictheme' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'basictheme' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'basictheme' ),
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

    register_post_type('basictheme_project', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục dự án', 'taxonomy general name', 'basictheme' ),
        'singular_name'     => _x( 'Danh mục dự án', 'taxonomy singular name', 'basictheme' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'basictheme' ),
        'all_items'         => __( 'Tất cả danh mục', 'basictheme' ),
        'parent_item'       => __( 'Danh mục cha', 'basictheme' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'basictheme' ),
        'edit_item'         => __( 'Sửa', 'basictheme' ),
        'update_item'       => __( 'Cập nhật', 'basictheme' ),
        'add_new_item'      => __( 'Thêm mới', 'basictheme' ),
        'new_item_name'     => __( 'Tên mới', 'basictheme' ),
        'menu_name'         => __( 'Danh mục', 'basictheme' ),
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

    register_taxonomy( 'basictheme_project_cat', array( 'basictheme_project' ), $taxonomy_args );
    /* End taxonomy */

}