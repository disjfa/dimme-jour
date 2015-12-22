<?php get_header(); ?>
    <div class="container">
        <div class="article-header">
            <h1><?php echo _x("Search for:", "label", "dimme-jour"); ?><?php echo esc_attr(get_search_query()); ?></h1>
        </div>
    </div>
<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        get_template_part('content', get_post_format());
    endwhile;

    dimme_jour_page_navi();
else :
    get_template_part('content', 'none');

endif;

get_footer();