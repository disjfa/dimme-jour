<?php

$query = new WP_Query(array(
    'post_type' => 'front-page',
    'posts_per_page' => 20,
    'orderby' => array(
        'menu_order' => 'DESC',
        'date' => 'DESC',
    )
));

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        get_template_part('content', 'front-page');
    }
}

wp_reset_postdata();


