<?php 
function changeBadgeStyle() {
	$ns_badge_postid = get_the_ID();
	if(get_post_meta($ns_badge_postid, '_ns_option_badge', true)==1){

		wp_enqueue_style('ns_style_inline',  plugin_dir_url( __FILE__ ). '../ASSETS/CSS/ns_badge_style_inline.css');

		//prendo gli id delle immagini(se ci sono)
		$ns_post_id=get_option('ns_loop_image');
		$ns_post_id_single=get_option('ns_single_product_image');
		$ns_post_id_single_tab=get_post_meta($ns_badge_postid, '_ns_option_badge_single_product_image', true);

		//verifico che ci siano le immagini e se siamo nello shop
		if(is_shop()  && ($ns_post_id!=false || is_numeric($ns_post_id_single_tab))) {
			
		
			//se è stata scelta un'immagine singola per questo prodotto
			if(is_numeric($ns_post_id_single_tab)){
				$ns_height=get_post_meta($ns_badge_postid, '_ns_single_height_image', true);
				$ns_width=get_post_meta($ns_badge_postid, '_ns_single_width_image', true);
	
				$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                        height: {$ns_height}px !important;
		                        width: {$ns_width}px !important;
		                }";
		        wp_add_inline_style('ns_style_inline', $ns_custom_style_inline );
				

			}else{

				//prelevo i valori dell'altezza e della larghezza;
				$ns_width=get_option('ns_option_image_width');
				$ns_height=get_option('ns_option_image_height');
				
				$ns_general_size_image = "
	                .ns_general_size_image-".get_the_ID()."{
	                		width: {$ns_width}px !important;
	                        height: {$ns_height}px !important;
	                }";
	            wp_add_inline_style('ns_style_inline', $ns_general_size_image );
			}
			
			
			

		}else if(is_product() && ($ns_post_id_single!=false || is_numeric($ns_post_id_single_tab))){

			//se è stata scelta un'immagine singola per questo prodotto
			if(is_numeric($ns_post_id_single_tab)){

				$ns_height=get_post_meta($ns_badge_postid, '_ns_single_height_image', true);
				$ns_width=get_post_meta($ns_badge_postid, '_ns_single_width_image', true);

				$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                        height: {$ns_height}px !important;
		                        width: {$ns_width}px !important;
		                }";
		        wp_add_inline_style('ns_style_inline', $ns_custom_style_inline );

			}else{

				//prelevo i valori dell'altezza e della larghezza;
				$ns_width=get_option('ns_option_single_image_width');
				$ns_height=get_option('ns_option_single_image_heigth');
				
				$ns_general_size_image = "
	                .ns_general_size_image-".get_the_ID()."{
	                		width: {$ns_width}px !important; 
	                        height: {$ns_height}px !important;
	                        
	                }";
	            wp_add_inline_style('ns_style_inline', $ns_general_size_image );
			}
			
			
			
		}else{

			$ns_text_size = get_post_meta($ns_badge_postid,  '_ns_option_badge_sizeText', true).'px';
			$ns_badge_shape = get_post_meta($ns_badge_postid,  '_ns_option_badge_shape', true);

			$ns_badge_color= get_post_meta($ns_badge_postid,  '_ns_option_badge_color', true);
			$ns_badge_size_shape = get_post_meta($ns_badge_postid,  '_ns_option_badge_size_shape', true);

			ns_return_size_value($ns_badge_size_shape, $ns_badge_shape, $ns_height, $ns_width);

			switch($ns_badge_shape){

				case 'cerchio':
					$ns_top=-($ns_width/3);
					$ns_left=-($ns_height/3);
					$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                		width: {$ns_width}px;
		                        height: {$ns_height}px;
		                        top: {$ns_top}px;
		                        left: {$ns_left}px;
		                        line-height: {$ns_height}px;
		                        background: {$ns_badge_color};
		                        font-size: {$ns_text_size};		                       
		                }";
		                break;

		        case 'triangolo':

				
		        	$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                        
		                        width: {$ns_width}px;
		                        height: {$ns_height}px;
		                        font-size: {$ns_text_size};
		                        background: linear-gradient(to top left, transparent 0%,transparent 50%, #000000 50%, {$ns_badge_color} 50%, {$ns_badge_color} 100%);
		                        
		                }";
		                break;

		        case 'quadrato':

		        	$ns_top=-($ns_width/3);
					$ns_left=-($ns_height/3);
		        	$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                        font-size: {$ns_text_size};
		                        background-color:{$ns_badge_color}; 
		                        height: {$ns_height}px;
		                        width: {$ns_width}px;
		                        top: {$ns_top}px;
		                        left: {$ns_left}px;
		                        line-height: {$ns_height}px;
		                        
		                }";
		                break;

		        case 'etichetta_sx':

		        	$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                        font-size: {$ns_text_size};
		                        background-color:{$ns_badge_color}; 
		                        height: {$ns_height}px;
		                        width: {$ns_width}px;

		                }";
		                break;

		        case 'standard':

		        	$ns_custom_style_inline = "
		                .ns_custom_style-".get_the_ID()."{
		                        font-size: {$ns_text_size};
		                        background-color:{$ns_badge_color};
		                        height: {$ns_height}px;
		                        width: {$ns_width}px;
		                        line-height: {$ns_height}px;
		                }";
		                break;

		        default:
		        	$ns_custom_style_inline = "";
		        	break;

			}

			wp_add_inline_style('ns_style_inline', $ns_custom_style_inline );

		}
	}
}
add_action('woocommerce_product_thumbnails', 'changeBadgeStyle');
add_action('woocommerce_before_shop_loop_item_title', 'changeBadgeStyle');


function ns_return_size_value($ns_size_value, $ns_badge_shape, &$ns_height, &$ns_width ){

	switch ($ns_badge_shape) {
		case 'cerchio': case 'triangolo': case 'quadrato':
			
			if($ns_size_value=='0'){
				$ns_height=40;
				$ns_width=40;
			}else if($ns_size_value=='1'){
				$ns_height=60;
				$ns_width=60;
			}
			else{
				$ns_height=80;
				$ns_width=80;
			}
			break;
		
		case 'etichetta_sx':
			if($ns_size_value=='0'){
				$ns_height=20;
				$ns_width=80;
			}else if($ns_size_value=='1'){
				$ns_height=25;
				$ns_width=90;
			}
			else{
				$ns_height=30;
				$ns_width=100;
			}
			break;

		case 'standard':
			if($ns_size_value=='0'){
				$ns_height=15;
				$ns_width=100;
			}else if($ns_size_value=='1'){
				$ns_height=25;
				$ns_width=100;
			}
			else{
				$ns_height=35;
				$ns_width=100;
			}
			break;

	}
}

?>