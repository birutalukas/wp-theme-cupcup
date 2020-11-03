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

<section class="border">
    <div class="flex-container">
        <div class="content__two-thirds cta">
            <?php the_field('cta_text'); ?>
            <?php $cta_link = get_field('cta_link'); ?>
            <div class="btn--cta">
                <a href="<?= $cta_link['url']; ?>"><?= $cta_link['title']; ?></a>
            </div>
        </div>
        <div class="content__third cta__image">
            <?php $cta_image = get_field('cta_image'); ?>
            <img src="<?= $cta_image['url']; ?>" alt="">
        </div>
    </div>
</section>
<?php
    $tags = get_terms('miestai');
    $post_tags = wp_get_post_terms($post->ID,'miestai',array('fields' => 'slugs'));
?>
<div class="flex-container cities--main">
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

<section> <!-- Map Section Starts -->
    <div class="container">
        <iframe src="https://www.google.com/maps/d/embed?mid=1SP6OeXl__MlcfJNC8cxiSvXbcRyY0ukp&hl=lt" width="100%" height="480"></iframe>
    </div>
</section> <!-- Map Section Ends -->

<?php get_footer(); ?>