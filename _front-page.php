<?php

/* Template Name: Home Page */

get_header();
get_template_part('partials/navbar');
?>

<div class="owl-carousel owl-theme hero-slider"> <!-- Slider Starts -->
    <?php 
    if(have_rows('hero_slider')):
        while(have_rows('hero_slider')):
            the_row();
            ?>
                <div class="hero-slide">
                    <div class="hero-slide__content--left">
                        <h2 class="heading"><?php the_sub_field('heading'); ?></h2>
                        <h3 class="subheading"><?php the_sub_field('sub_heading'); ?></h3>
                        <p class="text"><?php the_sub_field('text'); ?></p>
                        <div class="content__btn-container">
                            <div class="btn__border btn__border--transp">
                                <?php $hero_button = get_sub_field('button'); ?>
                                <a href="<?= $hero_button['link']; ?>" class="btn btn--green"><?= $hero_button['title']; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php $hero_background = get_sub_field('background'); ?>
                    <div class="hero-slide__content--right" <?php if (!empty($hero_background)) : ?> style="background-image: url('<?= $hero_background['url']; ?>');" <?php endif; ?>>
                        <?php $hero_image = get_sub_field('image');
                        if (!empty($hero_image)) : ?>
                            <img src="<?= $hero_image['url']; ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            <?php
        endwhile;
    endif;
    ?>
</div> <!-- Slider Ends -->

<div class="content-block"> <!-- Content Block Starts -->
    <?php
    if(get_field('content_block')) {
        $i = 0;
        foreach(get_field('content_block') as $block) {
        ?>
            <div class="flex-container content-block__item">
                <div class="content__half--left <?php if($i % 2 != 0 ) : echo 'reverse'; endif; ?>">
                    <?php 
                    if(!empty($block['border'])) { ?>
                        <div class="border-container">
                            <img src="<?= $block['image']['sizes']['large']; ?>" class="image-border" alt="">
                        </div>
                    <?php 
                    } else { ?>
                        <img src="<?= $block['image']['sizes']['large']; ?>" alt="">
                    <?php
                    } ?>
                </div>
                <div class="content__half--right <?php if($i % 2 != 0 ) : echo 'reversed'; endif; ?>">
                    <?php
                    if(!empty($block['heading'])) { ?>
                        <div class="content-heading">
                            <h2><?= $block['heading']; ?></h2>
                        </div>
                    <?php
                    } 
                    if(!empty($block['text'])) { 
                        echo $block['text'];
                    }
                    $block_btn = $block['buttons']['0']['button'];
                    if(!empty($block_btn)) { ?>
                        <div class="content__btn-container">
                            <div class="btn__border btn__border--full">
                                <a href="<?= $block_btn['link']; ?>" class="btn btn--white"><?= $block_btn['title']; ?></a>
                            </div>
                            <?php
                            $block_btn_scnd = $block['buttons']['1']['button'];
                            if(!empty($block_btn_scnd)) { ?>
                                    <div class="btn__border btn__border--full">
                                        <a href="<?= $block_btn_scnd['link']; ?>" class="btn btn--white"><?= $block_btn_scnd['title']; ?></a>
                                    </div>  
                            <?php 
                            }
                            ?>
                        </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        <?php
        $i++;
        }
    } ?>
</div> <!-- Content Block Ends -->

<section> <!-- Problems Starts -->
    <div class="container">
        <div class="section-heading">
            <h2>sprendžiamos problemos</h2>
        </div>
    </div>
    <?php 
    if(have_rows('problems')):
        while(have_rows('problems')):
            the_row();
            ?>
            <div class="problems__item">
                <div class="flex-container">
                    <div class="content__half problems__item--left">
                        <div>
                            <?php $icon = get_sub_field('icon');
                            if (!empty($icon)) { ?>
                                <img src="<?= $icon['url']; ?>" alt="">
                            <?php
                            }
                            ?>
                            <h3><?php the_sub_field('heading'); ?></h3>
                            <p><?php the_sub_field('text'); ?></p>
                        </div>
                    </div>
                    <div class="content__half problems__item--right">
                        <?php $border = get_sub_field('border'); ?>
                        <?php $problems_image = get_sub_field('image'); ?>
                        <?php if ($border === true) { ?>
                        <div class="border-container">
                            <img src="<?= $problems_image['url']; ?>" class="image-border" alt="">
                        </div>
                        <?php } else { ?>
                            <img src="<?= $problems_image['url']; ?>" alt="">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    endif;
    ?>
</section> <!-- Problems Ends -->

<section> <!-- Testimonials Starts-->
    <div class="container">
        <div class="section-heading">
            <h2>atsiliepimai</h2>
        </div>
    </div>
    <div class="flex-container">
        <div class="content__half testimonials">
            <?php 
            if(have_rows('testimonials')):
                while(have_rows('testimonials')):
                    the_row();
                    ?>
                        <?php $author_photo = get_sub_field('photo');
                        if (!empty($author_photo)) { ?>
                            <div class="testimonials__gallery--item author-photo">
                                <div>
                                    <img class="image-border" src="<?= $author_photo['url']; ?>" alt="">
                                </div>
                            </div>
                        <?php
                        } ?>

                        <div class="testimonials__item">
                            <div class="testimonials__item--text">
                                <p>
                                    <?php the_sub_field('text'); ?>
                                </p>
                            </div>
                            <div class="testimonials__item--author">
                                <p>
                                    <?php the_sub_field('author'); ?>
                                </p>
                            </div>
                        </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
        <div class="content__half">
            <div class="testimonials__gallery--container">
                <?php if(get_field('testimonials_gallery')) {
                    $count = 0;
                    foreach(get_field('testimonials_gallery') as $testimonial_photo) { ?>
                        <div class="testimonials__gallery--item">
                            <img class="image-border" src="<?= $testimonial_photo['photo']['url']; ?>" alt="">
                        </div>
                    <?php 
                    $count++;
                    }
                } ?>
            </div>
        </div>
    </div>
</section> <!-- Testimonials Ends -->

<!-- Section fix for TranslateY deformation -->
<section style="margin-top:<?= '-' . $count * 10 + 285 . 'px'?>" class="testimonials-margin-desktop"></section>
<section style="margin-top:<?= '-' . $count * 75 + 285 . 'px'?>" class="testimonials-margin-desktop--sm"></section>
<section style="margin-top:<?= '-' . $count * 25 + 285 . 'px'?>" class="testimonials-margin-tablet"></section>

<section> <!-- Partners Starts -->
    <div class="container">
        <div class="section-heading">
            <h2>partneriai</h2>
        </div>
        <div class="owl-carousel owl-theme partners-slider"> <!-- Partners Slider Starts -->
            <?php 
            if(have_rows('partners')):
                while(have_rows('partners')):
                    the_row();
                        $partner_img = get_sub_field('image');
                        $partner_link = get_sub_field('link');
                        if (!empty($partner_link)) { ?>
                            <div class="partners-slider__item">
                                <a href="<?= $partner_link; ?>">
                                    <img src="<?= $partner_img['url']; ?>" alt="">
                                </a>
                            </div>
                        <?php 
                        } else { ?>
                            <div class="partners-slider__item">
                                <img src="<?= $partner_img['url']; ?>" alt="">
                            </div>
                        <?php 
                        } ?>
                    <?php
                endwhile;
            endif;
            ?>
        </div> <!-- Partners Slider Ends -->
    </div>
</section> <!-- Partners Ends -->

<?php get_footer(); ?>