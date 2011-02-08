=== Hotfix ===
Contributors: markjaquith, wordpressdotorg
Tags: hotfix, bugs, wordpress, update
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 0.3

Provides fixes for selected WordPress bugs, so you don't have to wait for the next WordPress core release.

== Description ==

This plugin provides fixes for selected WordPress bugs, so you don't have to wait for the next WordPress core release. **This does not mean you can stop updating WordPress!** It just means that you'll get a few selected fixes more quickly.

Recent fixes:

* **WordPress 3.0.5**
	* Prevent KSES from overzealously stripping images and other advanced HTML from Administrator/Editor comments on display.

Fixes are specific to your version of WordPress. It may be that your version of WordPress has no fixes. That's fine. Keep the plugin activated and updated, in case you need it for a subsequent version of WordPress!

== Installation ==

1. [Click here](http://coveredwebservices.com/wp-plugin-install/?plugin=hotfix) to install and activate.

2. Done! Just remember to keep the plugin up to date!

== Frequently Asked Questions ==

= How do I know which hotfixes are being applied to my version? =

Read the "Complete Hotfix List" section in the description. A later version of the plugin may list the hotfixes in a special WordPress admin page.

== Changelog ==

= 0.3 =
* Adds a filter, and fixes a PHP warning for people on versions with no hotfixes available.

= 0.2 =
* Better 3.0.5 comment text KSES fix for the admin. Allows you to see safe HTML in the admin.
* Remove the cws_ prefixes. This may become official.

= 0.1 =
* First version
* Hotfix for WP 3.0.5 comment text KSES overzealousness.

== Upgrade Notice ==
= 0.3 =
If you're not running WordPress 3.0.5 and you're getting a "Line 19" error, this update will fix that.

= 0.2 =
Allows you to see safe HTML in the admin.

== Complete Hotfix List ==

* **WordPress 3.0.5**
	* Prevent KSES from overzealously stripping images and other advanced HTML from Administrator/Editor comments on display.
