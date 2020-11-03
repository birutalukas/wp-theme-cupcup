<?php

if(have_posts()):
	while(have_posts()):
		the_post();
		?>
		<!-- HTML BLOKAS -->
		<?php
	endwhile;
endif;

?>