<?php
/**
 * This file is part of the wet-boew-moodle-internet project.
 *
 * Copyright © 2016 onwards by TNG Consulting Inc.
 *
 * The WET-BOEW-MOODLE-Internet theme for Moodle is provided freely as open source software, can be redistributed
 * and/or modified it under the terms of the GNU General Public License version 3.0 or later.
 *
 * This software is distributed in the hope that it will be useful. However, there is no warranty,
 * implied or otherwise, of merchantability or fitness for any purpose.
 *
 * If for any reason a copy of the GNU General Public License was not included with this project,
 * you can view it online by going to: https://www.gnu.org/licenses/gpl-3.0.en.html</p>
**/

/**
 * Main settings file.
 *
 * @package    theme_wetboew_internet
 * @copyright  2016 TNG Consulting Inc. unless otherwise noted.
 * @author     Michael Milette <www.tngconsulting.ca>
 * @license    WET-BOEW-MOODLE-Internet: http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
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

// Theme name
$themename = 'theme_wetboew_internet';

if ($ADMIN->fulltree) {
    $themename = 'theme_wetboew_internet';
    $settings = new theme_boost_admin_settingspage_tabs('themesettingwetboew_internet', get_string('configtitle', $themename));
    
    require('settings/general.php');
    require('settings/css.php');
    // require('settings/presets_settings.php');
    // require('settings/presets_adjustments_settings.php');
    // require('settings/image_settings.php');
    // require('settings/colours_settings.php');
    // require('settings/content_settings.php');
    // require('settings/menu_settings.php');
    // require('settings/fpicons_settings.php');
    // require('settings/modchooser_settings.php');
    // require('settings/slideshow_settings.php');
    // require('settings/markettiles_settings.php');
    // require('settings/footer_settings.php');
    // require('settings/customlogin_settings.php');
}