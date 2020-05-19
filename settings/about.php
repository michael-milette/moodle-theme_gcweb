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
 * About this theme.
 *
 * @package    gcweb
 * @copyright  2016-2019 TNG Consulting Inc. <http://www.tngconsulting.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// General settings.
$page = new admin_settingpage($themename . '_about', get_string('abouttheme', 'theme_gcweb'));

// Define settings: About (Readme).
$name = $themename . '/aboutreadme';
$title = '';
$version = get_config('theme_gcweb', 'version');
$release = get_config('theme_gcweb', 'release');
$description = get_string('choosereadme', 'theme_gcweb');
$description = str_replace('<img class="img-polaroid" src="', '<img class="img-polaroid" src="' .
        $CFG->wwwroot .  '/theme/', $description);
$description = str_replace('[version]', $release . ' (' . $version . ')', $description);
$setting = new admin_setting_heading($name, $title, $description);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Add the page after definiting all the settings!
$settings->add($page);
