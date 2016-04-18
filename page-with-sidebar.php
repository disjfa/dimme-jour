<?php
/*
Template Name: Page with sidebar
*/

get_header();
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">


                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        get_template_part('content', get_post_format());
                    endwhile;
                    dimme_jour_page_navi();
                else :
                    get_template_part('content', 'none');
                endif;
                ?>
            </div>
            <div class="col-sm-3">
                <br>
                <?php dynamic_sidebar('sidebar-default'); ?>
            </div>
        </div>
    </div>

<?php
get_footer();