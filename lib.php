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
function theme_test_get_main_scss_content($theme) {
    global $CFG;
 
    $scss = '';
 
    $fs = get_file_storage();
 
    // Main CSS - Get the CSS from theme Classic.
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/classic/pre.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/preset/default.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/classic/post.scss');
 
    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/test/scss/pre.scss');
 
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/test/scss/post.scss');
 
    // Combine them together.
    return $pre . "\n" . $scss . "\n" . $post;
}