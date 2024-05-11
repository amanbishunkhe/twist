<?php
/** Theme functions
 * @package aquila
 */


if( !defined('AQUILA_DIR_PATH') ){
    //untrailingslashit removes the trailing slash of the path
    define('AQUILA_DIR_PATH',untrailingslashit(get_template_directory()) );
}

if( !defined('AQUILA_DIR_URI') ){
    define('AQUILA_DIR_URI',untrailingslashit(get_template_directory_uri()) );
}

require_once AQUILA_DIR_PATH.'/inc/helpers/autoloader.php';
require_once AQUILA_DIR_PATH.'/inc/helpers/template-tags.php';

///main theme instance 
// we can also use directly like \AQUILA_THEME\Inc\Aquila_theme::get_instance(); in the function

use AQUILA_THEME\Inc\Aquila_theme;
function aquila_get_theme_instance(){
    Aquila_theme::get_instance();
}
aquila_get_theme_instance();
