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

if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    // First time, initialize settings with defaults.
    unset_all_config_for_plugin($themename);
    set_config('showsignon', 1, $themename);
    set_config('showregister', 1, $themename);
    set_config('showaccountsettings', 1, $themename);
    set_config('alternatelogouturl', '', $themename);
    set_config('showsearch', 1, $themename);
    set_config('prebreadcrumbs', '', $themename);
    set_config('shownavdrawer', 1, $themename);
    set_config('showproblem', 1, $themename);
    set_config('problembuttonurl', '', $themename);
    set_config('showshare', 0, $themename);
    set_config('init', 1, $themename);
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

// Pre-breadcrumbs.
$name = $themename . '/prebreadcrumbs';
$title = get_string('prebreadcrumbs', $themename);
$description = get_string('prebreadcrumbs_desc', $themename);
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_RAW);
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

// Show Problem button.
$name = $themename . '/showproblem';
$title = get_string('showproblem', $themename);
$description = get_string('showproblem_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Problem button URL.
$name = $themename . '/problembuttonurl';
$title = get_string('problembuttonurl', $themename);
$description = get_string('problembuttonurl_desc', $themename);
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Share button. - TODO: Does not currently work.
// $name = $themename . '/showshare';
// $title = get_string('showshare', $themename);
// $description = get_string('showshare_desc', $themename);
// $default = 0;
// $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
// $setting->set_updatedcallback('theme_reset_all_caches');
// $page->add($setting);

// Add the page after definiting all the settings!
$settings->add($page);
