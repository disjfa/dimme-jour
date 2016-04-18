<?php
get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part('content', get_post_format());
    endwhile;
    dimme_jour_page_navi();
else :
    get_template_part('content', 'none');
endif;
get_footer();