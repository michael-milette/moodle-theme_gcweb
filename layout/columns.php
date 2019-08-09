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
    'output' => $OUTPUT,
    'pageheading' => $_PAGE['pageheading'],
    'pageheadinghidden' => $_PAGE['pageheadinghidden'],
    'standard_head_html' => $_PAGE['standard_head_html'],
    'sidepreblocks' => $_PAGE['blockspre'],
    'sidepostblocks' => $_PAGE['blockspost'],
    'haspreblocks' => $_PAGE['hassidepre'],
    'haspostblocks' => $_PAGE['hassidepost'],
    'regionmainsettingsmenu' => $_PAGE['regionmainsettingsmenu'],
    'hasregionmainsettingsmenu' => $_PAGE['hasregionmainsettingsmenu'],
    'hasblocks' => $_PAGE['hasblocks'],
    'htmlattributes' => $_PAGE['htmlattributes'],
    'bodyattributes' => $_PAGE['bodyattributes'],
    'wetboew' => $_PAGE['themewww'] . '/framework',
    'langmenu' => $_PAGE['langmenu'],
    'lang' => $_PAGE['lang'],
    'lastmodified' => $_PAGE['lastmodified'],
    'pagebutton' =>  $_PAGE['pagebutton'],
    'showproblembutton' => $_PAGE['showproblembutton'],
    'problembuttonurl' => format_string($theme->problembuttonurl),
    'showsharebutton' => $_PAGE['showsharebutton'],
    'loggedin' => (!isguestuser() && isloggedin()),
    'wwwroot' => $CFG->wwwroot,
    'shownavdrawer' => $_PAGE['shownavdrawer'],
    'navdraweropen' => $_PAGE['navdraweropen'],
    'showmoodledocs' => $_PAGE['showmoodledocs'],
    'showhomelink' => $_PAGE['showhomelink'],
    'showlogininfo' => $_PAGE['showlogininfo'],
    'showresetusertours' => $_PAGE['showresetusertours'],
    'footnote' => $_PAGE['footnote'],
    'links' => false,

    'flatnavigation' => $_PAGE['flatnavigation']
];

echo $OUTPUT->render_from_template('theme_wetboew_internet/columns', $templatecontext);

