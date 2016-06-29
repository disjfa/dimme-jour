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
if (is_singular() && has_post_thumbnail()) {
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dimme_jour_featured', false);
    if ($image) {
        list($header_image, $width, $height) = $image;
    } else {
        $header_image = false;
    }
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
    <?php if (is_front_page() && display_header_text()) : ?>
    <?php elseif ($header_image): ?>
        <div class="post-header" style="background-image: url(<?php echo $header_image; ?>);">

        </div>
    <?php endif; ?>



