<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package estatein
 */

// Get banner fields from theme options
$banner = get_field('banner', 'option');
$banner_text = isset($banner['banner_text']) ? $banner['banner_text'] : '';
$banner_link = isset($banner['banner_link']) ? $banner['banner_link'] : '';

// Add banner-active class to body if banner is active and has text
if (!empty($banner_text)) {
    add_filter('body_class', function($classes) {
        $classes[] = 'banner-active';
        return $classes;
    });
}

get_header();
?>

	<main id="primary" class="site-main">
		<?php if (!empty($banner_text)) : ?>
        <section class="banner">
            <div class="container">
                <div class="banner-inner">
                    <p>
                        <?php echo esc_html($banner_text); ?>
                        <?php if (!empty($banner_link)) : ?>
                            <a href="<?php echo esc_url($banner_link['url']); ?>" <?php echo (!empty($banner_link['target']) ? 'target="' . esc_attr($banner_link['target']) . '"' : ''); ?>>
                                <?php echo esc_html($banner_link['title']); ?>
                            </a>
                        <?php endif; ?>
                    </p>
                </div>
                <button class="banner-close">
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon-close-white"></use>
                    </svg>
                </button>
            </div>
        </section>
        <?php endif; ?>

		<?php
		while ( have_posts() ) :
			the_post();

			the_content();
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
