<?php
/*
Plugin Name: Grandex Popup Signup	
Description: This plugin prompts a user to signup for a newsletter after visiting the site 3 times. 
Version: 1.0
Author: Daniel Martinez
License: GPLv2
*/
if(!is_admin()):

function grandexpopup_enqueue_scripts() {

	wp_register_script( 'jquery-cookie',plugins_url( '/grandex-popup-signup/jquery.cookie.js'));
	wp_register_script( 'jquery-magnific',plugins_url( '/grandex-popup-signup/jquery.magnific-popup.js') );	

	wp_enqueue_script( 'jquery');

	wp_enqueue_script( 'jquery-cookie',plugins_url( '/grandex-popup-signup/jquery.cookie.js'),array('jquery'));	
	wp_enqueue_script ( 'jquery-magnific',plugins_url( '/grandex-popup-signup/jquery.magnific-popup.js'),array('jquery'));

	wp_enqueue_style( 'grandexpopupstyle', plugins_url( '/grandex-popup-signup/style.css') );
	wp_enqueue_style( 'grandexpopupmagnific', plugins_url( '/grandex-popup-signup/magnific-popup.css') );

}

add_action( 'init', 'grandexpopup_enqueue_scripts' );

?>

<div id="test-popup" class="white-popup mfp-hide">
	<h2>SUBSCRIBE TO OUR MAILING LIST</h2>
	<form action="/" method="post" id="subscribeform">
		
		<br>
		Email: <input type="text" name="emailfield" id="emailfield">
		<button type="button" name="formsubmitted" id="formsubmit">submit</button>
		<br>
		<br>
		I don't want to recieve funny emails
	</form>
	
</div>


<?php
if(!isset($_POST['formsubmitted'])):

	function grandexpopup_enqueue_js() {
		wp_register_script( 'grandexpopup_js',plugins_url( '/grandex-popup-signup/grandex-popup-signup.js') );	
		wp_enqueue_script( 'grandexpopup_js',plugins_url( '/grandex-popup-signup/grandex-popup-signup.js'),array('jquery'));	
	}

	add_action( 'wp_enqueue_scripts', 'grandexpopup_enqueue_js' );

endif;

add_action("wp_ajax_mailchimp_int", "mailchimp_int");

function mailchimp_int() {

	 if (isset($_POST['emailfield'])):
		$emailfieldpassed = $_POST['emailfield'];
		$submittedfromfield = 'Pop Up Form';

		include('mailchimpsrc/MailChimp.php');

		$MailChimp = new MailChimp('491c1d3db9dd3c9d79e1506f4ef0c036-us1');

		$result = $MailChimp->call('lists/subscribe',array(
			'id'             => '3e442fbcba',
			'email'          => array('email' => $emailfieldpassed),
			'merge_vars'     => array(
			'MERGE3' => $submittedfromfield,
			),
			'double_optin'       => false,
			'update_existing'    => true,
			'replace_intesrests' => false
		));

	 endif;		
}
endif;