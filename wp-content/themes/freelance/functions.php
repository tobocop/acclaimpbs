<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Homepage', 580, 275, TRUE);
add_image_size('Rectangle', 250, 160, TRUE);
add_image_size('Sidebar', 100, 80, TRUE);

// Add topnav section
add_action('genesis_before_header', 'freelance_include_topnav'); 
function freelance_include_topnav() {
    require(CHILD_DIR.'/topnav.php');
}

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'freelance_home_layout');
function freelance_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}  

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Top',
	'id' => 'home-top',
	'description' => 'This is the top section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom',
	'id' => 'home-bottom',
	'description' => 'This is the bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

/** Add Post image above post title, single posts only */
add_action( 'genesis_before_post_content', 'freelance_post_image' );
function freelance_post_image() {
	if ( is_category() ) return;
	if ( $image = genesis_get_image( 'format=url&size=post-image' ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="post-photo" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}
}

