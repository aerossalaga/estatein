<?php
/**
 * Team Cards Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'team-cards';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Load values and assign defaults.
$heading = get_field( 'heading' ) ?: 'Meet Our Team';
$text = get_field( 'text' ) ?: 'Our team is dedicated to providing the best service possible.';
$cards = get_field( 'cards' );
$button = get_field( 'button' );
$has_sparkle = get_field( 'has_sparkle' );

// Preview placeholder values
if ( $is_preview && empty( $cards ) ) {
    $cards = array(
        array(
            'image' => array(
                'url' => get_template_directory_uri() . '/assets/images/card1.jpg',
                'alt' => 'Innovation',
            ),
            'title' => 'John Doe',
            'text' => 'CEO',
            'twitter_url' => '#'
        ),
        array(
            'image' => array(
                'url' => get_template_directory_uri() . '/assets/images/card2.jpg',
                'alt' => 'Innovation',
            ),
            'title' => 'Jane Smith',
            'text' => 'CTO',
            'twitter_url' => '#'
        ),
        array(
            'image' => array(
                'url' => get_template_directory_uri() . '/assets/images/card3.jpg',
                'alt' => 'Innovation',
            ),
            'title' => 'Jane Smith',
            'text' => 'CTO',
            'twitter_url' => '#'
        ),
        array(
            'image' => array(
                'url' => get_template_directory_uri() . '/assets/images/card4.jpg',
                'alt' => 'Innovation',
            ),
            'title' => 'Jane Smith',
            'text' => 'CTO',
            'twitter_url' => '#'
        ),
    );
}

?>
<section <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="container">
        <div class="team-cards-inner">
            <div class="team-cards-content">
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
            <?php if ( $cards ) : ?>
            <div class="team-cards-cards">
                <?php foreach ( $cards as $card ) : ?>
                <div class="team-cards-card">
                    <div class="team-cards-card-inner">
                        <div class="team-cards-card-image">
                            <?php if ( !empty($card['image']) ) : ?>
                                <img src="<?php echo esc_url( $card['image']['url'] ); ?>" alt="<?php echo esc_attr( $card['image']['alt'] ); ?>">
                            <?php endif; ?>
                        </div>
                        <?php if ( !empty($card['twitter_url']) ) : ?>
                        <div class="team-cards-card-social">
                            <a href="<?php echo esc_url( $card['twitter_url'] ); ?>" class="team-cards-card-social-link" target="_blank">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon-twitter"></use>
                                </svg>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="team-cards-card-content">
                            <?php if ( !empty($card['title']) ) : ?>
                                <h3 class="team-cards-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( !empty($card['text']) ) : ?>
                                <p class="team-cards-card-description"><?php echo esc_html( $card['text'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="team-cards-card-message">
                            <form action="" class="team-cards-card-form">
                                <input class="team-cards-card-form-input" type="email" placeholder="Say Hello 👋">
                                <button type="submit" class="team-cards-card-form-button">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon-send-white"></use>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>