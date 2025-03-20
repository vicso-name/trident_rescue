<?php
/**
 * Template Name: Thank You Page
 */
get_header(); 

$social_media = get_field('social_media');

?>

<div class="thank-you-container">

    <div class="container">

        <?php 
        $thank_you_title = get_field('thank_you_title');
        if ($thank_you_title) : ?>
            <h1 class="thankyou-title"><?php echo $thank_you_title; ?></h1>
        <?php endif; ?>
            <div class="thankyou-description__wrapper">
                <?php 
                    $thank_you_message = get_field('thank_you_message');
                    if ($thank_you_message) : 
                ?>
                    <p class="thankyou-description"><?php echo $thank_you_message; ?></p>
                <?php endif; ?>
                <?php 
                    $link = get_field('return_button');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                        <a class="return_button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <span><?php echo esc_html( $link_title ); ?></span>
                        </a>
                <?php endif; ?>
                <div class="follow-us">
                    <h4 class="follow-us__title">Follow us:</h4>
                    <?php if($social_media): ?>
                        <ul class="follow-us-list">
                            <?php
                                foreach($social_media as $social): 
                                $link = $social['social_link'];
                                $icon = $social['icon'];
                            ?>
                                <li class="follow-us-list__item">
                                    <?php if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                        <a class="follow-us-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" class="follow-us-icon">
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            
    </div>
    <?php 
            $thanks_image = get_field('thanks_image');
            if($thanks_image):
    ?>
        <div class="thanks_image-wrapper">
            <img class="thanks_image" src="<?php echo $thanks_image['url'] ?>" alt="<?php echo $thanks_image['alt'] ?>">
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
