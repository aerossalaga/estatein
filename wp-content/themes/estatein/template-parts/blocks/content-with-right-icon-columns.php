<?php
/**
 * Content with Right Icon Columns Block Template.
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
$class_name = 'content-with-right-icon-columns';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Load values and assign defaults.
$heading = get_field( 'heading' ) ?: 'Reimagining Real Estate for the Modern Era';
$text = get_field( 'text' ) ?: 'Estatein represents a revolution in real estate, a harmonious blend of innovation and tradition that places your unique needs at the center of the property journey.';
$columns = get_field( 'columns' );
$button = get_field( 'button' );
$has_sparkle = get_field( 'has_sparkle' );

// Add class if heading has sparkle
if ( $has_sparkle ) {
    $class_name .= ' content-with-right-icon-columns--has-sparkle';
}

// Preview placeholder values
if ( $is_preview && empty( $columns ) ) {
    $columns = array(
        array(
            'icon' => array(
                'url' => get_template_directory_uri() . '/assets/images/icon-star-purple.png',
                'alt' => 'Innovation',
            ),
            'title' => 'Innovation',
            'text' => 'Embrace cutting-edge solutions that redefine property experiences.',
        ),
        array(
            'icon' => array(
                'url' => get_template_directory_uri() . '/assets/images/icon-cap-purple.png',
                'alt' => 'Integrity',
            ),
            'title' => 'Integrity',
            'text' => 'Trust built on transparency, honesty, and strong ethical foundations.',
        ),
        array(
            'icon' => array(
                'url' => get_template_directory_uri() . '/assets/images/icon-users-purple.png',
                'alt' => 'Excellence',
            ),
            'title' => 'Excellence',
            'text' => 'Committed to exceptional service that exceeds expectations.',
        ),
    );
}
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container">
        <div class="content-with-right-icon-columns-inner">
            <div class="content-with-right-icon-columns-content">
                <?php if ( $heading ) : ?>
                    <h2 <?php echo $has_sparkle ? 'class="heading-sparkle"' : ''; ?>><?php echo esc_html( $heading ); ?></h2>
                <?php endif; ?>
                
                <?php if ( $text ) : ?>
                    <p><?php echo esc_html( $text ); ?></p>
                <?php endif; ?>
                
                <?php if ( $button ) : ?>
                    <div class="content-with-right-icon-columns-button">
                        <a href="<?php echo esc_url( $button['url'] ); ?>" class="as-button as-button--purple-60" <?php echo ! empty( $button['target'] ) ? 'target="' . esc_attr( $button['target'] ) . '"' : ''; ?>>
                            <?php echo esc_html( $button['title'] ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ( $columns ) : ?>
            <div class="content-with-right-icon-columns-columns">
                <?php foreach ( $columns as $column ) : ?>
                <div class="content-with-right-icon-columns-column">
                    <div class="content-with-right-icon-columns-column-inner">
                        <div class="content-with-right-icon-columns-top">
                            <?php if ( !empty($column['icon']) ) : ?>
                            <div class="content-with-right-icon-columns-icon">
                                <?php 
                                // Check if icon is an array or a string
                                if (is_array($column['icon'])) : 
                                ?>
                                    <img src="<?php echo esc_url( $column['icon']['url'] ); ?>" alt="<?php echo esc_attr( $column['icon']['alt'] ); ?>">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $column['icon'] ); ?>" alt="<?php echo esc_attr( $column['title'] ); ?>">
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( !empty($column['title']) ) : ?>
                            <h3 class="content-with-right-icon-columns-title"><?php echo esc_html( $column['title'] ); ?></h3>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ( !empty($column['text']) ) : ?>
                        <p class="content-with-right-icon-columns-description"><?php echo esc_html( $column['text'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>