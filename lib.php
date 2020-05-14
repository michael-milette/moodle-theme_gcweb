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
 * WET-BOEW GCWeb theme library.
 *
 * @package   theme_gcweb
 * @copyright 2016-2019 TNG Consulting Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.

/**
 * Add support for the moodle-local_accessibilitytool plugin, if availble.
 *
 * @param page Moodle page object
 */
function theme_gcweb_page_init(moodle_page $page) {
    global $CFG;
    if (file_exists($CFG->dirroot . "/local/accessibilitytool/lib.php")) {
        require_once($CFG->dirroot . "/local/accessibilitytool/lib.php");
        local_accessibilitytool_page_init($page);
    }
}

/**
 * Post process the CSS tree.
 *
 * @param string $tree The CSS tree.
 * @param theme_config $theme The theme config object.
 */
function theme_gcweb_css_tree_post_processor($tree, $theme) {
    $prefixer = new theme_gcweb\autoprefixer($tree);
    $prefixer->prefix();
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_gcweb_get_extra_scss($theme) {
    global $CFG;
    
    $customcss = '';

    //
    // Hide User Profile Fields.
    //

    // Section: General.
    if (empty($theme->settings->showprofileemaildisplay)) {
        $customcss .= 'fieldset#id_moodle .fcontainer .form-group:nth-child(10),'; // Email display.
    }
    if (empty($theme->settings->showprofilecity)) {
        $customcss .= 'fieldset#id_moodle .fcontainer .form-group:nth-child(11),'; // City.
    }
    if (empty($theme->settings->showprofilecountry)) {
        $customcss .= 'fieldset#id_moodle .fcontainer .form-group:nth-child(12),'; // Country.
    }
    if (empty($theme->settings->showprofiletimezone)) {
        $customcss .= 'fieldset#id_moodle .fcontainer .form-group:nth-child(13),'; // Timezone.
    }
    if (empty($theme->settings->showprofiledescription)) {
        $customcss .= 'fieldset#id_moodle .fcontainer .form-group:nth-child(14),'; // Description.
    }

    // Section: User Picture.
    if (empty($theme->settings->showprofilepictureofuser)) {
        $customcss .= 'fieldset#id_moodle_picture,';
    }

    // Section: Additional Names.
    if (empty($theme->settings->showprofileadditionalnames)) {
        $customcss .= 'fieldset#id_moodle_additional_names,';
    }

    // Section: Interests.
    if (empty($theme->settings->showprofileinterests)) {
        $customcss .= 'fieldset#id_moodle_interests,';
    }

    // Section: Optional.
    if (empty($theme->settings->showprofileoptional)) {
        $customcss .= 'fieldset#id_moodle_optional,';
    }
    if (empty($theme->settings->showprofilewebpage)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(1),'; // Web Page.
    }
    if (empty($theme->settings->showprofileicqnumber)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(2),'; // ICQ.
    }
    if (empty($theme->settings->showprofileskypeid)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(3),'; // Skype.
    }
    if (empty($theme->settings->showprofileaimid)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(4),'; // AIM.
    }
    if (empty($theme->settings->showprofileyahooid)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(5),'; // Yahoo.
    }
    if (empty($theme->settings->showprofilemsnid)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(6),'; // MSN.
    }
    if (empty($theme->settings->showprofileidnumber)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(7),'; // ID number.
    }
    if (empty($theme->settings->showprofileinstitution)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(8),'; // Institution.
    }
    if (empty($theme->settings->showprofiledepartment)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(9),'; // Department.
    }
    if (empty($theme->settings->showprofilephone1)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(10),'; // Phone.
    }
    if (empty($theme->settings->showprofilephone2)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(11),'; // Mobile phone.
    }
    if (empty($theme->settings->showprofileaddress)) {
        $customcss .= 'fieldset#id_moodle_optional .fcontainer .form-group:nth-child(12),'; // Address.
    }

    // Hide links to Moodle page activities unless in edit mode on the front page.
    if (!empty($theme->settings->hidefrontpagelinkstopages)) {
        $customcss .= '#page-site-index:not(.editing) #page-content .modtype_page,';
    }

    // Completely hide conditionally hidden activities unless in edit mode on the front page.
    if (!empty($theme->settings->hideconditionallyhidden)) {
        $customcss .= '#page-site-index:not(.editing) .section .conditionalhidden,';
        $customcss .= '#page-site-index:not(.editing) .section .isrestricted,';
    }

    // Automatically hide guest login button if Auto-login Guests is enabled and Guest Login button is visible.
    if (!empty($CFG->autologinguests) && !empty($CFG->guestloginbutton)) {
        $customcss .= '#guestlogin,';
    }

    // Show or hide the Moodle logo on the Font Page.
    if (empty($theme->settings->footershowmoodlelogo)) {
        $customcss .= '.sitelink,';
    }

    // If there is something to hide, hide it.
    if (!empty($customcss)) {
        $customcss .= ' displaynone {display: none;}';
    }

    // Hide local login form on login page.
    if (!empty($theme->settings->hidelocallogin)) {
        $customcss .= '#page-login-index .card-body div.col-md-5:first-child, .forgetpass {display:none;}';
        $customcss .= '#page-login-index .card-body div.col-md-5 {flex: auto;max-width: 100%;}';
    }
    
    // Dashboard - Wrap Recently accessed courses list.
    if (!empty($theme->settings->wraprecentlyaccessedcourses)) {
        $customcss .= '.dashboard-card-deck.one-row {flex-flow: wrap;overflow-x: unset;}';
    }

    // Always return the scss when we have it.
    return $customcss . $theme->settings->scss;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_gcweb_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo' || $filearea === 'backgroundimage')) {
        $theme = theme_config::load('gcweb');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string All fixed Sass for this theme.
 */
function theme_gcweb_get_main_scss_content($theme) {
    global $CFG;

     // Main CSS - Get the main SCSS from out theme.
    $scss = file_get_contents($CFG->dirroot . '/theme/gcweb/scss/default.scss');

    // Combine them together.
    return $scss;
}

// /**
 // * Get compiled css.
 // *
 // * @return string compiled css
 // */
// function theme_gcweb_get_precompiled_css() {
    // global $CFG;
    // return file_get_contents($CFG->dirroot . '/theme/gcweb/style/moodle.css');
// }

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
// function theme_gcweb_get_pre_scss($theme) {
    // $scss = '';
    // $configurable = [
        // // Config key => [variableName, ...].
        // 'brandcolor' => ['primary'],
    // ];

    // // Prepend variables first.
    // foreach ($configurable as $configkey => $targets) {
        // $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        // if (empty($value)) {
            // continue;
        // }
        // array_map(function($target) use (&$scss, $value) {
            // $scss .= '$' . $target . ': ' . $value . ";\n";
        // }, (array) $targets);
    // }

    // // Prepend pre-scss.
    // if (!empty($theme->settings->scsspre)) {
        // $scss .= $theme->settings->scsspre;
    // }

    // return $scss;
// }
