<?php
get_header();
$options = get_option('dimme_jour_options');
$full_page_frontpage = isset($options['full_page_frontpage']) && (int)$options['full_page_frontpage'] === 1 ? true : false;
?>
<?php if ($full_page_frontpage) : ?>
    <div class="site-header"<?php if (isset($options['logo'])) : ?> style="background-image: url(<?php echo esc_url($options['logo']); ?>);"<?php endif; ?>>
        <?php if (display_header_text()) : ?>
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
                        <a href="#main" class="btn btn-lg btn-primary"><?php echo __('Go to the content', 'dimme-jour'); ?></a>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <a class="mouse-icon hidden-xs" href="#main">
        <div class="scroll"></div>
    </a>
<?php endif; ?>
    <div id="main">
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
    </div>
<?php

get_footer();