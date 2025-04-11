<?php
/**
 * The template for displaying all single posts
 *
 * @package Digital Magazine
 */

get_header();
?>

<div class="container">
	<?php
	$digital_magazine_post_layout = get_theme_mod( 'digital_magazine_post_layout', 'layout-1' );

	if ( $digital_magazine_post_layout == 'layout-1' ) {
		?>
	<div class="main-wrapper">
		<main id="primary" class="site-main lay-width">
		
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'revolution/template-parts/content', get_post_format() );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'digital-magazine' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'digital-magazine' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
				?>

				<?php 
				do_action('digital_magazine_related_posts');
				?>
				
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main>

		<?php
		get_sidebar();	?>
	</div>

	<?php
	} elseif ( $digital_magazine_post_layout == 'layout-2' ) {
		?>
	<div class="main-wrapper">
		<?php
		get_sidebar();	?>

		<main id="primary" class="site-main lay-width">
		
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'revolution/template-parts/content', get_post_format() );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'digital-magazine' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'digital-magazine' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
				?>

				<?php 
				do_action('digital_magazine_related_posts');
				?>
				
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main>
	</div>
	<?php } ?>
</div>
<?php

get_footer();