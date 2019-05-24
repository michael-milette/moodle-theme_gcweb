<?php
 
// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.
 
// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();
 
// We will add callbacks here as we add features to our theme.

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string All fixed Sass for this theme.
 */
function theme_wetboew_internet_get_main_scss_content($theme) {
    global $CFG;
 
    $scss = '';
 
    $fs = get_file_storage();
    
    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/wetboew_internet/scss/pre.scss');
 
     // Main CSS - Get the CSS from theme Classic.
    $scss .= file_get_contents($CFG->dirroot . '/theme/wetboew_internet/scss/default.scss');
    // $scss .= file_get_contents($CFG->dirroot . '/theme/wetboew_internet/frameworkd/css/theme.min.css');
    // $scss .= file_get_contents($CFG->dirroot . '/theme/wetboew_internet/frameworkd/css/cdtsfixes.css');
    // $scss .= file_get_contents($CFG->dirroot . '/theme/wetboew_internet/frameworkd/css/cdtsapps.css');
    // $scss .= file_get_contents($CFG->dirroot . '/theme/wetboew_internet/frameworkd/css/mdlfix.css');

    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/wetboew_internet/scss/post.scss');
 
    // Combine them together.
    return $pre . "\n" . $scss . "\n" . $post;
}

/**
 *  @brief Better Titles
 *  
 *  @param [in] $defaulttitle Default title if not found in list of links.
 *  @return Returns an alternate page title depending on the URL
 */
function theme_wetboew_internet_betterpagetitle($defaulttitle = '') {
    $urls = array(
        '/backup/import.php' => get_string('importdata'),
        '/calendar/view.php' => get_string('calendar', 'calendar'),
        '/login/index.php' => get_string('signon', 'theme_wetboew_internet'),
        '/login/logout.php' => get_string('signout', 'theme_wetboew_internet'),
        '/login/signup.php' => get_string('startsignup'),
        '/mod/' => get_string('activity') . ' : '.$defaulttitle,
        '/my/index.php' => get_string('mycourses'),
        '/user/edit.php' => get_string('editmyprofile'),
    );
    foreach($urls as $url => $title) {
        if (stripos($_SERVER['SCRIPT_NAME'], $url) !== false) {
            $defaulttitle = $title;
        }
    }
    return $defaulttitle;
}
