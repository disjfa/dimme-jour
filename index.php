<?php
get_header();
?>
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('content');
            endwhile;

            the_posts_navigation();
        else :
            get_template_part('content', 'none');
        endif;
        ?>
    </div>
<?php
get_footer();