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

namespace theme_gcweb\output;

use coding_exception;
use html_writer;
use tabobject;
use tabtree;
use custom_menu_item;
use custom_menu;
use filter_manager;
use block_contents;
use navigation_node;
use action_link;
use stdClass;
use moodle_url;
use preferences_groups;
use action_menu;
use help_icon;
use single_button;
use single_select;
use paging_bar;
use url_select;
use context_course;
use pix_icon;
use theme_config;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_gcweb
 * @copyright  2016-2020 TNG Consulting Inc. <www.tngconsulting.ca>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * Returns '' which removes the default Moodle behaviour. We will deal with the language menu in a different way.
     * @return string empty string
     */
    public function lang_menu() {
        return '';
    }

    /**
     * Returns language menu or '', this method also checks forcing of languages in courses.
     * This function calls {@link core_renderer::render_single_select()} to actually display the language menu.
     * @return string The lang menu HTML or empty string
     */
    public function wet_lang_menu() {
        global $CFG;

        if (empty($CFG->langmenu)) {
            return '';
        }

        if ($this->page->course->id != SITEID and !empty($this->page->course->lang)) {
            // Do not show lang menu if language forced.
            return '';
        }

        $currlang = current_language();
        $langs = get_string_manager()->get_list_of_translations();

        if (count($langs) < 2) {
            return ''; // Do not display language menu if only one language.
        }
//echo '<pre>';var_dump($langs);die;
        $s = '';
        foreach ($langs as $lang => $language) {
            if ($lang != $currlang) {
                if (!in_array($lang, ['ab', 'ba', 'hat', 'haw', 'mi', 'ms', 'om', 'tpi'])) {
                    if ($lang == 'cn_wp') {
                        $language = substr($language, strpos($language, ' ') + 1);
                    } else if (strpos($language, ' ')) {
                        $language = trim(substr($language, 0, strpos($language, ' ')));
                    }
                }
                $url = new moodle_url($this->page->url, ['lang' => $lang ]);
                $lang = str_replace('_', '-', $lang);
                $s .= '<li><a lang="' . $lang . '" href="' . $url . '">' . $language . '</a></li>' . PHP_EOL;
            }
        }

        return $s;
    }

    public function settings_menu() {
        return $this->context_header_settings_menu();
    }

    public function full_header() {
        global $CFG, $_PAGE, $OUTPUT, $USER;

        $header = new stdClass();
        $header->output = $OUTPUT;
        $header->langmenu = $_PAGE['langmenu'];
        $header->wetboew = $_PAGE['themewww'] . '/framework';
        $header->wwwroot = $CFG->wwwroot;
        $header->lang = current_language();
        $header->showsearch = $_PAGE['showsearch'];
        $header->searchurl = $_PAGE['searchurl'];
        $header->searchsettings = $_PAGE['searchsettings'];
        $header->sitename = $_PAGE['sitename'];
        $header->navdraweropen = $_PAGE['navdraweropen'];
        $header->showaccountsettings = $_PAGE['showaccountsettings'];
        $header->loggedin = $_PAGE['loggedin'];
        $header->showregister = $_PAGE['showregister'];
        $header->registerurl = $_PAGE['registerurl'];
        $header->signonurl = $_PAGE['signonurl'];
        $header->accountsettingsurl = $_PAGE['accountsettingsurl'];
        $header->signouturl = $_PAGE['signouturl'];
        $header->breadcrumbs = $_PAGE['breadcrumbs'];
        $header->userid = $USER->id;

        $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();

        /* If secondary nav */
        $header->skiptosectnav = $_PAGE['skiptosectnav'];

        return $this->render_from_template('theme_gcweb/header', $header);
    }

    /**
     * @brief Better page titles.
     *
     * @return Returns an alternate page title depending on the page.
     */
    public function pagetitle() {
        $title = '';
        if ($this->page->pagetype == 'site-index') { // Front page.
            if (empty($hometitle = get_config('theme_gcweb', 'hometitle'))) {
                $title = get_string('home');
            } else {
                $title = $hometitle;
            }
        } else { // All other pages.
            $title = $this->page->title;
        }
        if (!empty(get_config('theme_gcweb', 'titlesitename'))) {
            global $SITE;
            $title .= ' - ' . $SITE->fullname;
        }
        $title = format_string($title, false, ['context' => context_course::instance(SITEID), "escape" => false]);

        return $title;
    }

    /**
     * @brief Better page headings.
     *
     * @param [string] $title Default title if not found in list of links.
     * @return Returns an alternate page heading (h1) depending on the page layout,type and mode.
     */
    public function pageheading($title) {
        global $DB, $COURSE, $USER;

        $_PAGE['hometitle'] = $title;
        $mode = optional_param('mode', '', PARAM_ALPHA);
        if (!isguestuser() && isloggedin()) {
            $profilefullname = ' (' . $USER->firstname . ' ' . $USER->lastname . ')';
            $userid = optional_param('userid', optional_param('user', optional_param('id', $USER->id, PARAM_INT), PARAM_INT), PARAM_INT);
        } else {
            $profilefullname = '';
            $userid = 0;
        }
        switch ($this->page->pagelayout) {
            case $this->page->pagetype == 'mod-page-view' && $this->page->course->id == SITEID:
                $course = $this->page->course;
                $coursecontext = context_course::instance($course->id);
                if (!empty($this->page->cm->name)) {
                    $title = format_string($this->page->cm->name, false, ['context' => $coursecontext]);
                }
                break;
            case $this->page->pagetype == 'mod-forum-user': // Forum posts.
                if ($user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0))) {
                    $profilefullname = ' (' . $user->firstname . ' ' . $user->lastname . ')';
                }
                switch ($mode) {
                    case 'discussions':
                        $title = get_string('myprofileotherdis', 'mod_forum') . $profilefullname;
                        break;
                    default:
                        $title = get_string('forumposts', 'forum') . $profilefullname;
                        break;
                }
                break;
            case substr($this->page->pagetype, 0, 4) == 'mod-': // If a module.
                if ($COURSE->format == 'singleactivity') {
                    // Single activity course.
                    $title = format_string($COURSE->fullname, false);
                } else if (isset($this->page->cm->sectionnum)) {
                    // Viewing the page, not editing the page.
                    $title  = get_section_name($COURSE, $this->page->cm->sectionnum);
                }
                // Otherwise just keep page title as is.
                break;
            case 'incourse':
                switch ($this->page->pagetype) {
                    case 'notes-index': // Notes.
                        if ($user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0))) {
                            $profilefullname = ' (' . $user->firstname . ' ' . $user->lastname . ')';
                        }
                        $title = get_string('notes', 'notes') . $profilefullname;
                        break;
                    case 'backup-import': // Course > Import.
                        $title = $COURSE->shortname . ' : ' . get_string('importdata');
                        break;
                }
                break;
            case 'standard':
                if ($user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0))) {
                    $profilefullname = ' (' . $user->firstname . ' ' . $user->lastname . ')';
                }
                switch ($this->page->pagetype) {
                    case 'grade-report-overview-index': // Grades overview.
                        $title = get_string('gradesoverview', 'gradereport_overview') . $profilefullname;
                        break;
                    case 'badges-mybadges': // Badges.
                        $title .= $profilefullname;
                        break;
                    case 'badges-preferences': // Badges Preference.
                        $title .= $profilefullname;
                        break;
                    case 'badges-mybackpack': // My backpack Preference.
                        $title .= $profilefullname;
                        break;
                    case 'blog-external_blogs': // External blogs.
                        $title = get_string('externalblogs', 'blog') . $profilefullname;
                        break;
                    case 'blog-index': // Blogs Entries.
                        $title = get_string('myprofileuserblogs', 'blog') . $profilefullname;
                        break;
                    case 'admin-tool-lp-plans': // Learning plans.
                        $title = get_string('learningplans', 'tool_lp') . $profilefullname;
                        break;
                    case 'admin-tool-lp-user_evidence_list': // Evidence of prior learning.
                        $title = get_string('userevidence', 'tool_lp') . $profilefullname;
                        break;
                    case 'admin-tool-lp-user_evidence_edit': // Evidence of prior learning.
                        $title = get_string('addnewuserevidence', 'tool_lp') . $profilefullname;
                        break;
                    case 'calendar-view': // Calendar.
                        $title = get_string('calendar', 'calendar');
                }
                break;
            case 'course':    // Any type of courses page.
            case $this->page->pagetype == 'filter-manage':
            case $this->page->pagetype == 'course-edit':
            case $this->page->pagetype == 'course-completion':
            case substr($this->page->pagetype, 0, 6) == 'grade-':
            case substr($this->page->pagetype, 0, 6) == 'enrol-':
                $course = $this->page->course;
                $coursecontext = context_course::instance($course->id);
                $title = format_string($course->fullname, false, ['context' => $coursecontext]);
                break;
            case 'coursecategory':
                $id = optional_param('categoryid', 0, PARAM_INT);;
                if ($id) { // Category specific.
                    $title = $DB->get_field('course_categories', 'name', array('id' => $id), MUST_EXIST);
                    $title = format_string($title, false);
                } else { // All courses.
                    $title = get_string('fulllistofcourses');
                }
                break;
            case 'frontpage': // Home page.
                if (empty($title = get_config('gcweb', 'hometitle'))) {
                    $title = get_string('home');
                } else {
                    $title = format_string($title, false);
                }
                break;
            case 'login':
                switch ($this->page->pagetype) {
                    case 'login-index': // Sign-in / Login.
                        $title = get_string('signon', 'theme_gcweb');
                        break;
                    case 'login-logout': // Sign-out.
                        $title = get_string('signout', 'theme_gcweb');
                        break;
                    case 'login-signup': // Register.
                        $title = get_string('register', 'theme_gcweb') . ' : ' . $title;
                        break;
                }
                break;
            case 'base':
                switch ($this->page->pagetype) {
                    case 'login-logout': // Signout confirmation.
                        $title = get_string('signout', 'theme_gcweb');
                        break;
                }
                break;
            case 'mypublic':
                switch ($this->page->pagetype) {
                    case 'user-profile': // Account settings (Profile).
                        if ($user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0))) {
                            $profilefullname = ' (' . $user->firstname . ' ' . $user->lastname . ')';
                        }
                        $title = get_string('publicprofile') . $profilefullname;
                        break;

                }
                break;
            case 'report':
                if ($user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0))) {
                    $profilefullname = ' (' . $user->firstname . ' ' . $user->lastname . ')';
                }
                switch ($this->page->pagetype) {
                    case 'report-log-user': // Log Report.
                        switch ($mode) {
                            case 'today':
                                $title = get_string('todaylogs') . $profilefullname;
                                break;
                            default:
                                $title = get_string('alllogs') . $profilefullname;
                        }
                        break;
                    case 'report-outline-user':
                        switch ($mode) {
                            case 'outline':
                                $title = get_string('outlinereport') . $profilefullname;
                                break;
                            case 'complete':
                                $title = get_string('completereport') . $profilefullname;
                                break;
                        }
                        break;
                    case 'course-user': // Activity Report (grade).
                        if ($mode == 'grade') {
                            $title = get_string('pluginname' , 'gradereport_user') . ' - ' . get_string('grade') . $profilefullname;
                        }
                        break;
                }
                break;
            case 'admin':
                if ($this->page->pagetype == 'login-change_password') {
                    $userid = $USER->id;
                } else if ($user = $DB->get_record('user', array('id' => $userid, 'deleted' => 0))) {
                    $profilefullname = ' (' . $user->firstname . ' ' . $user->lastname . ')';
                }

                switch ($this->page->pagetype) {
                    case 'user-preferences': // Preferences
                        $title = get_string('accountsettings', 'theme_gcweb') . $profilefullname;
                        break;
                    case 'user-editadvanced': // Edit Profile.
                    case 'user-edit': // Edit Profile.
                        $title = get_string('editmyprofile') . $profilefullname;
                        break;
                    case 'login-change_password': // Change password.
                        $title .=  $profilefullname;
                        break;
                    case 'user-language': // Preferred language.
                        $title = get_string('preferredlanguage') . $profilefullname;
                        break;
                    case 'user-forum': // Forum Preferences.
                        $title = get_string('forumpreferences') . $profilefullname;
                        break;
                    case 'user-editor': // Editor Preferences.
                        $title = get_string('editorpreferences') . $profilefullname;
                        break;
                    case 'user-course': // Course Preferences.
                        $title = get_string('coursepreferences') . $profilefullname;
                        break;
                    case 'user-calendar': // Calendar Preferences.
                        $title = get_string('calendarpreferences', 'calendar') . $profilefullname;
                        break;
                    case 'message-edit': // Message Preferences.
                        $title .= $profilefullname;
                        break;
                    case 'message-notificationpreferences': // Notification Preferences.
                        $title .= $profilefullname;
                        break;
                    case 'blog-preferences': // Blog Preferences.
                        $title = get_string('preferences', 'blog') . $profilefullname;
                        break;
                    case 'blog-external_blog_edit': // Register an external blog.
                        $title = get_string('addnewexternalblog', 'blog') . $profilefullname;
                        break;
                    case 'report-usersessions-user': // Browser sessions.
                        $title .= $profilefullname;
                        break;
                    case 'auth-oauth2-linkedlogins': // Linked Logins.
                        $title = get_string('linkedlogins', 'auth_oauth2') . $profilefullname;
                        break;
                    case 'admin-setting-themesettinggcweb': // This Theme's settings.
                        $title = get_string('themesettings', 'admin');
                        break;
                    case 'admin-user': // Browser list of users.
                        $title = get_string('userlist', 'admin');
                        break;
                    case 'admin-user-editadvanced': // Add a new user.
                        $title = get_string('addnewuser');
                        break;
                    case 'backup-restorefile': // Restore a course.
                        $title = get_string('restorecourse', 'backup');
                        break;
                    case 'course-bulkcompletion': // Course completion.
                        $title = get_string('coursecompletion', 'completion') . " ($title)";
                        break;
                    case 'admin-roles-usersroles': // Role Assignments.
                    case 'admin-roles-permissions': // Permissions.
                    case 'admin-roles-check': // Role Check.
                    case 'backup-backup': // Course backup.
                    case 'admin-tool-lp-editplan': // Add/Edit Learning plan.
                    case 'report-participation-index': // Course Participation report.
                    case 'question-edit': // Edit Questions.
                    case 'question-category': // Edit categories.
                    case 'question-import': // Import questions from file.
                    case 'question-export': // Export questions to file.
                    case 'course-reset': // Reset course.
                        // These are fine as they are.
                        break;
                    default: // All others are site admin pages and will have the name of the site for now.
                        global $SITE;
                        $title = format_string($SITE->fullname, false);
                }
                break;
        }

        return $title;
    }

    /**
     * Returns HTML to display a "Turn editing on/off" button in a form.
     *
     * @param moodle_url $url The URL + params to send through when clicking the button
     * @return string HTML the button
     */
    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $title = get_string('turneditingoff');
            $icon = 'fa fa-power-off';
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $title = get_string('turneditingon');
            $icon = 'fa fa-edit';
        }
        return html_writer::tag('a',
                html_writer::start_tag('span', array('class' => $icon . ' icon-white')) .
                html_writer::end_tag('span'), array('href' => $url, 'class' => 'btn ' . $btn, 'title' => $title));
    }

    /**
     * Renders the login form.
     *
     * @param \core_auth\output\login $form The renderable.
     * @return string
     */
    public function render_login(\core_auth\output\login $form) {
        global $CFG, $SITE;

        $context = $form->export_for_template($this);

        // Override because rendering is not supported in template yet.
        if ($CFG->rememberusername == 0) {
            $context->cookieshelpiconformatted = $this->help_icon('cookiesenabledonlysession');
        } else {
            $context->cookieshelpiconformatted = $this->help_icon('cookiesenabled');
        }
        $context->errorformatted = $this->error_text($context->error);
        $url = $this->get_logo_url();
        if ($url) {
            $url = $url->out(false);
        }
        $context->logourl = $url;
        $context->sitename = format_string($SITE->fullname, true,
                ['context' => context_course::instance(SITEID), "escape" => false]);

        return $this->render_from_template('theme_gcweb/loginform', $context);
    }

    /**
     * Returns the URL for the favicon.
     *
     * @since Moodle 2.5.1 2.6
     * @return string The favicon URL
     */
    public function favicon() {
        global $CFG;
        return $CFG->wwwroot . '/theme/' . $this->page->theme->name . '/framework/assets/favicon.ico';
    }
    /*
     * Overriding the custom_menu function ensures the custom menu is
     * always shown, even if no menu items are configured in the global
     * theme settings page.
     */
    public function custom_menu($custommenuitems = '') {
        global $CFG;

        if (empty($custommenuitems) && !empty($CFG->custommenuitems)) {
            $custommenuitems = $CFG->custommenuitems;
        }
        // Don't filter menus on Theme Settings page or it will filter the custommenuitems field in the page and loose the tags.
        // Don't apply auto-linking filters.
        $filtermanager = filter_manager::instance();
        $filteroptions = array('originalformat' => FORMAT_HTML, 'noclean' => true);
        $skipfilters = array('activitynames', 'data', 'glossary', 'sectionnames', 'bookchapters');

        // Filter Custom Menu.
        $custommenuitems = $filtermanager->filter_text($custommenuitems,
                $this->page->context, $filteroptions, $skipfilters);
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }

    public function standard_top_of_body_html() {
        global $CFG;
        $additionalhtmltopofbody = $CFG->additionalhtmltopofbody;
        $CFG->additionalhtmltopofbody = format_text($CFG->additionalhtmltopofbody,
                FORMAT_HTML, ['noclean' => true, $this->page->context]);
        $output = parent::standard_top_of_body_html();
        $CFG->additionalhtmltopofbody = $additionalhtmltopofbody;
        return $output;
    }

    public function standard_end_of_body_html() {
        global $CFG;
        $additionalhtmlfooter = $CFG->additionalhtmlfooter;
        $CFG->additionalhtmlfooter = format_text($CFG->additionalhtmlfooter,
                FORMAT_HTML, ['noclean' => true, 'context' => $this->page->context]);
        $output = parent::standard_end_of_body_html();
        $CFG->additionalhtmlfooter = $additionalhtmlfooter;
        return $output;
    }
}