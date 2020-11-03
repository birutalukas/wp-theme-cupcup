<?php

// Uzklasos parametrai
$sql = [
	'parametras_1' => 'reiksme 1',
	'parametras_2' => 'reiksme 2'
];

// Uzklausos vykdymas ir rezultato saugojimas
$result = new WP_Query($sql);

// Gautu duomenu isvedimas
if($result->have_posts()):
	while($result->have_posts()):
		$result->the_post();
		?>
		<!-- HTML BLOKAS -->
		<?php
	endwhile;
endif;

// Atstatome pradine puslapio uzklausa
wp_reset_postdata();

?>