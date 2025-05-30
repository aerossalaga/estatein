<?php
/**
 * ACF Blocks and Custom Fields registration
 *
 * @package estatein
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register ACF Blocks
 */
function estatein_register_acf_blocks() {
    // Check if function exists
    if ( function_exists( 'acf_register_block_type' ) ) {
        
        // Register Hero Block
        acf_register_block_type( array(
            'name'              => 'hero',
            'title'             => __( 'Hero', 'estatein' ),
            'description'       => __( 'A custom hero block with image, text, and buttons.', 'estatein' ),
            'render_template'   => 'template-parts/blocks/hero.php',
            'category'          => 'estatein-blocks',
            'icon'              => 'admin-home',
            'keywords'          => array( 'hero', 'banner', 'header' ),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/style.css',
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
            'supports'          => array(
                'align' => false,
            ),
        ));
        
        // Register CTA Buttons Block
        acf_register_block_type( array(
            'name'              => 'cta-buttons',
            'title'             => __( 'CTA Buttons', 'estatein' ),
            'description'       => __( 'A block with call-to-action buttons.', 'estatein' ),
            'render_template'   => 'template-parts/blocks/cta-buttons.php',
            'category'          => 'estatein-blocks',
            'icon'              => 'button',
            'keywords'          => array( 'cta', 'buttons', 'call to action' ),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/style.css',
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
            'supports'          => array(
                'align' => false,
            ),
        ));
        
        // Register Text CTA Block
        acf_register_block_type( array(
            'name'              => 'text-cta',
            'title'             => __( 'Text CTA', 'estatein' ),
            'description'       => __( 'A text-based call-to-action block.', 'estatein' ),
            'render_template'   => 'template-parts/blocks/text-cta.php',
            'category'          => 'estatein-blocks',
            'icon'              => 'megaphone',
            'keywords'          => array( 'cta', 'text', 'call to action' ),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/style.css',
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
            'supports'          => array(
                'align' => false,
            ),
        ));
        
        // Register Intro with Image Block
        acf_register_block_type( array(
            'name'              => 'intro-with-image',
            'title'             => __( 'Intro with Image', 'estatein' ),
            'description'       => __( 'A block with introduction text and an image.', 'estatein' ),
            'render_template'   => 'template-parts/blocks/intro-with-image.php',
            'category'          => 'estatein-blocks',
            'icon'              => 'align-pull-right',
            'keywords'          => array( 'intro', 'image', 'about', 'statistics' ),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/style.css',
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
            'supports'          => array(
                'align' => false,
            ),
        ));
        
        // Register Content with Icon Columns Block
        acf_register_block_type( array(
            'name'              => 'content-with-right-icon-columns',
            'title'             => __( 'Content with Right Icon Columns', 'estatein' ),
            'description'       => __( 'A block with content on the left and icon columns on the right.', 'estatein' ),
            'render_template'   => 'template-parts/blocks/content-with-right-icon-columns.php',
            'category'          => 'estatein-blocks',
            'icon'              => 'columns',
            'keywords'          => array( 'content', 'columns', 'icons', 'features', 'values' ),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/style.css',
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
            'supports'          => array(
                'align' => false,
            ),
        ));

        // Register Team Cards Block
        acf_register_block_type( array(
            'name'              => 'team-cards',
            'title'             => __( 'Team Cards', 'estatein' ),
            'description'       => __( 'A block with content on the top and team cards on the bottom.', 'estatein' ),
            'render_template'   => 'template-parts/blocks/team-cards.php',
            'category'          => 'estatein-blocks',
            'icon'              => 'columns',
            'keywords'          => array( 'content', 'cards', 'team' ),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/style.css',
            'example'           => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview' => true
                    )
                )
            ),
            'supports'          => array(
                'align' => false,
            ),
        ));
    }
}
add_action( 'acf/init', 'estatein_register_acf_blocks' );

/**
 * Register custom block category
 */
function estatein_block_categories( $categories, $post ) {
    return array_merge(
        array(
            array(
                'slug'  => 'estatein-blocks',
                'title' => __( 'Estatein Blocks', 'estatein' ),
                'icon'  => 'admin-home',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'estatein_block_categories', 10, 2 );

/**
 * Register ACF Options Page
 */
function estatein_acf_options_page() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug'  => 'theme-options',
            'capability' => 'edit_posts',
            'redirect'   => false,
        ) );
    }
}
add_action( 'acf/init', 'estatein_acf_options_page' ); 