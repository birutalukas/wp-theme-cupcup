<?php 

/* Template Name: Naujienos */

get_header();
get_template_part('partials/navbar');
?>
<section>
    <div class="container">
        <div class="section-heading">
            <h2><?php the_title(); ?></h2>
        </div>
        <div class="search-container--tablet">
            <?php get_search_form(); ?>
        </div>
    </div>
    <div class="flex-container--small">
        <div class="content__two-thirds news__archive">
            <?php 
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 6,
                'paged' => $paged
            );
            $posts = new WP_Query ( $args );
            if($posts->have_posts()) :
                while($posts->have_posts()) : $posts->the_post(); ?>
                    <div class="news__item">
                        <?php $post_image = get_field('header_photo'); ?>
                        <img src="<?= $post_image['url']; ?>" alt="">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>                
                        </a>
                        <h4><?= get_the_date('Y-m-d'); ?></h4>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="more">Skaityti toliau</a>
                    </div>
                <?php
                endwhile;
            endif;
            ?>
            <div class="pagination">
                <?php 
                    echo paginate_links( array(
                        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'total'        => $posts->max_num_pages,
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'format'       => '?paged=%#%',
                        'show_all'     => false,
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 1,
                        'prev_next'    => true,
                        'prev_text'    => sprintf( '<img src="' . get_template_directory_uri() . '/dist/images/icon-prev.svg"> %1$s', __( 'Ankstesnis', 'text-domain' ) ),
                        'next_text'    => sprintf( '%1$s <img src="' . get_template_directory_uri() . '/dist/images/icon-next.svg">', __( 'Kitas', 'text-domain' ) ),
                        'add_args'     => false,
                        'add_fragment' => '',
                    ) );
                ?>
            </div>
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