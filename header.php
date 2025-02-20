<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
    <div id="wrapper">
    <header class="site-header">
        <div class="container">

            <div class="site-header-conten">
                <div class="header-log-popup">
                    <div class="header-logo">
                        <?php 
                        $logo = get_field('main_logotype', 'option'); 
                        if ($logo): ?>
                            <img class="svg replaced-svg" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="header-popup">
                        <p><?php the_field('popup_handler_text', 'option'); ?></p>
                    </div>
                </div>
                
                <div class="header-language-dotan">
                    <div class="header-lang-switcher">
                        <a href="#">🌍 En • Ua</a>
                    </div>

                    <div class="header-buttons">
                        <?php 
                        $donate_button = get_field('donate_button', 'option'); 
                        if ($donate_button): ?>
                            <a href="#" class="donate-button" style="background: <?php echo esc_attr($donate_button['button_background']); ?>">
                               <span> <?php echo esc_html($donate_button['button_text']); ?> </span> 
                            </a>
                        <?php endif; ?>

                        <?php 
                            $email_icon = get_field('email_icon', 'option'); 
                            if ($email_icon): ?>
                            <div id="open-popup" class="email-icon">
                                <img class="svg replaced-svg" src="<?php echo esc_url($email_icon['url']); ?>" alt="Email Icon">
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
            
        </div>
    </header>

    <!-- Main -->
    <main>