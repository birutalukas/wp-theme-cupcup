<?php

/* Template Name: Contact */ 

get_header();
get_template_part('partials/navbar');
?>
<section>
    <div class="container">
        <div class="section-heading">
            <h2><?php the_title(); ?></h2>
        </div>
    </div>
</section>

<div class="contact">
    <?php $contact_bg = get_field('contacts_background'); ?>
    <div class="content__half contact__bg" style="background-image: url(<?= $contact_bg['url']; ?>)"></div>
    <div class="content__half form-container">
        <div class="contact__social">
            <div class="contact__social__item">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/email.svg" class="style-svg" alt="">
                <?php $email = get_field('email', 'option'); ?>
                <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
            </div>
            <div class="contact__social__item">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" class="style-svg" alt="">
                <?php $phone = get_field('phone', 'option'); ?>
                <a href="tel:<?= $phone; ?>"><?= $phone; ?></a>
            </div>
            <div class="contact__social__item">
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
        <div class="form-content">
            <h2>susisiekite</h2>
            <div class="flex">
                <div class="form-content--left">
                    <?= do_shortcode('[contact-form-7 id="296" title="Contact Form Kontaktai"]'); ?>
                </div>
                <div class="form-content--right">
                    <div class="contact__social">
                        <div class="contact__social__item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/email.svg" class="style-svg" alt="">
                            <?php $email = get_field('email', 'option'); ?>
                            <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
                        </div>
                        <div class="contact__social__item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" class="style-svg" alt="">
                            <?php $phone = get_field('phone', 'option'); ?>
                            <a href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                        </div>
                        <div class="contact__social__item">
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
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>