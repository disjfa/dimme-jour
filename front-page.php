<?php
get_header();
$loop_the_loop = true;
$options = get_option('dimme_jour_options');
?>
<?php if (display_header_text()) : ?>
    <div class="site-header"<?php if (isset($options['logo'])) : ?> style="background-image: url(<?php echo  $options['logo']; ?>);"<?php endif; ?>>
        <div class="site-header-body">
            <h1>
                <?php echo get_bloginfo('name', 'display') ?>
            </h1>
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
        </div>
    </div>
    <a class="mouse-icon hidden-xs" href="#main">
        <div class="scroll"></div>
    </a>
<?php endif; ?>
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
        ?>
    </div>
<?php

get_footer();