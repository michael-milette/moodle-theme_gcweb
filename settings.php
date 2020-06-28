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
 * Main settings file.
 *
 * @package    theme_gcweb
 * @copyright  2016-2020 TNG Consulting Inc. unless otherwise noted.
 * @author     Michael Milette <www.tngconsulting.ca>
 * @license    WET-BOEW-MOODLE: http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 * @license    Moodle: http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 * @license    WET-BOEW: https://github.com/wet-boew/wet-boew/blob/master/License-eng.txt MIT License.
 * @license    Government of Canada graphics: Government of Canada http://www.tbs-sct.gc.ca/fip-pcim/index-eng.asp .
 * @license    3rd party software included with WET-BOEW: Held by the respective copyright holders as noted in those files.
 * @credits    theme_boost - MoodleHQ
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Settings have been split into separate files, one for each tab. These are called from this main settings.php file.

defined('MOODLE_INTERNAL') || die;

// Fix date format - enable leading zeros for day.
$CFG->nofixday  = true;

// Theme name.
$themename = 'theme_gcweb';

if ($ADMIN->fulltree) {
    $themename = 'theme_gcweb';
    $settings = new theme_boost_admin_settingspage_tabs('themesettinggcweb', get_string('configtitle', $themename));

    // First time or reset, remove any previous setting.
    if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
        unset_all_config_for_plugin($themename);
    }

    require('settings/general.php');
    require('settings/css.php'); // TODO: Settings page is done however the theme does not include in the SCSS information.
    require('settings/courselist.php');
    require('settings/profilefields.php');
    require('settings/header.php');
    require('settings/alerts.php');
    require('settings/footer.php');
    require('settings/styleguide.php');
    require('settings/about.php');

    // First time or reset, set init flag.
    if (empty(get_config($themename, 'init')) || (is_siteadmin() && optional_param('resettheme', 0, PARAM_INT) == 1)) {
        set_config('init', 1, $themename);
    }
}