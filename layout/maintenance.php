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
 * A maintenance layout for the WET-BOEW GCWeb theme.
 *
 * @package   theme_gcweb
 * @copyright 2016-2021 TNG Consulting Inc.
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$title = '';
$h1 = '';
$content = '';
// Display custom message when maintenance mode is enabled but not during upgrades.
$maintenance = 1;//is_major_upgrade_required() && isloggedin();
$message = get_config('moodle', 'maintenance_message');
$languages = array_keys(get_string_manager()->get_list_of_translations());
$grid = intdiv(12, count($languages));
foreach ($languages as $language) {
    list($lang) = explode("_", $language);
    $heading = get_string_manager()->get_string('maintenance_title','theme_gcweb', null, $lang);
    $content .= '<section class="col-md-' . $grid . '" lang="' . $lang . '">';
    $content .= '<h2>' . $heading . '</h2>';
    $content .= get_string_manager()->get_string('maintenance_message','theme_gcweb', null, $lang);
    $content .= '</section>';
    $title .= $heading . ' / ';
    $h1 .= '<span lang="' . $lang . '">' . $heading . '</span> / ';
}
$title = trim($title, ' /');
$h1 = trim($h1, ' /');
// Append Optional Maintenance Message.
$content .= get_config('moodle', 'maintenance_message');
if ($maintenance) {
    $content = '';
}

$templatecontext = [
    'title' => $title,
    'h1' => $h1,
    'content' => $content,
    'maintenance' => $maintenance,
    'output' => $OUTPUT
];

echo $OUTPUT->render_from_template('theme_gcweb/maintenance', $templatecontext);
