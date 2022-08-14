<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/* sic */
function sic_scripts() {
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/bundle.min.css', [], "2.0.0" );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.min.js', array(), "2.0.0", true );
    wp_enqueue_script( 'hyphenopoly', get_template_directory_uri() . '/lib/hyphenopoly/Hyphenopoly_Loader.js', array('jquery'), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'sic_scripts' );

function sic_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_editor_style('dist/bundle.min.css' );
    add_editor_style( "gutenberg/gutFixes.css" );
}
add_action( 'after_setup_theme', 'sic_theme_support' );


function sic_menus() {
  register_nav_menu('sic-main-nav',__( 'Main Navigation' ));
  register_nav_menu('sic-footer-nav',__( 'Footer Navigation' ));
}
add_action( 'init', 'sic_menus' );

function sic_menu_items( $location, $args = [] ) {

    // Get all locations
    $locations = get_nav_menu_locations();

    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );

    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );

    // Return menu post objects
    return $menu_items;
}

add_filter( 'wp_get_nav_menu_items', 'prefix_nav_menu_classes', 10, 3 );

function prefix_nav_menu_classes($items, $menu, $args) {
    _wp_menu_item_classes_by_context($items);
    return $items;
}


/* Widgets */

function sic_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Widget',
		'id'            => 'footer_widget',
		'before_widget' => '<div class="sic-footer-widget">',
		'after_widget'  => '</div>'
	) );

}
add_action( 'widgets_init', 'sic_widgets_init' );


// Shortcodes

/* Element Shortcode */
function sic_element_shortcode($atts) {
    $args = shortcode_atts( array(
        "elem" => "",
    ), $atts, "sic-element" );
    ob_start();
    get_template_part("template-parts/elements/{$args['elem']}", "", $atts);
    return ob_get_clean();
}

add_shortcode('sic-element', 'sic_element_shortcode');

function sic_highlight_shortcode($atts, $content = "") {
    $args = shortcode_atts( array(
        "classes" => "",
    ), $atts, "sic-highlight" );
    return "<span class='sic-highlight {$args["classes"]}'>{$content}</span>";
}

add_shortcode('sic', 'sic_highlight_shortcode');


// ACF

function sic_acf() {
    define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );
    include_once( MY_ACF_PATH . 'acf.php' );
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
    function set_acf_json_save_folder( $path ) {
        $path = MY_ACF_PATH . '/acf-json';
        return $path;
    }
    add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
    function add_acf_json_load_folder( $paths ) {
        unset($paths[0]);
        $paths[] = MY_ACF_PATH . '/acf-json';;
        return $paths;
    }

    // (Optional) Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    // function my_acf_settings_show_admin( $show_admin ) {
    //     return false;
    // }
}
sic_acf();

add_action('acf/init', 'sic_blocktypes');
function sic_blocktypes() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'fp-heroine',
            'title'             => __('Frontpage Heroine'),
            'description'       => __('Heroine on the frontpage of the theme.'),
            'render_template'   => 'template-parts/blocks/fp-heroine.php',
            'category'          => 'sic',
            'icon'              => '',
            'keywords'          => array("frontpage", "heroine"),
        ));

        acf_register_block_type(array(
            'name'              => 'button',
            'title'             => __('SIC Button'),
            'description'       => __('Button for the semper in circulo theme.'),
            'render_template'   => 'template-parts/blocks/button.php',
            'category'          => 'sic',
            'icon'              => '',
            'keywords'          => array("button", "buttons"),
        ));

        acf_register_block_type(array(
            'name'              => 'toggle',
            'title'             => __('Detail Toggle'),
            'description'       => __('Toggle that opens/closes based on user interaction'),
            'render_template'   => 'template-parts/blocks/toggle.php',
            'category'          => 'sic',
            'icon'              => '',
            'keywords'          => array("toggle", "detail"),
        ));

        acf_register_block_type(array(
            'name'              => 'img-spacer',
            'title'             => __('Image Spacer'),
            'description'       => __('Spacing random image'),
            'render_template'   => 'template-parts/blocks/img-spacer.php',
            'category'          => 'sic',
            'icon'              => '',
            'keywords'          => array("Image Spacer", "spacer", "image"),
        ));
    }
}

add_filter( 'render_block', 'sic_wrap_blocks', 10, 2 );

function sic_wrap_blocks( $block_content, $block ) {
    $fw = [
        "acf/fp-heroine",
        "core/shortcode"
    ];
    $lg = [
        ""
    ];
    $md = [
        "core/columns", "acf/img-spacer"
    ];

    if ($block['blockName'] == "") {
        $block['blockName'] = "core/none";
    }

    if (in_array($block['blockName'], $fw)) {
        $width = "fw-container";
    } else if (in_array($block['blockName'], $lg)) {
        $width = "lg-container";
    } else if (in_array($block['blockName'], $md)) {
        $width = "md-container";
    } else {
        if (is_front_page()) {
            $width = "md-container";
        } else {
            $width = "sm-container";
        }
    }

    $block_content = "<div data-block-name='{$block["blockName"]}' class='{$width}'>" . $block_content . "</div>";
    return $block_content;
}