<?php
function ssp_info() {
	if (is_front_page()) {
	$options = get_option('ssp');
	echo '<!-- Structured Social Profiles Plugin for WordPress: http://peadig.com/wordpress-plugins/structured-social-profiles/ -->
<script type="application/ld+json">
{ "@context" : "http://schema.org",
"@type" : "'.$options['type'].'",
';
	if (!empty($options['org']) && $options['type']=="Organization") { echo '"name" : "'.$options['org'].'",
'; }
	elseif (!empty($options['name']) && $options['type']=="Person") { echo '"name" : "'.$options['name'].'",
'; }
	echo '"url" : "'.get_bloginfo('url').'",';
	if (!empty($options['logo'])) { echo '"logo" : "'.$options['logo'].'",
'; }
	echo '"sameAs" : [ 
';
	if (!empty($options['facebook'])) {
		echo '"'.$options['facebook'].'",
';
	}
	if (!empty($options['twitter'])) {
		echo '"'.$options['twitter'].'",
';
	}
	if (!empty($options['gplus'])) {
		echo '"'.$options['gplus'].'",
';
	}
	if (!empty($options['instagram'])) {
		echo '"'.$options['instagram'].'",
';
	}
	if (!empty($options['youtube'])) {
		echo '"'.$options['youtube'].'",
';
	}
	if (!empty($options['linkedin'])) {
		echo '"'.$options['linkedin'].'"
';
	}
	if (!empty($options['myspace'])) {
		echo '"'.$options['myspace'].'"
';
	}
	echo ']
}
</script>';
}
}
add_action('wp_head', 'ssp_info');
?>