<?php
/**
 * The template for displaying search results pages
 *
 * @package Digital Magazine
 */

get_header();
?>

<?php
	$digital_magazine_archive_layout = get_theme_mod( 'digital_magazine_archive_layout', 'layout-1' ); ?> 

<div class="container">
	<?php
	if ( $digital_magazine_archive_layout == 'layout-1' ) {
		?>
	<div class="main-wrapper">
		<main id="primary" class="site-main ct-post-wrapper lay-width">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'digital-magazine' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'revolution/template-parts/content',  get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'revolution/template-parts/content', 'none' );

			endif;
			?>
		</main>
		<?php
		get_sidebar();	?>
	</div>
	<?php
	} elseif ( $digital_magazine_archive_layout == 'layout-2' ) {
	?>
	<div class="main-wrapper">
		<?php
		get_sidebar();	?>
		<main id="primary" class="site-main ct-post-wrapper lay-width">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'digital-magazine' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'revolution/template-parts/content',  get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'revolution/template-parts/content', 'none' );

			endif;
			?>
		</main>
	</div>
	<?php } ?>
</div>
<?php

get_footer();