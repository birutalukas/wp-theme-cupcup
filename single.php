<?php 

/* Template Name: Naujienos */

get_header();
get_template_part('partials/navbar');
?>
<section>
    <?php 
    if(have_posts()) :
        while(have_posts()) : the_post(); ?>
            <?php $post_image = get_field('header_photo'); ?>
            <div class="blog-hero" style="background-image: url(<?= $post_image['url']; ?>)";></div>
            <div class="flex-container--small">
                <?php $prev_post = get_previous_post_link( '%link', 'Ankstesnis', true );
                if ($prev_post != null) { ?>
                    <div class="post-prev">
                        <img src="<?= get_template_directory_uri(); ?>/dist/images/icon-prev.svg" alt="">
                        <?= $prev_post; ?>
                    </div>
                <?php
                } ?>
                <?php 
                $next_post = get_next_post_link( '%link', 'Kitas', true );
                if ($next_post != null) { ?>
                    <div class="post-next">
                        <?= $next_post; ?>
                        <img src="<?= get_template_directory_uri(); ?>/dist/images/icon-next.svg" alt="">
                    </div>
                <?php } ?>
            </div>
            <div class="flex-container--small">
                <div class="content__two-thirds news__archive">
                    <div class="news__item single">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>                
                        </a>
                        <h4><?= get_the_date('Y-m-d'); ?></h4>
                        <?php the_content(); ?>
                    </div>
                    <div class="social-share">
                        <?php $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" title="Share on Facebook">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/icon-share.svg" alt="">
                            Pasidalinti
                        </a>
                    </div>
                    <?php 
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </div>
            <?php
        endwhile;
    endif;
    ?>
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
                            <h4><?= get_the_date(); ?></h4> 
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="other">KITI STRAIPSNIAI</h2>
    </div>
    <div class="flex-container between">
        <?php
        $args_more = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'orderby' => 'rand'
        );
        $more_posts = new WP_Query ( $args_more );
        if($more_posts->have_posts()) :
            while($more_posts->have_posts()) : $more_posts->the_post(); ?>
                    <div class="news__item--more">
                        <?php $post_cover = get_field('header_photo'); ?>
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?= $post_cover['url']; ?>" alt="">
                        </a>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?= the_title(); ?></h2>
                        </a>
                        <h3><?= get_the_date('Y-m-d'); ?></h3>
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