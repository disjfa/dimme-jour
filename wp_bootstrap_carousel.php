<?php

/**
 * Class Name: wp_bootstrap_gallery
 * GitHub URI: https://github.com/twittem/wp-bootstrap-gallery
 * Description: A custom Wordpress gallery for dynamic thumbnail layout using Twitter Bootstrap 2 thumbnail layouts.
 * Version: 1.0
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

function wp_bootstrap_gallery($content, $attr)
{
    global $instance, $post;
    $instance++;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'figure',
        'icontag' => 'div',
        'captiontag' => 'figcaption',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);

    if ('RAND' == $order) {
        $orderby = 'none';
    }

    if ($include) {

        $include = preg_replace('/[^0-9,]+/', '', $include);

        $_attachments = get_posts(array(
            'include' => $include,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
        ));

        $attachments = array();

        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }

    } elseif ($exclude) {

        $exclude = preg_replace('/[^0-9,]+/', '', $exclude);

        $attachments = get_children(array(
            'post_parent' => $id,
            'exclude' => $exclude,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
        ));

    } else {

        $attachments = get_children(array(
            'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
        ));

    }

    if (empty($attachments)) {
        return;
    }

    if(in_array($size, array("thumbnail", "medium"))) {
        return;
    }

    if (is_feed()) {
        $output = "\n";
        foreach ($attachments as $att_id => $attachment)
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval(min(array(8, $columns)));
    $float = (is_rtl()) ? 'right' : 'left';

    $selector = "gallery-{$instance}";
    $size_class = sanitize_html_class($size);
    $output = sprintf('<div class="carousel slide carousel-%s" data-ride="carousel" id="%s">', $size, $selector);

    /**
     * Count number of items in $attachments array, and assign a colum layout to $span_array
     * variable based on the mumber of images in the $attachments array
     */
    $attachment_count = 0;

    $output .= sprintf('<ol class="carousel-indicators">');
    $active = 'active';
    foreach ($attachments as $id => $attachment) {
        $output .= sprintf('<li data-target="#%s" data-slide-to="%d" class="%s"></li>', $selector, $attachment_count, $active);
        $attachment_count++;
        $active = '';
    }

    $output .= sprintf('</ol>');
    $output .= sprintf('<div class="carousel-inner">');
    $active = ' active';
    foreach ($attachments as $id => $attachment) {
        $attachment_image = wp_get_attachment_image($id, $size);
        $attachment_link = wp_get_attachment_link($id, $size, !(isset($attr['link']) AND 'file' == $attr['link']), 1, false, array('class' => 'img-responsive'));

        $output .= sprintf('<div class="item%s">', $active);
        $output .= $attachment_link;
        $output .= '</div>';
        $active = '';
    }
    $output .= "</div>";
    $output .= sprintf('<a class="left carousel-control" href="#%s" role="button" data-slide="prev">', $selector);
    $output .= sprintf('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>');
    $output .= sprintf('<span class="sr-only">Previous</span>');
    $output .= sprintf('</a>');
    $output .= sprintf('<a class="right carousel-control" href="#%s" role="button" data-slide="next">', $selector);
    $output .= sprintf('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>');
    $output .= sprintf('<span class="sr-only">Next</span>');
    $output .= sprintf('</a>');
    $output .= "</div>";

    return $output;
}

add_filter('post_gallery', 'wp_bootstrap_gallery', 10, 2);

?>