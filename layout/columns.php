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
 * The columns layout for the gcweb theme.
 *
 * @package   theme_gcweb
 * @copyright 2016-2021 TNG Consulting Inc.
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

$PAGE->requires->jquery();

require(__DIR__ . '/../framework/settings.php');

$templatecontext = [
    'output' => $OUTPUT,
    'pageheading' => $_PAGE['pageheading'],
    'pageheadinghidden' => $_PAGE['pageheadinghidden'],
    'standard_head_html' => $_PAGE['standard_head_html'],
    'sidepreblocks' => $_PAGE['blockspre'],
    'sidepostblocks' => $_PAGE['blockspost'],
    'haspreblocks' => $_PAGE['hassidepre'],
    'haspostblocks' => $_PAGE['hassidepost'],
    'contentpreblocks' => $_PAGE['contentpre'],
    'contentpostblocks' => $_PAGE['contentpost'],
    'regionmainsettingsmenu' => $_PAGE['regionmainsettingsmenu'],
    'hasregionmainsettingsmenu' => $_PAGE['hasregionmainsettingsmenu'],
    'hasblocks' => $_PAGE['hasblocks'],
    'htmlattributes' => $_PAGE['htmlattributes'],
    'bodyattributes' => $_PAGE['bodyattributes'],
    'alerts' => $_PAGE['alerts'],
    'wetboew' => $_PAGE['themewww'] . '/framework',
    'langmenu' => $_PAGE['langmenu'],
    'lang' => $_PAGE['lang'],
    'lastmodified' => $_PAGE['lastmodified'],
    'pagebutton' => $_PAGE['pagebutton'],
    'showproblembutton' => $_PAGE['showproblembutton'],
    'problembuttonurl' => $_PAGE['problembuttonurl'],
    'showsharebutton' => $_PAGE['showsharebutton'],
    'loggedin' => (!isguestuser() && isloggedin()),
    'wwwroot' => $CFG->wwwroot,
    'shownavdrawer' => $_PAGE['shownavdrawer'],
    'navdraweropen' => $_PAGE['navdraweropen'],
    'showmoodledocs' => $_PAGE['showmoodledocs'],
    'showhomelink' => $_PAGE['showhomelink'],
    'showlogininfo' => $_PAGE['showlogininfo'],
    'footnote' => $_PAGE['footnote'],
    'footertext' => $_PAGE['footertext'],
    'links' => false,

    'flatnavigation' => $_PAGE['flatnavigation']
];

echo $OUTPUT->render_from_template('theme_gcweb/columns', $templatecontext);

