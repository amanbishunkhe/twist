<?php
/**
 * 
 * entry header
 */
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail( $the_post_id );
$show_hide_page_title = get_post_meta( get_the_ID(),'_hide_page_title',true );
$heading_class = ! empty( $show_hide_page_title ) && 'yes' === $show_hide_page_title ? 'hide' : '';
?>
<header class="entry-header">
    <?php
        //featured image
        if( $has_post_thumbnail ){
            ?>
            <div class="entry-image mb-3" >
                <a href="<?php echo esc_url( get_the_permalink() ); ?>" >
                        <?php the_post_custom_thumbnail($the_post_id,'featured-large',[
                            'sizes'=>'(max-width:590px) 590px,425px',
                            'class'=>'attachement-featured-large-size'
                        ]
                    ); ?>
                </a>

            </div>
            <?php
        }

        //title
        if( is_single() || is_page() ){
            printf('<h1 class="page-title text-dark %1$s" >%2$s</h1>',esc_attr($heading_class), wp_kses_post( get_the_title()) );                                                                              
        }else{
            printf('<h2 class="entry-title text-dark mb-3" ><a href="%1$s">%2$s</a>',
            esc_url( get_the_permalink() ), wp_kses_post( get_the_title() )); 
        }
    ?>
</header>