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
 * Nav Drawer Settings.
 *
 * @package    theme_gcweb
 * @copyright  2016-2022 TNG Consulting Inc. <https://www.tngconsulting.ca>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Nav Drawer settings.
$page = new admin_settingpage($themename . '_navdrawer', get_string('navdrawersettings', 'theme_gcweb'));
$draweritems = ['myhome', 'sitehome', 'calendar', 'privatefiles', 'contentbank', 'mycourses'];

// If first time, initialize this tab's settings with defaults.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    set_config('shownavdrawer', 1, $themename); // Yes.
    set_config('navdraweropen', 'true', $themename); // Open.
    foreach ($draweritems as $item) { // Show/Hide some items in Nav Drawer when in a course.
        set_config('coursenavdrawer' . $item, ($item == 'contentbank' ? '1' : '0'), $themename); // No, except Content Bank.
    }
}

// Show Nav Drawer to Students.
$name = $themename . '/shownavdrawer';
$title = get_string('shownavdrawer', $themename);
$description = get_string('shownavdrawer_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Nav Drawer should be open by default?
$name = $themename . '/navdraweropen';
$title = get_string('navdraweropen', $themename);
$description = get_string('navdraweropen_desc', $themename);
$default = 'true';
$choices = array('true' => get_string('resourcedisplayopen'), '' => get_string('closebuttontitle'));
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show/Hide some items in Nav Drawer when in a course.
foreach ($draweritems as $item) {
    $name = $themename . '/coursenavdrawer' . $item;
    $title = get_string($item, ($item == 'calendar' ? $item : 'moodle'));
    $description = get_string('coursenavdrawer' . $item . '_desc', $themename);
    $default = ($item == 'contentbank' ? '1' : '0');
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
}

// Add the page after defining all the settings!
$settings->add($page);
