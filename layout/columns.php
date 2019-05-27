<?php
// This file is part of the classic theme for Moodle
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
 * The columns layout for the classic theme.
 *
 * @package   theme_wetboew_internet
 * @copyright 2019 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
include __DIR__ . '/../framework/settings.php';

$_PAGE['skiptosectnav'] = '';
if(!empty($_PAGE['showsectmenu'])) {
    $_PAGE['skiptosectnav'] = '<li class="wb-slc visible-sm visible-md visible-lg><a class="wb-sl" href="#wb-info">' . $_STRINGS['skiptosectnav'] . '</a></li>';
}

$_PAGE['langmenu'] = $OUTPUT->wet_lang_menu();

$_PAGE['sitename'] = format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]);
$_PAGE['pagetitle'] = theme_wetboew_internet_betterpagetitle($OUTPUT->full_header());

$templatecontext = [
    'sitename' => $_PAGE['sitename'],
    'pagetitle' => $_PAGE['pagetitle'],
    'output' => $OUTPUT,
    'standard_head_html' => str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', '', $OUTPUT->standard_head_html()),
    'sidepreblocks' => $_PAGE['blockspre'],
    'sidepostblocks' => $_PAGE['blockspost'],
    'haspreblocks' => $_PAGE['hassidepre'],
    'haspostblocks' => $_PAGE['hassidepost'],
    'bodyattributes' => $OUTPUT->body_attributes(),
    'wet-boew' => $_PAGE['wet-boew'],
    'langmenu' => $_PAGE['langmenu'],
    'lang' => current_language(),
    'lastmodified' => date('Y-m-d', $PAGE->course->timemodified),
    'showmegamenu' => $_PAGE['showmegamenu'],
    'showsearch' => $_PAGE['showsearch'],
    'searchurl' => $_PAGE['searchurl'],
    'searchsettings' => $_PAGE['searchsettings'],
    'topicsmenulist' => get_string('topicsmenulist', 'theme_wetboew_internet'),
    'breadcrumbs' => $_PAGE['breadcrumbs'],

    'showregister' => (isguestuser() || !isloggedin()), // TODO: Determine if registration is enabled.
    'registerurl' => empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/signup.php' : $CFG->alternateloginurl,

    'loggedin' => (!isguestuser() && isloggedin()),
    'signonurl' => empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/' : $CFG->alternateloginurl,
    'signouturl' => $CFG->wwwroot . '/login/logout.php',

    'showaccountsettings' => !(isguestuser() || !isloggedin()),
    'accountsettingsurl' => $CFG->wwwroot . '/user/profile.php',
    'pagebutton' =>  str_replace('singlebutton', 'btn btn-default', $this->page_heading_button()),
    'showproblembutton' => $_PAGE['showproblembutton'],
    'showsharebutton' => $_PAGE['showsharebutton']
];

echo $OUTPUT->render_from_template('theme_wetboew_internet/columns', $templatecontext);

