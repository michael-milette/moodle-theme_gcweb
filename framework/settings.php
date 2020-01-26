<?php
// This file is part of the WET-BOEW-Moodle (GCWeb) theme for Moodle - http://moodle.org/
//
// WET-BOEW-Moodle (GCWeb) is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// WET-BOEW-Moodle (GCWeb) is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Initialize setting for the WET-BOEW-Moodle GCWeb theme.
 *
 * @package   theme_gcweb
 * @copyright 2016-2019 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $_PAGE;

$theme = get_config('theme_gcweb');

// Cause the userdate() function not to fix %d in date strings. Just let them show with a zero prefix.

$CFG->nofixday = true;

$_PAGE['searchsettings'] = ''; // For additional hidden form fields.
$_PAGE['themewww'] = $CFG->wwwroot . '/theme/gcweb';     // Absolute path to this theme.

// Default settings for page.

$_PAGE['lang'] = current_language();
$_PAGE['showmegamenu'] = true;
$_PAGE['showsectmenu'] = false;
$_PAGE['description'] = '';
$_PAGE['breadcrumbs'] = $theme->prebreadcrumbs;
$_PAGE['lastmodified'] = date('Y-m-d', getlastmod());// date("Y-m-d", filemtime(__FILE__));

// Insert extra head content just before </HEAD>.

$additionalhtmlhead = $CFG->additionalhtmlhead ;
$CFG->additionalhtmlhead = format_text($CFG->additionalhtmlhead, FORMAT_HTML, ['noclean' => true, 'context' => context_system::instance()]);
$_PAGE['standard_head_html'] = $OUTPUT->standard_head_html();
$CFG->additionalhtmlhead = $additionalhtmlhead;
// Remove <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
$_PAGE['standard_head_html'] = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', '', $_PAGE['standard_head_html']);

// Search engine

$_PAGE['showsearch'] = $theme->showsearch && empty($PAGE->layout_options['nosearch']) && (!empty($CFG->enableglobalsearch) || has_capability('moodle/search:query', context_system::instance()));
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

// Breadcrumbs
if ($PAGE->pagetype != 'site-index' || $theme->showhomebreadcrumbs) {
    // If this is not home page OR showhomebreadcrumbs is enabled.
    $_PAGE['breadcrumbs'] = format_text($_PAGE['breadcrumbs'], FORMAT_HTML, ['noclean' => true, 'context' => context_system::instance()]);
    $_PAGE['breadcrumbs'] = $OUTPUT->navbar($_PAGE['breadcrumbs']);
} else {
    $_PAGE['breadcrumbs'] = '';
}

// Document type.

$_PAGE['doctype'] = $OUTPUT->doctype();

// HTML tag attributes.

$_PAGE['htmlattributes'] = $OUTPUT->htmlattributes();
if (strpos($_PAGE['htmlattributes'], 'xml') !== false) { // Trim off: xml:lang="en".
    $_PAGE['htmlattributes'] = substr($_PAGE['htmlattributes'], 0, strpos($_PAGE['htmlattributes'], 'xml:lang="'));
}
// Change HTML lang="fr-ca" to just "fr" for compatibility with WET-BOEW in French.
$_PAGE['htmlattributes'] = str_replace("fr-ca", "fr", $_PAGE['htmlattributes']);

//
// Nav drawer should be available if shownavdrawer is true or user is greater than student.
//

// Default is not to display the Nav Drawer.
$_PAGE['navdraweropen'] = '';
// If logged-in and not a guest user.
$_PAGE['shownavdrawer'] = isloggedin() && !isguestuser();

// If set to not show nav drawer, go through the exceptions.
if(empty($theme->shownavdrawer) && $_PAGE['shownavdrawer']) {
    // If switched roles, figure out archetype.
    if (is_role_switched($PAGE->course->id)) {
        $context = context_course::instance($PAGE->course->id);
        $archetype = $USER->access['rsw'][$context->path];
        // Override - Enable nav drawer if archetype is higher than student.
        $theme->shownavdrawer = ($archetype < 5); // 1 to 4.
        $_PAGE['shownavdrawer'] = $theme->shownavdrawer;
    } else if (!is_siteadmin()) { // Is not administrator but is more than a student.
        global $DB;
        $theme->shownavdrawer = false;
        // Get all of the user's roles.
        $roleassignments = $DB->get_records('role_assignments', ['userid' => $USER->id], '', 'id,roleid');
        // Identify the archetype of each role.
        $archetypes = ['manager', 'coursecreator', 'editingteacher', 'teacher'];
        foreach($roleassignments as $role) {
            // Override - Enable nav drawer if archetype is higher than student.
            $archetype = $DB->get_record('role', ['id' => $role->roleid], 'archetype');
            $theme->shownavdrawer = in_array($archetype, $archetypes);
            if($theme->shownavdrawer) {
                break;
            }
        }
        $_PAGE['shownavdrawer'] = $theme->shownavdrawer;
    }
}
if ($theme->shownavdrawer) {
    $_PAGE['navdraweropen'] = get_user_preferences('drawer-open-nav', $theme->navdraweropen) == 'true' ? 'true' : '';
}

//
// BODY tag attributes.
//

$extraclasses = [];
// If course list view layout is set to cards. (ALPHA)
if($theme->courselistlayout == 'card') {
    $extraclasses[] = 'coursecardview';
}
$_PAGE['bodyattributes'] = $OUTPUT->body_attributes($extraclasses);

// If secondary nav.

$_PAGE['skiptosectnav'] = '';
if(!empty($_PAGE['showsectmenu'])) {
    $_PAGE['skiptosectnav'] = '<li class="wb-slc visible-sm visible-md visible-lg><a class="wb-sl" href="#wb-info">'
            . $_STRINGS['skiptosectnav'] . '</a></li>';
}

$_PAGE['regionmainsettingsmenu'] = $OUTPUT->region_main_settings_menu();
$_PAGE['hasregionmainsettingsmenu'] = !empty($_PAGE['regionmainsettingsmenu']);

//
// Footer.
//

$_PAGE['hasfooter'] = (empty($PAGE->layout_options['nofooter']));
// Show Problem button.
$_PAGE['showproblembutton'] = $theme->showproblem;
// WET "Share" button is not compatible with fr-ca language.
$_PAGE['showsharebutton'] = $theme->showshare;
// Moodle docs link.
$_PAGE['showmoodledocs'] = $theme->footershowmoodledocs;
// Home link.
$_PAGE['showhomelink'] = $theme->footershowhomelink;
// Login/logout link.
$_PAGE['showlogininfo'] = $theme->footershowlogininfo;
// Reset user tours.
$_PAGE['showresetusertours'] = $theme->footershowresetusertours;
// Footnote.
$_PAGE['footnote'] = format_text($theme->footnote, FORMAT_HTML, ['noclean' => true, 'context' => context_system::instance()]);

//
// Site name and page title.
//

$_PAGE['sitename'] = format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), "escape" => false]);
$_PAGE['lastmodified'] = date('Y-m-d', $PAGE->course->timemodified);
$_PAGE['pagebutton'] = str_replace('singlebutton', 'btn btn-default', $this->page_heading_button());
$_PAGE['pageheading'] = $OUTPUT->pageheading($PAGE->title);
$_PAGE['pageheadinghidden'] = '';
if ($PAGE->pagetype == 'site-index') { // frontpage
    if (empty($theme->showhometitle)) {
        // Hide title on Home page.
        $_PAGE['pageheadinghidden'] = ' property="name" class="wb-inv"';
    }
}

// Login/Sign-in, Logout/Sign-out, Register, Account Settings buttons.

$_PAGE['signonurl'] = '';
$_PAGE['signouturl'] = '';
$_PAGE['showsignon'] = $theme->showsignon;
$_PAGE['showaccountsettings'] = false;
$_PAGE['accountsettingsurl'] = '';
$_PAGE['showregister'] = false;
$_PAGE['registerurl'] = '';

$signouturl = format_string($theme->alternatelogouturl, true,
        ['context' => context_course::instance(SITEID), "escape" => false]);

if ($_PAGE['loggedin'] = (!isguestuser() && isloggedin())) {
    if ($PAGE->pagetype != 'login-logout') {
        if ($USER->auth == 'oauth2' && !empty($signouturl)) {
            $_PAGE['signouturl'] = $signouturl;
        } else {
            $_PAGE['signouturl'] = $CFG->wwwroot . '/login/logout.php' . ($theme->confirmlogout ? '' : '?sesskey=' . sesskey());
        }
    }
    $_PAGE['showaccountsettings'] = $theme->showaccountsettings;
    // URL of Profile settings button.
    if (has_capability('moodle/user:editownprofile', context_system::instance())) {
        $_PAGE['accountsettingsurl'] = $CFG->wwwroot . '/user/profile.php';
    }
} else { // Logged-out.
    require_once $CFG->libdir . '/authlib.php';
    $_PAGE['showregister'] = (!empty($theme->showregister) && (empty($CFG->authpreventaccountcreation) || signup_is_enabled())
            && $PAGE->pagetype != 'login-signup');
    if ($_PAGE['showregister']) {
        $_PAGE['registerurl'] = empty($theme->alternateregisterurl) ? $CFG->wwwroot . '/login/signup.php'
                : $theme->alternateregisterurl;
    }

    if($_PAGE['showsignon']) {
        if ($PAGE->pagetype != 'login-index') {
            if (empty($CFG->alternateloginurl)) {
                $_PAGE['signonurl'] = $CFG->wwwroot . '/login/';
            } else {
                $_PAGE['signonurl'] = format_string($CFG->alternateloginurl, true,
                        ['context' => context_course::instance(SITEID), "escape" => false]);
            }
        }
    }
}

// Life tip: die('happy');

$_PAGE['flatnavigation'] = $PAGE->flatnav;

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
