<?php
get_header();
?>
    <div class="container">
        <?php

        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('content');
                comments_template('', true);

                the_post_navigation();
            endwhile;
        else :
            get_template_part('content', 'none');
        endif;
        ?>
    </div>
<?php

get_footer();