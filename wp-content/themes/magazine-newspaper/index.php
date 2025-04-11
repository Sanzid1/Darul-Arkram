<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package magazine-newspaper
 */

get_header(); ?>

<?php
	$layout = get_theme_mod( 'magazine_newspaper_blog_sidebar_layout', 'right-sidebar' );
	$view = get_theme_mod( 'magazine_newspaper_blog_view', 'list-view' );

	if( $layout == 'no-sidebar' ) {
		$content_column_class = 'col-sm-12';
	} else {
		$content_column_class = 'col-sm-8';
	}

	$post_details = get_theme_mod( 'magazine_newspaper_blog_details', array( 'date', 'categories' ) );
 	set_query_var( 'post_details', $post_details );
?>
<div class="home-archive inside-page post-list">
  <div class="container">
    <div class="row">

    	<?php if ( $layout == 'left-sidebar' ) : ?>
    	<div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
    	<?php endif; ?>

    	<div class="<?php echo esc_attr( $content_column_class ); ?>">
    		<div class="flex-table view <?php echo esc_attr( $view ); ?> row">
	        <!-- <div class="row"> -->
	        	<?php if ( have_posts() ) : ?>
		            <?php while ( have_posts() ) : the_post(); ?>
		              <?php
			              get_template_part( 'template-parts/content' ,null, array(
		                  'view' => $view,
		                  'post_details' => $post_details
		                ) );
		              ?>
		            <?php endwhile; ?>
		        <?php else : ?>
		          <?php
	              get_template_part( 'template-parts/content' ,null, array(
                  'view' => $view,
                  'post_details' => $post_details
                ) );
              ?>
		        <?php endif; ?>
		    <!-- </div> -->
        </div> <!-- end view -->			    				    
			</div>

			<?php if( $layout == 'right-sidebar' ) : ?>
	    	<div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
	    <?php endif; ?>

   	</div>

   	<?php
	    if (  $wp_query->max_num_pages > 1 ) {
	      if( get_theme_mod( 'magazine_newspaper_pagination_type', 'number-pagination' ) == 'number-pagination' ) {
	        magazine_newspaper_numeric_posts_nav();
	      } else if( get_theme_mod( 'magazine_newspaper_pagination_type', 'number-pagination' ) == 'ajax-loadmore' ) { ?>
	        <div id="magazine_newspaper_pagination" class="loadmore"><button view="<?php echo $view;?>"><?php esc_html_e( 'More posts', 'magazine-newspaper' ); ?></button></div>
	      <?php }
	    }
	  ?>
	  
	</div>
</div>

<?php get_footer(); ?>
