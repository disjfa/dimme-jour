<?php
get_header();
?>
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('content');
            endwhile;
            
            dimme_jour_page_navi();
        else :
            get_template_part('content', 'none');
        endif;
        ?>
    </div>
<?php
get_footer();