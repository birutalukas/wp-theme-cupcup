<?php 

/* Template Name: Naujienos */

get_header();
get_template_part('partials/navbar');
?>
<section>
    <div class="container">
        <div class="section-heading">
            <h2>Paieškos rezultatai</h2>
        </div>
        <div class="search-container--tablet">
            <?php get_search_form(); ?>
        </div>
    </div>
    <div class="flex-container--small">
        <div class="content__two-thirds news__archive">
            <?php 
            $s=get_search_query();
            $args = array(
                's' => sanitize_text_field( get_search_query( false ) ),
                'post_type' => 'post'
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post(); ?>

                    <div class="news__item search-result">
                        <?php $post_image = get_field('header_photo');
                        if(!empty($post_image)) { ?>
                            <img src="<?= $post_image['url']; ?>" alt="">
                        <?php 
                        } ?>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>                
                        </a>
                        <h4><?= get_the_date('Y-m-d'); ?></h4>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="more">Skaityti toliau</a>
                    </div>
                <?php
                } 
            } else { ?>
                <div class="news__item search-result">
                    <h2>Atsiprašome, bet neradome jokių atitikmenų pagal Jūsų užklausą. Pabandykite dar kartą.</h2> 
                </div>
            <?php 
            } ?>
        </div>
        <div class="content__third news__aside">
            <?php get_search_form(); ?>
            <div class="subscribe">
                <h3 class="subscribe-heading">naujienlaiškio prenumerata</h3>
                <div>
                    <input type="email" name="subscribe" id="subscribe" placeholder="El. paštas" required>
                </div>
                <div class="btn__border--transp--green">
                    <button class="btn--subscribe--green">PRENUMERUOTI</button>
                </div> 
            </div>
            <div class="news--latest">
                <h2>Naujausi įrašai</h2>
                <?php 
                $args_latest = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 5,
                    'orderby' => 'publish_date',
                    'order' => 'DESC'
                );
                $latest = new WP_Query ( $args_latest );
                if($latest->have_posts()) :
                    while($latest->have_posts()) : $latest->the_post(); ?>
                        <div class="news__item--latest">
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <h4><?= get_the_date('Y-m-d'); ?></h4> 
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>