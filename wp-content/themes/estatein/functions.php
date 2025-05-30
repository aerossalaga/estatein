<?php
/**
 * estatein functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package estatein
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function estatein_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on estatein, use a find and replace
		* to change 'estatein' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'estatein', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Header Menu', 'estatein' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'estatein_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'estatein_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function estatein_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'estatein_content_width', 640 );
}
add_action( 'after_setup_theme', 'estatein_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function estatein_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'estatein' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'estatein' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'estatein_widgets_init' );

/**
 * Custom Nav Walker
 */
require get_template_directory() . '/inc/class-estatein-nav-walker.php';
require get_template_directory() . '/inc/class-estatein-mobile-nav-walker.php';

/**
 * ACF Blocks and related functionality
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Enqueue scripts and styles.
 */
function estatein_scripts() {
	// Enqueue our custom main CSS
	wp_enqueue_style( 'estatein-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );
	
	// Enqueue the original style.css at a lower priority
	// wp_enqueue_style( 'estatein-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_style_add_data( 'estatein-style', 'rtl', 'replace' );

	// Enqueue our custom main.js
	wp_enqueue_script( 'estatein-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'estatein_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * SVG Icons
 */
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Enqueue admin styles for the block editor only
 */
function estatein_enqueue_admin_styles() {
    wp_enqueue_style( 'estatein-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', array(), _S_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'estatein_enqueue_admin_styles' );

/**
 * Add SVG icons to the admin footer only on post edit screens
 */
function estatein_add_admin_svg_icons() {
    $current_screen = get_current_screen();
    if ( $current_screen && ( $current_screen->base === 'post' || $current_screen->is_block_editor ) ) {
        estatein_admin_svg_icons();
    }
}
add_action( 'admin_footer', 'estatein_add_admin_svg_icons' );

/**
 * Improve performance by disabling emoji script
 */
function estatein_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    
    // Remove the tinymce emoji plugin
    add_filter( 'tiny_mce_plugins', 'estatein_disable_emojis_tinymce' );
    
    // Remove emoji DNS prefetch
    add_filter( 'wp_resource_hints', 'estatein_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'estatein_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin
 */
function estatein_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints
 */
function estatein_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}

/**
 * Add image alt text support for SEO
 */
function estatein_add_image_alt_theme_support() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'estatein_add_image_alt_theme_support' );

/**
 * Add meta description for SEO
 */
function estatein_meta_description() {
    global $post;
    if ( is_singular() ) {
        $description = wp_strip_all_tags( get_the_excerpt(), true );
        if ( ! $description ) {
            $description = get_bloginfo( 'description' );
        }
    } else {
        $description = get_bloginfo( 'description' );
    }
    
    if ( $description ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'estatein_meta_description' );

/**
 * Add accessibility features
 */
function estatein_accessibility_features() {
    // Add screen reader text class
    add_theme_support( 'editor-styles' );
    
    // Add skip link
    add_action( 'wp_footer', 'estatein_skip_link_focus_fix' );
}
add_action( 'after_setup_theme', 'estatein_accessibility_features' );

/**
 * Fix skip link focus in IE11
 */
function estatein_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}

/**
 * Add schema markup for SEO
 */
function estatein_schema_org() {
    // Add basic schema.org data
    $schema = array(
        '@context'  => 'https://schema.org',
        '@type'     => 'WebSite',
        'name'      => get_bloginfo( 'name' ),
        'url'       => home_url(),
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'estatein_schema_org' );

/**
 * Optimize images by adding loading="lazy" attribute
 */
function estatein_add_lazy_loading_attribute( $content ) {
    // Add loading="lazy" to img tags
    if ( is_admin() ) {
        return $content;
    }
    
    $content = preg_replace( '/<img(\s+)([^>]*)>/i', '<img$1$2 loading="lazy">', $content );
    
    return $content;
}
add_filter( 'the_content', 'estatein_add_lazy_loading_attribute' );
add_filter( 'post_thumbnail_html', 'estatein_add_lazy_loading_attribute' );

/**
 * Add Open Graph and Twitter Card meta tags for social sharing
 */
function estatein_social_meta_tags() {
    global $post;

    if ( is_singular() ) {
        $title = get_the_title();
        $excerpt = wp_strip_all_tags( get_the_excerpt(), true );
        $permalink = get_permalink();
        
        // Get featured image
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = '';
        if ( $thumbnail_id ) {
            $thumbnail_url = wp_get_attachment_url( $thumbnail_id );
        }
        
        // Open Graph
        echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( $permalink ) . '" />' . "\n";
        if ( $thumbnail_url ) {
            echo '<meta property="og:image" content="' . esc_url( $thumbnail_url ) . '" />' . "\n";
        }
        echo '<meta property="og:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
        
        // Twitter Card
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
        if ( $thumbnail_url ) {
            echo '<meta name="twitter:image" content="' . esc_url( $thumbnail_url ) . '" />' . "\n";
        }
    }
}
add_action( 'wp_head', 'estatein_social_meta_tags' );

