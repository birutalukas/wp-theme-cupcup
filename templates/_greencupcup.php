<?php

/* Template Name: Green CupCup */

get_header();
get_template_part('partials/navbar');
?>

<section>
    <div class="container">
        <div class="section-heading">
            <h2><span>green </span> CupCup</h2>
        </div>
    </div>
    <div class="flex-container--small content-block__item">
        <div class="content__half--left green-cupcup">
            <?php $green_image = get_field('green_image_left'); ?>
            <img src="<?= $green_image['url']; ?>" alt="">
        </div>
        <div class="content__half--right green-cupcup">
            <?php $green_heading = get_field('green_heading'); 
            if(!empty($green_heading)) {?>
                <h2><?= $green_heading; ?></h2>
            <?php
            }
            $green_text = get_field('green_text'); 
            if(!empty($green_text)) {
                echo $green_text;
            }
            $green_button = get_field('green_button');
            if(!empty($green_button)) { ?>
                <div class="btn__border btn__border--transp--black">
                    <a href="<?= $green_button['url']; ?>" class="btn btn--black"><?= $green_button['title']; ?></a>
                </div>
            <?php
            } ?>

        </div>
    </div>
</section>

<section class="bg--black"> <!-- Black Background Content Starts -->
    <div class="flex-container--small">
        <?php $black_section_heading = get_field('black_heading'); ?>
        <h3><?= $black_section_heading; ?> </h3> 
        <div class="content__half--left black-section__content--left">
            <?php
            if(get_field('how_to_list')) {
                $point_counter = 1;
                foreach(get_field('how_to_list') as $list_item) { ?>
                <p><span class="bullet"><?= $point_counter; ?></span><?= $list_item['how_to_list']; ?></p>
                <?php
                $point_counter++;
                }
            } ?>
        </div>
        <div class="content__half--right black-section__content--right">
            <?php $black_image = get_field('black_image'); ?>
            <img src="<?= $black_image['url']; ?>" alt="">
        </div>
    </div>
</section> <!-- Black Background Content Ends -->

<section> <!-- Why Us Starts -->
<div class="container">
    <div class="section-heading--min">
        <h2><?php the_field('why_us_heading'); ?></h2>
    </div>
</div>
    <div class="flex-container why-us">
        <?php 
        if(have_rows('why_us')):
            while(have_rows('why_us')):
                the_row();
                ?>
                    <div class="why-us__box">
                        <?php $icon = get_sub_field('icon'); ?>
                        <img src="<?= $icon['url']; ?>" alt="">
                        <h3><?php the_sub_field('title'); ?></h3>
                        <p><?php the_sub_field('text'); ?></p>
                    </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</section> <!-- Why Us Ends -->

<?php
get_footer();
?>