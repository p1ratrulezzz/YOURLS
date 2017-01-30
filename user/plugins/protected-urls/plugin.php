<?php
/*
Plugin Name: Protected URLS
Plugin URI: http://yourls.org/
Description: Show password page for Protected Urls
Version: 1.0
Author: ID
Author URI: http://demirel.ws/
*/

// Hook our custom function into the 'pre_redirect' event
yourls_add_action( 'redirect_shorturl', 'gural_yourls_protected_keyword' );

// Our custom function that will be triggered when the event occurs
function gural_yourls_protected_keyword( $args ) {

	require_once( YOURLS_INC.'/functions.php' );
	
	$longurl = $args[0];
	$keyword = $args[1];
	
	$pass = yourls_get_keyword_pass($keyword);
	
	//echo "Pass : ".$pass." <br>";die();
	
	if (empty($pass)) {
		return true;
	}
	elseif (isset($pass) && $pass != "")
	{
		$postedPass = $_POST['pass'];
		if (!$postedPass || $pass != $postedPass)
		{
			echo GetPasswordForm();
			die();
		}else
		{
			$update_clicks = yourls_update_clicks( $keyword );
		}
	}else
	{
		echo "Not Protected";
		die();
	}
}


function GetPasswordForm()
{
	yourls_html_head( 'preview', 'Short URL preview' );
		
	$form=<<<HTML
<section>				
        <div id="container_demo" >
            <div id="wrapper">
				<form method="post" action="$url"> 
					<p class="text"> 
						<strong>Provide Password</strong><br /><input type="text" id="submit-pass" name="pass" value="" class="text" size="40" />
					<p class="login button"> 
						<input type="submit" /> 
					</p>
				</form>
            </div>
        </div>  
    </section>
HTML;
	
	//yourls_html_footer();
	
	return $form;
}
