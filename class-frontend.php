<?php
function ssp_info() {
	if (is_front_page()) {
	$options = get_option('ssp');
	$ssp = '';
	$ssp .= '<!-- Structured Social Profiles Plugin for WordPress: http://peadig.com/wordpress-plugins/structured-social-profiles/ -->
<script type="application/ld+json">
{ "@context" : "http://schema.org",
"@type" : "'.$options['type'].'",
';
	if (!empty($options['org']) && $options['type']=="Organization") { $ssp .= '"name" : "'.$options['org'].'",
'; }
	elseif (!empty($options['name']) && $options['type']=="Person") { $ssp .= '"name" : "'.$options['name'].'",
'; }
	$ssp .= '"url" : "'.get_bloginfo('url').'",';
	if (!empty($options['logo'])) { $ssp .= '"logo" : "'.$options['logo'].'",
'; }
	$ssp .= '"sameAs" : [ 
';
	if (!empty($options['facebook'])) {
		$ssp .= '"'.$options['facebook'].'",
';
	}
	if (!empty($options['twitter'])) {
		$ssp .= '"'.$options['twitter'].'",
';
	}
	if (!empty($options['gplus'])) {
		$ssp .= '"'.$options['gplus'].'",
';
	}
	if (!empty($options['instagram'])) {
		$ssp .= '"'.$options['instagram'].'",
';
	}
	if (!empty($options['youtube'])) {
		$ssp .= '"'.$options['youtube'].'",
';
	}
	if (!empty($options['linkedin'])) {
		$ssp .= '"'.$options['linkedin'].'",
';
	}
	if (!empty($options['myspace'])) {
		$ssp .= '"'.$options['myspace'].'",
';
	}
	//$ssp = rtrim($ssp,",");
	$ssp = substr($ssp, 0, -2);
	$ssp .= '
]
}
</script>';
}
echo $ssp;
}
add_action('wp_head', 'ssp_info');
?>