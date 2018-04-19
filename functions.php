<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes.php';
//require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
require_once get_template_directory() . '/core/classes/class-post-type.php';
require_once get_template_directory() . '/core/classes/class-taxonomy.php';
require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
//require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);


		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Odin 2.2.10
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 255,
			'flex-height' => true,
		) );


	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Html5Shiv
	wp_enqueue_script( 'html5shiv', $template_url . '/assets/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Swipe Library
	wp_enqueue_style( 'swipe', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css' );
	wp_enqueue_script( 'swipe', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js' );
	wp_enqueue_script( 'swipe', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.jquery.min.js' );

	wp_enqueue_script( 'validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js', 'jquery', '', true );
	wp_enqueue_script( 'mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js', 'jquery', '', true );

	// Games Assets
	if ( is_singular( 'jogo' ) ) {
		wp_enqueue_script( 'tarot-asset', $template_url . '/assets/js/tarot-amor.js', array(), null, true );
	}
	if ( is_page( 'oraculos-gratis' ) ) {
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, 'all' );
	}

	// Animate CSS
	// wp_enqueue_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', '', '', 'all' );


	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Games Assets
	if ( is_singular( 'jogo' ) ) {
		wp_enqueue_script( 'tarot-asset', $template_url . '/assets/js/tarot-amor.js', array(), null, true );

		wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, 'all' );
		wp_enqueue_style( 'starrr-css', $template_url . '/assets/css/libs/starrr.css', array(), null, 'all' );
		wp_enqueue_script( 'starrr-js',  $template_url . '/assets/js/libs/starrr.js', array(), null, true );

		wp_enqueue_script( 'combinacao-dos-signos-js', $template_url . '/assets/js/compatibility.js', 'jquery', '', true );
	}

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';


function add_custom_sizes() {
    add_image_size( 'post-thumbs', 142, 80, true );
    add_image_size( 'post-image', 1074, 725, true );
}
add_action('after_setup_theme','add_custom_sizes');

/* Ajax search */
function astro_search_scripts() {
    wp_enqueue_script('jquery');
    $ajaxurl = admin_url('admin-ajax.php');
    wp_localize_script( 'jquery', 'ajaxVars', array( 'ajaxurl' => $ajaxurl ) );
}
add_action('wp_enqueue_scripts', 'astro_search_scripts');


add_action('wp_ajax_astro_search', 'astro_search');
add_action('wp_ajax_nopriv_astro_search', 'astro_search');
function astro_search(){

/* creating a search query */
	$search_term = $_POST['navbar_search'];
	$args = array(
		'post_type' => 'any',
		'post_status' => 'publish',
		'order' => 'DESC',
		'orderby' => 'date',
		's' => $search_term,
		'posts_per_page' =>5
	);

	$query = new WP_Query( $args );

// display results
	if( $query->have_posts() && !empty($search_term) ){ ?>
		<ul class="post-list">
		<?php while ($query->have_posts()) {
			$query->the_post();
			?>
			<li class="post-list-item">
				<a class="post-link d-flex" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbs'); ?><?php endif; ?>
					<h3 class="post-title"><?php the_title(); ?>
						<span class="post-date"><?php the_date('d/m/Y'); ?></span>
					</h3>
				</a>
			</li>
			<?php
		} ?>
		</ul>
		<?php
	}else{

		?>
		<h4>Desculpe, mas não conseguimos achar o que você procura :(</h4>
		<h5>Que tal dar uma olhada em nossos últimos artigos? :)</h5>
		<ul class="post-list">
		<?php
			$query_noresult = new WP_Query( 'posts_per_page=3' );
			while ($query_noresult -> have_posts()) : $query_noresult -> the_post();
		?>
			<li class="post-list-item">
				<a class="post-link d-flex" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail('post-thumbs'); ?><?php endif; ?>
					<h3 class="post-title"><?php the_title(); ?>
						<span class="post-date"><?php the_date('d/m/Y'); ?></span>
					</h3>
				</a>
			</li>
		<?php
			endwhile;
			wp_reset_postdata();
		?>
		</ul>
		<?php
	}
	exit;
}

add_filter('widget_text','do_shortcode');

/* Async load */
function astrocentro_async_scripts($url){
	if ( strpos( $url, '#asyncload') === false )
		return $url;
	else if ( is_admin() )
		return str_replace( '#asyncload', '', $url );
	else
		return str_replace( '#asyncload', '', $url )."' async='async";
}
add_filter( 'clean_url', 'astrocentro_async_scripts', 11, 1 );


/* Add href to Main menu first depth */
add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args, $depth = 0 ) {
	$categories = array('Tarot', 'Vidência', 'Astrologia', 'Bem-estar', 'Numerologia', 'Oráculos');

	foreach($categories as $item) {
		if( $atts['title'] == $item ){
			$atts['href'] = get_category_link( get_cat_ID( $item ) );
		}
	}

    return $atts;
}, 10, 4 );


/* Pushs notifications */
function add_one_signal() {
    ?>
        <link rel="manifest" href="/blog/manifest.json">
		<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
		<script src="<?php echo ( get_template_directory_uri().'/assets/js/pwa.js' ) ?>"></script>
    <?php
}
add_action('wp_head', 'add_one_signal');

/* Add CTAs to posts */
function insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {
		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}
		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	return implode( '', $paragraphs );
}
//Insert after first paragraph
function insert_post_ads( $content ) {

	$current_post = get_the_ID();
	$meta = get_post_meta($current_post);
	$current_taxo_tracker = $meta["tracker_"][0];
	$taxo_tracker = get_term_by( 'id', $current_taxo_tracker, 'tracker' );
	$tracker_id = preg_replace("/[^0-9]/","",$taxo_tracker->slug);

	$ctas = get_posts(array(
	    'showposts' => -1,
	    'post_type' => 'cta',
	    'order' => 'ASC',
	    'tax_query' => array(
	        array(
		        'taxonomy' => 'tracker',
		        'field' => 'term_id',
		        'terms' => $current_taxo_tracker
			)
	    ))
	);

	foreach ($ctas as $cta) {
		$img_desk_1 = wp_get_attachment_image_src( $cta->imagem_desktop_1, 'full' );
		$img_desk_2 = wp_get_attachment_image_src( $cta->imagem_desktop_2, 'full' );

		$img_mobile_1 = wp_get_attachment_image_src( $cta->imagem_mobile_1, 'full' );
		$img_mobile_2 = wp_get_attachment_image_src( $cta->imagem_mobile_2, 'full' );

		$url_desk_1 = $cta->link_desktop_1;
		$url_desk_2 = $cta->link_desktop_2;
		$url_mobile_1 = $cta->link_mobile_1;
		$url_mobile_2 = $cta->link_mobile_2;

		$ad_cta_1 = '
			<div class="cta-desktop">
				<a href="'. $url_desk_1 .'&tracker_id=v2_'. $tracker_id .'">
					<img src="'. $img_desk_1[0] .'" />
				</a>
			</div>
			<div class="cta-mobile">
				<a href="'. $url_mobile_1 .'&tracker_id=v2_'. $tracker_id .'">
					<img src="'. $img_mobile_1[0] .'" />
				</a>
			</div>
		';
		$ad_cta_2 = '
			<div class="cta-desktop">
				<a href="'. $url_desk_2 .'&tracker_id=v2_'. $tracker_id .'">
					<img src="'. $img_desk_2[0] .'" />
				</a>
			</div>
			<div class="cta-mobile">
				<a href="'. $url_mobile_2 .'">
					<img src="'. $img_mobile_2[0] .'" />
				</a>
			</div>
		';
	}
	if ( is_single() && ! is_admin() ) {
		$content .= $ad_cta_2;
		return insert_after_paragraph( $ad_cta_1, 1, $content );
	}

	// $term = get_term_by('slug', 'tracker', 'category');
	// $id = $term->term_id;

	return $content;
}
add_filter( 'the_content', 'insert_post_ads' );


/* Remove wp_emoji */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/* Add Taboola */
function add_taboola_to_header(){
    ?>
		<script type="text/javascript">
		  window._taboola = window._taboola || [];
		  _taboola.push({article:'auto'});
		  !function (e, f, u, i) {
		    if (!document.getElementById(i)){
		      e.async = 1;
		      e.src = u;
		      e.id = i;
		      f.parentNode.insertBefore(e, f);
		    }
		  }(document.createElement('script'),
		  document.getElementsByTagName('script')[0],
		  '//cdn.taboola.com/libtrc/astrocentro/loader.js',
		  'tb_loader_script');
		</script>
    <?php
}
add_action('wp_head', 'add_taboola_to_header');

function add_taboola_to_bottom() {
    ?>
		<script type="text/javascript">
		  window._taboola = window._taboola || [];
		  _taboola.push({flush: true});
		</script>
	<?php
}
add_action( 'wp_footer', 'add_taboola_to_bottom' );

/* Loading bar */
function loading_bar() {
    ?>
		<script type="text/javascript">
			paceOptions = {
				elements: false,
				ajax: false,
				restartOnRequestAfter: false
			}
		</script>
	<?php
}
add_action( 'wp_footer', 'add_taboola_to_bottom' );

/* Add PWA meta */
function add_meta_pwa_to_header(){
    ?>
	<link rel="apple-touch-icon" href="/blog/wp-content/themes/odin/assets/images/touch/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/blog/wp-content/themes/odin/assets/images/touch/apple-touch-icon-bg.png">
	<link rel="apple-touch-icon" sizes="128x128" href="/blog/wp-content/themes/odin/assets/images/touch/icon-128x128-bg.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/blog/wp-content/themes/odin/assets/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/blog/wp-content/themes/odin/assets/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/blog/wp-content/themes/odin/assets/images/favicon-16x16.png">
	<meta name="apple-mobile-web-app-title" content="Astrocentro Blog">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="#f9efee">
	<meta name="theme-color" content="#f9efee">
    <?php
}
add_action('wp_head', 'add_meta_pwa_to_header');

/* Add fix to standalone browser */
function add_fixbug_standalone_browser(){
	?>
	<!-- Add fix to standalone browser -->
	<script type="text/javascript" charset="utf-8">
		(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(chref=d.href).replace(e.href,"").indexOf("#")&&(!/^[a-z\+\.\-]+:/i.test(chref)||chref.indexOf(e.protocol+"//"+e.host)===0)&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone");
	</script>
    <?php
}
add_action('wp_head', 'add_fixbug_standalone_browser');

/* Tracking */
include "tracking.php";


/* Games type */
function astro_games_cpt() {
    $game = new Odin_Post_Type(
        'Jogo',
        'jogo'
    );

    $game->set_labels(
        array(
            'menu_name' => __( 'Jogos', 'odin' )
        )
    );

    $game->set_arguments(
        array(
            'supports' => array( 'title', 'editor', 'thumbnail' ),
			'capability_type' => 'page',
			'menu_icon' => 'dashicons-smiley'
        )
    );
}
add_action( 'init', 'astro_games_cpt', 1 );

/* Subcategory :: Bugfix */
function getPostsInCategory($category) {
    return get_posts(array(
        'post_status'   => 'publish',
        'category'      => $category,
        'posts_per_page'   => -1
    ));
}

function redirect_subcategory_posts() {
	if (is_category('8') ) {
		getPostsInCategory(8);
   }
}
add_action( 'template_redirect', 'redirect_subcategory_posts' );

/* Remove all existing pingback */
function remove_xmlrpc_pingback_ping( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
}
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );

/* Create Tracker category */
function astro_tracker_taxonomy() {
    $tracker_id = new Odin_Taxonomy(
        'Tracker', // Nome (Singular) da nova Taxonomia.
        'tracker', // Slug do Taxonomia.
        'cta' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
    );

    $tracker_id->set_labels(
        array(
            'menu_name' => __( 'Tracker / Subcategoria', 'odin' )
        )
    );

    $tracker_id->set_arguments(
        array(
            'hierarchical' => false
        )
    );
}
add_action( 'init', 'astro_tracker_taxonomy', 1 );

/* Create CTA content type */
function astro_cta() {
    $cta = new Odin_Post_Type(
        'CTA', // Nome (Singular) do Post Type.
        'cta' // Slug do Post Type.
    );

    $cta->set_labels(
        array(
            'menu_name' => __( 'CTAs', 'odin' )
        )
    );

    $cta->set_arguments(
        array(
			// 'supports' => array( 'title', 'custom-fields' ),
			'supports' => array( 'title' ),
			'menu_icon' => 'dashicons-carrot'
        )
    );
}
add_action( 'init', 'astro_cta', 1 );

/* Add Desktop custom fields to CTA content type */
function astro_cta_desktop_metabox() {
	$cta_desktop = new Odin_Metabox(
	    'cta_desktop', // Slug/ID of the Metabox (Required)
	    'Desktop', // Metabox name (Required)
	    'cta', // Slug of Post Type (Optional)
	    'advanced', // Context (options: normal, advanced, or side) (Optional)
	    'high' // Priority (options: high, core, default or low) (Optional)
	);

	$cta_desktop->set_fields(
        array(

			// Image Desktop 1
            array(
                'id'          => 'imagem_desktop_1',
                'label'       => __( 'Imagem desktop 1', 'odin' ),
                'type'        => 'image',
            ),
			// Link Desktop 1
            array(
                'id'          => 'link_desktop_1',
                'label'       => __( 'Link desktop 1', 'odin' ),
                'type'        => 'text',
				'attributes'  => array(
			        'placeholder' => __( '' )
			    ),
            ),
			// Separator.
            array(
                'id'   => 'separator1',
                'type' => 'separator'
            ),
			// Image Desktop 2
			array(
                'id'          => 'imagem_desktop_2',
                'label'       => __( 'Imagem 2', 'odin' ),
                'type'        => 'image',
            ),
			// Link Desktop 2
            array(
                'id'          => 'link_desktop_2',
                'label'       => __( 'Link desktop 2', 'odin' ),
                'type'        => 'text',
				'attributes'  => array(
			        'placeholder' => __( '' )
			    ),
            ),
        )
    );
}
add_action( 'init', 'astro_cta_desktop_metabox', 1 );

/* Add Mobile custom fields to CTA content type */
function astro_cta_mobile_metabox() {
	$cta_mobile = new Odin_Metabox(
	    'cta_mobile',
	    'Mobile',
	    'cta',
	    'advanced',
	    'high'
	);

	$cta_mobile->set_fields(
        array(

			// Image Desktop 1
            array(
                'id'          => 'imagem_mobile_1',
                'label'       => __( 'Imagem mobile 1', 'odin' ),
                'type'        => 'image',
            ),
			// Link Desktop 1
            array(
                'id'          => 'link_mobile_1',
                'label'       => __( 'Link mobile 1', 'odin' ),
                'type'        => 'text',
				'attributes'  => array(
			        'placeholder' => __( '' )
			    ),
            ),
			// Separator.
            array(
                'id'   => 'separator1',
                'type' => 'separator'
            ),
			// Image Desktop 2
			array(
                'id'          => 'imagem_mobile_2',
                'label'       => __( 'Imagem 2', 'odin' ),
                'type'        => 'image',
            ),
			// Link Desktop 2
            array(
                'id'          => 'link_mobile_2',
                'label'       => __( 'Link mobile 2', 'odin' ),
                'type'        => 'text',
				'attributes'  => array(
			        'placeholder' => __( '' )
			    ),
            ),
        )
    );
}
add_action( 'init', 'astro_cta_mobile_metabox', 1 );

/* Add Google Verification */
function google_site_verification(){
	if ( is_home() ) {
		?>
		<meta name="google-site-verification" content="UEhWRmRrTUQqDnwbZ3OljpBoobN9qcqAnEaAsci9WR4" />
	    <?php
	}
}
add_action('wp_head', 'google_site_verification');

/* Estrelafone */
add_action('wp_ajax_estrelafone_api', 'estrelafone_api');
add_action('wp_ajax_nopriv_estrelafone_api', 'estrelafone_api');
function estrelafone_api(){

    $_POST = array_map('stripslashes_deep', $_POST);

	$name = $_POST['name'];
	$name = str_replace(' ', '-', $name);

	$phonenumber = $_POST['phonenumber'];
	$phonenumber = str_replace(' ', '', $phonenumber);
	$phonenumber = str_replace('(', '', $phonenumber);
	$phonenumber = str_replace(')', '', $phonenumber);
	$phonenumber = str_replace('-', '', $phonenumber);

	$from = "";
	if (isset($_POST['from'])) {
		$from = $_POST['from'];
	}

	$json = array(
		'civilite'			=> '',
		'nom'				=> '',
		'prenom' 			=> $name,
		'emailAddress'		=> '',
		'dob'				=> '',
		'origin'			=> 'VidentesOnline',
		'ipAddress'			=> $_SERVER['REMOTE_ADDR'],
		'telephoneNumber'	=> '55'.$phonenumber,
		'conversation'		=> '1',
		'c'					=> '230',
		's'					=> 'ca_astra_br',
		'countryCode'		=> 'BR',
		'telCountry'		=> 'BR'
	);

	$data = "civilite=".$json['civilite'] .	"&emailAddress=".$json['emailAddress'] . "&nom=".$json['nom'] .	"&prenom=".$json['prenom'] . "&dob=".$json['dob'] . "&ipAddress=".$json['ipAddress'] . "&telephoneNumber=".$json['telephoneNumber'] . "&origin=".$json['origin'] . "&c=".$json['c'] . "&s=".$json['s'] . "&conversation=".$json['conversation'] . "&countryCode=".$json['countryCode'] .	"&telCountry=".$json['telCountry'];

	$url = 'http://www.estrelafone.com.br/pt/clientV2/createClientV2.json?' . $data;

	$ch = curl_init($url);

	$options = array(
		CURLOPT_CONNECTTIMEOUT => 30,
		CURLOPT_POST => false,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_RETURNTRANSFER => true
	);

	curl_setopt_array( $ch, $options );

	$result = curl_exec($ch);
	$status = curl_getinfo($ch);

	if ($result === false) {
        echo curl_error($ch);
        die();
    }

	curl_close($ch);

// CREATE TABLE `wp_astrocentro_prod`.`log_estrelafone` ( `date` DATE NOT NULL , `name` VARCHAR(200) NOT NULL , `phone` VARCHAR(200) NOT NULL , `result` VARCHAR(200) NOT NULL ) ENGINE = InnoDB;

	global $wpdb;
	$error_code = json_decode(utf8_encode($result));

	$code = $error_code->errorCode.$from;

	$sql = "INSERT INTO `log_estrelafone` (`date`,`name`,`phone`,`result`) values (NOW(), '$name', '$phonenumber', '$code')";
	$wpdb->query($sql);

	echo utf8_encode($result);
}

/* Shortcode Jogo Compatibilidade de Signos */
function get_signs_compatibility(){
	include_once( 'jogos/compatibilidade/index.php' );
}
add_shortcode('signs_compatibility','get_signs_compatibility');


/* Add Xanox */
function xanox(){
	if ( is_home() ) {
		?>
		<meta name="verification" content="cd507441b3b37930af31b0a79ea0067e" />
	    <?php
	}
}
add_action('wp_head', 'xanox');
