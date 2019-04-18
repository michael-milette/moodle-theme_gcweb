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
 * @package   theme_test
 * @copyright 2019 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
include __DIR__ . '/../framework/theme-gcweb/settings.php';
include __DIR__ . '/../config-framework.php';

$_PAGE['skiptosectnav'] = '';
if(!empty($_PAGE['showsectmenu'])) {
    $_PAGE['skiptosectnav'] = '<li class="wb-slc"><a class="wb-sl" href="#wb-info">' . $_STRINGS['skiptosectnav'] . '</a></li>';
}

$_PAGE['langmenu'] = '';
if($_PAGE['langmenu']) {
    $_PAGE['langmenu'] .= '<section id="wb-lng" class="visible-md visible-lg text-right">';
    $_PAGE['langmenu'] .= '    <h2 class="wb-inv">' . $_STRINGS['languageselection'] . '</h2>';
    $_PAGE['langmenu'] .= '    <div class="row">';
    $_PAGE['langmenu'] .= '        <div class="col-md-12">';
    $_PAGE['langmenu'] .= '            <ul class="list-inline margin-bottom-none">';
    $_PAGE['langmenu'] .= '                <li><a lang="fr" href="content-fr.html">' . $_STRINGS['french'] . '</a></li>';
    $_PAGE['langmenu'] .= '            </ul>';
    $_PAGE['langmenu'] .= '        </div>';
    $_PAGE['langmenu'] .= '    </div>';
    $_PAGE['langmenu'] .='</section>';
}

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $_PAGE['blockspre'],
    'sidepostblocks' => $_PAGE['blockspost'],
    'haspreblocks' => $_PAGE['hassidepre'],
    'haspostblocks' => $_PAGE['hassidepost'],
    'bodyattributes' => $OUTPUT->body_attributes(),
    'wet-boew' => $_SITE['wet-boew'],
    'langmenu' => $_PAGE['langmenu'],
    'lang' => $_SITE['lang'],
    'showmegamenu' => $_PAGE['showmegamenu'],
    'showsearch' => $_PAGE['showsearch'],
    'searchurl' => $_PAGE['searchurl'],
    'shortname' => $_SITE['shortname'],
    'searchsettings' => $_SITE['searchsettings'],
    'topicsmenulist' => $_STRINGS['topicsmenulist'],
    'breadcrumbs' => $_PAGE['breadcrumbs'],

    'showregister' => (isguestuser() || !isloggedin()), // TODO: Determine if registration is enabled.
    'registerurl' => empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/signup.php' : $CFG->alternateloginurl,

    'showsignon' => (isguestuser() || !isloggedin()),
    'signonurl' => empty($CFG->alternateloginurl) ? $CFG->wwwroot . '/login/' : $CFG->alternateloginurl,

    'showsignout' => (!isguestuser() && isloggedin()),
    'signouturl' => $CFG->wwwroot . '/login/logout.php',

    'showaccountsettings' => !(isguestuser() || !isloggedin()),
    'accountsettingsurl' => $CFG->wwwroot . '/user/profile.php',
    'pagebutton' =>  str_replace('singlebutton', 'btn btn-default', $this->page_heading_button())
];

echo $OUTPUT->render_from_template('theme_test/columns', $templatecontext);

