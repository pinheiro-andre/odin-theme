<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( ! get_option( 'site_icon' ) ) : ?>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Facebook Sharing button -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Twitter Sharing button -->
	<script>window.twttr = (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0],
	t = window.twttr || {};
	if (d.getElementById(id)) return t;
	js = d.createElement(s);
	js.id = id;
	js.src = "https://platform.twitter.com/widgets.js";
	fjs.parentNode.insertBefore(js, fjs);

	t._e = [];
	t.ready = function(f) {
	t._e.push(f);
	};

	return t;
	}(document, "script", "twitter-wjs"));</script>



	<header id="header" role="banner">
		<div class="container">
			<div class="page-header hidden-xs d-flex justify-content-between align-items-center">

				<?php odin_the_custom_logo(); ?>

				<?php if ( get_header_image() ) : ?>
					<div class="custom-header">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
						</a>
					</div>
				<?php endif; ?>
				<div class="hidden-md-down">
					<?php if( !is_mobile() ): ?>
					<form method="get" class="ac-search d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
						<div class="form-group">
							<input type="search" value="<?php echo get_search_query(); ?>" class="form-control" name="s" id="navbar-search" placeholder="<?php _e( 'O que você procura?', 'odin' ); ?>" />
						</div>
						<button type="submit" class="btn btn-primary"><span class="svg-i i-search-white"></span></button>
					</form>
					<?php endif; ?>
				</div>
			</div><!-- .page-header-->
		</div><!-- .container-->
	</header><!-- #header -->

	<div class="container">
		<div class="row">
			<?php if(!is_mobile()): ?>
			<div class="col col-xl-2">
				<nav class="ac-menu-desk">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'nav navbar-nava',
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
					?>
				</nav>
			</div><!-- #main-navigation-->
			<?php endif; ?>
			<div id="wrapper" class="container col-xl-10">
				<div class="row">
