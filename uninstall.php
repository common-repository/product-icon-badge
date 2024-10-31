<?php
// if uninstall.php is not called by WordPress, die	
	if (!defined('WP_UNINSTALL_PLUGIN')) {
	    die;
	}

	/* DELETE POSTMETA */
	delete_post_meta_by_key( '_ns_option_badge_color' );
	delete_post_meta_by_key( '_ns_option_badge' );
	delete_post_meta_by_key( '_ns_option_badge_text' );
	delete_post_meta_by_key( '_ns_option_badge_sizeText' );
	delete_post_meta_by_key( '_ns_option_badge_shape' );
	delete_post_meta_by_key( '_ns_option_badge_size_shape' );
	delete_post_meta_by_key( '_ns_option_badge_single_product_image' );
	delete_post_meta_by_key( '_ns_single_width_image' );
	delete_post_meta_by_key( '_ns_single_height_image' );

	/* DELETE OPTIONS */
	delete_option('ns_loop_image');
	delete_option('ns_option_image_height');
	delete_option('ns_option_image_width');
	delete_option('ns_option_single_image_height');
	delete_option('ns_option_single_image_width');
	delete_option('ns_single_product_image');

	$args = array(
				'post_type' 		=> 'attachment',
				'posts_per_page' 	=> -1,
			);
	$ns_image_ids = get_posts( $args ); 
	foreach ($ns_image_ids as $value) {
		if($value->post_content=='ns_image')
			wp_delete_post( $value->ID);
	} 
?>