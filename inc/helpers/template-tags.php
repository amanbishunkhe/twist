<?php
function get_the_post_custom_thumbnail($post_id,$size="featured-large", $additional_attributes=[]){
    if( null===$post_id ){
        $post_id = get_the_ID();
    }
    if(has_post_thumbnail( $post_id )){
        $default_attributes = array( 'loading'=>'lazy' );

        $attributes = array_merge( $additional_attributes, $default_attributes );

        $custom_thumbnail = wp_get_attachment_image( 
            get_post_thumbnail_id( $post_id ),
            $size,
            false,
            $attributes
        );
    }

    return $custom_thumbnail;
}

function the_post_custom_thumbnail($post_id,$size="featured-large", $additional_attribute=array()){
    echo get_the_post_custom_thumbnail( $post_id, $size,$additional_attribute );
}

//post date

function aquila_posted_on(){
    $time_string = '<time class="entry-date published updated" datetime="%1$s" ></time>';

    //published and modified time is not same
    if( get_the_time('U') !==get_the_modified_time('U')){
        $time_string = '<time class="entry-date published" datetime="%1$s" >%2$s</time><time class="updated" datetime="%3$s" >%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_attr( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_attr( get_the_modified_date() ));

    //esc_html_x for translation
    $posted_on = sprintf( esc_html_x( 'Posted on %s','post date','aquilla' ),
        '<a href="'.esc_url( get_the_permalink() ).'" rel="bookmark">'. $time_string .'</a>');    

    echo '<span class="posted-on" >'.$posted_on.'</span>';
}

//aquilla posted by
function aquila_posted_by(){
    $byline = sprintf( 
        esc_html_x( 'By %s' , 'post author' , 'aquila' ),
        '<span class="author vcard" ><a href="'.esc_url( get_author_posts_url(get_the_author_meta('ID'))).'">'.esc_html( get_the_author() ).'</a></span>');

    echo '<span class="byline text-secondary">'.$byline.'</span>';    
}

function aquila_the_excerpt($trim_character_count=0){
    if( !has_excerpt() || 0 === $trim_character_count ){
        the_excerpt();
        return;
    }
    
    $excerpt = wp_strip_all_tags( get_the_excerpt()); // strip if there is script and style tags
    
    $excerpt = substr( $excerpt,0,$trim_character_count );
    
    //trims upto the character

    $excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );

    // trauncate after the closet word after space
    // eg not counting if 250 then to exact 250 , but after the space

    echo $excerpt. '[...]';
}

function aquila_excerpt_more($more = ''){
    if( !is_single() ){
        $more = sprintf('<button class="mt-4 btn btn-info" ><a class="aquila-read-more" href="%1$s" ></a>%2$s</button>', get_permalink( get_the_ID() ), __('readmore','aquila')
        );
        
    }
    return $more;
}


// function aquila_pagination(){
//     previous_post_link();
//     next_post_link();
// }

function aquila_pagination(){
    $allowed_tags = [
        'span' =>[
            'class'=>[]
        ],
        'a'=>[
            'span'=>[],
            'href'=>[],
        ]
    ];
    $args=[
        'before_page_number'=>'<span class="btn border border-secondary mr-2 mb-2" >',
        'after_page_number'=>'</span>',
    ];
    printf('<nav class="aquila-pagination clearfix">%s</nav>',wp_kses( paginate_links($args), $allowed_tags ));
}
