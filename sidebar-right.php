
<?php if ( is_active_sidebar( 'sidebar-right' ) ) { ?>
<div id="sidebar-right" class="<?php dimme_jour_sidebar_right_classes(); ?>" role="complementary">
    <div class="vertical-nav block">
    <?php dynamic_sidebar( 'sidebar-right' ); ?>
    </div>
</div>
<?php } ?>