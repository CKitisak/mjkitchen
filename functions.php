<?php 
	
	// Import bootstrap with jQuery
	function bootstrap_scripts() {
		// Register the script like this for a theme:
		wp_register_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'),'3.1.1',true );
		// For either a plugin or a theme, you can then enqueue the script:
		wp_enqueue_script('bootstrap');
	}
	add_action( 'wp_enqueue_scripts', 'bootstrap_scripts' );
	
	// Main Menu
	function register_my_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'footer-menu' => __( 'Footer Menu' )
			)
		);
	}
	add_action( 'init', 'register_my_menus' );
	
	// Remove menu wraper
	function my_wp_nav_menu_args( $args = '' ) {
		$args['container'] = false;
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
	
	// Dynamic Sidebar
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
	));
	
	add_theme_support( 'post-thumbnails' );
	
	// Searchform
	function my_search_form( $form ) {
	    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
	    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="ค้นหา" />
	    <button type="submit" id="searchsubmit" value="'. esc_attr__( '' ) .'" ><span class="glyphicon glyphicon-search"></span></button>
	    </div>
	    </form>';
	
	    return $form;
	}
	
	add_filter( 'get_search_form', 'my_search_form' );
	
/*
	// THIS LINKS THE THUMBNAIL TO THE POST PERMALINK
	add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
	
	function my_post_image_html( $html, $post_id, $post_image_id ) {
	
		$html = '<a class="image-post-link" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	
		return $html;
	}
*/
	
	// Make the "read more" link to the post
	function new_excerpt_more( $more ) {
		return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );

/*
	// Remove [...] string using Filters
	function new_excerpt_more( $more ) {
		return '[.....]';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
*/

	// Change excerpt length to 20 words	
	function custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	// my theme option by
	if ( file_exists( STYLESHEETPATH . '/class.my-theme-options.php' ) ) 
		include_once( STYLESHEETPATH . '/class.my-theme-options.php' );


		
?>