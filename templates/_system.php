<?php

/* Template Name: CupCup System */

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
    if(get_field('system_content_block')) {
        $i = 0;
        foreach(get_field('system_content_block') as $content_block) {
            $heading = $content_block['s_block_heading'];
            $text = $content_block['s_block_text'];
            $buttons = $content_block['s_block_buttons'];
            $image = $content_block['s_block_image'];
            $border = $content_block['image_border'];
            ?>
            <div class="flex-container system--content-block">
                <div class="content__half--left <?php if($i % 2 != 0 ) : echo 'reverse'; endif; ?>">
                    <?php
                    if (!empty($heading)) { ?>
                        <div class="content-block__heading">
                            <h2><?= $heading; ?></h2>
                        </div>
                    <?php
                    } if(!empty($text)) { ?>
                        <?= $text; ?>
                    <?php
                    } if(!empty($buttons)) {
                        $odd_or_even = 0;
                        foreach($buttons as $button) { ?>
                        <div class="content__btn-container">
                            <div class="btn__border <?php if($odd_or_even % 2 != 0) { echo 'btn__border--full'; } else { echo 'btn__border--transp'; }; ?>">
                                <a href="<?= $button['s_block_button']['url']; ?>" class="btn <?php if($odd_or_even % 2 != 0) { echo 'btn--white';} else { echo 'btn--green'; }; ?>"><?= $button['s_block_button']['title']; ?></a>
                            </div>
                        </div>
                        <?php
                        $odd_or_even++;
                        }
                    } ?>
                </div>
                <?php if(!empty($border)) { ?>
                    <div class="content__half--right <?php if($i % 2 != 0 ) : echo 'reversed'; endif; ?>">
                        <div class="border-container">
                            <img src="<?= $image['url']; ?>" class="image-border" alt="">
                        </div>
                    </div>
                </div>
                <?php
                } else { ?>
                    <div class="content__half--right <?php if($i % 2 != 0 ) : echo 'reversed'; endif; ?>">
                        <img src="<?= $image['url']; ?>" alt="">
                    </div>
                <?php
                } ?>
            </div>
        <?php
        $i++;
        }
    } ?>
</section>

<?php
get_footer();
?>