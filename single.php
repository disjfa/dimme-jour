<?php
get_header();
?>
    <div class="container">
        <?php

        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('content', get_post_format());
                comments_template('', true);
                if (get_next_post() || get_previous_post()) {
                    ?>
                    <nav class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="pager pager-unspaced">
                                    <li class="previous"><?php previous_post_link('%link', "&laquo; " . __('Previous Post', "dimme-jour")); ?></li>
                                    <li class="next"><?php next_post_link('%link', __('Next Post', "dimme-jour") . " &raquo;"); ?></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <?php
                }
            endwhile;
        else :
            get_template_part('content', 'none');
        endif;
        ?>
    </div>
<?php

get_footer();