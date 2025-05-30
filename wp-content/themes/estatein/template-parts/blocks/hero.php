<?php
/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Load values and assign defaults.
$heading = get_field( 'heading' ) ?: 'Discover Your Dream Property with Estatein';
$text = get_field( 'text' ) ?: 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.';
$image = get_field( 'image' );
$badge_text = get_field( 'badge_text' ) ?: '✨Discover Your Dream Property';
$buttons = get_field( 'buttons' );
$stats = get_field( 'stats' );

// Preview placeholder values
if ( $is_preview && empty( $image ) ) {
    $image = array(
        'url' => get_template_directory_uri() . '/assets/images/home-hero.jpg',
        'alt' => 'Hero Image',
    );
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="hero-inner">
        <?php if ( $image ) : ?>
        <div class="hero-image">
            <?php 
            // Check if image is an array or a string
            if (is_array($image)) : 
            ?>
                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
            <?php else : ?>
                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $heading ); ?>">
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ( $badge_text ) : ?>
        <div class="hero-badge">
            <div class="hero-badge-inner">
                <div class="hero-badge-text">
                    <svg width="175" height="175" viewBox="0 0 175 175">
                        <path id="circlePath" d="M 87.5, 87.5 m -70, 0 a 70,70 0 1,1 140,0 a 70,70 0 1,1 -140,0" style="fill: none;"></path>
                        <text><textPath href="#circlePath" startOffset="0%"><?php echo esc_html( $badge_text ); ?></textPath></text>
                    </svg>
                </div>
                <div class="hero-badge-icon">
                    <svg width="34" height="34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon-arrow-diagonal-white"></use>
                    </svg>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="container">
            <div class="hero-content">
                <div class="hero-content-inner">
                    <h1><?php echo esc_html( $heading ); ?></h1>
                    <p><?php echo esc_html( $text ); ?></p>

                    <?php if ( $buttons ) : ?>
                    <div class="hero-actions">
                        <?php foreach ( $buttons as $button ) : ?>
                            <a href="<?php echo esc_url( $button['link']['url'] ); ?>" class="hero-actions-link as-button as-button--<?php echo esc_attr( $button['style'] ); ?>" <?php echo ( ! empty( $button['link']['target'] ) ? 'target="' . esc_attr( $button['link']['target'] ) . '"' : '' ); ?>>
                                <?php echo esc_html( $button['link']['title'] ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( $stats ) : ?>
                    <div class="hero-count">
                        <?php foreach ( $stats as $stat ) : ?>
                            <div class="hero-count-item">
                                <span class="hero-count-item-number"><?php echo esc_html( $stat['number'] ); ?></span>
                                <span class="hero-count-item-text"><?php echo esc_html( $stat['text'] ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section> 