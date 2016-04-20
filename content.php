<?php
$post_custom = get_post_custom('class');
$class = isset($post_custom['class']) ? $post_custom['class'] : array();
?>
<div class="<?php echo implode(" ", $class); ?>">
    <div class="row">
        <article id="post-<?php the_ID(); ?>" <?php post_class("col-xs-12"); ?> role="article">
            <header>
                <?php if (is_singular()) : ?>
                    <div class="article-header">
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                    </div>
                <?php else: ?>
                    <div class="article-header">
                        <h2 class="h1">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </div>
                <?php endif ?>
                <?php dimme_jour_display_post_meta() ?>
            </header>
            <section class="post_content">
                <?php
                if (is_search()) {
                    the_excerpt();
                } else {
                    /* translators: %s: Name of current post */
                    the_content(sprintf(
                        __('Continue reading %s', 'dimme-jour'),
                        the_title('<span class="screen-reader-text">', '</span>', false)
                    ));

                    wp_link_pages();
                }
                ?>
            </section>
            <footer>
                <?php the_tags('<p class="tags">', ' ', '</p>'); ?>
            </footer>
        </article>
    </div>
</div>

