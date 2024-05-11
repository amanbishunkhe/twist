<?php
/**
 * no content templage
 * @package 
 */
?>
 <section class="no-result_found" >
    <header class="page-header" >
        <h1 class="page-title" ><?php esc_html_e('Nothing Found', 'aquila') ?></h1>
    </header>

    <div class="page-content" >
        <?php if( is_home() && current_user_can('publish_posts') ){
            ?>
            <p>
                <?php
                printf(
                    wp_kses(
                        __('Ready to publish ? <a href="%s" >Get Started Here</a>','aquila'),
                        array(
                            'a'=>array( 'href'=>[] )
                        )
                    ),
                    esc_url( admin_url('post-new.php') )    
                )
                ?>
            </p>
            <?php
        }elseif( is_search() ){
            echo 'search';
        }else{
            echo 'no any things to show';
        }        
        ?>
    </div>
 </section>