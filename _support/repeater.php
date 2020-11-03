<?php 
if(have_rows('repeater_name')):
    while(have_rows('repeater_name')):
        the_row();
        ?>
    <!-- HTML that has to be repeated -->
        <?php
    endwhile;
endif;
?>