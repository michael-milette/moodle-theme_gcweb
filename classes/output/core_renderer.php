<?php
// This file is part of the classic theme for Moodle
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

namespace theme_wetboew_internet\output;

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

//require_once ($CFG->dirroot . "/course/renderer.php");

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_wetboew_internet
 * @copyright  2019 TNG Consulting Inc. <www.tngconsulting.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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

        if ($this->page->course != SITEID and !empty($this->page->course->lang)) {
            // do not show lang menu if language forced
            return '';
        }

        $currlang = current_language();
        $langs = get_string_manager()->get_list_of_translations();

        if (count($langs) < 2) {
            return ''; // Do not display language menu if only one language.
        }

        $s = '';
        foreach($langs as $lang => $language) {
            if($lang != $currlang) {
                if(strpos($language, '(')) {
                    $language = trim(substr($language, 0, strpos($language, '(')-4));
                }
                if(strpos($language, ' - ')) {
                    $language = trim(substr($language, 0, strpos($language, ' - ')));
                }
                $url = new moodle_url($this->page->url, ['lang' => $lang ]);
                $lang = str_replace('_', '-', $lang);
                $s .= '<li><a lang="' . $lang . '" href="' . $url . '">' . $language . '</a></li>' . PHP_EOL;
            }
        }

        return $s;
    }


    /**
     * Return the navbar content so that it can be echoed out by the layout
     *
     * @return string XHTML navbar
     */
    public function xnavbar() {
        return $this->render_from_template('core/navbar', $this->page->navbar);
    }

    /*
     * Render the breadcrumb
     * @param array $items
     * @param string $breadcrumbs
     *
     * return string
     */
    public function navbar($breadcrumbs = '') {
        $items = $this->page->navbar->get_items();
        foreach ($items as $item) {
            $item->hideicon = true;
            $breadcrumbs .= html_writer::tag('li', $this->render($item));
        }
        return html_writer::tag('ol', $breadcrumbs, ['class' => 'breadcrumb']);
    }

    public function settings_menu() {
        return $this->context_header_settings_menu();
    }

    public function full_header() {
        global $CFG, $PAGE, $_PAGE, $OUTPUT, $USER;

        // $theme = theme_config::load('wetboew_internet');
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

        //$header->contextheader = $this->context_header();
        //$header->contextheader = html_writer::link(new moodle_url('/course/view.php', array(
        //    'id' => $PAGE->course->id
        //)) , $this->context_header());
        //$header->headerimage = $this->headerimage();
        $header->hasnavbar = empty($PAGE->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();

        /* If secondary nav */
        $header->skiptosectnav = $_PAGE['skiptosectnav'];

        return $this->render_from_template('theme_wetboew_internet/header', $header);
    }

    /**
     *  @brief Better Titles
     *
     *  @param [string] $title Default title if not found in list of links.
     *  @return Returns an alternate page title depending on the page layout and type.
     */
    public function pagetitle($title) {
        global $SITE, $DB, $COURSE;

        switch ($this->page->pagelayout) {
            case substr($this->page->pagetype, 0, 4) == 'mod-':
                if ($COURSE->format == 'singleactivity') {
                    $title = format_string($COURSE->fullname, false);
                } elseif (isset($this->page->cm->sectionnum)) {
                    // Viewing the page, not editing the page.
                    $title  = get_section_name($COURSE, $this->page->cm->sectionnum);
                }
                break;
            case 'course':
            case 'incourse':
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
                if($id) {
                    $title = $DB->get_field('course_categories', 'name', array('id' => $id), MUST_EXIST);
                    $title = format_string($title, false);
                } else {
                    $title = get_string('fulllistofcourses');
                }
                break;
            case 'frontpage':
                $title = '';
                break;
            case 'login':
               switch ($this->page->pagetype) {
                    case 'login-index':
                        $title = get_string('signon', 'theme_wetboew_internet');
                        break;
                    case 'login-logout':
                        $title = get_string('signout', 'theme_wetboew_internet');
                        break;
                    case 'login-signup':
                        $title = get_string('register', 'theme_wetboew_internet') . ' : ' . $title;
                        break;
                }
                break;
             case 'admin':
               switch ($this->page->pagetype) {
                    case 'backup-backup':
                        //$title = get_string('backup', 'theme_wetboew_internet');
                        break;
                    case 'backup-restorefile':
                        $title = get_string('restorecourse', 'backup');
                        break;
                    default:
                        $title = format_string($SITE->fullname, false);
                }
                break;
             case 'base':
                switch ($this->page->pagetype) {
                    case 'login-logout':
                        $title = get_string('signout', 'theme_wetboew_internet');
                        break;
                }
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
     * Returns the URL for the favicon.
     *
     * @since Moodle 2.5.1 2.6
     * @return string The favicon URL
     */
    public function favicon() {
        global $CFG, $PAGE;
        return $CFG->wwwroot . '/theme/' . $PAGE->theme->name . '/framework/assets/favicon.ico';
    }
    /*
     * Overriding the custom_menu function ensures the custom menu is
     * always shown, even if no menu items are configured in the global
     * theme settings page.
     */
    public function custom_menu($custommenuitems = '') {
        global $CFG, $PAGE;

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
                $PAGE->context, $filteroptions, $skipfilters);
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }

    public function standard_top_of_body_html() {
        global $CFG, $PAGE;
        $additionalhtmltopofbody = $CFG->additionalhtmltopofbody;
        $CFG->additionalhtmltopofbody = format_text($CFG->additionalhtmltopofbody, FORMAT_HTML, ['noclean' => true, $PAGE->context]);
        $output = parent::standard_top_of_body_html();
        $CFG->additionalhtmltopofbody = $additionalhtmltopofbody;
        return $output;
    }

    public function standard_end_of_body_html() {
        global $CFG, $PAGE;
        $additionalhtmlfooter = $CFG->additionalhtmlfooter;
        $CFG->additionalhtmlfooter = format_text($CFG->additionalhtmlfooter, FORMAT_HTML, ['noclean' => true, 'context' => $PAGE->context]);
        $output = parent::standard_end_of_body_html();
        $CFG->additionalhtmlfooter = $additionalhtmlfooter;
        return $output;
    }
}
