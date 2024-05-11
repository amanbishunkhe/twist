<?php

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Meta_boxes{
    use Singleton;

    protected function __construct(){
        $this->setup_hooks();
    }

    function setup_hooks(){
        add_action( 'add_meta_boxes',array( $this,'aquila_post_metabox' ) );
        add_action('save_post',array($this,'show_hide_metabox_save'));
    }

    function aquila_post_metabox(){
        $screens = [ 'post' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'hide-page-title',                
                __('Hide Page Title','aquila'),      
                array( $this,'custom_metabox_callback' ),  
                $screen                      
            );
        }
    }

    function custom_metabox_callback($post){
        $value = get_post_meta( $post->ID, '_hide_page_title', true );

        wp_nonce_field(plugin_basename(__FILE__),'hide_title_meta_nonce');
        ?>
        <label for="aquila-post-title-option"><?php esc_html_e('Hide Page Title','aquila') ?></label>
        <select name="aquila_post_title_option" id="aquila-post-title-option" class="postbox">   
            <option value="">
                <?php esc_html_e('Select','aquila')?>
            </option>         
            <option value="yes" <?php selected( $value, 'yes' ); ?>>
                <?php esc_html_e('Yes','aquila')?>
            </option>
            <option value="no" <?php selected( $value, 'no' ); ?>>
                <?php esc_html_e('No','aquila'); ?>
            </option>
        </select>
        <?php
    }

    function show_hide_metabox_save($post_id){

        //You can also check
        if( !current_user_can('edit_post', $post_id ) ){
            return;
        }

        if(! isset($_POST['hide_title_meta_nonce']) || !wp_verify_nonce($_POST['hide_title_meta_nonce'],plugin_basename(__FILE__)) ){
            return;
        }


        if ( array_key_exists( 'aquila_post_title_option', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_hide_page_title',
                $_POST['aquila_post_title_option']
            );
        }
    }

}