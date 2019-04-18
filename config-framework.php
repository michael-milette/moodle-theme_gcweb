<?php

// This setting will cause the userdate() function not to fix %d in
// date strings, and just let them show with a zero prefix.
$CFG->nofixday = true;

// Extra head content. Will be inserted just before </HEAD>.
$_PAGE['extrahead'] = $OUTPUT->standard_head_html();
$_PAGE['extrahead'] = substr($_PAGE['extrahead'], strpos($_PAGE['extrahead'], '>') + 1); // Remove <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

// Search engine
$_PAGE['showsearch'] = empty($PAGE->layout_options['nosearch']);
$_PAGE['searchurl'] = $CFG->wwwroot . '/course/search.php';

// Show language menu
$_PAGE['langmenu'] = empty($_PAGE['langmenu']) ? true : $_PAGE['langmenu']; // TODO: determine this from Moodle's list of installed locales.
$_PAGE['langmenu']  = ($_PAGE['langmenu'] && $_SERVER['REQUEST_METHOD'] != 'POST'); // No language switching after a form POST.

$_PAGE['title'] = $OUTPUT->page_title();

// Breadcrumbs
$_PAGE['breadcrumbs'] = $OUTPUT->navbar();

// Page title tag and the page's H1 heading.
$_PAGE['heading'] = $_PAGE['title'];

// Document type.
$_PAGE['doctype'] = $OUTPUT->doctype();

// HTML tag attributes.
$_PAGE['htmlattributes'] = $OUTPUT->htmlattributes();
if (strpos($_PAGE['htmlattributes'], 'xml') !== false) { // Trim off: xml:lang="en".
    $_PAGE['htmlattributes'] = substr($_PAGE['htmlattributes'], 0, strpos($_PAGE['htmlattributes'], 'xml'));
}

// BODY tag attributes.
$_PAGE['bodyattributes'] = $OUTPUT->body_attributes();

// Signon: 1 show logged-in, 0 don't show, -1 logged-out.
$_PAGE['signon'] = (isguestuser() || !isloggedin()) ? -1 : 1;

// URL of Sign-On button.
$_PAGE['signonurl'] = empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/' : $CFG->alternateloginurl;
$_PAGE['registerurl'] = !empty($CFG->alternateloginurl) ? '' : $CFG->wwwroot . '/login/signup.php';

// URL of Sign-out button.
$_PAGE['signouturl'] = $CFG->wwwroot . '/login/logout.php';

// URL of Profile settings button.
if (has_capability('moodle/user:editownprofile', context_system::instance())) {
    $_SITE['accountsettingsurl'] = $CFG->wwwroot . '/user/profile.php';
}

// User menu - If signed in.
if(!$_PAGE['signon']) {
    $_PAGE['usermenu'] = $OUTPUT->full_header();//$OUTPUT->page_heading_menu();
} else {
    $_PAGE['usermenu'] = '';
}

//die($_PAGE['usermenu']);
if(strpos($_PAGE['usermenu'], '<form')) {
    $_PAGE['usermenu'] = '<div class="singlebutton"><form id="customisethis"' . substr($_PAGE['usermenu'], strpos($_PAGE['usermenu'], '<form') + 5);
    $_PAGE['usermenu'] = substr($_PAGE['usermenu'], 0, strrpos($_PAGE['usermenu'], 'form>') + 5) . '</div>';
} else {
    $_PAGE['usermenu'] = '';
}
$_PAGE['usermenu'] = $_PAGE['signon'] ? $OUTPUT->user_menu() . $OUTPUT->navbar_plugin_output() . $_PAGE['usermenu'] : '';

// Blocks
$_PAGE['hascontentpre']  = $PAGE->blocks->region_has_content('content-pre', $OUTPUT);
$_PAGE['hascontentpost'] = $PAGE->blocks->region_has_content('content-post', $OUTPUT);
$_PAGE['contentpre'] = $OUTPUT->blocks('content-pre');
$_PAGE['contentpost'] = $OUTPUT->blocks('content-post');

$_PAGE['blockspre'] = $OUTPUT->blocks('side-pre');
$_PAGE['blockspost'] = $OUTPUT->blocks('side-post');
$_PAGE['hassidepre'] = empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$_PAGE['hassidepost'] = empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$_PAGE['maincolwidth'] = 12;
$_PAGE['sidecolwidth'] = 4;
$_PAGE['maincolwidth'] = $_PAGE['maincolwidth'] - ($_PAGE['hassidepre'] * $_PAGE['sidecolwidth']) - ($_PAGE['hassidepost'] * $_PAGE['sidecolwidth']);

// Mega menu
$_PAGE['showmegamenu'] = true;

// Footer
$_PAGE['hasfooter'] = (empty($PAGE->layout_options['nofooter']));

// Sidebars
$_PAGE['maxcolumns'] = 2;

// $_PAGE['showsecnav'] = true;
// $_PAGE['description'] = '';

