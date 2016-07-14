<!doctype html>

<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>
<?php
$options = get_option('dimme_jour_options');
$full_page_frontpage = isset($options['full_page_frontpage']) && (int)$options['full_page_frontpage'] === 1 ? true : false;
$logo = empty($options['logo']) === false ? esc_url($options['logo']) : false;

if (is_singular() && has_post_thumbnail()) {
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dimme_jour_featured', false);
    if ($image) {
        list($header_image, $width, $height) = $image;
    } else {
        $header_image = false;
    }
} elseif (is_front_page() && $full_page_frontpage === false && $logo) {
    $header_image = $logo;
} else {
    $header_image = get_header_image();
}

?>
<body <?php body_class(); ?>>

<div id="content-wrapper">
    <header<?php echo is_front_page() && display_header_text() ? ' class="is-front-page"' : ''; ?>>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <?php if (has_nav_menu("main_nav")): ?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-responsive-collapse">
                            <span class="sr-only"><?php _e('Navigation', 'dimme-jour'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php endif ?>

                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <a class="navbar-brand" title="<?php bloginfo('description'); ?>" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php echo get_bloginfo('name', 'raw'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (has_nav_menu("main_nav")): ?>
                    <div id="navbar-responsive-collapse" class="collapse navbar-collapse">
                        <?php
                        dimme_jour_display_main_menu();
                        ?>

                    </div>
                <?php endif ?>
            </div>
        </nav>
    </header>
    <?php if (is_front_page() && $full_page_frontpage) : ?>

    <?php elseif ($header_image): ?>
        <div class="post-header" style="background-image: url(<?php echo $header_image; ?>);">
            <?php if (display_header_text()) : ?>
                <div class="site-header-body">
                    <h1>
                        <?php echo get_bloginfo('name', 'display') ?>
                    </h1>
                    <p>
                        <?php echo get_bloginfo('description', 'display') ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>



