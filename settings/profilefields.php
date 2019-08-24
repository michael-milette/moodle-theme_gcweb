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
 * Settings for Profile fields.
 *
 * @package    theme_gcweb
 * @copyright  2016-2019 TNG Consulting Inc. <http://www.tngconsulting.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die;

// User Profile Fields tab.
$page = new admin_settingpage($themename . '_profilefields', get_string('profilefields', 'admin'));

// List of user profile fields sections that we can show or hide.
$profilefieldsections = ['pictureofuser', 'additionalnames', 'interests', 'optional'];

// List of user profile fields that we can show or hide.
$profilefields = [
        'emaildisplay',
        'city',
        'country',
        'timezone',
        'description',
        // User Picture section.
        'pictureofuser',
        // Additional Names section.
        'additionalnames',
        // Interests section.
        'interests',
        // Optional section.
        'optional',
        'webpage',
        'icqnumber',
        'skypeid',
        'aimid',
        'yahooid',
        'msnid',
        'idnumber',
        'institution',
        'department',
        'phone1',
        'phone2',
        'address',
    ];

// If first time, initialize this tab's settings with defaults.
// Default for all User Profile fields and sections is to show.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    foreach ($profilefields as $field) {
        set_config('showprofile' . $field , '1', $themename);
    }
}

//
// Show / Hide User Profile fields and sections page heading.
//
$name = $themename . '/showprofileeheading';
$title = '';
$description = get_string('showprofile_heading', $themename);
$setting = new admin_setting_heading($name, $title, $description);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$name = $themename . '/showprofileeheading_general';
$title = get_string('section') . ' : ' . get_string('general');
$description = '';
$setting = new admin_setting_heading($name, $title, $description);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Create list of profile fields.
$default = 1;
foreach ($profilefields as $field) {
    if (in_array($field, $profilefieldsections)) {
        // Add profile field section header.
        $name = $themename . '/showprofileeheading_' . $field;
        $description = '';
        $title = get_string('section') . ' : ' . get_string($field);
        $setting = new admin_setting_heading($name, $title, $description);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);
        $description = get_string('showprofilesection_desc', $themename);
    } else {
        $description = '';
    }
    $name = $themename . '/showprofile' . $field;
    $title = get_string($field);
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
}

// Add the page after definiting all the settings!
$settings->add($page);
