<?php wp_footer(); ?>

<footer>
    <div class="flex-container footer-container">
        <div class="footer__item--left">
            <?php $logo_white = get_field('logo_white', 'option'); ?>
            <img src="<?= $logo_white['url']; ?>"  class="logo" alt="">
            <div class="mobile-contacts">
                <div class="footer__social-item">
                    <img src="<?= get_template_directory_uri(); ?>/dist/images/email.svg" class="style-svg" alt="">
                    <?php $email = get_field('email', 'option'); ?>
                    <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
                </div>
                <div class="footer__social-item">
                    <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" class="style-svg" alt="">
                    <?php $phone = get_field('phone', 'option'); ?>
                    <a href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                </div>
                <div class="footer__social-icons">
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
                </div>
            </div>
            <p>Copyright 2019 © CupCup</p>
        </div>
        <div class="footer__item--mid">
            <h3 class="footer-heading">naujienlaiškio prenumerata</h3>
            <div>
                <input type="email" name="subscribe" id="subscribe" placeholder="El. paštas" required>
            </div>
            <div class="btn__border--transp--white">
                <button class="btn--subscribe">PRENUMERUOTI</button>
            </div>            
        </div>
        <div class="footer__item--right">
            <h3 class="footer-heading">kontaktai</h3>
            <div class="footer__social-item">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/email.svg" class="style-svg" alt="">
                <?php $email = get_field('email', 'option'); ?>
                <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
            </div>
            <div class="footer__social-item">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" class="style-svg" alt="">
                <?php $phone = get_field('phone', 'option'); ?>
                <a href="tel:<?= $phone; ?>"><?= $phone; ?></a>
            </div>
            <div class="footer__social-icons">
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
            </div>
        </div>
    </div>
</footer>
    
</body>
</html>