<?php

$post_custom = get_post_custom('class');
$class = isset($post_custom['class']) ? $post_custom['class'] : array();
$class[] = 'main-container';
$aside_image = '';
$background_image = '';
$post_format = get_post_format();

if (get_post_type() == 'front-page') {
    if ($post_format == 'aside') {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dimme_jour_aside', false);
        if (count($image) > 0) {
            $aside_image = $image[0];
        }
    } else {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'dimme_jour_featured', false);
        if (count($image) > 0) {
            $background_image = sprintf(' style="background-image:url(%s);"', $image[0]);
        }
    }
}
?>

<div class="<?php echo implode(" ", $class); ?>"<?php echo $background_image; ?>>
    <article id="post-<?php the_ID(); ?>" <?php post_class("container"); ?> role="article">
        <div class="row">
            <div class="col-xs-12">
                <header>
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                </header>
                <section class="post_content">
                    <?php
                    the_content(sprintf(
                        __('Continue reading %s', 'dimme-jour'),
                        the_title('<span class="screen-reader-text">', '</span>', false)
                    ));
                    ?>
                </section>
                <?php if ($aside_image): ?>
                    <div class="aside-image">
                        <img src="<?php echo $aside_image; ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>