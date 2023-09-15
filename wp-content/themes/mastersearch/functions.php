<?php
    function title_theme_name(){
        add_theme_support('title-tag');
        add_theme_support('custom-logo');
    }
    add_action('after_setup_theme', 'title_theme_name');

    function theme_menus(){
        $location = array(
            'primary' => 'Main navbar',
        );
        register_nav_menus($location);
    }
    add_action('init', 'theme_menus');
    
    function find_master_styles(){
        $version = wp_get_theme()->get('Version');
        wp_enqueue_style('find_master-custom', get_template_directory_uri().'/style.css', array('find_master-bootstrap'), 'all');
        wp_enqueue_style('find_master-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css", array(), '5.3.0', 'all');
        wp_enqueue_style('find_master-font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'find_master_styles');

    function find_master_scripts(){
        wp_enqueue_script('find_master-custom', get_template_directory_uri().'/assets/js/main.js', array('find_master-bootstrap'), false);
        wp_enqueue_script('find_master-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js", array(), '5.3.0', false);
        wp_enqueue_script('find_master-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), '3.6.4', false);
        wp_enqueue_script('find_master-caroussel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js', array(), '1.8.1', false);
    }
    add_action('wp_enqueue_scripts', 'find_master_scripts');

    function custom_content_meta_box() {
        add_meta_box(
            'custom-content-meta-box',
            'Custom Content',
            'display_custom_content_meta_box',
            'page',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'custom_content_meta_box');

    function display_custom_content_meta_box($post) {
        $custom_content = get_post_meta($post->ID, 'custom_content', true);
        wp_editor($custom_content, 'custom-content', 'Custom Content', false);
    }
    function save_custom_content_meta_box($post_id) {
        if (array_key_exists('custom-content', $_POST)) {
            update_post_meta($post_id, 'custom_content', $_POST['custom-content']);
        }
    }
    add_action('save_post', 'save_custom_content_meta_box');
?>