<?php
/*********************************************************/
//				CREAZIONE TAB "Badge"
/*********************************************************/
function NS_badge_new_product_tab( $NS_Badge_tabs ) {
	
	// Adds the new tab
	
	$NS_Badge_tabs['badge'] = array(
		'label'		=> __( 'Badge', 'ns-iba-icon-badge-archive'),
		'target'	=> 'NS_badge_options',
		
	);
	
	return $NS_Badge_tabs;

}
add_filter( 'woocommerce_product_data_tabs', 'NS_badge_new_product_tab' );

/*********************************************************/
//				VISUALIZZARE FORM/FUNZIONALITA' 
/*********************************************************/
function NS_Badge_product_tab_content() {


	global $post;
	$ns_badge_postid = get_the_ID();
	?>
	<div id='NS_badge_options' class='panel woocommerce_options_panel'>
		<div class='options_group'>
			<?php
			if(!$ns_badge_value=get_post_meta($ns_badge_postid, '_ns_option_badge', true)){
				$ns_badge_value='0';
				$ns_display = 'none';
			}else 
				$ns_display='inline';

			woocommerce_wp_select(array(
                'id' 		=> 'NS_Option_badge',
                'class' 	=> 'NS_options',
                'label' 	=> __('Badge', 'ns-iba-icon-badge-archive'),
                'value'		=> $ns_badge_value,
                'options' 	=> array('1' => __('Yes', 'ns-iba-icon-badge-archive'), '0'	=> __('No', 'ns-iba-icon-badge-archive'),),
                ))
            
            ?>
		</div>

			<div id="show_option_badge" style="display: <?php echo $ns_display; ?>;">
				
				<?php
					
					if(!$ns_badge_text_value=get_post_meta($ns_badge_postid, '_ns_option_badge_text', true))
						$ns_badge_text_value='';

		            woocommerce_wp_text_input( array(
						'id'				=> 'NS_Option_badge_text',
						'label'				=> __( 'Text: ', 'ns-iba-icon-badge-archive'),
						'desc_tip'			=> 'true',
						'description'		=> __( 'Choose the text to display on the badge', 'ns-iba-icon-badge-archive'), //Scegliere il testo da inserire sul badge
						'type' 				=> 'text',
						'value'				=> $ns_badge_text_value
						
					) );

		            if(!$ns_badge_size_text_value=get_post_meta($ns_badge_postid, '_ns_option_badge_sizeText', true))
						$ns_badge_size_text_value='';

					woocommerce_wp_text_input( array(
						'id'				=> 'NS_Option_badge_sizeText',
						'label'				=> __( 'Size: ', 'ns-iba-icon-badge-archive'),
						'desc_tip'			=> 'true',
						'description'		=> __( 'Choose the badge size text(pixel)', 'ns-iba-icon-badge-archive'),//Indicare la dimensione del testo che si vuole visualizzare sul badge (pixel)
						'type' 				=> 'number',
						'value'				=> $ns_badge_size_text_value,
						'custom_attributes'	=> array(
							'min'	=> '1',
							'max'	=> '60',
							'step'	=> '1',
						),
					) );
					echo '<hr>';

					if(!$ns_badge_shape_value=get_post_meta($ns_badge_postid, '_ns_option_badge_shape', true))
						$ns_badge_shape_value= 'standard';

		            woocommerce_wp_select(array(
                		'id' 			=> 'NS_Option_badge_shape',
                		'class' 		=> 'NS_options',
                		'label'			=> __('Shape: ', 'ns-iba-icon-badge-archive'),
                		'value'			=> $ns_badge_shape_value,
                		'options' 		=> array(
                    	'standard' 		=> ' ',
                    	'cerchio' 		=> __('Circle', 'ns-iba-icon-badge-archive'),
                    	'triangolo' 	=> __('Triangle', 'ns-iba-icon-badge-archive'),
                    	'quadrato' 		=> __('Quadrate', 'ns-iba-icon-badge-archive'),
                    	'etichetta_sx' 	=> __('Label', 'ns-iba-icon-badge-archive'),
                		))
           			);
		            
		            if(!$ns_badge_size_shape_value=get_post_meta($ns_badge_postid, '_ns_option_badge_size_shape', true))
						$ns_badge_size_shape_value= '0';

           			woocommerce_wp_select(array(
	                		'id' 		=> 'NS_Option_badge_size_shape',
	                		'class' 	=> 'NS_options',
	                		'label' 	=> __('Size:', 'ns-iba-icon-badge-archive'),
	                		'value' 	=> $ns_badge_size_shape_value,
	                		'options' 	=> array(
	                		'0' => 'S',
	                    	'1' => 'M',
	                    	'2' => 'L',
	                		))
	           			);

           			if(!$ns_badge_color_value=get_post_meta($ns_badge_postid, '_ns_option_badge_color', true))
						$ns_badge_color_value= '#000000';

					woocommerce_wp_text_input( array(
						'id'				=> 'NS_Option_badge_color',
						'label'				=> __( 'Color: ', 'ns-iba-icon-badge-archive'),
						'type' 				=> 'text',
						'class'				=> 'ns-color-picker-badge', 
						'value'				=> $ns_badge_color_value,
						'custom_attributes'	=> array(
							'min'	=> '1',
							'max'	=> '100',
							'step'	=> '1',
						),
					) );
					
					

				wp_enqueue_media();

				?>

				<br>
				<hr>
				<p><?php _e('Or upload/select image:', 'ns-iba-icon-badge-archive')?> </p>
				<form method='post'>
					<br>
					<div class='ns_image-preview-wrapper_1'>
						<img id='image-preview' class="ns_image-preview" src='<?php echo wp_get_attachment_url( get_post_meta($ns_badge_postid, '_ns_option_badge_single_product_image', true) ); ?>' height='100'>
					</div>
					<input id="upload_image_button" type="button" class="ns_upload_image button" value="<?php _e('Upload image', 'ns-iba-icon-badge-archive' ); ?>" /> 
					<input type='hidden' name='single_loop_product_image_attachment_id' id='single_loop_product_image_attachment_id' class="image_attachment_id" value="<?php echo get_post_meta($ns_badge_postid, '_ns_option_badge_single_product_image', true) ?>">
				</form>
				<br>
				<?php

           		if(!$ns_badge_single_width_value=get_post_meta($ns_badge_postid, '_ns_single_width_image', true))
					$ns_badge_single_width_value= '';
				woocommerce_wp_text_input( array(
								'id'				=> 'ns_single_width_image',
								'label'				=> __( 'width: ', 'ns-iba-icon-badge-archive'),
								'type' 				=> 'number',
								'value'				=> $ns_badge_single_width_value,
								'desc_tip'			=> 'true',
								'description'		=> __('Set badge width (pixel)','ns-iba-icon-badge-archive' ),
								'custom_attributes'	=> array(
									'step'	=> '1',
									'min'   => '1',
									'max'	=> '9999',
								),
							) );
				if(!$ns_badge_single_height_value=get_post_meta($ns_badge_postid, '_ns_single_height_image', true))
					$ns_badge_single_height_value= '';
				woocommerce_wp_text_input( array(
					'id'				=> 'ns_single_height_image',
					'label'				=> __( 'height: ', 'ns-iba-icon-badge-archive' ),
					'type' 				=> 'number',
					'desc_tip'			=> 'true',
								'description'		=> __('Set badge height (pixel)','ns-iba-icon-badge-archive' ),
					'value'				=> $ns_badge_single_height_value,
					'custom_attributes'	=> array(
						'step'	=> '1',
						'min'   => '1',
						'max'	=> '9999',
					),
				) );
				?>
				<hr>
				<br>
				
				</div>
			<br>
			<div class="ns_option_badge_button_tab">

			<?php 	

				//submit_button(__('Save changes', 'ns-iba-icon-badge-archive'), 'primary', 'ns_save_option_badge_button_tab');
				submit_button(__('Delete badge', 'ns-iba-icon-badge-archive'), 'delete', 'ns_delete_option_badge_button_tab');
			?>
			</div>
	</div>
	<?php

}
add_filter( 'woocommerce_product_data_panels', 'NS_Badge_product_tab_content' ); 

function ns_media_selector_print_scripts_tab($ns_badge_postid) {

	$ns_my_saved_attachment_post_id = get_post_meta($ns_badge_postid, '_ns_option_badge_single_product_image', true);
		
}
add_action( 'admin_footer', 'ns_media_selector_print_scripts_tab' );

/*********************************************************/
//				SALVARE DATI PRELAVATI DAL FORM
/*********************************************************/

function NS_Badge_save_options( $ns_badge_post_id ) {

	if(isset($_POST['ns_delete_option_badge_button_tab'])){

		delete_post_meta($ns_badge_post_id, '_ns_option_badge' );
		delete_post_meta($ns_badge_post_id, '_ns_option_badge_single_product_image');
		delete_post_meta($ns_badge_post_id, '_ns_single_width_image');
		delete_post_meta($ns_badge_post_id, '_ns_single_height_image');
		delete_post_meta($ns_badge_post_id, '_ns_option_badge_text');
		delete_post_meta($ns_badge_post_id, '_ns_option_badge_shape');
		delete_post_meta($ns_badge_post_id, '_ns_option_badge_sizeText');
		delete_post_meta($ns_badge_post_id, '_ns_option_badge_size_shape');
		delete_post_meta($ns_badge_post_id, '_ns_option_badge_color');
	}else if($_POST['NS_Option_badge']==1){

		if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge', $_POST['NS_Option_badge'], true ) ) { 
	   		update_post_meta( $ns_badge_post_id, '_ns_option_badge',  $_POST['NS_Option_badge']);
	   	}
	
		if (is_numeric( $_POST['single_loop_product_image_attachment_id'] ) ){

			if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge_single_product_image', $_POST['single_loop_product_image_attachment_id'], true ) ) { 
	   			update_post_meta( $ns_badge_post_id, '_ns_option_badge_single_product_image',  $_POST['single_loop_product_image_attachment_id']);	

	   			$ns_loop_image_to_update = array(
      				'ID'           => $_POST['single_loop_product_image_attachment_id'],
      				'post_content' => 'ns_image',
  				);
				// Update the post into the database
  				wp_update_post( $ns_loop_image_to_update );
			}
			if ( ! add_post_meta( $ns_badge_post_id, '_ns_single_width_image', $_POST['ns_single_width_image'], true ) ) { 
	   			update_post_meta( $ns_badge_post_id, '_ns_single_width_image',  $_POST['ns_single_width_image']);	
			}
			if ( ! add_post_meta( $ns_badge_post_id, '_ns_single_height_image', $_POST['ns_single_height_image'], true ) ) { 
	   			update_post_meta( $ns_badge_post_id, '_ns_single_height_image',  $_POST['ns_single_height_image']);	
			}
		}else{
		
			if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge_text', $_POST['NS_Option_badge_text'], true ) ) { 
		   	update_post_meta( $ns_badge_post_id, '_ns_option_badge_text',  $_POST['NS_Option_badge_text']);	
			}

			if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge_shape', $_POST['NS_Option_badge_shape'], true ) ) { 
		   	update_post_meta( $ns_badge_post_id, '_ns_option_badge_shape',  $_POST['NS_Option_badge_shape']);	
			}

			if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge_sizeText', $_POST['NS_Option_badge_sizeText'], true ) ) { 
		   	update_post_meta( $ns_badge_post_id, '_ns_option_badge_sizeText',  $_POST['NS_Option_badge_sizeText']);	
			}

			if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge_size_shape', $_POST['NS_Option_badge_size_shape'], true ) ) { 
		   	update_post_meta( $ns_badge_post_id, '_ns_option_badge_size_shape',  $_POST['NS_Option_badge_size_shape']);	
			}

			if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge_color', $_POST['NS_Option_badge_color'], true ) ) { 
		   	update_post_meta( $ns_badge_post_id, '_ns_option_badge_color',  $_POST['NS_Option_badge_color']);	
			}
			
		}
		
	}else{
		if ( ! add_post_meta( $ns_badge_post_id, '_ns_option_badge', $_POST['NS_Option_badge'], true ) ) { 
	   		update_post_meta( $ns_badge_post_id, '_ns_option_badge',  $_POST['NS_Option_badge']);
		}
	}
	
}
add_action( 'woocommerce_process_product_meta', 'NS_Badge_save_options'  );
?>