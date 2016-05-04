<?php
/*
Template Name: Page with sidebar
*/

get_header();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        get_template_part('content');
                        comments_template('', true);
                    endwhile;
                    dimme_jour_page_navi();
                else :
                    get_template_part('content', 'none');
                endif;
                ?>
            </div>
            <div class="col-md-3 col-xs-12">
                <br>
                <?php dynamic_sidebar('sidebar-default'); ?>
            </div>
        </div>
    </div>

<?php
get_footer();