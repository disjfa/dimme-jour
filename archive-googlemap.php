<?php
get_header();
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php if (is_page()): ?>
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            get_template_part('content');
                        endwhile;
                    endif;
                    ?>
                <?php endif; ?>
                <?php if (is_archive()): ?>
                    <h1 class="archive_title">
                        <?php echo get_the_archive_title(); ?>
                    </h1>
                    <p>
                        <?php echo get_the_archive_description(); ?>
                    </p>
                <?php endif; ?>
                <div class="googlemaps">
                    <div class="googlemaps-buttons">
                        <div class="btn-group">
                            <a href="#googlemaps-posts" class="btn btn-default googlemap-show-list">
                                <?php _e('show list', 'dimme-jour'); ?>
                            </a>
                            <a href="#googlemaps-map" class="btn btn-default googlemap-show-map">
                                <?php _e('show map', 'dimme-jour'); ?>
                            </a>
                        </div>
                    </div>

                    <div class="googlemaps-map" id="googlemaps-map">
                        <?php
                        $dimmeGoolemaps = DimmeGooglemaps::get_instance();
                        $dimmeGoolemaps->show_map(true);
                        ?>
                    </div>
                    <div class="googlemaps-posts" id="googlemaps-posts">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                get_template_part('content');
                            endwhile;
                            dimme_jour_page_navi();
                        else :
                            get_template_part('content', 'none');
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
