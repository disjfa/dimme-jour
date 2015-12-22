<?php
get_header();
$loop_the_loop = true;
$show_blog_info = true;
?>
    <div class="site-header" style="background-image: url(<?php echo header_image(); ?>);">
        <div class="site-header-body">
            <?php if (is_singular()): ?>
                <?php
                the_post();
                $loop_the_loop = false;

                $content = get_the_content();
                if ($content != '') {
                    $show_blog_info = false;
                }
                ?>
            <?php endif; ?>
            <?php if ($show_blog_info): ?>
                <?php if (isset($options['logo'])): ?>
                    <br>
                    <img src="<?php echo $options['logo']; ?>" alt="<?php echo get_bloginfo('name', 'display') ?>"
                         class="site-header-logo">
                <?php else: ?>
                    <h1>
                        <?php echo get_bloginfo('name', 'display') ?>
                    </h1>
                <?php endif; ?>
                <p>
                    <?php echo get_bloginfo('description', 'display') ?>
                </p>
                <?php if (get_query_var('paged')): ?>
                <?php else: ?>
                    <p>
                        <a href="#main"
                           class="btn btn-lg btn-primary"><?php echo __('Go to the content', 'dimme-jour'); ?></a>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <a class="mouse-icon hidden-xs" href="#main">
        <div class="scroll"></div>
    </a>
    <div id="main">
        <?php
        if ($loop_the_loop) {
            if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('content', get_post_format());
                endwhile;
                dimme_jour_page_navi();
            else :
                get_template_part('content', 'none');
            endif;
        }
        get_template_part('dimme-jour-front', '');

        ?>
    </div>
<?php

get_footer();