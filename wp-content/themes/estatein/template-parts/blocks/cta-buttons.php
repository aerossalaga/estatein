<?php
/**
 * CTA Buttons Block Template.
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
$class_name = 'cta-buttons';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Load values
$buttons = get_field('buttons');

// Set default values for preview
if ( $is_preview && empty( $buttons ) ) {
    $buttons = array(
        array(
            'icon' => array(
                'url' => get_template_directory_uri() . '/assets/images/icon-cta-house.svg',
                'alt' => 'Buy',
            ),
            'text' => 'Find Your Dream Home',
            'link' => array(
                'url' => '#',
                'title' => 'Find Your Dream Home',
                'target' => '',
            ),
        ),
        array(
            'icon' => array(
                'url' => get_template_directory_uri() . '/assets/images/icon-cta-camera.svg',
                'alt' => 'Sell',
            ),
            'text' => 'Unlock Property Value',
            'link' => array(
                'url' => '#',
                'title' => 'Unlock Property Value',
                'target' => '',
            ),
        ),
    );
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="cta-buttons-inner">
        <?php if ( $buttons ) : ?>
            <?php foreach ( $buttons as $button ) : ?>
                <?php 
                    if (
                        !is_array($button) ||
                        !isset($button['link']['url'])
                      ) {
                        continue;
                    }    
                ?>
                <div class="cta-buttons-item">
                    <a href="<?php echo esc_url( $button['link']['url'] ); ?>" class="cta-buttons-item-link" <?php echo (!empty($button['link']['target']) ? 'target="' . esc_attr($button['link']['target']) . '"' : ''); ?>>
                        <div class="cta-buttons-item-icon">
                            <?php if ( !empty($button['icon']) ) : ?>
                                <?php 
                                // Check if icon is an array (image field) or string (image URL)
                                if (is_array($button['icon'])) : 
                                ?>
                                    <img src="<?php echo esc_url( $button['icon']['url'] ); ?>" class="cta-buttons-item-icon-image" alt="<?php echo esc_attr( $button['icon']['alt'] ); ?>">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $button['icon'] ); ?>" class="cta-buttons-item-icon-image" alt="<?php echo esc_attr( $button['text'] ); ?>">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="cta-buttons-item-text">
                            <span><?php echo esc_html( $button['text'] ); ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section> 