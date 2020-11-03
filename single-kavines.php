<?php

/* Template Name: Maps */

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

<section class="coffee"> <!-- Local caffee Post Starts -->
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="flex-container">
                <div class="content__half--left">
                    <?php
                    if (have_rows('kontaktai')) :
                        while (have_rows('kontaktai')) :
                            the_row();
                            $caffee_logo = get_sub_field('logo'); 
                            if(!empty($caffee_logo)) { ?>
                                <div class="coffee-logo">
                                    <img src="<?= $caffee_logo['sizes']['coffee_logo']; ?>" alt="">
                                </div>
                            <?php
                            }
                            ?>                          
                            <h2 class="coffee-name"><?php the_title(); ?></h2>
                            <div class="coffee-content">
                                <?php the_content(); ?>
                            </div>
                            <div class="coffee-contact phone">
                                <p><?php the_sub_field('telefonas'); ?></p>
                            </div>
                            <div class="coffee-contact address">
                                <p><?php the_sub_field('adresas'); ?></p>
                            </div>
                            <div class="coffee-contact www">
                                <a href="<?php the_sub_field('www'); ?>" target="_blank"><?php the_sub_field('www'); ?></a>
                            </div>
                        </div>
                        <div class="content__half--right coffee-photo">
                            <?php $caffee_photo = get_sub_field('photo');
                            if(!empty($caffee_photo)) { ?> 
                                <div class="border-container">
                                    <img src="<?= $caffee_photo['url']; ?>" class="image-border" alt="">
                                </div>
                            <?php 
                            } ?>
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>  
            </div>
        <?php
        endwhile;
    endif;
    ?>

<section>
    <?php 
    if (get_field('walk_recommendations')) { ?>
        <div class="container">
            <div class="section-heading">
                <h2 class="distance">pasivaikščiojimų rekomendacijos</h2>
            </div>
        </div>
        <?php
        $i = 1;
        foreach(get_field('walk_recommendations') as $recomendation) { ?>
            <div class="flex-container--small distance-container">
                <div class="content__half distance-block start text">
                    <div class="distance-number">
                        <?= $i ?>
                    </div>
                    <h4>
                        <span><?= $recomendation['start_place']; ?></span>
                        <br>
                        <?= $recomendation['start_address']; ?>
                    </h4>
                </div>
                <div class="content__half distance-block finish text">
                    <h4>
                        <span><?= $recomendation['finish_place']; ?></span>
                        <br>
                        <?= $recomendation['finish_address']; ?>
                    </h4>
                </div>
                <div class="distance-line">
                    <div class="content__half distance-block location"></div>
                    <div class="distance-block">
                        <div class="duration">
                            <h4><?= $recomendation['duration']; ?></h4>
                            <h4><?= $recomendation['distance']; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $i++;
        }
    } ?>
</section>
</section> <!-- Local caffee Post Ends -->

<section class="border">
    <div class="flex-container cities"> <!-- Cities Selection Starts -->
        <?php
        $tags = get_terms('miestai');
        $post_tags = wp_get_post_terms($post->ID,'miestai',array('fields' => 'slugs'));
        ?>
        <p class="<?php foreach( $post_tags as $post_tag ): echo $post_tag.' '; endforeach; ?>">
            <?php 
            $number = 1;
            foreach( $tags as $tag ): ?>
                <div class="city" id="city-<?= $number; ?>">
                    <h3><?= $tag->name ?></h3>
                    <div class="city__list" id="city-list-<?= $number; ?>">
                        <div class="city__list__item">
                            <?php
                            $args = array(  
                                'post_type' => 'kavines',
                                'post_status' => 'publish',
                                'posts_per_page' => -1, 
                                'orderby' => 'title', 
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'miestai',
                                        'field' => 'slug',
                                        'terms' => $tag->name
                                    )
                                )
                            );

                            $loop = new WP_Query( $args ); 
                                
                            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php    
                            endwhile;

                            wp_reset_postdata(); 
                            ?>
                        </div>
                    </div>
                </div>
            <?php 
            $number++;
            endforeach; ?>        			
        </p>
    </div> 
</section><!-- Cities Selection Ends -->

<?php get_footer(); ?>