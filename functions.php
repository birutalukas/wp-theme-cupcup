<?php


// Įjungiame post thumbnail

add_theme_support( 'post-thumbnails' );

// Apsibrėžiame stiliaus failus ir skriptus

if( !defined('THEME_FOLDER') ) {
	define('THEME_FOLDER', get_bloginfo('template_url'));
}

function theme_scripts(){

    if ( !is_admin() ) {

    	//wp_register_script(handle, path, dependency, version, load_in_footer);

        //wp_deregister_script('jquery');
		//wp_register_script('jquery', THEME_FOLDER . '/assets/js/jquery-2.1.1.js', false, '2.1.1', true);

    	//Registration
        wp_register_script('fontawesome', 'https://kit.fontawesome.com/c22b7541a4.js', array('jquery'), '1.0', true);
        wp_register_script('owl_carousel', THEME_FOLDER . '/dist/vendor/owl.carousel.min.js', array('fontawesome'), '1.0', true);
        wp_register_script('js_main', THEME_FOLDER . '/dist/js/custom.js', array('owl_carousel'), '1.0', true);

        //Loading
        wp_enqueue_script('fontawesome');
        wp_enqueue_script('owl_carousel');
        wp_enqueue_script('js_main');
    }
}
add_action('wp_enqueue_scripts', 'theme_scripts');


function theme_stylesheets(){

	if( defined('THEME_FOLDER') ) {
		//wp_register_style(handle, path, dependency, version, devices);	

		//Registration
		wp_register_style('owl', THEME_FOLDER . '/dist/vendor/owl.carousel.min.css', array(), false, 'all');
		wp_register_style('owl_theme', THEME_FOLDER . '/dist/vendor/owl.theme.default.min.css', array('owl'), false, 'all');
		wp_register_style('main-css', THEME_FOLDER . '/dist/css/bundle.css', array('owl_theme'), false, 'all');

		//Loading
		wp_enqueue_style('owl');
		wp_enqueue_style('owl_theme');
		wp_enqueue_style('main-css');
	}
}
add_action('wp_enqueue_scripts', 'theme_stylesheets');

// Apibrėžiame navigacijas

function register_theme_menus() {
   
	register_nav_menus(array( 
        'primary-navigation' => __( 'Primary Navigation' ) 
    ));
}

add_action( 'init', 'register_theme_menus' );

// Apibrėžiame widgets juostas

#$sidebars = array( 'Footer Widgets', 'Blog Widgets' );

if( isset($sidebars) && !empty($sidebars) ) {

	foreach( $sidebars as $sidebar ) {

		if( empty($sidebar) ) continue;

		$id = sanitize_title($sidebar);

		register_sidebar(array(
			'name' => $sidebar,
			'id' => $id,
			'description' => $sidebar,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	}
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}

function search_form( $form ) {
	$form = '
	<div class="search-container">
		<form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >
			<input type="search" class="search" placeholder="'.__("Paieška").'" value="' . get_search_query() . '" name="s" id="s" />
			<button type="submit" id="searchsubmit" class="search-icon">
				<img src="' . get_template_directory_uri() . '/dist/images/icon-search.svg" alt="">
			</button>
		</form>
	</div>';
	return $form;
}
add_filter( 'get_search_form', 'search_form' );

add_image_size( 'coffee_logo', 125, 125, false);

// Comments

//change comment form fields order
add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );
function mo_comment_fields_custom_order( $fields ) {
	$comment_field = $fields['comment'];
	$author_field = $fields['author'];
	$email_field = $fields['email'];
	$url_field = $fields['url'];
	unset( $fields['comment'] );
	unset( $fields['author'] );
	unset( $fields['email'] );
	unset( $fields['url'] );
	// the order of fields is the order below, change it as needed:
	$fields['author'] = $author_field;
	$fields['email'] = $email_field;
	$fields['comment'] = $comment_field;
	// done ordering, now return the fields:
	return $fields;
}	

function my_update_comment_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
	$aria_req  = $req ? "aria-required='true'" : '';
	
	$fields['author'] =
		'<p class="comment-form-author">
			<input id="author" name="author" type="text" placeholder="' . esc_attr__( "Vardas *", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30" ' . $aria_req . ' />
		</p>';

	$fields['email'] =
		'<p class="comment-form-email">
			<input id="email" name="email" type="email" placeholder="' . esc_attr__( "El.paštas *", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'" size="30" ' . $aria_req . ' />
		</p>';

	return $fields;
}
add_filter( 'comment_form_default_fields', 'my_update_comment_fields' );


function my_update_comment_field( $comment_field ) {
	$comment_field =
	  '<p class="comment-form-comment">
			  <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Komentaras *", "text-domain" ) . '" rows="8" aria-required="true"></textarea>
		  </p>';
  
	return $comment_field;
}
add_filter( 'comment_form_field_comment', 'my_update_comment_field' );


function comment_form_hide_cookies( $fields ) {
	unset( $fields['cookies'] );
	return $fields;
}
add_filter( 'comment_form_default_fields', 'comment_form_hide_cookies' );


function add_comment_form_before( $defaults ) {
	$defaults['comment_notes_before'] = '';
	$defaults['label_submit'] = "paskelbti";
	return $defaults;
}
add_filter( 'comment_form_defaults', 'add_comment_form_before' );


function change_comment_form_title ($arg) {
	$arg['title_reply'] = __('palikti komentarą');
	return $arg;
}
add_filter('comment_form_defaults','change_comment_form_title');


function wpb_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', 'Atsakyti', $link );
	return $link;
}
add_filter( 'comment_reply_link', 'wpb_comment_reply_text' );


function pressfore_comment_time_output($date, $d, $comment){
	return sprintf( _x( 'Paskelbta prieš %s', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
}
add_filter('get_comment_date', 'pressfore_comment_time_output', 10, 3);

function login_logo() { 
	?> 
	<style type="text/css"> 
		body.login div#login h1 a {
			background-image: url('<?= get_template_directory_uri(); ?>/dist/images/logo.svg');
			transform: scale(2);
		} 
	</style>
	<?php 
}
add_action( 'login_enqueue_scripts', 'login_logo' );
	