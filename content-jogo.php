<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( get_the_category_list() .'<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
		<?php if ( !is_single() ) : ?>
			<div class="entry-summary">
				<?php //the_excerpt(); ?>
				<p><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
			</div><!-- .entry-summary -->
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php odin_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

		<div class="entry-content">
			<a href="<?php echo get_permalink() ?>" title="">
				<picture class="wp-picture">
					<source srcset="<?php the_post_thumbnail_url('medium'); ?>" media="(max-width: 767px)">
					<source srcset="<?php the_post_thumbnail_url('large'); ?>" media="(max-width: 768px) and (max-width: 1023px)">
					<source srcset="<?php the_post_thumbnail_url('full'); ?>" media="(min-width: 1024px)">
					<img srcset="<?php the_post_thumbnail_url('full'); ?>" alt="">
				</picture>
				<img class="wp-picture-ie" src="<?php the_post_thumbnail_url('full'); ?>" alt="">
			</a>
		<?php if ( is_single() ) : ?>
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'odin' ) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		<?php endif; ?>
		</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>

	<footer class="entry-meta">
		<div class="box-social-media ac-sb">
			<ul class="social-media row">
				<li class="hidden-lg-up col-xs-4">
					<a class="svg-i i-wa-c" href="whatsapp://send?text=Queria compartilhar isso com você: <?php esc_url(the_permalink()) ?>" title="<?php _e( 'Compartilhar no whatsapp', 'odin' ); ?>"></a>
				</li>
				<li class="col-xs-4">
					<div class="fb-share-button" data-href="<?php esc_url(the_permalink()) ?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php esc_url(the_permalink()) ?>%2F&amp;src=sdkpreparse"><?php _e( 'Compartilhar no Facebook', 'odin' ); ?></a></div>
				</li>
				<li class="col-xs-4">
					<a class="twitter-share-button"
					  href="https://twitter.com/share"
					  data-size="large"
					  data-text="<?php the_title(); ?>"
					  data-url="<?php esc_url(the_permalink()) ?>"
					  data-via="AstrocentroBR">
					Tweet
					</a>
				</li>
			</ul>
		</div>
		<div class="box-notification" id="pushes" style="display: none;">
			<h3><?php _e( 'Para ter informações exclusivas, ative nossas notificações', 'odin' ); ?></h3>
			<div class="btn-actions text-center">
				<a href="#" id="subscribe-link" class="btn btn-primary btn-lg svg-i i-bell" style="display: none;" role="button"><?php _e( 'Receber notificações', 'odin' ); ?></a>
			</div>
		</div>
	</footer>
	<?php endif; ?>
</article><!-- #post-## -->

<?php if ( is_single() ) : ?>
<div id="wengosense_below_article" class="wengosense-cached ac-sb wg-list">
	<h3><?php _e( 'Especialistas online', 'odin' ); ?></h3>
	<?php
		include_once get_template_directory() . '/cron/wengosense_cached.php';
		echo get_experts_tabs(array('zone'=>'sidebar'));
	 ?>
 </div>

<!-- Below Article Thumbnails -->
<div id="taboola-below-article-thumbnails" class="ac-sb"></div>
<script type="text/javascript">
	window._taboola = window._taboola || [];
	_taboola.push({
		mode: 'thumbnails-a',
		container: 'taboola-below-article-thumbnails',
		placement: 'Below Article Thumbnails',
		target_type: 'mix'
	});
</script>

<!-- Organic Below Article Thumbnails -->
<div id="taboola-organic-below-article-thumbnails" class="ac-sb"></div>
<script type="text/javascript">
	window._taboola = window._taboola || [];
	_taboola.push({
		mode: 'organic-thumbnails-a',
		container: 'taboola-organic-below-article-thumbnails',
		placement: 'Organic Below Article Thumbnails',
		target_type: 'mix'
	});
</script>

<!-- Right Rail Article Thumbnails
<div id="taboola-right-rail-article-thumbnails"></div>
<script type="text/javascript">
	window._taboola = window._taboola || [];
	_taboola.push({
		mode: 'thumbnails-rr',
		container: 'taboola-right-rail-article-thumbnails',
		placement: 'Right Rail Article Thumbnails',
		target_type: 'mix'
	});
</script>
 -->

<!-- Organic Right Rail Article Thumbnails
<div id="taboola-organic-right-rail-article-thumbnails" class="ac-sb"></div>
<script type="text/javascript">
	window._taboola = window._taboola || [];
	_taboola.push({
		mode: 'organic-thumbnails-rr',
		container: 'taboola-organic-right-rail-article-thumbnails',
		placement: 'Organic Right Rail Article Thumbnails',
		target_type: 'mix'
	});
</script>
 -->
<?php endif; ?>
