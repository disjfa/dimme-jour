<?php get_header(); ?>

    <div class="container">
        <h1 class="archive_title">
            <?php echo get_the_archive_title() ?>
        </h1>
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