<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author           WooThemes
 * @package          WooCommerce/Templates
 * @version          1.6.4
 * @flatsome-version 3.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

do_action( 'flatsome_before_product_page' );

?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			// Check if this is a VinFast product
			$is_vf = function_exists('is_vinfast_product') && get_post_meta(get_the_ID(), '_vf_is_vinfast', true) === 'yes';
			
			if ( $is_vf ) {
				// Render universal VinFast template
				?>
				<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
					<div class="vinfast-custom-content">
						<?php include get_template_directory() . '/template-parts/product/vinfast-product.php'; ?>
					</div>
				</div>
				<?php
			} elseif ( flatsome_product_block( get_the_ID() ) ) {
				wc_get_template_part( 'content', 'single-product-custom' );
			} else {
				wc_get_template_part( 'content', 'single-product' );
			}
			?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php

do_action( 'flatsome_after_product_page' );

get_footer( 'shop' );

?>
