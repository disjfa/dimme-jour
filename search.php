<?php get_header(); ?>
    <div class="container">
        <div class="article-header">
            <h1><?php echo _x("Search for:", "label", "dimme-jour"); ?><?php echo esc_attr(get_search_query()); ?></h1>
        </div>

        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('content');
            endwhile;

            the_post_navigation();
        else :
            get_template_part('content', 'none');

        endif;
        ?>
    </div>
<?php
get_footer();