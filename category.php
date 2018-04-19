<?php
/**
 * The template for displaying Category pages.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<main id="content" class="<?php echo odin_classes_page_sidebar(); ?>" tabindex="-1" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
				<?php
					single_term_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				</header><!-- .page-header -->

				<?php
						echo ("<div class='article-list'>");
						// Start the Loop.
						while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

						endwhile;
						echo ("</div>");
						// Page navigation.
						odin_paging_nav();

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

				endif;
				$category = get_the_category();

				// if mobile or Mediunidade category
				if (is_mobile() || $category[0]->cat_ID == 13 ) {
					echo do_shortcode("[dfp_ads id=110]");
				}else{
					echo do_shortcode("[dfp_ads id=103]");
				}


			?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
