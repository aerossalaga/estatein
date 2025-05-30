<?php
/**
 * Intro with Image Block Template.
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
$class_name = 'intro-with-image';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Load values and assign defaults.
$heading = get_field( 'heading' ) ?: 'Our Journey';
$text = get_field( 'text' ) ?: 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary. Over the years, we\'ve expanded our reach, forged valuable partnerships, and gained the trust of countless clients.';
$image = get_field( 'image' );
$image_position = get_field( 'image_position' ) ?: 'right';
$button = get_field( 'button' );
$stats = get_field( 'stats' );

// Add position class
$class_name .= ' intro-with-image--' . $image_position;

// Preview placeholder values
if ( $is_preview ) {
    if ( empty( $image ) ) {
        $image = array(
            'url' => get_template_directory_uri() . '/assets/images/intro-img.png',
            'alt' => 'Placeholder Image',
        );
    }
    
    if ( empty( $stats ) ) {
        $stats = array(
            array(
                'number' => '200+',
                'text' => 'Happy Customers'
            ),
            array(
                'number' => '10k+',
                'text' => 'Properties For Clients'
            ),
            array(
                'number' => '16+',
                'text' => 'Years of Experience'
            )
        );
    }
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container">
        <div class="intro-with-image-inner">
            <?php if ( $image && $image_position === 'left' ) : ?>
            <div class="intro-with-image-media">
                <?php 
                // Check if image is an array or a string
                if (is_array($image)) : 
                ?>
                    <img src="<?php echo esc_url( $image['url'] ); ?>" class="intro-with-image-image" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
                <?php else : ?>
                    <img src="<?php echo esc_url( $image ); ?>" class="intro-with-image-image" alt="<?php echo esc_attr( $heading ); ?>" loading="lazy">
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <div class="intro-with-image-content">
                <?php if ( $heading ) : ?>
                    <h2 class="heading-sparkle"><?php echo esc_html( $heading ); ?></h2>
                <?php endif; ?>
                
                <?php if ( $text ) : ?>
                    <p><?php echo esc_html( $text ); ?></p>
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
                
                <?php if ( $button ) : ?>
                    <div class="intro-with-image-button">
                        <a href="<?php echo esc_url( $button['url'] ); ?>" class="as-button as-button--purple-60" <?php echo ! empty( $button['target'] ) ? 'target="' . esc_attr( $button['target'] ) . '"' : ''; ?>>
                            <?php echo esc_html( $button['title'] ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ( $image && $image_position === 'right' ) : ?>
            <div class="intro-with-image-media">
                <?php 
                // Check if image is an array or a string
                if (is_array($image)) : 
                ?>
                    <img src="<?php echo esc_url( $image['url'] ); ?>" class="intro-with-image-image" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
                <?php else : ?>
                    <img src="<?php echo esc_url( $image ); ?>" class="intro-with-image-image" alt="<?php echo esc_attr( $heading ); ?>" loading="lazy">
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>