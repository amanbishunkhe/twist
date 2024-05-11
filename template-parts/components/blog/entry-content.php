<?php
/***
 * 
 * content template
 * 
 */

?>
<div class="entry-content" >
    <?php
        //&rarr; particlular arrow sign
        if( is_single() ){
            the_content(
                sprintf(
                    wp_kses(
                                __('Continue reading %s <span class="meta-nav" >&rarr;</span>','aquila' ),
                                [
                                    'span'=>[
                                        'class'=>[]
                                    ]
                                ]
                            ),
                            the_title('<span class="screen-reader-text">"','"</span>',false)
                )
            );
            
            $args = array (
                'before'      		=> '<div class="page-links-XXX"><span class="page-link-text">' . __( 'Pages: ', 'aquila' ) . '</span>',
                'after'       		=> '</div>',
                'link_before' 		=> '<span class="page-link">',
                'link_after'  		=> '</span>',
                'next_or_number'	=> 'number',
                'separator'			=> '',
                'nextpagelink'		=> __( 'Next &raquo', 'aquila' ),
                'previouspagelink'	=> __( '&laquo Previous', 'aquila' ),
            );

            wp_link_pages( $args );
        
        }else{
            aquila_the_excerpt( 100 );
            echo aquila_excerpt_more();
        }
    ?>
</div>