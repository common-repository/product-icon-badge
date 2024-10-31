<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once( plugin_dir_path( __FILE__ ).'inc.php');

$link_sidebar = $ns_url_plugin_premium.'?ref-ns=2&campaign=PIB-sidebar&utm_source='.$ns_menu_label.'%20Sidebar&utm_medium=Sidebar%20dentro%20settings&utm_campaign='.$ns_menu_label.'%20Sidebar%20premium';
$link_bannerino = $ns_url_plugin_premium.'?ref-ns=2&campaign=PIB-bannerino&utm_source='.$ns_menu_label.'%20Bannerino&utm_medium=Bannerino%20dashboard&utm_campaign='.$ns_menu_label.'%20Bannerino%20premium'; 
$link_bannerone = $ns_url_plugin_premium.'?ref-ns=2&campaign=PIB-bannerone&utm_source='.$ns_menu_label.'%20Bannerone&utm_medium=Bannerone%20dashboard&utm_campaign='.$ns_menu_label.'%20Bannerone%20premium'; 
$link_promo_theme = $ns_url_theme_promo.'?ref-ns=2&campaign='.$ns_theme_promo_slug.'&utm_source='.$ns_theme_promo_slug.'%20'.$ns_menu_label.'%20Sidebar&utm_medium=Sidebar%20'.$ns_theme_promo_slug.'%20dentro%20settings&utm_campaign='.$ns_theme_promo_slug.'%20'.$ns_menu_label.'%20Sidebar%20premium';
?>

	    <div class="verynsbigbox">
	    	<?php 
	    		/* *** BOX THEME PROMO *** */
				require_once( plugin_dir_path( __FILE__ ).'ns_settings_box_theme_promo.php');

	    		/* *** BOX PREMIUM VERSION *** */
				require_once( plugin_dir_path( __FILE__ ).'ns_settings_box_pro_version.php');

	    		/* *** BOX NEWSLETTER *** */
				//require_once( plugin_dir_path( __FILE__ ).'ns_settings_box_newsletter.php');
			?>			
		</div>
	   

		<div class="verynsbigboxcontainer">

	<div class="postbox nsproversionfbpx4wp">
        <h3 class="titprofbpx4wp"><?php _e( 'Upgrade to the PREMIUM VERSION', 'ns-iba-icon-badge-archive' ); ?></h3>
	        <div class="colprofbpx4wp">
	        <h2 class="titlefbpx4wp"><?php _e('How to use', $ns_text_domain); ?></h2><br><br>
				        	
	        <iframe width="100%" height="250" src="https://www.youtube.com/embed/ibh9BW3cR0o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	        </div>
	        <div class="colprofbpx4wp2">
	        	<h2 class="titlefbpx4wp2"><?php _e( 'Upgrade or get support:', 'ns-iba-icon-badge-archive' ); ?></h2><br><br>
				<?php _e( 'If you upgrade your plugin you will get one year of free updates and support
				through our website available 24h/24h. Upgrade and you\'ll have the advantage
				of additional features of the premium version.', 'ns-iba-icon-badge-archive' ); ?>
				<br><br>
				<a id="fbp4wplinkpremiumboxpremium" class="button-primary" href="<?php echo $link_bannerino; ?>" target="_blank"><?php _e( 'Get Premium Now', 'ns-iba-icon-badge-archive' ); ?></a>
	        </div>
    </div>






