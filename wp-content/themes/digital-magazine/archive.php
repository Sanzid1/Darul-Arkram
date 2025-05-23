<?php
/**
 * The template for displaying archive pages
 *
 * @package Digital Magazine
 */

get_header();
?>

<?php $digital_magazine_archive_layout = get_theme_mod( 'digital_magazine_archive_layout', 'layout-1' ); ?> 

<div class="container">
	<?php
	if ( $digital_magazine_archive_layout == 'layout-1' ) {
		?>
	<div class="main-wrapper">
		<main id="primary" class="site-main ct-post-wrapper lay-width">

			<?php if ( have_posts() ) : ?>

				<?php do_action('digital_magazine_breadcrumbs'); ?>

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'revolution/template-parts/content', get_post_format() );

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

				<?php do_action('digital_magazine_breadcrumbs'); ?>

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'revolution/template-parts/content', get_post_format() );

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