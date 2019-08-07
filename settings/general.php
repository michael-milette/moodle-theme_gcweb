<?php
// This file is part of Moodle - http://moodle.org/
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
 * Settings for Custom CSS.
 *
 * @package    theme_wet-boew
 * @copyright  2016 TNG Consulting Inc. <http://www.tngconsulting.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// General settings.
$page = new admin_settingpage($themename . '_general', get_string('generalsettings', 'theme_boost'));

// If first time, initialize this tab's settings with defaults.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    set_config('hidelocallogin', 0, $themename); // Yes.
    set_config('confirmlogout', 0, $themename); // No.
    set_config('showhometitle', 1, $themename); // Yes.
    set_config('hometitle', '', $themename); // Home.
    set_config('titlesitename', 0, $themename); // No.
    set_config('shownavdrawer', 1, $themename); // Yes.
    set_config('navdraweropen', 'true', $themename); // Open.
}

// Hide local login form on login page.
$name = $themename . '/hidelocallogin';
$title = get_string('hidelocallogin', $themename);
$description = get_string('hidelocallogin_desc', $themename);
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Enable logout confirmation screen.
$name = $themename . '/confirmlogout';
$title = get_string('confirmlogout', $themename);
$description = get_string('confirmlogout_desc', $themename);
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Home Page Title (h1).
$name = $themename . '/showhometitle';
$title = get_string('showhometitle', $themename);
$description = get_string('showhometitle_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Home Page Title/heading (h1).
$name = $themename . '/hometitle';
$title = get_string('hometitle', $themename);
$description = get_string('hometitle_desc', $themename);
$default = get_string('home');
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Add site name to Page Titles (h1).
$name = $themename . '/titlesitename';
$title = get_string('titlesitename', $themename);
$description = get_string('titlesitename_desc', $themename);
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

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

// Add the page after definiting all the settings!
$settings->add($page);
