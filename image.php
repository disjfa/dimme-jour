<?php
/**
 * The WordPress template hierarchy first checks for any
 * MIME-types and then looks for the attachment.php file.
 *
 * @link codex.wordpress.org/Template_Hierarchy#Attachment_display
 */

get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class("block"); ?> role="article">
            <header>
                <div class="article-header"><h1 itemprop="headline">
                        <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo esc_html(get_the_title($post->post_parent)); ?></a> &raquo; <?php the_title(); ?>
                    </h1></div>
                <?php dimme_jour_display_post_meta() ?>
            </header>

            <section class="post_content" itemprop="articleBody">
                <!-- To display current image in the photo gallery -->

                <a href="<?php echo wp_get_attachment_url($post->ID); ?>">
                    <?php
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');

                    if ($image) : ?>
                        <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive thumbnail">
                    <?php endif; ?>
                </a>

            </section>

            <footer>
                <?php the_tags('<p class="tags">', ' ', '</p>'); ?>
            </footer>

            <nav>
                <ul class="pager">
                    <li class="previous"><?php next_image_link(false, __('&laquo; Previous', "dimme-jour")); ?></li>
                    <li class="next"><?php previous_image_link(false, __('Next &raquo;', "dimme-jour")); ?></li>
                </ul>
            </nav>

        </article>
    </div>
    <?php comments_template(); ?>

<?php endwhile; ?>

<?php else : ?>

    <?php get_template_part('content', 'none'); ?>

<?php endif; ?>


<?php get_footer(); ?>