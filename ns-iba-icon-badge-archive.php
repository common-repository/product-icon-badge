<?php
/*
Plugin Name: NS Product Icon Badge
Plugin URI: http://www.nsthemes.com/
Description: This plugin allows you to create custom badges for your products.
Version: 1.2.4
Author: NsThemes
Author URI: http://www.nsthemes.com
Text Domain: ns-iba-icon-badge-archive
Domain Path: /i18n
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'product-icon-badge',
    'main_file_name'            => 'ns-iba-icon-badge-archive.php',
    'redirect_after_confirm'    => 'admin.php?page=badge-options',
    'plugin_id'                 => '274',
    'plugin_token'              => 'NWQwMGFjZmNkODQ3NDRkNWY2MGQ2MmI4NTljZTIzMDYwN2RjMjcxZDI3Mzc4YTg3NmI2MGMyNGM1ZGUwODMyZjJkZjk4YzBiNDZiOWI=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj274 = new pluginEye($plugineye);
$plugineyeobj274->pluginEyeStart();      


function ns_admin_notice_deactivate_plugin() {

	if(is_plugin_active('ns-iba-icon-badge-archive/ns-iba-icon-badge-archive.php')){
    ?>
    <div class="update notice is-dismissible notice-success">
        <p><?php _e( 'Plugin Premium Product Icon Badge <strong>deactivated</strong>. Hit the <a href="">refresh</a> button to reload the page to begin using the plugin.', 'ns-iba-icon-badge-archive' ); ?></p>
    </div>
    <?php
   }
}

function ns_deactivate_plugins(){
	deactivate_plugins('ns-iba-icon-badge-archive-premium/ns-iba-icon-badge-archive-premium.php');
}

if(is_plugin_active('ns-iba-icon-badge-archive-premium/ns-iba-icon-badge-archive-premium.php')){
	
	add_action( 'admin_init', 'ns_deactivate_plugins' );
	activate_plugin('ns-iba-icon-badge-archive/ns-iba-icon-badge-archive.php');
	add_action( 'admin_notices', 'ns_admin_notice_deactivate_plugin' );


}else{
	/*
		INDICE DEI FILE INCLUSI

	1.0 INCLUSIONE ns_addNewBadgeTab.php
	2.0 INCLUSIONE ns_changeBadgeStyle.php
	3.0 INCLUSIONE ns_addNewOptionsPage.php
	4.0 INCLUSIONE tex domain
	5.0 INCLUSIONE ns_showHideOptions.js && ns_IBA_addNewMedia.js
	6.0 INCLUSIONE ns_badge_style.css
	7.0 INCLUSIONE ns_color_picker.js
	8.0 STAMPA DEL BADGE

	*/
	
	/*********************************************************
				1.0 INCLUSIONE ns_addNewBadgeTab.php
	*********************************************************/
	require_once( plugin_dir_path( __FILE__ ).'ns_IBA_mainOptions/ns_addNewBadgeTab.php');
	//include 'ns_addNewBadgeTab.php';

	/*********************************************************
			   2.0 INCLUSIONE ns_changeBadgeStyle.php
	*********************************************************/
	require_once( plugin_dir_path( __FILE__ ).'ns_IBA_mainOptions/ns_changeBadgeStyle.php');
	//include 'changeBadgeStyle.php';

	/*********************************************************
			   3.0 INCLUSIONE ns_addNewOptionsPage.php
	*********************************************************/
	require_once( plugin_dir_path( __FILE__ ).'ns_IBA_mainOptions/ns_addNewOptionsPage.php');//????????
	//include 'addNewOptionsPage.php';

	/*********************************************************
			   4.0 INCLUSIONE text domain
	*********************************************************/
	function ns_IBA_translate(){

	    load_plugin_textdomain('ns-iba-icon-badge-archive',false, basename( dirname( __FILE__ ) ) .'/i18n/');
	}
	add_action('plugins_loaded','ns_IBA_translate');

	/*********************************************************
	  5.0 INCLUSIONE ns_showHideOptions.js && ns_addNewMedia.js
	*********************************************************/
	function ns_show_hide_enqueue(){

		wp_enqueue_script( 'ns_show_hide_options', plugins_url( 'ASSETS/JS/ns_showHideOptions.js', __FILE__ ), array('jquery') );
	   	wp_enqueue_script('ns_media_update',  plugins_url( 'ASSETS/JS/ns_IBA_addNewMedia.js', __FILE__ ), array('jquery'));
	}
	add_action('admin_enqueue_scripts', 'ns_show_hide_enqueue');

	/*********************************************************
				6.0 INCLUSIONE ns_badge_style.css
	*********************************************************/
	function ns_badge_style_enqueue(){
		
		wp_enqueue_style('ns_badge_style',  plugins_url( 'ASSETS/CSS/ns_badge_style.css', __FILE__ ));
		wp_enqueue_style('ns_badge_style',  plugins_url( 'ASSETS/CSS/ns-option-css-page.css', __FILE__ ));


	}
	add_action( 'wp_enqueue_scripts', 'ns_badge_style_enqueue' );
	add_action( 'admin_enqueue_scripts', 'ns_badge_style_enqueue' );

	/*********************************************************
				7.0 INCLUSIONE ns_color_picker.js
	*********************************************************/


	function ns_color_picker_enqueue($hook) {
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'sl-script-handle', plugins_url( 'ASSETS/JS/ns_color_picker.js', __FILE__ ), array( 'wp-color-picker','jquery' ), false, true );
	}
	add_action( 'admin_enqueue_scripts', 'ns_color_picker_enqueue' );


	//Add DIV end element after shop loop item
	add_action('woocommerce_after_shop_loop_item', 'ns_add_container_after_shop_loop_item', 10, 0);
	function ns_add_container_after_shop_loop_item( ) {
	  echo "</div>";
	 };
	//Add DIV start element before shop loop item
	add_action('woocommerce_before_shop_loop_item', 'ns_add_container_before_shop_loop_item', 10, 0);
	function ns_add_container_before_shop_loop_item( ) {
	   echo "<div class='ns_container_div_image'>";
	};




	/*********************************************************
					8.0 STAMPA DEL BADGE
	*********************************************************/
	function ns_IBA_IconBadgeArchive(){

		$ns_badge_postid = get_the_ID(); //ottengo l'id del singolo prodotto

		if(get_post_meta($ns_badge_postid, '_ns_option_badge', true)==1){

			$ns_badge_string_output= get_post_meta($ns_badge_postid, '_ns_option_badge_text', true);
			$ns_shape_class=get_post_meta($ns_badge_postid, '_ns_option_badge_shape', true);
			
			$ns_post_id=get_option('ns_loop_image');
			$ns_post_id_single=get_option('ns_single_product_image');
			$ns_post_id_single_tab=get_post_meta($ns_badge_postid, '_ns_option_badge_single_product_image', true);
			if(is_shop()  && ($ns_post_id!=false || is_numeric($ns_post_id_single_tab))) {

				if(is_numeric($ns_post_id_single_tab))
					$ns_img_url_src = wp_get_attachment_image_src($ns_post_id_single_tab, 'full');
				else
					$ns_img_url_src = wp_get_attachment_image_src($ns_post_id, 'full');
				
				echo '<img src="'.$ns_img_url_src[0].' "class="ns_badge ns_custom_style-'.$ns_badge_postid.' ns_general_size_image-'.$ns_badge_postid.'">';
			
			}else if(is_product() && ($ns_post_id_single!=false || is_numeric($ns_post_id_single_tab))){

				if(is_numeric($ns_post_id_single_tab))
					$ns_img_url_src = wp_get_attachment_image_src($ns_post_id_single_tab, 'full');
				else
					$ns_img_url_src = wp_get_attachment_image_src($ns_post_id_single, 'full');
				
				echo '<img src="'.$ns_img_url_src[0].'" class="ns_badge ns_custom_style-'.$ns_badge_postid.' ns_general_size_image-'.$ns_badge_postid.'">';
			}
			else{
			?>
				<div class="ns_badge <?php echo  $ns_shape_class; ?> ns_custom_style-<?php echo $ns_badge_postid?>">
				<?php
				if('triangolo'==$ns_shape_class){
					echo '<div class="ns_tringle_class">';
					echo $ns_badge_string_output;
					echo '</div>';
				}
				else 
					echo $ns_badge_string_output;
				echo '</div>';
			}
		}
	}
	add_action('woocommerce_before_single_product_summary', 'ns_IBA_IconBadgeArchive');
	add_action('woocommerce_before_shop_loop_item', 'ns_IBA_IconBadgeArchive');
}


/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nsproducticonbadge_add_action_links' );

function nsproducticonbadge_add_action_links ( $links ) {	
 $mylinks = array('<a id="nspiblinkpremium" href="https://www.nsthemes.com/product/product-icon-badge/?ref-ns=2&campaign=PIB-linkpremium" target="_blank">'.__( 'Premium Version', 'ns-facebook-pixel-for-wp' ).'</a>');
return array_merge( $links, $mylinks );
}
?>