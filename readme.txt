=== Protect pages and categories with login ===
Contributors: mrrotella
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WBR5M7GLCMJ2G
Tags: login, protect page with login, protect category with login
Requires at least: 3.5.1
Tested up to: 5.1
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Protect pages and categories with login using a shortcode.

== Description ==

This plugin protects pages and categories with login using a shortcode.
For page protection add a shortcode on the content and it will be prompted to login in order to view the content. After login user will be redirected to the requested page.
For category protection add a shortcode on the cetgory description and it will be prompted to login in order to view the category contents. After login user will be redirected to the requested category page.
You may also want to display a certain category or page depending on the user's roles. In the case of pages the content displayed will be replaced with the text "NOT ALLOWED", while in the case of categories the user who does not have the indicated role will be redirected to the homepage.

== Installation ==

= Minimum Requirements =

* WordPress 3.5 or greater
* PHP version 4 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install of "Protect pages and categories with login", log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "protect page and categories with login" and click Search Plugins. Once you've found our plugin you can view details about it such as the the point release, rating and description. Most importantly of course, you can install it by simply clicking "Install Now".

= Manual installation =

1. Upload `protect-page-and-categories-with-login` folder to the `/wp-content/plugins/` directory or install via zip
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How can I protect one page with login? =

Just add **[sp4ppcl_protect_page_with_login]** to the page content.

= How can I protect one category with login? =

Just add **[sp4ppcl_protect_page_with_login]** to the category description.

= How can I manage user's role permission in protected page or category? =

Just use **[sp4ppcl_protect_page_with_login role="[ROLE_TO_ENABLE]"]** shortcode to enable the view for setted user roles.
To enable more than one role use ; (semicolon) as separation char. Ex. **[sp4ppcl_protect_page_with_login role="author;subscriber"]**

= Why in the protected category the role check not work? =

Probably there are content associated with multiple category and one of that isn't protected.

== Screenshots ==

1. Page shortcode.
2. Category shortcode.

== Changelog ==

= 1.3 =
* Fixed minor bug (shortcode replacement on content with multiple category).
* Category abilitation pre-check

= 1.2 =
* Fixed minor bug (shortcode replacement on content with multiple category).

= 1.1 =
* Add user role control check.

= 1.0 =
* Release version.

== Translations ==

* English - default, always included
* Italiano - sempre incluso

*Note:* Feel free to translate this plugin in your language. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the ["Poedit Editor"](http://www.poedit.net/).