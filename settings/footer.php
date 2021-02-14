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
 * Settings for footer.
 *
 * @package    theme_gcweb
 * @copyright  2016-2021 TNG Consulting Inc. <https://www.tngconsulting.ca>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// General settings.
$page = new admin_settingpage($themename . '_footer', get_string('footer', $themename));

// If first time, initialize this tab's settings with defaults.
if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
    set_config('showproblem', 1, $themename); // Yes.
    set_config('problembuttonurl', '', $themename); // None.
    set_config('showshare', 0, $themename); // No.
    set_config('footershowmoodledocs', 1, $themename); // Yes.
    set_config('footershowhomelink', 1, $themename); // Yes.
    set_config('footershowlogininfo', 1, $themename); // Yes.
    set_config('footnote', '', $themename); // Blank.
}

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
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_RAW_TRIMMED);
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

// Show Moodle Logo.
$name = $themename . '/footershowmoodlelogo';
$title = get_string('footershowmoodlelogo', $themename);
$description = get_string('footershowmoodlelogo_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Moodle Docs link.
$name = $themename . '/footershowmoodledocs';
$title = get_string('footershowmoodledocs', $themename);
$description = get_string('footershowmoodledocs_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show Home link.
$name = $themename . '/footershowhomelink';
$title = get_string('footershowhomelink', $themename);
$description = get_string('footershowhomelink_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show login info link.
$name = $themename . '/footershowlogininfo';
$title = get_string('footershowlogininfo', $themename);
$description = get_string('footershowlogininfo_desc', $themename);
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Footer.
$name = $themename . '/footertext';
$title = get_string('footertext', $themename);
$description = get_string('footertextdesc', $themename);
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Footnote (e.g. Privacy, Terms & conditions, phone number, etc).
$name = $themename . '/footnote';
$title = get_string('footnote', $themename);
$description = get_string('footnote_desc', $themename);
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Add the page after definiting all the settings!
$settings->add($page);
