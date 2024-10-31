<?php


function ns_addNewOptionsPage(){
    add_menu_page('Opzioni badge', __('Badge options', 'ns-iba-icon-badge-archive'), 'manage_options', 'badge-options', 'ns_badge_options_page', plugin_dir_url( __FILE__ ).'img/backend-sidebar-icon.png', 58);
    
}
add_action('admin_menu', 'ns_addNewOptionsPage');


function ns_badge_options_page(){

        $ns_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'loop_upload_image'; 
        ?>
         
        <h2 class="nav-tab-wrapper">
        	<a href="?page=badge-options&tab=loop_upload_image" class="nav-tab <?php echo $ns_active_tab == 'loop_upload_image' ? 'nav-tab-active' : ''; ?>"><?php _e('Shop image', 'ns-iba-icon-badge-archive')?></a>
        	<a href="?page=badge-options&tab=shop_upload_image" class="nav-tab <?php echo $ns_active_tab == 'shop_upload_image' ? 'nav-tab-active' : ''; ?>"><?php _e('Single product image', 'ns-iba-icon-badge-archive')?></a>
        	<a href="?page=badge-options&tab=ns_premium_version_page" class="nav-tab <?php echo $ns_active_tab == 'ns_premium_version_page' ? 'nav-tab-active' : ''; ?>"><?php _e('Premium features', 'ns-iba-icon-badge-archive')?></a>
        </h2>
        <?php

        switch ($ns_active_tab) {

        	case 'shop_upload_image':
        		ns_image_upload_shop();
        		break;

        	case 'loop_upload_image':
        		ns_image_upload_loop();
        		break;

        	case 'ns_premium_version_page':
        		ns_premium_version_page();
        		break;
        }
}

function ns_image_upload_shop(){

	/*<-- ******************************************* -->
					START SINGLE PRODUCT
	<-- ******************************************* -->*/

	
	if ( isset( $_POST['ns_single_submit_image_selector'] ) && isset( $_POST['ns_single_image_attachment_id'] ) ){
		update_option( 'ns_single_product_image', absint( $_POST['ns_single_image_attachment_id'] ) );
		// Update post with id $_POST['ns_single_image_attachment_id']
  		$ns_single_image_to_update = array(
      		'ID'           => $_POST['ns_single_image_attachment_id'],
      		'post_content' => 'ns_image',
  		);

		// Update the post into the database
  		wp_update_post( $ns_single_image_to_update );
	}
	
	wp_enqueue_media();
	?>
	<div class="ns_border_div_ns_themes">
		<h3><?php _e('Select image for single product page:', 'ns-iba-icon-badge-archive')?></h3>
		<p class="description"><?php _e('Load or select an image for your single products\'s page badges', 'ns-iba-icon-badge-archive')?></p><br>
		<form method='post'>
			<div class='ns_image-preview-wrapper_2'>
				<img id='image-preview' class="ns_image-preview" src='<?php echo wp_get_attachment_url( get_option( 'ns_single_product_image' ) ); ?>' height='100'>
			</div>
			<br>
			<input id="upload_image_button" type="button" class="ns_upload_image button" value="<?php _e( 'Upload image', 'ns-iba-icon-badge-archive'); ?>" />
			<input type='hidden' name='ns_single_image_attachment_id' id='ns_single_image_attachment_id' class="image_attachment_id" value='<?php echo get_option( 'ns_single_product_image' ); ?>'><br><br>
			<input type="submit" name="ns_single_submit_image_selector" value="<?php _e('Save', 'ns-iba-icon-badge-archive') ?>" class="button-primary">
		</form>
	</div>	
		<?php
		
		/*<-- ******************************************* -->
					INPUT SIZE IMAGE SINGLE PRODUCT
		<-- ******************************************* -->*/

		
		if(isset($_POST['ns_single_size_image_button']) && isset($_POST['ns_single_image_width']) && isset($_POST['ns_single_image_height'])) {
		if(!add_option("ns_option_single_image_height", $_POST['ns_single_image_height']))
			update_option("ns_option_single_image_height", $_POST['ns_single_image_height']);
		if(!add_option("ns_option_single_image_width", $_POST['ns_single_image_width']))
			update_option("ns_option_single_image_width", $_POST['ns_single_image_width']);
		}
		$ns_badge_single_width= get_option("ns_option_single_image_width");
		$ns_badge_single_height= get_option("ns_option_single_image_height");
		if(empty($ns_badge_single_width) && empty($ns_badge_single_height)){

			$ns_badge_single_width = "placeholder= \" \"";
			$ns_badge_single_height = "placeholder= \" \"";
		}else{
			$ns_badge_single_width = "value=\"$ns_badge_single_width\"";
			$ns_badge_single_height = "value=\"$ns_badge_single_height\"";
		}
		?>
		<div class="ns_border_div_ns_themes">
			<h3><?php _e('Size:', 'ns-iba-icon-badge-archive')?> </h3>
			<p class="description"><?php _e('enter image\'s width and height', 'ns-iba-icon-badge-archive')?></p>
			<div class="ns_container_div_form_size_image">
			<form method='post' action="<?php echo $_SERVER["PHP_SELF"]."?page=badge-options&tab=shop_upload_image"?>">
				<table class="ns_table_size_image">
					<tr>
						<td class="ns_th_form_size_image"> <?php _e('Width:', 'ns-iba-icon-badge-archive')?> </td> 
						<td class="ns_th_form_size_image"> <input type="number" name="ns_single_image_width" <?php echo $ns_badge_single_width ?>> px;<br></td>
					</tr>
					<tr>
						<td class="ns_th_form_size_image"> <?php _e('Height:', 'ns-iba-icon-badge-archive')?></td>
						<td class="ns_th_form_size_image"> <input type="number" name="ns_single_image_height" <?php echo $ns_badge_single_height ?>> px;<br><br></td>
					</tr>
				</table>
				<input type="submit" name="ns_single_size_image_button" class="button-primary" value="<?php _e('Save', 'ns-iba-icon-badge-archive') ?>">
			</form>
			</div>
		</div>
	
		<!-- ******************************************* 
				DELETE OPTION BUTTON(single product)
		 ******************************************* -->
		
	
		<div class="ns_border_div_ns_themes">
			<form method='post' action="<?php echo $_SERVER["PHP_SELF"]."?page=badge-options&tab=shop_upload_image"?>">
				<h3><?php _e('Reset form:', 'ns-iba-icon-badge-archive')?></h3>
				<p class="description"><?php _e('remove image and sizes from single product page', 'ns-iba-icon-badge-archive')?></p>
			<?php

				submit_button( __('Delete', 'ns-iba-icon-badge-archive'), 'delete', 'ns_delete_single_product_image_button');
			?>
			</form>
		</div>
		<?php
		if(isset($_POST['ns_delete_single_product_image_button'])){

			delete_option('ns_option_single_image_height');
			delete_option('ns_option_single_image_width');
			delete_option('ns_single_product_image');
			echo '<meta http-equiv="Refresh" content="0">';
		}
		
	/*<-- ******************************************* -->
					END SINGLE PRODUCT
	<-- ******************************************* -->*/
}



function ns_image_upload_loop(){

	/*<-- ******************************************* -->
					GENERAL IMAGE UPLOAD
	<-- ******************************************* -->*/
	// Save attachment ID
	
	if ( isset( $_POST['ns_loop_submit_image_selector'] ) && isset( $_POST['ns_loop_image_attachment_id'] ) ){
		update_option( 'ns_loop_image', absint( $_POST['ns_loop_image_attachment_id'] ) );
		// Update post with id $_POST['ns_single_image_attachment_id']
  		$ns_loop_image_to_update = array(
      		'ID'           => $_POST['ns_loop_image_attachment_id'],
      		'post_content' => 'ns_image',
  		);

		// Update the post into the database
  		wp_update_post( $ns_loop_image_to_update );
	}
	
	wp_enqueue_media();
	?>	
	<!-- ******************************************* -->
	<!-- LOOP -->
	<!-- ******************************************* -->
	<div class="ns_border_div_ns_themes">
		<h3><?php _e('Select image for loop page:', 'ns-iba-icon-badge-archive') ?></h3>
		<p class="description"><?php _e('Load or select an image for your shop\'s badges', 'ns-iba-icon-badge-archive')?> </p><br>
		<form method='post'>
			<div class='ns_image-preview-wrapper_1'>
				<img id='image-preview' class="ns_image-preview" src='<?php echo wp_get_attachment_url( get_option( 'ns_loop_image' ) ); ?>' height='100'>
			</div>
			<br>
			<input id="upload_image_button" type="button" class="ns_upload_image button" value="<?php _e( 'Upload image', 'ns-iba-icon-badge-archive' ); ?>" />
			<input type='hidden' name='ns_loop_image_attachment_id' id='ns_loop_image_attachment_id' class="image_attachment_id" value='<?php echo get_option( 'ns_loop_image' ); ?>'><br><br>
			<input type="submit" name="ns_loop_submit_image_selector" value="<?php _e('Save', 'ns-iba-icon-badge-archive') ?>" class="button-primary">
		</form>
	</div>
	<?php
	if(isset($_POST['ns_size_image_button']) && isset($_POST['ns_image_width']) && isset($_POST['ns_image_height'])) {
		if(!add_option("ns_option_image_height", $_POST['ns_image_height']))
			update_option("ns_option_image_height", $_POST['ns_image_height']);
		if(!add_option("ns_option_image_width", $_POST['ns_image_width']))
			update_option("ns_option_image_width", $_POST['ns_image_width']);
	}
	/*<-- ******************************************* -->
					INPUT SIZE IMAGE LOOP
	<-- ******************************************* -->*/
	$ns_badge_loop_width= get_option("ns_option_image_width");
	$ns_badge_loop_height= get_option("ns_option_image_height");
	if(empty($ns_badge_loop_width) && empty($ns_badge_loop_height)){

		$ns_badge_loop_width = "placeholder= \" \"";
		$ns_badge_loop_height = "placeholder= \" \"";
	}else{
		$ns_badge_loop_width = "value=\"$ns_badge_loop_width\"";
		$ns_badge_loop_height = "value=\"$ns_badge_loop_height\"";
	}
	?>
	<div class="ns_border_div_ns_themes">
		<h3><?php _e('Size:', 'ns-iba-icon-badge-archive') ?> </h3>
		<p class="description"><?php _e('enter image\'s width and height', 'ns-iba-icon-badge-archive')?></p>
		<form method='post' action="<?php echo $_SERVER["PHP_SELF"]."?page=badge-options&tab=loop_upload_image"?>">
			<table class="ns_table_size_image">
				<tr>
					<td class="ns_th_form_size_image"><?php _e('Width:', 'ns-iba-icon-badge-archive') ?> </td> 
					<td class="ns_th_form_size_image"> <input type="number" name="ns_image_width" <?php echo $ns_badge_loop_width ?>> px;<br></td>
				</tr>
				<tr>
					<td class="ns_th_form_size_image"> <?php _e('Height:', 'ns-iba-icon-badge-archive') ?></td>
					<td class="ns_th_form_size_image"> <input type="number" name="ns_image_height" <?php echo $ns_badge_loop_height ?>> px;<br><br></td>
				</tr>
			</table>
			<input type="submit" name="ns_size_image_button" class="button-primary" value="<?php _e('Save', 'ns-iba-icon-badge-archive') ?>">
		</form>
	</div>
		
	<!-- ******************************************* 
					DELETE OPTION BUTTON(loop)
	 ******************************************* -->
	<div class="ns_border_div_ns_themes">
		<form method='post' action="<?php echo $_SERVER["PHP_SELF"]."?page=badge-options&tab=loop_upload_image"?>">
			<h3><?php _e('Reset form:', 'ns-iba-icon-badge-archive')?></h3>
			<p class="description"><?php _e('remove image and sizes from shop page', 'ns-iba-icon-badge-archive')?></p>
		<?php
			submit_button(__('Delete', 'ns-iba-icon-badge-archive'), 'delete', 'ns_delete_loop_image_button');
		?>
		</form>
		<?php
		if(isset($_POST['ns_delete_loop_image_button'])){

			delete_option('ns_loop_image');
			delete_option('ns_option_image_height');
			delete_option('ns_option_image_width');
			echo '<meta http-equiv="Refresh" content="0">';
		}
		?>
	</div>
		

	<!-- ******************************************* -->
	<!-- END LOOP -->
	<!-- ******************************************* -->
	<?php

}


function ns_media_selector_print_scripts() {

	$ns_my_saved_attachment_post_id = get_option( 'ns_loop_image', 0 );
	
}
add_action( 'admin_footer', 'ns_media_selector_print_scripts' );


function ns_premium_version_page(){

	
	require_once(plugin_dir_path( __FILE__ ).'ns_admin_option_dashboard.php');

	?>
	
	<!-- <div class="ns_general_div_container">
		<div class="ns_div_grey_top">
			<a href="https://www.nsthemes.com/product-category/woocommerce-plugins/">
				<img src=" <?php //echo plugin_dir_url( __FILE__ ).'img/ns-bannerino.jpg';?> " id="ns_bannerino_top"class="ns_div_container_banner ns_color">
			</a>
		</div>


		<div class="ns_div_container_white">
			<h1 class="ns_title_premium">PREMIUM FEATURES</h1>
			<div class="ns_div_image_container_premium ns_div_position_left">
				<img src="<?php //echo plugin_dir_url( __FILE__ ).'img/ns_loop_sale.png';?> "id="ns_img_no_1" class="ns_images_premium_page_left ns_tilt_rev ">
			</div>
			<div class="ns_div_text_container_premium ns_div_position_right">
				<p class="ns_description_premium_page ns_text_position_right">
					<span class="ns_text_title_premium">SET BADGE POSITION</span><br><br> Set badge position where you want!<br> You can choose differents positions<br> for loop and single product page for<br> the same product!
				</p>
			</div>
			
		</div>
		<div class="ns_div_container_grey">
			<div class="ns_div_text_container_premium ns_div_position_left">
				<p id="ns_text_no_2" class="ns_description_premium_page ">
					<span  class="ns_text_title_premium ">CUSTOM BADGE</span><br><br> Change text color! You can<br> choose the text color if you're not<br> satisfied of default browsers colors!
				</p>
			</div>
			<div class="ns_div_image_container_premium ">
				<img src="<?php //echo plugin_dir_url( __FILE__ ).'img/single_product-image.png';?> " id="ns_img_no_2" class="ns_images_premium_page_left ns_tilt">
			</div>

			
		</div>

		<div class="ns_div_container_white">
			<div id="ns_div_image_no_3"class="ns_div_image_container_premium ns_div_position_left ns_padding_top">
				<img src="<?php //echo plugin_dir_url( __FILE__ ).'img/options-position.png';?> " id="ns_img_no_3" class="ns_images_premium_page_left ns_tilt_rev">
			</div>
			<div  id="ns_div_text_no_3" class="ns_div_image_container_premium ns_div_position_right ns_padding_top">
				<p class="ns_description_premium_page ns_text_position_right">
					<span class="ns_text_title_premium">BADGE POSITION OPTIONS</span><br><br> If you want change badge position<br> you can change this values<br> for the product you are editing!
				</p>
			</div>
			
		</div>

		<div class="ns_div_container_grey">
			<div class="ns_div_text_container_premium ns_div_position_left ns_padding_top">
				<p id="ns_text_no_2" class="ns_description_premium_page ">
					<span  class="ns_text_title_premium ">MULTIPLE BADGE</span><br><br> Same badge for multiple<br> products in the same position!
				</p>
			</div>
			<div class="ns_div_image_container_premium ns_padding_top">
				<img src="<?php //echo plugin_dir_url( __FILE__ ).'img/multiple-images.png';?> " id="ns_img_no_3" class="ns_images_premium_page_left ns_tilt">
			</div>

			
		</div>


		<div class="ns_div_container_white">
			<a href="https://www.nsthemes.com/product-category/woocommerce-plugins/">
				<div class="ns_div_white_down">
					<img src=" <?php //echo plugin_dir_url( __FILE__ ).'img/ns-bannerino.jpg';?> " class="ns_div_container_banner ns_color">
				</div>
			</a>
		</div>

	</div> -->
	<?php
}
?>