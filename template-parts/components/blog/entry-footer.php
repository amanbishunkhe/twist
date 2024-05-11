<?php
/****
 * 
 * 
 * Aquila footer
 */

$post_id = get_the_ID();
$arcticle_terms = wp_get_post_terms( $post_id, array('category','post_tag') );

if( empty( $arcticle_terms ) || !is_array( $arcticle_terms ) ){
    return;
}
?>
<div Class="entry-footer mt-4" >
    <?php
        foreach( $arcticle_terms as $key => $arcticle_term ){
            ?>
            <button class="btn border border-secondary mb-2 mr-2" >
                <a class="entry-footer-link" href="<?php echo esc_url( get_term_link( $arcticle_term->term_id ) ); ?>" >
                <?php echo esc_html( $arcticle_term->name ); ?>
            </a>
            </button>
            <?php
        }
    ?>
</div>
<?php
