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
$_PAGE['themewww'] = $CFG->wwwroot . '/theme/wetboew_internet';     // Absolute path to this theme.

// Default settings for page.

$_PAGE['lang'] = current_language();
$_PAGE['showmegamenu'] = true;
$_PAGE['showsectmenu'] = false;
$_PAGE['description'] = '';
$_PAGE['breadcrumbs'] = '<li><a href="https://canada.ca/">Canada.ca</a></li><li><a href="http://www.ic.gc.ca/">{mlang en}<abbr title="Innovation, Science and Economic Development Canada">ISED</abbr>{mlang}{mlang fr-ca}<abbr title="Innovation, Sciences et Développement économique Canada">ISDE</abbr>{mlang}</a></li>';
$_PAGE['lastmodified'] = date('Y-m-d', getlastmod());// date("Y-m-d", filemtime(__FILE__));
$_PAGE['extrahead'] = '';   // Inserted just before </head>.
$_PAGE['extraheader'] = ''; // Inserted right after </body>.
$_PAGE['extrafooter'] = ''; // Inserted just before </body>.

// Cause the userdate() function not to fix %d in date strings. Just let them show with a zero prefix.

$CFG->nofixday = true;

// Insert extra head content just before </HEAD>.

$_PAGE['standard_head_html'] = $OUTPUT->standard_head_html();
// Remove <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
$_PAGE['standard_head_html'] = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', '', $_PAGE['standard_head_html']);

// Search engine

$_PAGE['showsearch'] = empty($PAGE->layout_options['nosearch']) && (!empty($CFG->enableglobalsearch) || has_capability('moodle/search:query', context_system::instance()));
$_PAGE['searchurl'] = $CFG->wwwroot . '/course/search.php';

// Show language menu

if (!empty($CFG->langmenu)
        && (!isset($PAGE->layout_options['langmenu']) || $PAGE->layout_options['langmenu'] != false)
        && ($PAGE->course == SITEID or empty($PAGE->course->lang)) 
        && count($langs = get_string_manager()->get_list_of_translations()) > 1
        && $_SERVER['REQUEST_METHOD'] != 'POST') { // Language switching not available after a form POST.
    $_PAGE['langmenu'] = $OUTPUT->wet_lang_menu();
} else {
    $_PAGE['langmenu'] = '';
}

// Show Problem button

$_PAGE['showproblembutton'] = true;
$_PAGE['showsharebutton'] = false; // WET "Share" button is not compatible with fr-ca language.

// Breadcrumbs

$_PAGE['breadcrumbs'] = format_text($_PAGE['breadcrumbs'], FORMAT_HTML, ['noclean' => true]);
$_PAGE['breadcrumbs'] = $OUTPUT->navbar($_PAGE['breadcrumbs']);

// Document type.

$_PAGE['doctype'] = $OUTPUT->doctype();

// HTML tag attributes.

$_PAGE['htmlattributes'] = $OUTPUT->htmlattributes();
if (strpos($_PAGE['htmlattributes'], 'xml') !== false) { // Trim off: xml:lang="en".
    $_PAGE['htmlattributes'] = substr($_PAGE['htmlattributes'], 0, strpos($_PAGE['htmlattributes'], 'xml:lang="'));
}
// Change HTML lang="fr-ca" to just "fr" for compatibility with WET-BOEW in French.
$_PAGE['htmlattributes'] = str_replace("fr-ca", "fr", $_PAGE['htmlattributes']);

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

// If secondary nav.

$_PAGE['skiptosectnav'] = '';
if(!empty($_PAGE['showsectmenu'])) {
    $_PAGE['skiptosectnav'] = '<li class="wb-slc visible-sm visible-md visible-lg><a class="wb-sl" href="#wb-info">' . $_STRINGS['skiptosectnav'] . '</a></li>';
}

$_PAGE['regionmainsettingsmenu'] = $OUTPUT->region_main_settings_menu();
$_PAGE['hasregionmainsettingsmenu'] = !empty($_PAGE['regionmainsettingsmenu']);

// Footer
$_PAGE['hasfooter'] = (empty($PAGE->layout_options['nofooter']));

// Site name and page title.

$_PAGE['sitename'] = format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), "escape" => false]);
$_PAGE['pagetitle'] = $OUTPUT->pagetitle($PAGE->title);
$_PAGE['bodyattributes'] = $OUTPUT->body_attributes();
$_PAGE['lastmodified'] = date('Y-m-d', $PAGE->course->timemodified);
$_PAGE['pagebutton'] = str_replace('singlebutton', 'btn btn-default', $this->page_heading_button());

// Login/Sign-in, Logout/Sign-out, Register, Account Settings buttons.

$_PAGE['signonurl'] = '';
$_PAGE['signouturl'] = '';
$_PAGE['showsignon'] = true;
$_PAGE['showregister'] = false;
$_PAGE['registerurl'] = '';
$_PAGE['showaccountsettings'] = false;
$_PAGE['accountsettingsurl'] = '';

if ($_PAGE['loggedin'] = (!isguestuser() && isloggedin())) {
    if ($PAGE->pagetype != 'login-logout') {
        $_PAGE['signouturl'] = $CFG->wwwroot . '/login/logout.php';
    }
    $_PAGE['showaccountsettings'] = $_PAGE['loggedin'];
    // URL of Profile settings button.
    if (has_capability('moodle/user:editownprofile', context_system::instance())) {
        $_PAGE['accountsettingsurl'] = $CFG->wwwroot . '/user/profile.php';
    }
} else { // Logged-out.
    require_once $CFG->libdir . '/authlib.php';
    if ($_PAGE['showregister'] = signup_is_enabled() && $PAGE->pagetype != 'login-signup') {
        $_PAGE['registerurl'] = empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/signup.php' : $CFG->alternateloginurl;
    }
    if($_PAGE['showsignon']) {
        if ($PAGE->pagetype != 'login-index') {
            if (empty($CFG->alternateloginurl)) {
                $_PAGE['signonurl'] = $CFG->wwwroot . '/login/';
            } else {
                $_PAGE['signonurl'] = format_string($CFG->alternateloginurl, true, ['context' => context_course::instance(SITEID), "escape" => false]);
                //die('happy');
            }
        }
    }
}

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
