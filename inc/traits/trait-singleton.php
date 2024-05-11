<?php
namespace AQUILA_THEME\Inc\Traits;

trait Singleton{
    public function __construct(){

    }
    // we use keyword final to that other cannot overwritten the function
    final public static function get_instance(){
        static $instance = [];

        $called_class = get_called_class();

        if( !isset( $instance[$called_class] ) ){
            $instance[$called_class] = new $called_class();

            //here do action if any plugin wants to hook the action
            do_action( sprintf('aquila_theme_singleton_init%s',$called_class) );
        }

        return $instance[$called_class];

    } 
}