<?php
/*
Plugin Name: WPSSL (WordPress with SSL)
Plugin URI: http://austindev.com/wordpress-plugins/wpssl
Description: Check to see if the page has the "force_ssl" meta tag, if it does it will send the user to the SSL side.  It will also make sure to load any page elements via SSL as well so that users will not get warnings or errors.  You can use this for a page that you want secure (like a contact form).
Author: Austin Web Development
Version: 1.1.3
Author URI: http://austindev.com
*/

// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

function wpssl_showlink($value)
{
	if($_SERVER['SERVER_PORT'] == '443') 
	{
		$value = preg_replace('|/+$|', '', $value);
		$value = preg_replace('/http:\/\//', 'https://', $value);
	}
	//$value = str_replace("http", "https", $value);
	return $value;	
	
}

function wpssl_forcessl() 
{
	global $post;
	
    $post_id = $post;
   
           
    if (is_object($post_id)) 
    {
		$post_id = $post_id->ID;
	}
	
	
	// Todo: Maybe add a "check box" for each post (make it easy to force_ssl)
    $force_ssl  = get_post_meta($post_id, 'force_ssl');

    // Is it empty?
    if(!empty($force_ssl))
    {
    	// Check to see if we are in admin area, if we are don't "redirect"
    	if(!stristr($_SERVER['REQUEST_URI'], 'wp-admin'))
		{
    		// If we are not in SSL mode, redirect.  If we are then we don't need to do anything
        	if($_SERVER['SERVER_PORT'] != '443') 
        	{
            	$newurl = "https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            	header("Location: $newurl");
            	exit();
        	}
        }
    }
}

function wpssl_usessl($value) 
{
	
	// Specific fix for WPCF 7 issue (look to see if WPCF7 is installed)
	if(defined('WPCF7_VERSION'))
	{
		if($_SERVER['SERVER_PORT'] == '443')
		{
			define('WPCF7_CAPTCHA_TMP_URL', 'https://'.$_SERVER["SERVER_NAME"].'/wp-content/uploads/wpcf7_captcha/');
		}
	}
	
	// Specific fix for plugin: Hover
	if(defined('HOVER_BASE'))
	{
		if($_SERVER['SERVER_PORT'] == '443')
		{
			define('HOVER_BASE', 'https://'.$_SERVER["SERVER_NAME"].'/wp-content/plugins/hover/');
			define('HOVER_DOMTT_URL', HOVER_BASE."/domTT");
		}
	}
	
	// Fix for a-slideshow plugin
	//str_replace("http", "https", WP_PLUGIN_URL);
	//$aslideshowFix = 'https://'.$_SERVER["SERVER_NAME"].'/wp-content/plugins';
	//define('WP_PLUGIN_URL', $aslideshowFix);

	if($_SERVER['SERVER_PORT'] == '443') 
	{
		$value = preg_replace('|/+$|', '', $value);
		$value = preg_replace('/http:\/\//', 'https://', $value);
	}
	return $value;
}

// If we have the force_ssl make the site redirect to SSL
add_action('wp', 'wpssl_forcessl', 0);

// Filter to get any poorly written plugins
add_filter('all_options', 'wpssl_usessl', 0);
add_filter('the_content', 'wpssl_usessl', 0);

?>