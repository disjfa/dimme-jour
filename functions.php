<?php
include('wp_bootstrap_carousel.php');

function dimme_jour_admin_init()
{
    add_editor_style(get_stylesheet_directory_uri() . '/editor-style.css');
}

add_action('admin_init', 'dimme_jour_admin_init');

// Declaration of theme supported features
/**
 *
 */
function dimme_jour_theme_support()
{
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('custom-logo', array(
        'width' => 90,
        'height' => 60,
    ));
    add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
    set_post_thumbnail_size(125, 125, true);   // default thumb size
    add_theme_support('automatic-feed-links'); // rss thingy
    add_theme_support('title-tag');

    register_nav_menus(
        array(
            'main_nav' => __('Main Menu', 'dimme-jour'),   // main nav in header
        )
    );
    register_default_headers(array(
        'pineapples' => array(
            'url' => '%s/img/header.jpg',
            'thumbnail_url' => '%s/img/header-thumb.jpg',
            'description' => __('Pineapples', 'dimme-jour')
        )
    ));
    add_image_size('dimme_jour_aside', 400, 400, false);
    add_image_size('dimme_jour_featured', 1200, 800, true);
    load_theme_textdomain('dimme-jour', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'dimme_jour_theme_support');

/**
 * @param WP_Customize_Manager $wp_customize
 */
function dimme_jour_customize_register($wp_customize)
{
    $wp_customize->add_setting('dimme_jour_options[logo]', array(
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label' => __('Frontpage logo', 'dimme-jour'),
        'section' => 'title_tagline',
        'settings' => 'dimme_jour_options[logo]',
    )));


    $wp_customize->add_setting('dimme_jour_options[full_page_frontpage]', array(
        'capability' => 'edit_theme_options',
        'type' => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'full_page_frontpage', array(
        'settings' => 'dimme_jour_options[full_page_frontpage]',
        'label' => __('Show fullscreen frontpage', 'dimme-jour'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    )));
}

add_action('customize_register', 'dimme_jour_customize_register');

/**
 *
 */
function dimme_jour_theme_scripts()
{
    // For child themes
    wp_register_style('wpbs-style', get_stylesheet_directory_uri() . '/style.css', array(), null, 'all');
    wp_enqueue_style('wpbs-style');
    wp_register_script('bower-libs',
        get_template_directory_uri() . '/js/app.min.js',
        array('jquery'),
        null);
    wp_enqueue_script('bower-libs');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'dimme_jour_theme_scripts');

/**
 *
 */
function dimme_jour_load_fonts()
{
    wp_register_style('dimme_jour_googleFonts', '//fonts.googleapis.com/css?family=Montserrat|Raleway');
    wp_enqueue_style('dimme_jour_googleFonts');
}

add_action('wp_print_styles', 'dimme_jour_load_fonts');

/**
 *
 */
function dimme_jour_custom_header_setup()
{
    add_theme_support('custom-header', apply_filters('dimme_jour_custom_header_args', array(
        'default-text-color' => '#F7F7F7',
        'width' => 1200,
        'height' => 675
    )));
}

add_action('after_setup_theme', 'dimme_jour_custom_header_setup');

// Set content width
if (!isset($content_width))
    $content_width = 1140;

// Sidebar and Footer declaration
/**
 *
 */
function dimme_jour_register_sidebars()
{
    register_sidebar(array(
        'id' => 'footer-1',
        'name' => __('Footer 1', 'dimme-jour'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'footer-2',
        'name' => __('Footer 2', 'dimme-jour'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'footer-3',
        'name' => __('Footer 3', 'dimme-jour'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-default',
        'name' => __('Default Sidebar', 'dimme-jour'),
        'description' => __('Used on every page.', 'dimme-jour'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'dimme_jour_register_sidebars');

// Menu output mods
/**
 * Class dimme_jour_Bootstrap_walker
 */
class dimme_jour_Bootstrap_walker extends Walker_Nav_Menu
{

    /**
     * @param string $output
     * @param object $object
     * @param int $depth
     * @param array $args
     * @param int $current_object_id
     */
    function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0)
    {

        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $dropdown = $args->has_children && $depth == 0;

        $class_names = $value = '';

        // If the item has children, add the dropdown class for bootstrap
        if ($dropdown) {
            $class_names = "dropdown ";
        }

        $classes = empty($object->classes) ? array() : (array)$object->classes;
        $classes[] = 'nav-item';

        $class_names .= join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $object));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $object->ID . '"' . $value . $class_names . '>';

        if ($dropdown) {
            $attributes = ' href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"';
        } else {
            $attributes = !empty($object->attr_title) ? ' title="' . esc_attr($object->attr_title) . '"' : '';
            $attributes .= !empty($object->target) ? ' target="' . esc_attr($object->target) . '"' : '';
            $attributes .= !empty($object->xfn) ? ' rel="' . esc_attr($object->xfn) . '"' : '';
            $attributes .= !empty($object->url) ? ' href="' . esc_attr($object->url) . '"' : '';
            $attributes .= ' class="nav-link"';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $object->title, $object->ID);
        $item_output .= $args->link_after;

        // if the item has children add the caret just before closing the anchor tag
        if ($dropdown) {
            $item_output .= ' <b class="caret"></b>';
        }
        $item_output .= '</a>';

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $object, $depth, $args);
    } // end start_el function

    /**
     * @param string $output
     * @param int $depth
     * @param array $args
     */
    function start_lvl(&$output, $depth = 0, $args = Array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='dropdown-menu' role='menu'>\n";
    }

    /**
     * @param object $element
     * @param array $children_elements
     * @param int $max_depth
     * @param int $depth
     * @param array $args
     * @param string $output
     */
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
/**
 * @param $classes
 * @param $item
 * @return array
 */
function dimme_jour_add_active_class($classes, $item)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = "active";
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'dimme_jour_add_active_class', 10, 2);

// display the main menu bootstrap-style
// this menu is limited to 2 levels (that's a bootstrap limitation)
/**
 * display custom menu on the page
 */
function dimme_jour_display_main_menu()
{
    wp_nav_menu(
        array(
            'theme_location' => 'main_nav', /* where in the theme it's assigned */
            'menu' => 'main_nav', /* menu name */
            'menu_class' => 'nav navbar-nav',
            'container' => false, /* container class */
            'depth' => 2,
            'walker' => new dimme_jour_Bootstrap_walker(),
        )
    );
}

/*
  A function used in multiple places to generate the metadata of a post.
*/
/**
 * @return bool
 */
function dimme_jour_display_post_meta()
{
    if (get_post_type() != 'post') {
        edit_post_link(__('Edit', "dimme-jour"), '<span class="glyphicon glyphicon-pencil"></span> ', '');
        return false;
    }

    ?>
    <ul class="meta list-inline">
        <li>
            <a href="<?php the_permalink() ?>">
                <span class="glyphicon glyphicon-time"></span>
                <?php the_date(); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <span class="glyphicon glyphicon-user"></span>
                <?php the_author(); ?>
            </a>
        </li>
        <?php if (!post_password_required() && (comments_open() || get_comments_number())) : ?>
            <li>
                <?php
                $sp = '<span class="glyphicon glyphicon-comment"></span> ';
                comments_popup_link($sp . __('Leave a comment', "dimme-jour"), $sp . __('1 Comment', "dimme-jour"), $sp . __('% Comments', "dimme-jour"));
                ?>
            </li>
        <?php endif; ?>
        <?php edit_post_link(__('Edit', "dimme-jour"), '<li><span class="glyphicon glyphicon-pencil"></span> ', '</li>'); ?>
    </ul>

    <?php
}

add_filter('embed_oembed_html', 'dimme_jour_embed_oembed_html', 99, 4);
function dimme_jour_embed_oembed_html($html, $url, $attr, $post_id)
{
    if (preg_match('/^<iframe/', $html)) {
        return '<div class="video-container">' . $html . '</div>';
    }
    return $html;
}

function dimme_jour_link_pages_args($params)
{
    $args = array(
        'before' => '<nav><ul class="pagination">',
        'after' => '</ul></nav>',
        'link_before' => '',
        'link_after' => ''
    );
    return wp_parse_args($args, $params);
}

function dimme_jour_link_pages_link($link, $i)
{
    global $page;
    if ($page === $i) {
        return '<li class="active"><span>' . $link . '</span></li>';
    } else {
        return '<li>' . $link . '</li>';
    }
}

add_filter('wp_link_pages_link', 'dimme_jour_link_pages_link', 99, 2);
add_filter('wp_link_pages_args', 'dimme_jour_link_pages_args', 99, 2);