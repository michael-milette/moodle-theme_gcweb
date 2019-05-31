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

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

include __DIR__ . '/../framework/settings.php';

$templatecontext = [
    'sitename' => $_PAGE['sitename'],
    'output' => $OUTPUT,
    'pagetitle' => $_PAGE['pagetitle'],
    'standard_head_html' => str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', '', $OUTPUT->standard_head_html()),
    'standard_top_of_body_html' => preg_replace('/<div>.*<\/div>/s', '', $OUTPUT->standard_top_of_body_html()),
    'sidepreblocks' => $_PAGE['blockspre'],
    'sidepostblocks' => $_PAGE['blockspost'],
    'haspreblocks' => $_PAGE['hassidepre'],
    'haspostblocks' => $_PAGE['hassidepost'],
    'regionmainsettingsmenu' => $_PAGE['regionmainsettingsmenu'],
    'hasblocks' => true,
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
    'showsharebutton' => $_PAGE['showsharebutton'],
    
    'navdraweropen' => $_PAGE['navdraweropen'],
    'regionmainsettingsmenu' => $_PAGE['regionmainsettingsmenu'],
    'hasregionmainsettingsmenu' => !empty($_PAGE['regionmainsettingsmenu'])
];

$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template('theme_wetboew_internet/columns', $templatecontext);

