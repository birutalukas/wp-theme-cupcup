<?php

/* Template Name: Products */

get_header();
get_template_part('partials/navbar');
?>

<section>
    <div class="container">
        <div class="section-heading">
            <h2><?php the_title(); ?></h2>
        </div>
    </div>
    <?php 
    if(get_field('products')) {
        $odd_or_even = 0;
        foreach(get_field('products') as $product) { ?>
            <div class="flex product">
                <div class="product--left <?php if($odd_or_even % 2 != 0 ) : echo 'reverse'; endif; ?>">
                    <?php $product_photo = $product['product_photo']; ?>
                    <div class="product-photo">
                        <img src="<?= $product_photo['url']; ?>" alt="">
                    </div>
                </div>
                <div class="product--right <?php if($odd_or_even % 2 != 0 ) : echo 'reversed'; endif; ?>">
                    <div class="product__content">
                        <?= $product['product_description']; ?>
                        <div class="product__cta">
                            <div class="btn__border btn__border--full">
                                <a href="<?= $product['product_button']['link']; ?>" class="btn btn--white"><?= $product['product_button']['title']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $odd_or_even++;
        }
    } ?>
</section>
<?php
get_footer();
?>