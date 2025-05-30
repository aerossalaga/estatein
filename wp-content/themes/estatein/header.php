<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package estatein
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'estatein' ); ?></a>

    <div class="mobile-menu-overlay" aria-hidden="true"></div>
    <header class="header" role="banner">
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
					<a href="<?php echo home_url(); ?>">
                    <?php 
                    $logo_id = get_field('logo', 'option');
                    if ($logo_id) {
                        $logo_alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
                        $site_name = get_bloginfo('name');
                        $logo_alt = $logo_alt ? $logo_alt : $site_name . ' Logo';
                        echo wp_get_attachment_image($logo_id, 'full', false, array('alt' => $logo_alt));
                    } else {
                        the_custom_logo();
                        }
                        ?>
					</a>
                </div>
                <div class="header-menu">
                    <nav class="header-nav" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'estatein'); ?>">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'menu_class'     => 'header-nav-list',
                                'walker'         => new Estatein_Nav_Walker(),
                            )
                        );
                        ?>
                    </nav>
                </div>
                <div class="header-mobile-menu">
                    <button class="header-mobile-toggle" aria-expanded="false" aria-controls="mobile-menu" aria-label="<?php esc_attr_e('Toggle mobile menu', 'estatein'); ?>">
                        <svg fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                            <use href="#icon-hamburger"></use>
                        </svg>
                    </button>
                    <div class="header-mobile-nav" id="mobile-menu" aria-hidden="true">
                        <button class="header-mobile-nav-close" aria-label="<?php esc_attr_e('Close mobile menu', 'estatein'); ?>">
                            <svg fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                <use href="#icon-close-white"></use>
                            </svg>
                        </button>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'mobile-menu',
                                'container'      => false,
                                'menu_class'     => 'header-mobile-nav-list',
                                'walker'         => new Estatein_Mobile_Nav_Walker(),
                            )
                        );
                        ?>
                        <div class="header-mobile-actions">
                            <?php 
                            $header_button = get_field('header_button', 'option');
                            if ($header_button): ?>
                                <a href="<?php echo esc_url($header_button['url']); ?>" class="as-button as-button--gray-08" <?php echo $header_button['target'] ? 'target="' . esc_attr($header_button['target']) . '"' : ''; ?>>
                                    <?php echo esc_html($header_button['title']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="header-actions">
                    <?php 
                    $header_button = get_field('header_button', 'option');
                    if ($header_button): ?>
                        <a href="<?php echo esc_url($header_button['url']); ?>" class="header-actions-link" <?php echo $header_button['target'] ? 'target="' . esc_attr($header_button['target']) . '"' : ''; ?>>
                            <?php echo esc_html($header_button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
