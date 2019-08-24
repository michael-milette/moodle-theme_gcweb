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
 * Settings for header.
 *
 * @package    theme_gcweb
 * @copyright  2016-2019 TNG Consulting Inc. <http://www.tngconsulting.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die;

// General settings.
$page = new admin_settingpage($themename . '_header', get_string('header', $themename));

// If first time, initialize this tab's settings with defaults.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    set_config('showsignon', 1, $themename); // Yes.
    set_config('showregister', 1, $themename); // Yes.
    set_config('showaccountsettings', 1, $themename); // Yes.
    set_config('alternatelogouturl', '', $themename); // None.
    set_config('showsearch', 1, $themename); // Yes.
    set_config('showhomebreadcrumbs', 1, $themename); // Yes.
    set_config('prebreadcrumbs', '', $themename); // None.
}

// Show Sign-on button.
$name = $themename . '/showsignon';
$title = get_string('showsignon', $themename);
$description = get_string('showsignon_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Register button.
$name = $themename . '/showregister';
$title = get_string('showregister', $themename);
$description = get_string('showregister_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Account Settings button.
$name = $themename . '/showaccountsettings';
$title = get_string('showaccountsettings', $themename);
$description = get_string('showaccountsettings_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Custom alternate logout URL - only applicable for accounts other than Manual and Email-based self-registration.
$name = $themename . '/alternatelogouturl';
$title = get_string('alternatelogouturl', $themename);
$description = get_string('alternatelogouturl_desc', $themename);
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Course Search field.
$name = $themename . '/showsearch';
$title = get_string('showsearch', $themename);
$description = get_string('showsearch_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Home Breadcrumbs.
$name = $themename . '/showhomebreadcrumbs';
$title = get_string('showhomebreadcrumbs', $themename);
$description = get_string('showhomebreadcrumbs_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Pre-breadcrumbs.
$name = $themename . '/prebreadcrumbs';
$title = get_string('prebreadcrumbs', $themename);
$description = get_string('prebreadcrumbs_desc', $themename);
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Add the page after definiting all the settings!
$settings->add($page);
