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
 * Alert Settings.
 *
 * @package    theme_gcweb
 * @copyright  2016-2022 TNG Consulting Inc. <https://www.tngconsulting.ca>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// General settings.
$page = new admin_settingpage($themename . '_alert', get_string('alertsettings', $themename));

// Alert types.
$alerts['info'] = get_string('alertinfo', $themename);
$alerts['warning'] = get_string('alertwarning', $themename);
$alerts['success'] = get_string('alertsuccess', $themename);
$alerts['danger'] = get_string('alertdanger', $themename);
$alerttypes = array_keys($alerts);

$iedetecttitle = '{mlang en}' . get_string_manager()->get_string('iedetect_heading', 'theme_gcweb', null, 'en') . '{/mlang}'
        . '{mlang fr}' . get_string_manager()->get_string('iedetect_heading', 'theme_gcweb', null, 'fr') . '{/mlang}';
$iedetectmessage = '<p>{mlang en}' . get_string_manager()->get_string('iedetect_message', 'theme_gcweb', null, 'en') . '{/mlang}'
        . '{mlang fr}' . get_string_manager()->get_string('iedetect_message', 'theme_gcweb', null, 'fr') . '{/mlang}</p>';

// If first time, initialize this tab's settings with defaults.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    for ($cnt = 1; $cnt <= 4; $cnt++) {
        set_config('alert' . $cnt . 'type', $alerttypes[$cnt - 1], $themename);
    }
    // IE Detection Alert.
    set_config('alertiedetectenable', true, $themename);
    set_config('alertiedetecttype', $alerttypes[1], $themename);
}

// User alerts.
$name = 'theme_gcweb_alerts';
$title = get_string('alertsheadingsub', $themename);
$description = get_string('alertsdesc', $themename);
$setting = new admin_setting_heading($name, $title, $description);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

for ($cnt = 1; $cnt <= 4; $cnt++) {
    // Enable alert.
    $name = 'theme_gcweb/alert' . $cnt . 'enable';
    $title = get_string('alertenable', $themename) . ' ' . $cnt;
    $description = get_string('alertenabledesc', $themename);
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Alert type.
    $name = 'theme_gcweb/alert' . $cnt . 'type';
    $title = get_string('alerttype', $themename);
    $description = get_string('alerttypedesc', $themename);
    $default = $alerttypes[$cnt - 1];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $alerts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Alert title.
    $name = 'theme_gcweb/alert' . $cnt . 'title';
    $title = get_string('alerttitle', $themename);
    $description = get_string('alerttitledesc', $themename);
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Alert text.
    $name = 'theme_gcweb/alert' . $cnt . 'text';
    $title = get_string('alerttext', $themename);
    $description = get_string('alerttextdesc', $themename);
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
}

// Enable IE detection alert.
$name = 'theme_gcweb/alertiedetectenable';
$title = get_string('alertiedetectenable', $themename);
$description = get_string('alertiedetectenabledesc', $themename);
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Enable IE detection alert type.
$name = 'theme_gcweb/alertiedetecttype';
$title = get_string('alerttype', $themename);
$description = get_string('alerttypedesc', $themename);
$default = $alerttypes[1];
$setting = new admin_setting_configselect($name, $title, $description, $default, $alerts);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// The heading and text for IE detection alert is in the language pack.

// Add the page after defining all the settings!
$settings->add($page);
