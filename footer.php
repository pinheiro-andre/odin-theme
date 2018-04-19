<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

				</div><!-- .row -->
			</div><!-- #wrapper -->
		</div><!-- .row -->
	</div><!-- .container -->
	<footer id="footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-4">
					<?php odin_the_custom_logo(); ?>
					<p><?php _e( 'Consultas esotéricas 24 horas', 'odin' ); ?></p>
					<p><?php _e( 'Telefone', 'odin' ); ?>: <?php if ( is_mobile() ) { ?><a href="tel:+551139571012"><?php } ?>(11) 3957-1012<?php if ( is_mobile() ) { ?></a><?php } ?></p>
					<div class="box-social-media">
						<ul class="social-media">
							<li>
								<a class="svg-i i-fb" href="https://www.facebook.com/Astrocentro.com.br" title="<?php _e( 'Curta nossa página', 'odin' ); ?>" target="_blank"></a>
							</li>
							<li>
								<a class="svg-i i-tt" href="https://twitter.com/AstrocentroBR" title="<?php _e( 'Siga-nos', 'odin' ); ?>" target="_blank"></a>
							</li>
							<li>
								<a class="svg-i i-gp" href="https://plus.google.com/+AstrocentroBr" title="<?php _e( 'Curta nossa página', 'odin' ); ?>" target="_blank"></a>
							</li>
							<li>
								<a class="svg-i i-is" href="https://instagram.com/astrocentrobr" title="<?php _e( 'Siga-nos', 'odin' ); ?>" target="_blank"></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-lg-4">
					<strong><?php _e( 'Menu', 'odin' ); ?></strong>
					<?php
						$cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=2&parent=0&style=none'));
						$cat_n = count($cats) - 1;
						echo "<ul class='footer-links links-category'>";
						for ($i=0;$i< $cat_n;$i++)
						{
						echo "<li>$cats[$i]</li>";
						}
						echo "</ul>";
					?>
				</div>
				<div class="col-6 col-lg-2">
					<strong><?php _e( 'Nossos Especialistas', 'odin' ); ?></strong>
					<ul class="footer-links">
						<li><a href="http://astrocentro.com.br/consultas/?payload[page]=especialidade-astrologia&tracker_id=v2_26707" title="" target="_blank">Astrólogos</a></li>
						<li><a href="http://astrocentro.com.br/consultas/?payload[page]=especialidade-numerologia&tracker_id=v2_26710" title="" target="_blank">Numerólogos</a></li>
						<li><a href="http://astrocentro.com.br/consultas/?payload[page]=especialidade-tarologia&tracker_id=v2_26708" title="" target="_blank">Tarólogos</a></li>
						<li><a href="http://astrocentro.com.br/consultas/?payload[page]=especialidade-videncia&tracker_id=v2_26709" title="" target="_blank">Videntes</a></li>
					</ul>
				</div>
				<div class="col-6 col-lg-2">
					<strong><?php _e( 'Nossas marcas', 'odin' ); ?></strong>
					<ul class="footer-links">
						<li><a href="http://www.astroshopping.com.br/index.php?utm_source=astrocentro&utm_medium=rodape" title="" target="_blank">Astroshopping</a></li>
						<li><a href="https://numerologos.com.br/?utm_source=astrocentro&utm_medium=rodape" title="" target="_blank">Numerólogos </a></li>
					</ul>
				</div>
			</div>
		</div><!-- .container -->
		<p class="ac-copy">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a> - <?php _e( 'All rights reserved', 'odin' ); ?></p>
	</footer><!-- #footer -->

	<?php if (is_mobile()): ?>
		<nav class="ac-menu menu-mobile">
			<ul>
				<li class="ac-menu-item home-item hidden-lg-up">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<span class="svg-i i-home label"><?php _e( 'Home', 'odin' ); ?></span>
					</a>
				</li>
				<li class="ac-menu-item category-item">
					<div class="ac-menu-sub-title hidden-lg-up" data-toggle="dropdown-menu">
						<span class="svg-i i-stack label"><?php _e( 'Categorias', 'odin' ); ?></span>
					</div>
					<div class="ac-menu-sub-item ">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'depth'          => 2,
									'container'      => false,
									'menu_class'     => 'nav navbar-nav',
									'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
									'walker'         => new Odin_Bootstrap_Nav_Walker()
								)
							);
						?>
					</div>
				</li>
				<li class="ac-menu-item search-item hidden-lg-up search-menu">
					<div class="ac-menu-sub-title" data-toggle="dropdown-menu">
						<span class="svg-i i-search label"><?php _e( 'Procurar', 'odin' ); ?></span>
					</div>
					<div class="ac-menu-sub-item ">
						<button type="button" class="close" aria-label="Close" data-toggle="dropdown-menu">
							<span aria-hidden="true">&times;</span>
						</button>
						<form method="get" class="ac-search d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
							<div class="form-group">
								<input type="search" value="<?php echo get_search_query(); ?>" class="form-control" name="s" id="navbar-search" placeholder="<?php _e( 'O que você procura?', 'odin' ); ?>" />
							</div>
							<button type="submit" class="btn btn-primary"><span class="svg-i i-search-white"></span></button>
						</form>
						<div id="search-result" class="search-result <?php echo (is_ios() ? "is-safari" : ""); ?>"></div>
					</div>
				</li>
				<li class="ac-menu-item specialist-item hidden-lg-up wengosense-block">
					<div class="ac-menu-sub-title" data-toggle="dropdown-menu">
						<span class="svg-i i-phone label"><?php _e( 'Consulte-se', 'odin' ); ?></span>
					</div>
					<div class="ac-menu-sub-item">
						<div class="wengosense-cached">
							<h3><?php _e( 'Especialista online', 'odin' ); ?></h3>
							<?php
								include_once get_template_directory() . '/cron/wengosense_cached.php';
								echo get_experts_tabs(array('zone'=>'menu_mobile'));
							 ?>
						 </div>
					</div>
				</li>
			</ul>
		</nav>
	<?php endif; ?>
	<?php wp_footer(); ?>
	<div class="mask-menu-over"></div>
</body>
</html>
