<?php
$_SITE['theme'] = 'theme-gcweb';
$_SITE['lang'] = 'en';
$_SITE['langdir'] = 'ltr';
$_SITE['showproblembutton'] = true;
$_SITE['showsharebutton'] = true;
$_SITE['accountsettingsurl'] = '';
$_SITE['homelinks'] = '<li><a href="https://www.canada.ca/en.html">Home</a></li>';
$_SITE['langselecturl'] = '/langselect/lang.php';
$_SITE['searchurl'] = '/search/search.php';
$_SITE['searchsettings'] = ''; // For additional hidden form fields.
$_SITE['name'] = 'Government of Canada';
$_SITE['shortname'] = 'Canada.ca';

$_SITE['webroot'] = 'http://localhost/wet-boew-ised/theme/test/framework/new';     // Root URL of website.
$_SITE['fileroot'] = $CFG->dirroot;    // Root Folder of website.
$_SITE['wet-boew'] = '/wetboew-ised/theme/test/framework/themes-dist/' . $_SITE['theme'];     // Path to WETBOEW themes relative to root.
//$_SITE['wet-boewphp'] = '../framework/wet-boew-php'; // Path to WET-BOEW-PHP relative to root.

/* Default settings for page */
$_PAGE['showsearch'] = true;
$_PAGE['showmegamenu'] = true;
$_PAGE['showsectmenu'] = false;
$_PAGE['description'] = '';
$_PAGE['breadcrumbs'] = '<li><a href="/">Home</a></li>';
$_PAGE['title'] = 'Home';
$_PAGE['heading'] = $_PAGE['title'];
$_PAGE['content'] = '[[content goes here]]';
$_PAGE['lastmodified'] =  date("Y-m-d", filemtime(__FILE__));
$_PAGE['extrahead'] = '';   // Inserted just before </head>.
$_PAGE['extraheader'] = ''; // Inserted right after </body>.
$_PAGE['extrafooter'] = ''; // Inserted just before </body>.

include 'lang/' . $_SITE['lang'] . '.php';

?>