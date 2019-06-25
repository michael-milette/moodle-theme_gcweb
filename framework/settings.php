<?php
// This file is part of the WET-BOEW-Moodle Internet theme for Moodle
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The columns layout for the WET-BOEW-Moodle Internet theme.
 *
 * @package   theme_wetboew_internet
 * @copyright 2016-2019 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
 defined('MOODLE_INTERNAL') || die();

global $_PAGE;

$_PAGE['searchsettings'] = ''; // For additional hidden form fields.
//$_PAGE['shortname'] = 'Canada.ca';
$_PAGE['themewww'] = $CFG->wwwroot . '/theme/wetboew_internet';     // Absolute path to this theme.

/* Default settings for page */
$_PAGE['lang'] = current_language();
$_PAGE['showsearch'] = true;
$_PAGE['showmegamenu'] = true;
$_PAGE['showsectmenu'] = false;
$_PAGE['description'] = '';
$_PAGE['breadcrumbs'] = '<li><a href="/">Home</a></li>';
$_PAGE['lastmodified'] = date('Y-m-d', getlastmod());// date("Y-m-d", filemtime(__FILE__));
$_PAGE['extrahead'] = '';   // Inserted just before </head>.
$_PAGE['extraheader'] = ''; // Inserted right after </body>.
$_PAGE['extrafooter'] = ''; // Inserted just before </body>.

// This setting will cause the userdate() function not to fix %d in
// date strings, and just let them show with a zero prefix.
$CFG->nofixday = true;

// Insert extra head content just before </HEAD>.
$_PAGE['standard_head_html'] = $OUTPUT->standard_head_html();
// Remove <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
$_PAGE['standard_head_html'] = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', '', $_PAGE['standard_head_html']);

// Search engine
$_PAGE['showsearch'] = empty($PAGE->layout_options['nosearch']) && (!empty($CFG->enableglobalsearch) || has_capability('moodle/search:query', context_system::instance()));
$_PAGE['searchurl'] = $CFG->wwwroot . '/course/search.php';
//die(empty($PAGE->layout_options['langmenu']) ? "true":"false");
// Show language menu
if (!empty($CFG->langmenu)
        && (!isset($PAGE->layout_options['langmenu']) || $PAGE->layout_options['langmenu'] != false)
        && ($PAGE->course == SITEID or empty($PAGE->course->lang)) 
        && count($langs = get_string_manager()->get_list_of_translations()) > 1
        && $_SERVER['REQUEST_METHOD'] != 'POST') { // No language switching after a form POST.
    $_PAGE['langmenu'] = $OUTPUT->wet_lang_menu();
} else {
    $_PAGE['langmenu'] = '';
}

// Show Problem button
$_PAGE['showproblembutton'] = true;
$_PAGE['showsharebutton'] = false; // WET "Share" button is not compatible with fr_ca language.

// Page title tag and the page's H1 heading.
$_TITLES = [
    '/my/index.php' => 'Hello',//get_string('mymoodle', 'my'),
];
$_PAGE['url'] = substr($PAGE->url, strlen($CFG->wwwroot));
$_PAGE['title'] = $_TITLES[$_PAGE['url']] ?? $OUTPUT->page_title();
$_PAGE['heading'] = $_PAGE['title'];

// Breadcrumbs
$_PAGE['breadcrumbs'] = $OUTPUT->navbar();

// Document type.
$_PAGE['doctype'] = $OUTPUT->doctype();

// HTML tag attributes.
$_PAGE['htmlattributes'] = $OUTPUT->htmlattributes();
if (strpos($_PAGE['htmlattributes'], 'xml') !== false) { // Trim off: xml:lang="en".
    $_PAGE['htmlattributes'] = substr($_PAGE['htmlattributes'], 0, strpos($_PAGE['htmlattributes'], 'xml'));
}

// BODY tag attributes.
if (isloggedin() && !isguestuser()) {
    $_PAGE['navdraweropen']= (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $_PAGE['navdraweropen'] = false;
}
$extraclasses = [];
if ($_PAGE['navdraweropen']) {
    $extraclasses[] = 'drawer-open-left';
}
$_PAGE['bodyattributes'] = $OUTPUT->body_attributes($extraclasses);

/* If secondary nav */
$_PAGE['skiptosectnav'] = '';
if(!empty($_PAGE['showsectmenu'])) {
    $_PAGE['skiptosectnav'] = '<li class="wb-slc visible-sm visible-md visible-lg><a class="wb-sl" href="#wb-info">' . $_STRINGS['skiptosectnav'] . '</a></li>';
}

// Signon: 1 show logged-in, 0 don't show, -1 logged-out.
$_PAGE['signon'] = (isguestuser() || !isloggedin()) ? -1 : 1;

// URL of Sign-On button.
$_PAGE['signonurl'] = empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/' : $CFG->alternateloginurl;
$_PAGE['registerurl'] = !empty($CFG->alternateloginurl) ? '' : $CFG->wwwroot . '/login/signup.php';

// URL of Sign-out button.
$_PAGE['signouturl'] = $CFG->wwwroot . '/login/logout.php';

// URL of Profile settings button.
if (has_capability('moodle/user:editownprofile', context_system::instance())) {
    $_PAGE['accountsettingsurl'] = $CFG->wwwroot . '/user/profile.php';
}

// User menu - If signed in.
if(!$_PAGE['signon']) {
    $_PAGE['usermenu'] = '';//TODO: $OUTPUT->full_header();//$OUTPUT->page_heading_menu();
} else {
    $_PAGE['usermenu'] = '';
}
if(strpos($_PAGE['usermenu'], '<form')) {
    $_PAGE['usermenu'] = '<div class="singlebutton"><form id="customisethis"' . substr($_PAGE['usermenu'], strpos($_PAGE['usermenu'], '<form') + 5);
    $_PAGE['usermenu'] = substr($_PAGE['usermenu'], 0, strrpos($_PAGE['usermenu'], 'form>') + 5) . '</div>';
} else {
    $_PAGE['usermenu'] = '';
}
$_PAGE['usermenu'] = $_PAGE['signon'] ? $OUTPUT->user_menu() . $OUTPUT->navbar_plugin_output() . $_PAGE['usermenu'] : '';

$_PAGE['regionmainsettingsmenu'] = $OUTPUT->region_main_settings_menu();
$_PAGE['hasregionmainsettingsmenu'] = !empty($_PAGE['regionmainsettingsmenu']);

// Footer
$_PAGE['hasfooter'] = (empty($PAGE->layout_options['nofooter']));

// Sidebars
$_PAGE['maxcolumns'] = 2;

// Site name and page title.
$_PAGE['sitename'] = format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), "escape" => false]);
$_PAGE['pagetitle'] = $OUTPUT->pagetitle($PAGE->title);
$_PAGE['bodyattributes'] = $OUTPUT->body_attributes();

$_PAGE['lastmodified'] = date('Y-m-d', $PAGE->course->timemodified);
$_PAGE['showregister'] = (isguestuser() || !isloggedin()); // TODO: Determine if registration is enabled.
$_PAGE['registerurl'] = empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/signup.php' : $CFG->alternateloginurl;
$_PAGE['loggedin'] = (!isguestuser() && isloggedin());
$_PAGE['signonurl'] = empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/' : $CFG->alternateloginurl;
$_PAGE['signouturl'] = $CFG->wwwroot . '/login/logout.php';
$_PAGE['showaccountsettings'] = !(isguestuser() || !isloggedin());
$_PAGE['accountsettingsurl'] = $CFG->wwwroot . '/user/profile.php';
$_PAGE['pagebutton'] = str_replace('singlebutton', 'btn btn-default', $this->page_heading_button());

$_PAGE['flatnavigation'] = $PAGE->flatnav;
$_PAGE['analytics'] = '<!-- Google Tag Manager DO NOT REMOVE OR MODIFY - NE PAS SUPPRIMER OU MODIFIER -->
<noscript>
    <iframe title="Google Tag Manager" src="//www.googletagmanager.com/ns.html?id=GTM-TLGQ9K" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\': new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!=\'dataLayer1\'?\'&l=\'+l:\'\';j.async=true;j.src=\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);})(window,document,\'script\',\'dataLayer1\',\'GTM-TLGQ9K\');</script>
<!-- End Google Tag Manager -->
';

// Blocks
if ($_PAGE['hascontentpre']  = $PAGE->blocks->region_has_content('content-pre', $OUTPUT)) {
    $_PAGE['contentpre'] = $OUTPUT->blocks('content-pre');
} else {
    $_PAGE['contentpre'] = '';
}
if ($_PAGE['hascontentpost'] = $PAGE->blocks->region_has_content('content-post', $OUTPUT)) {
    $_PAGE['contentpost'] = $OUTPUT->blocks('content-post');
} else {
    $_PAGE['contentpost'] = '';
}

$_PAGE['blockspre'] = $OUTPUT->blocks('side-pre');
$_PAGE['hassidepre'] = strpos($_PAGE['blockspre'], 'data-block=') !== false;
//$_PAGE['hassidepre'] = empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$_PAGE['blockspost'] = $OUTPUT->blocks('side-post');
$_PAGE['hassidepost'] = empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$_PAGE['hasblocks'] = $_PAGE['hassidepre'] || $_PAGE['hassidepost'];

$_PAGE['sidebar'] = 'right';

// $_PAGE['showsecnav'] = true;
// $_PAGE['description'] = '';

// --------------------- TO VERIFY ----------------------------
// $_SITE['theme'] = 'theme-gcweb';
// $_SITE['lang'] = 'en';
// $_SITE['langdir'] = 'ltr';
// $_SITE['showsearch'] = true;
// $_SITE['showmegamenu'] = true;
// $_SITE['showloginout'] = true;
// $_SITE['showproblembutton'] = true;
// $_SITE['showsharebutton'] = true;
// $_SITE['homelinks'] = '<li><a href="https://www.canada.ca/en.html">Home</a></li>';
// $_SITE['langselecturl'] = '/langselect/lang.php';
// $_SITE['searchurl'] = '/search/search.php';
// $_SITE['searchsettings'] = ''; // For additional hidden form fields.
// $_SITE['name'] = 'Government of Canada';
// $_SITE['shortname'] = 'Canada.ca';

// $_SITE['webroot'] = 'http://localhost/wet-boew-ised/theme/wetboew_internet/framework';     // Root URL of website.
// // $_SITE['fileroot'] = './';    // Root Folder of website.
// $_SITE['wetboew'] = '../framework/themes-dist/' . $_SITE['theme'];     // Path to WETBOEW themes relative to root.
// $_SITE['wet-boewphp'] = '../framework/wet-boew-php'; // Path to WET-BOEW-PHP relative to root.

// /* Default settings for page */
// $_PAGE['showsectmenu'] = false;
// $_PAGE['title'] = '';
// $_PAGE['description'] = '';
// $_PAGE['breadcrumbs'] = '<li><a href="/">Home</a></li>';
// $_PAGE['title'] = 'Home';
// $_PAGE['heading'] = $_PAGE['title'];
// $_PAGE['content'] = '[[content goes here]]';
// $_PAGE['lastmodified'] =  date("Y-m-d", filemtime(__FILE__));
// $_PAGE['extrahead'] = '';   // Inserted just before </head>.
// $_PAGE['extraheader'] = ''; // Inserted right after </body>.
// $_PAGE['extrafooter'] = ''; // Inserted just before </body>.

// include 'lang/' . $_SITE['lang'] . '.php';