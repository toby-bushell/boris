<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_image_size( 'hero', 1500 );
		parent::__construct();
	}

	function register_post_types() {
    require('assets/lib/custom-types.php');
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		$context['twitter_widget'] = Timber::get_widgets('footer_twitter');
		$context['facebook_widget'] = Timber::get_widgets('footer_facebook');
		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();

// Enqueue scripts
function my_scripts() {

	// Use jQuery from a CDN
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), null, true);

	// Enqueue our stylesheet and JS file with a jQuery dependency.
	// Note that we aren't using WordPress' default style.css, and instead enqueueing the file of compiled Sass.
	wp_enqueue_style( 'my-styles', get_template_directory_uri() . '/assets/css/main.css', 1.0);
	wp_enqueue_script( 'scroll-reveal', get_template_directory_uri() . '/assets/js/vendor/scrollreveal.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'typed', get_template_directory_uri() . '/assets/js/vendor/typed.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'my-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'maps', get_template_directory_uri() . '/assets/js/vendor/maps.js', array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );


/**
 * Register our sidebars and widgetized areas.
 *
 */
function initiate_widgets() {

	register_sidebar( array(
		'name'          => 'Footer twitter',
		'id'            => 'footer_twitter',
		'before_widget' => '<div class="c-twitter">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="o-twitter-header">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => 'Footer facebook',
		'id'            => 'footer_facebook',
		'before_widget' => '<div class="c-twitter">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="o-twitter-header">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'initiate_widgets' );


function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyCYjFcrf7EY8vrMw4X5Qdy3QUAgKQsDHK8');
}

add_action('acf/init', 'my_acf_init');


// Options acf page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}
/* functions.php */
add_filter( 'timber_context', 'mytheme_timber_context'  );

function mytheme_timber_context( $context ) {
    $context['options'] = get_fields('option');
    return $context;
}
?>
