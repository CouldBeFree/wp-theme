<?php
/**
 * Create custom post types.
 */
add_action('init', 'create_posttype');

function create_posttype()
{
    register_post_type('Oval', array(
        'supports' => array('title', 'editor'),
        'labels' => array(
            'name' => 'Oval',
            'singular_name' => __('Oval')
        ),
        'public' => true,
        'menu_position' => 5,
        'rewrite' => array('slug' => 'member'),
        'taxonomies' => array('category')
    ) );

    register_post_type('Circle', array(
        'supports' => array('title', 'editor'),
        'labels' => array(
            'name' => 'Circle',
            'singular_name' => __('Circle')
        ),
        'public' => true,
        'menu_position' => 4,
        'rewrite' => array('slug' => 'member'),
        'taxonomies' => array('category')
    ) );

    register_post_type('Rectangle', array(
        'supports' => array('title', 'editor'),
        'labels' => array(
            'name' => 'Rectangle',
            'singular_name' => __('Rectangle')
        ),
        'public' => true,
        'menu_position' => 6,
        'rewrite' => array('slug' => 'member'),
        'taxonomies' => array('category')
    ) );

    // Register taxonomy
    register_taxonomy(
        'keywords-tag', //taxonomy
        'Labels', //post-type
        array(
            'hierarchical'  => false,
            'label'         => __( 'Keywords','taxonomy general name'),
            'singular_name' => __( 'Tag', 'taxonomy general name' ),
            'labels'              => array(
                'name'          => 'Keyword',
                'singular_name' => 'Keyword',
                'add_new_item'      => 'Add New Keyword',
                'menu_name'     => 'Keyword'
            ),
            'rewrite'       => true,
            'query_var'     => true
        ));

    register_taxonomy('industry-tag', array('post'), array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Industry',
            'singular_name'     => 'Industry',
            'search_items'      => 'Search Industries',
            'all_items'         => 'All Industries',
            'view_item '        => 'View Industry',
            'parent_item'       => 'Industry Genre',
            'parent_item_colon' => 'Industry Genre:',
            'edit_item'         => 'Edit Industry',
            'update_item'       => 'Update Industry',
            'add_new_item'      => 'Add New Industry',
            'new_item_name'     => 'New Industry Name',
            'menu_name'         => 'Industry',
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => null, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
        'show_tagcloud'         => false, // равен аргументу show_ui
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        'hierarchical'          => true,
        //'update_count_callback' => '_update_post_term_count',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    ) );

    register_post_type('Labels', array(
        'supports' => array('title', 'editor'),
        'labels' => array(
            'name' => 'Labels',
            'singular_name' => __('Labels')
        ),
        'public' => true,
        'menu_position' => 7,
        'rewrite' => array('slug'  => 'labels',
            'with_front'     =>false,
            'menu_position'     => null),
        'label'     => 'Labels',
        'taxonomies' => array('keywords-tag', 'industry-tag'),
    ) );

}
