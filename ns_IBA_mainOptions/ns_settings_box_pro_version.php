<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="nsbigbox<?php echo $ns_style; ?>">
	<div class="titlensbigbox<?php echo $ns_style; ?>">
		<h4><?php echo strtoupper($ns_full_name); ?> <?php _e( 'PREMIUM VERSION', 'ns-facebook-pixel-for-wp' ); ?></h4>
	</div>
	<div class="contentnsbigbox">
		<p>	<?php _e( 'ALL FREE VERSION FEATURES and:', 'ns-facebook-pixel-for-wp' ); ?><br/><br/> <?php echo $ns_premium_feature_list; ?></p>
		<a id="fbp4wplinkpremiumsidebar" href="<?php echo $link_sidebar; ?>" target="_blank" class="linkBigBoxNS">
			<div class="buttonNsbigbox<?php echo $ns_style; ?>">
				<?php _e( 'UPGRADE!', 'ns-facebook-pixel-for-wp' ); ?>
			</div>
		</a>
	</div>
</div>