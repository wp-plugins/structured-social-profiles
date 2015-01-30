<?php
define("SSP_NAME","Structured Social Profiles");
define("SSP_TAGLINE","Add structured data to Google search results!");
define("SSP_URL","http://peadig.com/wordpress-plugins/structured-social-profiles/");
define("SSP_EXTEND_URL","http://wordpress.org/extend/plugins/facebook-comments-plugin/");
define("SSP_AUTHOR_TWITTER","alexmoss");
define("SSP_DONATE_LINK","https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WFVJMCGGZTDY4");

add_action('admin_init', 'ssp_init' );
function ssp_init(){
	$org = get_bloginfo('name');
	register_setting( 'ssp_options', 'ssp' );
	$new_options = array(
		'type' => 'Organization',
		'org' => $org,
		'name' => 'Your Name',
        'logo' => '',
		'facebook' => '',
		'twitter' => '',
		'gplus' => '',
		'instagram' => '',
		'youtube' => '',
		'linkedin' => '',
		'myspace' => ''
	);

	add_option( 'ssp', $new_options );
}


add_action('admin_menu', 'show_ssp_options');
function show_ssp_options() {
	add_options_page('Structured Social Profiles Options', 'Structured Social Profiles', 'manage_options', 'ssp', 'ssp_options');
}


function ssp_fetch_rss_feed() {
    include_once(ABSPATH . WPINC . '/feed.php');
	$rss = fetch_feed("http://peadig.com/feed");	
	if ( is_wp_error($rss) ) { return false; }	
	$rss_items = $rss->get_items(0, 3);
    return $rss_items;
}   

// ADMIN PAGE
function ssp_options() {
?>
    <link href="<?php echo plugins_url( 'admin.css' , __FILE__ ); ?>" rel="stylesheet" type="text/css">
    <div class="pea_admin_wrap">
        <div class="pea_admin_top">
            <h1><?php echo SSP_NAME?> <small> - <?php echo SSP_TAGLINE?></small></h1>
        </div>

        <div class="pea_admin_main_wrap">
            <div class="pea_admin_main_left">
                <div class="pea_admin_signup">
                    Want to know about updates to this plugin without having to log into your site every time? Want to know about other cool plugins we've made? Add your email and we'll add you to our very rare mail outs.

                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                    <form action="http://peadig.us5.list-manage2.com/subscribe/post?u=e16b7a214b2d8a69e134e5b70&amp;id=eb50326bdf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Address
                    </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL"><button type="submit" name="subscribe" id="mc-embedded-subscribe" class="pea_admin_green">Sign Up!</button>
                    </div>
                        <div id="mce-responses" class="clear">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>	<div class="clear"></div>
                    </form>
                    </div>

                    <!--End mc_embed_signup-->
                </div>

		<form method="post" action="options.php" id="options">
			<?php settings_fields('ssp_options'); ?>
			<?php $options = get_option('ssp'); ?>
			<table class="form-table">
                <tr valign="top"><th scope="row">Testing Tool</th>
                    <td>
                        Once you have entered settings below, you can test this via <a href="https://developers.google.com/webmasters/structured-data/testing-tool/" target="_blank">Google's Structured Data Testing Tool</a>
                    </td>
                </tr>
				<tr valign="top"><th scope="row"><label for="language">Type of Site</label></th>
					<td>
						<select name="ssp[type]">
							<option value="Organization" <?php selected( $options['type'], 'Organization' ); ?>>Organization</option>
							<option value="Person" <?php selected( $options['type'], 'Person' ); ?>>Person</option>
						</select>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><label for="org">Organization's Name</label></th>
					<td><input id="org" type="text" name="ssp[org]" value="<?php echo $options['org']; ?>" /> <small>if you're an organization, enter its name here</small></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="name">Person's Name</label></th>
					<td><input id="name" type="text" name="ssp[name]" value="<?php echo $options['name']; ?>" /> <small>if your site represents a person, enter the name here</small></td>
				</tr>
                <tr valign="top"><th scope="row"><label for="logo">Logo URL</label></th>
                    <td><input id="logo" type="text" name="ssp[logo]" value="<?php echo $options['logo']; ?>" /></td>
                </tr>
				<tr valign="top"><th scope="row"><label for="facebook">Facebook URL</label></th>
					<td><input id="facebook" type="text" name="ssp[facebook]" value="<?php echo $options['facebook']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="twitter">Twitter URL</label></th>
					<td><input id="twitter" type="text" name="ssp[twitter]" value="<?php echo $options['twitter']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="gplus">Google+ URL</label></th>
					<td><input id="gplus" type="text" name="ssp[gplus]" value="<?php echo $options['gplus']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="instagram">Instagram URL</label></th>
					<td><input id="instagram" type="text" name="ssp[instagram]" value="<?php echo $options['instagram']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="youtube">Youtube URL</label></th>
					<td><input id="youtube" type="text" name="ssp[youtube]" value="<?php echo $options['youtube']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="linkedin">Linkedin URL</label></th>
					<td><input id="linkedin" type="text" name="ssp[linkedin]" value="<?php echo $options['linkedin']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="myspace">Myspace URL</label></th>
					<td><input id="myspace" type="text" name="ssp[myspace]" value="<?php echo $options['myspace']; ?>" /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
</div>
            <div class="pea_admin_main_right">
                 <div class="pea_admin_box">

            <center><a href="http://peadig.com/?utm_source=<?php echo $domain; ?>&utm_medium=referral&utm_campaign=Facebook%2BComments%2BAdmin" target="_blank"><img src="<?php echo plugins_url( 'images/peadig-landscape-300.png' , __FILE__ ); ?>" width="220" height="69" title="Peadig">
            <strong>Peadig: the WordPress framework that Integrates Bootstrap</strong></a><br /><br />
            <a href="https://twitter.com/peadig" class="twitter-follow-button">Follow @peadig</a>
			<div class="fb-like" data-href="http://www.facebook.com/peadig" data-layout="button_count" data-action="like" data-show-faces="false"></div>
<div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/116387945649998056474" data-rel="publisher"></div>
<br /><br /><br />
                </div>
                   <center> <h2>Share the plugin love!</h2>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="<?php echo SSP_URL; ?>" data-layout="button_count" data-show-faces="true"></div>

                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo SSP_URL; ?>" data-text="Just been using <?php echo SSP_NAME; ?> #WordPress plugin" data-via="<?php echo SSP_AUTHOR_TWITTER; ?>" data-related="WPBrewers">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<a href="http://bufferapp.com/add" class="buffer-add-button" data-text="Just been using <?php echo SSP_NAME; ?> #WordPress plugin" data-url="<?php echo SSP_URL; ?>" data-count="horizontal" data-via="<?php echo SSP_AUTHOR_TWITTER; ?>">Buffer</a><script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
                    <div class="g-plusone" data-size="medium" data-href="<?php echo SSP_URL; ?>"></div>
                    <script type="text/javascript">
                      window.___gcfg = {lang: 'en-GB'};

                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                    <su:badge layout="3" location="<?php echo SSP_URL?>"></su:badge>
                    <script type="text/javascript">
                      (function() {
                        var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
                        li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
                      })();
                    </script>
<br /><br />
<a href="<?php echo SSP_DONATE_LINK; ?>" target="_blank"><img class="paypal" src="<?php echo plugins_url( 'images/paypal.gif' , __FILE__ ); ?>" width="147" height="47" title="Please Donate - it helps support this plugin!"></a></center>

                <div class="pea_admin_box">
                    <h2>About the Author</h2>

                    <?php
                    $default = "http://reviews.evanscycles.com/static/0924-en_gb/noAvatar.gif";
                    $size = 70;
                    $alex_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( "alex@peadig.com" ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                    ?>

                    <p class="pea_admin_clear"><img class="pea_admin_fl" src="<?php echo $alex_url; ?>" alt="Alex Moss" /> <h3>Alex Moss</h3><br />Alex Moss is the Co-Founder of <a href="http://peadig.com/" target="_blank">Peadig</a>, a WordPress framework built with Bootstrap. He has also developed several WordPress plugins (which you can <a href="http://peadig.com/wordpress-plugins/?utm_source=<?php echo $domain; ?>&utm_medium=referral&utm_campaign=Structured%2BSocial%2BProfiles%2BAdmin" target="_blank">view here</a>) totalling over 500,000 downloads.</p>
<center><br><a href="https://twitter.com/alexmoss" class="twitter-follow-button">Follow @alexmoss</a>
<div class="fb-subscribe" data-href="https://www.facebook.com/alexmoss1" data-layout="button_count" data-show-faces="false" data-width="220"></div>
<div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/+AlexMoss" data-rel="author"></div>
</div>

                    <h2>More from Peadig</h2>
    <p class="pea_admin_clear">
                    <?php
				$SSP_feed = ssp_fetch_rss_feed();
                echo '<ul>';
                foreach ( $SSP_feed as $item ) {
			    	$url = preg_replace( '/#.*/', '', esc_url( $item->get_permalink(), $protocolls=null, 'display' ) );
					echo '<li>';
					echo '<a href="'.$url.'?utm_source='.$domain.'&utm_medium=RSS&utm_campaign=Structured%2BSocial%2BProfiles%2BAdmin" target="_blank">'. esc_html( $item->get_title() ) .'</a> ';
					echo '</li>';
			    }
                echo '</ul>';
                    ?></p>


            </div>
        </div>
    </div>



<?php
}
?>