<?php get_header(); ?>


    <article id="post-not-found" class="container">

        <section class="post_content">
            <br><br>

            <h1>
                <?php _e("Page not found", "dimme-jour"); ?>
            </h1>

            <p class="lead">
                <?php _e("Looks like something went completely wrong", "dimme-jour"); ?>
            </p>

            <p>
                <?php _e("Please try another section of our awesome page", "dimme-jour"); ?>
            </p>
            <br><br>
            <?php get_search_form(); ?>
            <br><br><br>
        </section>

    </article>


<?php get_footer(); ?>