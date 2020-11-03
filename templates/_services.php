<?php

/* Template Name: Services */

get_header();
get_template_part('partials/navbar'); 
?>

<section>
    <div class="container">
        <div class="section-heading">
            <h2><?php the_title(); ?></h2>
        </div>
    </div>
    <?php if(!empty(get_field('services_about'))) { ?>
        <div class="container--mini services__about">
            <?php the_field('services_about'); ?>
        </div>
    <?php
    } ?>
    <div class="flex-container">
        <?php 
        if(have_rows('services')):
            while(have_rows('services')):
                the_row();
                ?>
                <div class="services__block">
                    <?php $service_image = get_sub_field('background_image'); ?>
                    <div class="services__block--bg-img" style="background-image: url(<?= $service_image['url']; ?>);"></div>
                    <div class="services__block--bg-overlay"></div>
                    <div class="services__block--content">
                        <h3><?php the_sub_field('service_title'); ?></h3>
                        <div class="services__block--content--hidden">
                            <div class="service-text">
                                <?php the_sub_field('service_text'); ?>
                            </div>
                            <?php 
                            if(get_sub_field('service_links')) { ?>
                                <div class="flex">
                                    <?php
                                    $counter = 0;
                                    foreach(get_sub_field('service_links') as $service_link) { ?>
                                        <div class="btn__border btn__border--transp--white" style="<?php if($counter > 0) { echo 'margin-top: 16px;'; }; ?>">
                                            <a href="<?= $service_link['service_link']['url']; ?>" class="btn btn--white--full"><?= $service_link['service_link']['title']; ?></a>
                                        </div>
                                    <?php
                                    $counter++;
                                    } ?>
                                </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</section>

<?php
get_footer();
?>