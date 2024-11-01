=== Plugin Name ===
Donate link: http://austindev.com
Tags: https,http,ssl,encrypted
Requires at least: 2.9
Tested up to: 3.0.1
Stable tag: 1.1.3

Check to see if the page has the "force_ssl" meta tag, if it does it will send the user to the SSL side.  It will also make sure to load any page elements via SSL as well so that users will not get warnings or errors.  You can use this for a page that you want secure (like a contact form).

== Description ==

This plugin will force a WordPress post or page to use https instead of http.  It is based off of "Dwamian's Per Page Force SSL" plugin, but this has been updated for us with WordPress 3.x.  Additionally, when a page is "forced" into SSL mode, it will make sure that all page elements are loaded via https (so that you won't get warnings).  If you have to link to a 3rd party external file, use the wpssl_showlink function (it will switch it between https and http).  The usage is <?php echo wpssl_showlink('http://this.is.some.3rd.party.tld/file.ext') ?> 

== Installation ==

* Upload to your '/wp-content/plugins'
* Enable the plugin in your admin section
* On a post or page you want under SSL, add the meta-tag key "force_ssl" and the value of "true".  Don't forget to save ;)
	
That's it you're done!

== Frequently Asked Questions ==

= I have enabled the plugin, but I get all sorts of "not found" errors =

You MUST have an SSL certificate installed at the same URL as your site.  So if your site is http://www.some-domain.com, your SSL certificate must be for https://www.some-domain.com.  I'm working on the ability to change that, but right now that's what I got :)

= I have enabled the plugin, but I don't see a lock icon =

There are a few reasons this could happen.  If you have a correctly installed SSL certificate, more than likely the site is loading "non-ssl" items.

= Can you add feature X? =

It depends on what feature X is.  I'd love to hear any suggestions or enhancement requests.  Contact me at http://help.austindev.com

= I'm having some issues, can you help? =

I can try.  I'm more than happy to take a look, contact me at http://help.austindev.com and I'll see what I can do.  

== Changelog ==

= 1.0 =

* Initial Release

= 1.1 =

* BUG: Resolved issue when saving a post, wpssl would "force" SSL of the admin section (thus making it appear you logged out)
* ENHANCEMENT: You no longer need to put in special code if you have WordPress Contact Form 7 installed, the plugin checks for that now
* Cleaned up some debug items in the code
* Added GPL License snippet in the file
* Fixed some typos in the README file

= 1.1.1 = 

* Updated change log a bit more (new FAQ questions, and typo fixes)
* Changed the minimum version (I guess I was using something that didn't exist in WP 2.8)

= 1.1.2 = 

* Updated change log to change the tested version
* ENHANCEMENT: Changed the add_filters to set a higher priority

= 1.1.3 = 

* Cleaned up the code more
* BUG: Fixed a issue where all content was made SSL (so the site wouldn't exit SSL mode)
* NEW: Added the wpssl_showlink function, for use in themes when you need to link to an external file
* Updated the readme.txt file

