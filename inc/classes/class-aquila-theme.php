<?php
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Aquila_theme{
    use Singleton;

    protected function __construct(){
        $this->class_initialize();
        $this->setup_hooks();
    }

    //Load Classes
    protected function class_initialize(){        
        Menus::get_instance();
        Meta_boxes::get_instance();
        Sidebars:: get_instance();
    }

    protected function setup_hooks(){
        add_action('after_setup_theme',array( $this,'aquila_theme_setup' ));
        add_action( 'wp_enqueue_scripts',array( $this,'aquila_scripts' ) );
    }

    function aquila_theme_setup(){
        add_theme_support('title-tag');
        $defaults = array(
            'height'               => 100,
            'width'                => 400,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array( 'site-title', 'site-description' ),
            'unlink-homepage-logo' => true, 
        );
        add_theme_support( 'custom-logo', $defaults );
        add_theme_support('post-thumbnails');

        add_image_size('featured-large',300,250,true);
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', 
                array( 'comment-list', 
                        'comment-form', 
                        'search-form', 
                        'gallery', 
                        'caption', 
                        'style', 
                        'script',
                        'navigation-widgets',
                    ) );
        add_theme_support( 'customize-selective-refresh-widgets' );
        //add_editor_styles();
        add_theme_support('wp-block-styles');
    }

    public function aquila_scripts(){
        //style
        wp_enqueue_style('aquilla-style',get_stylesheet_uri(),array(),filemtime(AQUILA_DIR_PATH.'/style.css'),'all');

        //bootstrap-css
        wp_enqueue_style('bootstrap',AQUILA_DIR_URI.'/assets/src/library/css/bootstrap.min.css',array(),false,'all');

        //script
        wp_enqueue_script('aquilla-script',AQUILA_DIR_URI.'/assets/js/custom.js',array('jQuery'),filemtime(AQUILA_DIR_PATH.'/assets/js/custom.js'),'true');

        //bootstrap-js
        wp_enqueue_script('bootstrap-script',AQUILA_DIR_URI.'/assets/src/library/js/bootstrap.min.js',array('jquery'),false,true);

    }
}