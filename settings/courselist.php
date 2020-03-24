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
 * General Settings.
 *
 * @package    theme_gcweb
 * @copyright  2016-2020 TNG Consulting Inc. <http://www.tngconsulting.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Course listing settings.
$page = new admin_settingpage($themename . '_courselists', get_string('courselistsettings', 'theme_gcweb'));

// If first time, initialize this tab's settings with defaults.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    set_config('courselistlayout', 'list', $themename); // List.
    set_config('filtercoursesbylang', '0', $themename); // No.
    set_config('wraprecentlyaccessedcourses', 0, $themename); // Don't wrap the Dashboard's Recently Accessed Courses list.
    set_config('courselistcolumns', 2, $themename); // 3 columns (0 based array).
    set_config('cardsummary', 1, $themename); // Show card summary.
    set_config('cardcustomfields', 1, $themename); // Show card custom fields.
    set_config('cardcontacts', 1, $themename); // Show card contacts (e.g. teachers).
    set_config('cardimage', 1, $themename); // Show card course image.
    set_config('cardbutton', 1, $themename); // Show card enrolment/get started button.
    set_config('filtertag', '', $themename); // No filtering of course list.
}

// Course List Display Styles
// Note: If you modify the list of layouts, you must change the language file, settings/general.php, 
// wet-boew-moodle.css, wet-boew-moodle-min.css and classes/output/course_renderer.php.

// Course Listing.
$name = $themename . '/courselisting';
$title = '';
$description = get_string('courselistsettings_desc', $themename);
$setting = new admin_setting_heading($name, $title, $description);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Course Layout.
$name = $themename . '/courselistlayout';
$title = get_string('courselistlayout' , $themename);
$description = get_string('courselistlayout_desc', $themename);
$choices = [];
for ($cnt = -3; $cnt <= 5; $cnt++) {
    $choices[$cnt] = get_string('courselistlayout' . $cnt, $themename);
}
$default = get_string('courselistlayout0', $themename);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Course List Columns
$name = $themename . '/courselistcolumns';
$title = get_string('courselistcolumns' , $themename);
$description = get_string('courselistcolumns_desc', $themename);
$choices = [1, 2, 3, 4];
$default = 2;
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Card header.
$name = $themename . '/cardheader';
$title = get_string('cardheader', $themename);
$description = get_string('cardheader_desc', $themename);
$choices = [];
for ($cnt = 0; $cnt <= 2; $cnt++) {
    $choices[$cnt] = get_string('cardheaderopt' . $cnt, $themename);
}
$default = 0; // None.
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show card image.
$name = $themename . '/cardimage';
$title = get_string('cardimage', $themename);
$description = get_string('cardimage_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show card category.
$name = $themename . '/cardcategory';
$title = get_string('cardcategory', $themename);
$description = get_string('cardcategory_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show card summary.
$name = $themename . '/cardsummary';
$title = get_string('cardsummary', $themename);
$description = get_string('cardsummary_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show card contacts.
$name = $themename . '/cardcontacts';
$title = get_string('cardcontacts', $themename);
$description = get_string('cardcontacts_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show card custom fields.
$name = $themename . '/cardcustomfields';
$title = get_string('cardcustomfields', $themename);
$description = get_string('cardcustomfields_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show card button.
$name = $themename . '/cardbutton';
$title = get_string('cardbutton', $themename);
$description = get_string('cardbutton_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show progress.
$name = $themename . '/cardprogress';
$title = get_string('cardprogress', $themename);
$description = get_string('cardprogress_desc', $themename);
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Card Footer.
$name = $themename . '/cardfooter';
$title = get_string('cardfooter', $themename);
$description = get_string('cardfooter_desc', $themename);
$choices = [];
for ($cnt = 0; $cnt <= 4; $cnt++) {
    $choices[$cnt] = get_string('cardfooteropt' . $cnt, $themename);
}
$default = 0; // None.
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Front Page/Home Page Course List Tag Filter.
$name = $themename . '/filtercoursesbytag';
$title = get_string('filtercoursesbytag', $themename);
$description = get_string('filtercoursesbytag_desc', $themename);
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Filter out courses in course lists and search results whose forced language, if set, does not match the current language.
$name = $themename . '/filtercoursesbylang';
$title = get_string('filtercoursesbylang', $themename);
$description = get_string('filtercoursesbylang_desc', $themename);
$default = 0;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Add the page after definiting all the settings!
$settings->add($page);
