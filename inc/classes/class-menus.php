<?php

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Menus{
    use Singleton;

    protected function __construct(){
        $this->setup_hooks();
    }

    function setup_hooks(){
        add_action( 'init',array($this,'register_menu') );
    }

    function register_menu(){
        register_nav_menus(array(
            'header-menu'=>esc_html__('Header','aquila'),
            'footer-menu'=>esc_html__('Footer','aquila')
        ));
    }
    //return header-menu id
    function get_menu_id_from_location( $location ){
        $locations = get_nav_menu_locations();
        $menu_id = $locations[$location];
        
        return !empty( $menu_id )? $menu_id : '';

    }

    function get_child_menu_items($menu_array,$parent_id){
      
        $child_menus = [];
        if( !empty( $menu_array ) && is_array( $menu_array ) ){
            foreach ($menu_array as $menu) {
                if( intval( $menu->menu_item_parent ) === $parent_id ){
                    array_push($child_menus,$menu); 
                }
            }
        }

        return $child_menus;
    }
}