<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package estatein
 */

?>

	<footer class="footer">
		<div class="container">
			<div class="footer-inner">
				<div class="footer-logo">
					<div class="footer-logo-image">
						<?php 
						$logo_id = get_field('logo', 'option');
						if ($logo_id) {
							echo wp_get_attachment_image($logo_id, 'full');
						} else {
							the_custom_logo();
						}
						?>
					</div>
					<div class="footer-email-form">
						<input type="email" placeholder="Enter Your Email">
						<button class="footer-email-form-button" type="submit">
							<svg width="30" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
								<use href="#icon-send-white"></use>
							</svg>
						</button>
					</div>
				</div>
				<div class="footer-nav">
					<?php 
					$footer_navigation = get_field('footer_navigation', 'option');
					if ($footer_navigation) {
						foreach ($footer_navigation as $nav) {
							echo '<div class="footer-nav-list">';
							if (!empty($nav['title'])) {
								echo '<h5>' . esc_html($nav['title']) . '</h5>';
							}
							
							if (!empty($nav['links'])) {
								echo '<ul>';
								foreach ($nav['links'] as $link) {
									if (!empty($link['link'])) {
										echo '<li><a href="' . esc_url($link['link']['url']) . '"' . 
										(!empty($link['link']['target']) ? ' target="' . esc_attr($link['link']['target']) . '"' : '') . '>' . 
										esc_html($link['link']['title']) . '</a></li>';
									}
								}
								echo '</ul>';
							}
							echo '</div>';
						}
					}
					?>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-inner">
					<p class="footer-bottom-text">
						<span>
							<?php 
							$footer_copy = get_field('footer_copy', 'option');
							if ($footer_copy) {
								echo esc_html($footer_copy);
							} else {
								echo '&copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.';
							}
							?>
						</span>
						<?php 
						$footer_link = get_field('footer_link', 'option');
						if ($footer_link) {
							echo '<a href="' . esc_url($footer_link['url']) . '"' . 
								(!empty($footer_link['target']) ? ' target="' . esc_attr($footer_link['target']) . '"' : '') . '>' . 
								esc_html($footer_link['title']) . '</a>';
						}
						?>
					</p>
					<div class="footer-bottom-social">
						<?php 
						$social_media = get_field('social_media', 'option');
						if ($social_media) {
							foreach ($social_media as $social) {
								if (!empty($social['icon']) && !empty($social['url'])) {
									echo '<a href="' . esc_url($social['url']) . '" class="footer-bottom-social-link" target="_blank" rel="noopener noreferrer">';
									echo '<svg fill="none" xmlns="http://www.w3.org/2000/svg">';
									echo '<use href="#icon-' . esc_attr($social['icon']) . '"></use>';
									echo '</svg>';
									echo '</a>';
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<?php 
	// Output SVG Icons using our function
	estatein_output_svg_icons(); 
	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
