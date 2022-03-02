<?php
// This file is part of the WET-BOEW-Moodle (GCWeb) theme for Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Initialize setting for the WET-BOEW-Moodle GCWeb theme.
 *
 * @package   theme_gcweb
 * @copyright 2016-2022 TNG Consulting Inc.
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $_PAGE;

$theme = get_config('theme_gcweb');
$context = context_system::instance();

// Cause the userdate() function not to fix %d in date strings. Just let them show with a zero prefix.

$CFG->nofixday = true;

$_PAGE['searchsettings'] = ''; // For additional hidden form fields.
$_PAGE['themewww'] = $CFG->wwwroot . '/theme/gcweb';     // Absolute path to this theme.

// Default settings for page.

$_PAGE['lang'] = strtolower(substr(current_language(), 0, 2));
$_PAGE['showmegamenu'] = true;
$_PAGE['showsectmenu'] = false;
$_PAGE['description'] = '';
$_PAGE['breadcrumbs'] = $theme->prebreadcrumbs;

// Get Last Modified date.

$_PAGE['lastmodified'] = '';
// If in a course, use the course start date.
// Reminder: The front page does not have a start date even though it is a course.
if (!empty($PAGE->course->startdate)) {
    // Most of Moodle's activity and resource modules don't store the last modified date.
    // So our hack is to use the course start date instead. This also allows for minor edits
    // without causing a course's Last Modified date to change.
    $_PAGE['lastmodified'] = date('Y-m-d', $PAGE->course->startdate);
}
if (empty( $_PAGE['lastmodified'])) {
    // So, it wasn't a course. Could be the front page... or other Moodle page.
    if ($PAGE->cm) {
        // If in a course module, can only be in one of the Site Pages under front page.
        if ($PAGE->cm->modname == 'page') {
            // If in a Site Page, use its last modified date.
            // Get the Course Module ID from URL.
            $id = optional_param('id', 0, PARAM_INT);
            if (!empty($id) && $cm = get_coursemodule_from_id('page', $id)) {
                global $DB;
                $page = $DB->get_record('page', array('id'=>$cm->instance), '*', MUST_EXIST);
                // You got it! the page's last modified date.
                $_PAGE['lastmodified'] = date('Y-m-d', $page->timemodified);
            }
        } else {
            // Other type of course module: use the course's last modified date.
            $_PAGE['lastmodified'] = date('Y-m-d', $PAGE->course->timemodified);
        }
    }
}
if (empty( $_PAGE['lastmodified'])) {
    // Hmmm... not in a course module, not even Front page.
    // Guess we will use Moodle's major release date since Moodle is generating the page.
    // But we don't want to give away exactly which release of Moodle we are using.
    $verdate = (string) intval($CFG->version);
    $_PAGE['lastmodified'] = substr($verdate, 0,4) . '-' . substr($verdate, 4,2) . '-' . substr($verdate, 6,2);
}

// User menu - hack here due to a bug in the Moodle minifier which inserts an unwanted space after the commas.

$extracss = '';
if (empty($theme->settings->showumprofilelink)) { // Hide the Profile link.
    $extracss .= '#action-menu-1-menubar a[data-title="profile,moodle"] {display:none!important;}';
}
if (empty($theme->settings->showumlogoutlink)) {  // Hide the Log Out link.
    $extracss .= '#action-menu-1-menubar a[data-title="logout,moodle"] {display:none!important;}';
}
if (!empty($extracss)) {
    $extracss = '<style>' . $extracss . '</style>';
}

// Insert extra head content just before </HEAD>.

$additionalhtmlhead = $CFG->additionalhtmlhead ;
$CFG->additionalhtmlhead = format_text($CFG->additionalhtmlhead . $extracss, FORMAT_HTML,
        ['noclean' => true, 'context' => $context]);
$_PAGE['standard_head_html'] = $OUTPUT->standard_head_html();
$CFG->additionalhtmlhead = $additionalhtmlhead;
// Remove <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
$_PAGE['standard_head_html'] = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', '',
        $_PAGE['standard_head_html']);

// Search engine

$_PAGE['showsearch'] = $theme->showsearch && empty($PAGE->layout_options['nosearch'])
        && (!empty($CFG->enableglobalsearch) || has_capability('moodle/search:query', $context));
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
    $_PAGE['breadcrumbs'] = format_text($_PAGE['breadcrumbs'], FORMAT_HTML,
            ['noclean' => true, 'context' => $context]);
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
// Change HTML lang="..." to just 2 letter language code for compatibility with WET-BOEW in French.
$start = strpos($_PAGE['htmlattributes'], 'lang="') + 6;
$length = strpos($_PAGE['htmlattributes'], '"', $start + 1) - $start;
$lang = substr($_PAGE['htmlattributes'], $start, $length);
$_PAGE['htmlattributes'] = str_replace($lang, substr($lang, 0, 2), $_PAGE['htmlattributes']);

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
        $ccontext = context_course::instance($PAGE->course->id);
        $archetype = $USER->access['rsw'][$ccontext->path];
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

//
// Alerts.
//
$_PAGE['alerts']  = '';

$iedetectsrc = '<div class="unsupported-browser"></div>
<script type="text/javascript">
    // <![CDATA[
    // Detect IE 10 and IE 11
    function isIE() {
        return /Trident\/|MSIE/.test(window.navigator.userAgent);
    }
    let showBrowserAlert = (function() {
        if (document.querySelector(\'.unsupported-browser\')) {
            let d = document.getElementsByClassName(\'unsupported-browser\');
            is_IE = isIE();
            if (is_IE) {
                d[0].innerHTML = \'<section class="alert alert-' . $theme->alertiedetecttype . '">\
<h2>' . addslashes(get_string('iedetect_heading', 'theme_gcweb')) . '</h2>\
<p>' . addslashes(get_string('iedetect_message', 'theme_gcweb')) . '</p>\
</section>\';
            }
        }
    });
    document.addEventListener(\'DOMContentLoaded\', showBrowserAlert);
    // ]]>
</script>
';

for ($cnt = 1; $cnt <= 4; $cnt++) {
    // Note: Dismissable alerts not yet supported.
    // Fetch alerts -- but only if they are not suppressed by user cookie.
    if (isset($_COOKIE['gcwebalert-' . $cnt]) && $_COOKIE['gcwebalert-' . $cnt] === "closed") {
        continue;
    } else if (empty($theme->{"alert{$cnt}enable"})) {
        continue;
    }

    $_PAGE['alerts'] .= '<section class="alert alert-' . $theme->{"alert{$cnt}type"} . '">';
    if (!empty($theme->{"alert{$cnt}title"})) {
        $_PAGE['alerts'] .= '<h2>' . $theme->{"alert{$cnt}title"} . '</h2>';
    }
    $_PAGE['alerts'] .= '<p>' . $theme->{"alert{$cnt}text"} . '</p>';
    $_PAGE['alerts'] .= '</section>';
}
// IE Detection alert.
if (!empty($theme->alertiedetectenable)) {
    $_PAGE['alerts'] .= $iedetectsrc;
}

if (!empty($_PAGE['alerts'])) {
    $_PAGE['alerts'] = format_text($_PAGE['alerts'], FORMAT_HTML, ['noclean' => true, 'context' => $context]);
    $_PAGE['alerts'] = '<div class="gcwebalerts">' . $_PAGE['alerts'] . '</div>';
}

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
// Problem button URL.
$_PAGE['problembuttonurl'] = format_string($theme->problembuttonurl);
if (!empty($_PAGE['problembuttonurl'])) {
    $_PAGE['problembuttonurl'] = new moodle_url($_PAGE['problembuttonurl']);
}
// WET "Share" button is not compatible with fr-ca language.
$_PAGE['showsharebutton'] = $theme->showshare;
// Moodle docs link.
$_PAGE['showmoodledocs'] = $theme->footershowmoodledocs;
// Home link.
$_PAGE['showhomelink'] = $theme->footershowhomelink;
// Login/logout link.
$_PAGE['showlogininfo'] = $theme->footershowlogininfo;
// Footnote.
$_PAGE['footnote'] = format_text($theme->footnote, FORMAT_HTML, ['noclean' => true, 'context' => $context]);
// Footer.
$_PAGE['footertext'] = format_text($theme->footertext, FORMAT_HTML, ['noclean' => true, 'context' => $context]);

//
// Site name and page title.
//

$_PAGE['sitename'] = format_string($SITE->fullname, true, ['context' => $context, "escape" => false]);
$_PAGE['pagebutton'] = str_replace('singlebutton', 'btn btn-default', $this->page_heading_button());
$_PAGE['pageheading'] = $OUTPUT->pageheading($PAGE->title);
$_PAGE['pageheadinghidden'] = '';
if ($PAGE->pagetype == 'site-index') { // Frontpage.
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

$signouturl = format_string($theme->alternatelogouturl, true, ['context' => $context, "escape" => false]);

if ($_PAGE['loggedin'] = (!isguestuser() && isloggedin())) {
    if ($PAGE->pagetype != 'login-logout') {
        if ($USER->auth == 'oauth2' && !empty($signouturl)) {
            $_PAGE['signouturl'] = new moodle_url($signouturl);
        } else {
            $_PAGE['signouturl'] = $CFG->wwwroot . '/login/logout.php' . ($theme->confirmlogout ? '' : '?sesskey=' . sesskey());
        }
    }
    $_PAGE['showaccountsettings'] = $theme->showaccountsettings;
    // URL of Profile settings button.
    if (has_capability('moodle/user:editownprofile', $context)) {
        $_PAGE['accountsettingsurl'] = $CFG->wwwroot . '/user/profile.php';
    }
} else { // Logged-out.
    require_once $CFG->libdir . '/authlib.php';
    $_PAGE['showregister'] = (!empty($theme->showregister) && (empty($CFG->authpreventaccountcreation) || signup_is_enabled())
            && $PAGE->pagetype != 'login-signup');
    if ($_PAGE['showregister']) {
        $_PAGE['registerurl'] = empty($theme->alternateregisterurl) ? $CFG->wwwroot . '/login/signup.php'
                : new moodle_url($theme->alternateregisterurl);
    }

    if($_PAGE['showsignon']) {
        if ($PAGE->pagetype != 'login-index') {
            if (empty($CFG->alternateloginurl)) {
                $_PAGE['signonurl'] = $CFG->wwwroot . '/login/';
            } else {
                $_PAGE['signonurl'] = new moodle_url($CFG->alternateloginurl);
            }
        }
    }
}

// Life tip: die('happy');.

$_PAGE['flatnavigation'] = $PAGE->flatnav;

// Blocks.

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
