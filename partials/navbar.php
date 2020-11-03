<div class="navbar">
    <div class="flex-container navbar__content">
        <div class="navbar__content--left">
            <?php $logo_black = get_field('logo_black', 'option');?>
            <a href="<?= home_url(); ?>">
                <img src="<?= $logo_black['url']; ?>" alt="">
            </a>
        </div>
        <!-- Primary Navigation -->
        <?php
        wp_nav_menu( array( 
            'theme_location' => 'primary-navigation',
            'container' => 'nav'
            ) ); 
        ?>
        <!-- Mobile Navigation Toggler -->
        <input type="checkbox" id="toggle">
        <div class="btn-map-mobile">
            <a href="<?php the_field('maps_link', 'option'); ?>">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/icon_map.svg" alt="">
            </a>
        </div>
        <label for="toggle">    
            <div class="hamburger">
                <div class="center"></div>
            </div>           
        </label>
        <!-- Mobile Navigation Window -->
        <div class="mobile-nav">
            <?php
            wp_nav_menu( array( 
                'theme_location' => 'primary-navigation',
                'container' => 'nav'
                ) ); 
            ?>
            <div class="nav-social">
                <?php 
                if(have_rows('social', 'option')):
                    while(have_rows('social', 'option')):
                        the_row();
                        ?>  
                        <a href="<?php the_sub_field('social_link'); ?>" target="blank">
                            <i class="<?php the_sub_field('social_icon'); ?>"></i>
                        </a>
                        <?php
                    endwhile;
                endif;
                ?>
                <?php $email = get_field('email', 'option'); ?>
                <a href="mailto:<?= $email; ?>">
                    <img src="<?= get_template_directory_uri(); ?>/dist/images/email.svg" class="style-svg" alt="">
                </a>
            </div>
        </div>
    </div>
</div>