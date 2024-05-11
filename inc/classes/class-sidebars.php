<?php
/**
 * 
 * aquila sidebars
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Sidebars{
    use Singleton;

    function __construct(){
        $this->setup_hooks();
    }

    function setup_hooks(){
        add_action( 'widgets_init',array( $this,'register_sidebars' ) );
    }

    function register_sidebars(){
        register_sidebar(
            array(
                'name'          => esc_html__( 'Main Sidebar', 'aquila' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets for Main sidebar.', 'twentytwentyone' ),
                'before_widget' => '<section id="%1$s" class="widget primary-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Footer Sidebar', 'aquila' ),
                'id'            => 'sidebar-2',
                'description'   => esc_html__( 'Add widgets for Main sidebar.', 'twentytwentyone' ),
                'before_widget' => '<section id="%1$s" class="widget widget-footer %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
}