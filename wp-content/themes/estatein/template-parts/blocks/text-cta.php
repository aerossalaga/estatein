<?php
/**
 * Text CTA Block Template.
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
$class_name = 'text-cta';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Load values
$heading = get_field('heading');
$text = get_field('text');
$button = get_field('button');

// Set default values for preview
if ( $is_preview ) {
    if ( empty( $heading ) ) {
        $heading = 'Start Your Real Estate Journey Today';
    }
    if ( empty( $text ) ) {
        $text = 'Your dream property is just a click away. Whether you\'re looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.';
    }
    if ( empty( $button ) ) {
        $button = array(
            'title' => 'Explore Properties',
            'url' => '#',
            'target' => '',
        );
    }
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container">
        <div class="text-cta-inner">
            <div class="text-cta-content">
                <?php if ( $heading ) : ?>
                    <h2><?php echo esc_html( $heading ); ?></h2>
                <?php endif; ?>
                
                <?php if ( $text ) : ?>
                    <p><?php echo esc_html( $text ); ?></p>
                <?php endif; ?>
            </div>
            
            <?php if ( $button ) : ?>
                <div class="text-cta-button">
                    <a href="<?php echo esc_url( $button['url'] ); ?>" class="as-button as-button--purple-60" <?php echo ! empty( $button['target'] ) ? 'target="' . esc_attr( $button['target'] ) . '"' : ''; ?>>
                        <?php echo esc_html( $button['title'] ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section> 