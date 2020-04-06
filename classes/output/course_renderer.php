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
 * Course renderer.
 *
 * @package   theme_gcweb
 * @copyright 2016-2020 TNG Consulting Inc. - www.tngconsulting.ca
 * @copyright 2016 Frédéric Massart - FMCorz.net
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_gcweb\output\core;

defined('MOODLE_INTERNAL') || die();

use moodle_url;
use lang_string;
use coursecat_helper;
use core_course_category;
use stdClass;
use core_course_list_element;
use context_course;
use context_system;
use pix_url;
use html_writer;
use heading;
use pix_icon;
use image_url;
use single_select;

// Load libraries.
require_once $CFG->dirroot . '/course/renderer.php';

/**
 * Course renderer class.
 *
 * @package theme_gcweb
 * @author  Michael Milette - TNG Consulting Inc. <www.tngconsulting.ca>
 * @author  Frédéric Massart - <FMCorz.net>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {
    protected $countcategories = 0;

    /* Course contacts. */
    private function getcontacts($course) {
        $content = '';
        if ($course->has_course_contacts()) {
            $content .= html_writer::start_tag('ul', array('class' => 'teacherscourseview list-unstyled m-0 p-0'));
            foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                $name = $coursecontact['rolename'] . ': ' . $coursecontact['username'];
                $content .= html_writer::tag('li', $name);
            }
            $content .= html_writer::end_tag('ul');
        }
        return $content;
    }

    private function getcatcontent($course) {
        // Display course category.
        if ($cat = core_course_category::get($course->category, IGNORE_MISSING)) {
            $catcontent = html_writer::link(new moodle_url('/course/index.php', array('categoryid' => $cat->id)),
                    $cat->get_formatted_name(), array('class' => $cat->visible ? '' : 'dimmed'));
        } else {
            $catcontent = '';
        }
        return $catcontent;
    }

    private function getpixicons($course) {
        $pixicons = '';
        //if ($cat = core_course_category::get($course->category, IGNORE_MISSING)) {
            if ($icons = enrol_get_course_info_icons($course)) {
                // Print enrolment icons.
                foreach ($icons as $pix_icon) {
                    $pixicons .= $this->render($pix_icon);
                }
                if (!empty($pixicons)) {
                    $pixicons = html_writer::start_tag('span', array('class' => 'enrolmenticons')) . $pixicons;
                    $pixicons .= html_writer::end_tag('span');
                }
            }
        //}
        return $pixicons;
    }

    private function getcustomfieldcontent($course) {
        // Display custom fields.
        $customfieldcontent = '';
        if ($course->has_custom_fields()) {
            $handler = \core_course\customfield\course_handler::create();
            if (!empty($customfields = $handler->display_custom_fields_data($course->get_custom_fields()))) {
                $customfieldcontent = \html_writer::tag('div', $customfields, ['class' => 'customfields-container']);
            }
        }
        return $customfieldcontent;
    }

    private function getprogressbar($course, $systemcontext) {
        // Course completion Progress bar
        $progressbar = '';
        $comppercent = 0;
        if ($course->enablecompletion == 1 && isloggedin() && $systemcontext == 'page-site-index') {
            if (\core_completion\progress::get_course_progress_percentage($course)) {
                $comppc = \core_completion\progress::get_course_progress_percentage($course);
                $comppercent = number_format($comppc, 0);
                $progressbar = '<meter value="' . $comppercent . '" min="0" max="100">' . $comppercent . '%</meter> <span class="small">' . $comppercent . '% ' . get_string('completed', 'completion') . '</span> ';
            }
        }
        return $progressbar;
    }

    private function getimgurl($course) {
        // Load image from course image. If none, generate a course image based on the course ID.
        $imgurl = '';
        $context = context_course::instance($course->id);
        if ($course instanceof stdClass) {
            $course = new \core_course_list_element($course);
        }
        $coursefiles = $course->get_course_overviewfiles();
        foreach ($coursefiles as $file) {
            if ($isimage = $file->is_valid_image()) {
                $imgurl = file_encode_url("/pluginfile.php", '/' . $file->get_contextid() . '/' . $file->get_component() . '/' . $file->get_filearea() . $file->get_filepath() . $file->get_filename() , !$isimage);
                $imgurl = new moodle_url($imgurl);
            }
        }
        if (empty($imgurl)) {
            global $OUTPUT;
            $imgurl = $OUTPUT->get_generated_image_for_id($course->id);
        }
        return $imgurl;
    }

    private function hastag($courseid, $tag) {
        if (empty($tag)) {
            return true;
        }
        $tags = \core_tag_tag::get_item_tags_array('core', 'course', $courseid);
        $tags = ($tags) ? array_values($tags) : [];
        $found = in_array(strtolower($tag), array_map('strtolower', $tags));
        return $found;
    }

    /*
     * Available courses
     */
    public function view_available_courses($categoryid = 0, $courses = null, $totalcount = null) {
        if (count($courses) == 0) {
            return '';
        }

        global $CFG, $OUTPUT, $USER, $_PAGE;

        // Note: If you modify the list of layouts, you must change the language file, settings/general.php,
        // wet-boew-moodle.css, wet-boew-moodle-min.css and classes/output/course_renderer.php.
        $courselistlayout = optional_param('layout', $this->page->theme->settings->courselistlayout, PARAM_INT);
        $columns = optional_param('cols', $this->page->theme->settings->courselistcolumns + 1, PARAM_INT);

        $context = context_system::instance();
        $systemcontext = $this->page->bodyid;

        $content = '';
        $hasside = $_PAGE['hasblocks'] ? ' hasside' : ' noside';
        $grid = 'cols-' . $columns . $hasside . ' clayout' . $courselistlayout;

        switch($courselistlayout) {
            case -3: // Expandable list (name/details).
                $header = '<div class="container-fluid"><ul class="list-unstyled' . ' clayout' . $courselistlayout . '">';
                $footer = '</ul></div>';
                break;
            case -2: // Table list.
                $header = '<div class="container-fluid' . ' clayout' . $courselistlayout . '">';
                $header .= '<div class="table-responsive">';
                $header .= '<table class="table table-sm table-hover">';
                $header .= '<thead><tr>';
                $header .= '<th scope="col" style="width:30%">' . get_string('course') . '</th>';
                if (!empty($this->page->theme->settings->cardcategory)) {
                    $header .= '<th scope="col" style="width:15%">' . get_string('category') . '</th>';
                }
                if (!empty($this->page->theme->settings->cardcustomfields)) {
                    $header .= '<th scope="col" style="width:20%">' . get_string('moreinfo') . '</th>';
                }
                if (!empty($this->page->theme->settings->coursesummary)) {
                    $header .= '<th scope="col" style="width:35%">' . get_string('summary') . '</th>';
                }
                if (!empty($this->page->theme->settings->cardcontacts)) {
                    $header .= '<th scope="col" style="width:25%">' . get_string('contacts', 'message') . '</th>';
                }
                $header .= '</tr></thead><tbody>';
                $footer = '</tbody></table>';
                break;
            case -1: // Masonry.
                $header = '<div id="category-course-list">';
                $header .= '<div class="container-fluid mt-2">';
                $header .= '<div class="row">';
                $header .= '<div class="card-columns ' . $hasside . '">';
                $footer = '</div>';
                $footer .= '</div>';
                $footer .= '</div>';
                $footer .= '</div>';
                break;
            default: // All others.
                $header = '<div class="container-fluid mt-2">';
                $header .= '<div class="card-deck">';
                $footer = '</div>';
                $footer .= '</div>';
                break;
        }

        $acourseids = array_keys($courses);
        foreach ($acourseids as $courseids) {
            $course = get_course($courseids);

            $context = context_course::instance($course->id);

            // Learner's progress bar.
            $courseinfo['progressbar'] = $this->getprogressbar($course, $systemcontext);

            if ($course instanceof stdClass) {
                $course = new core_course_list_element($course);
            }

            // Course summary.
            if (!empty($this->page->theme->settings->cardsummary)) {
                if ($systemcontext == 'page-site-index') {
                    $coursesummary = file_rewrite_pluginfile_urls($course->summary, 'pluginfile.php', $context->id, 'course', 'summary', null);
                } else {
                    $coursesummary = $course->summary;
                }
                $courseinfo['coursesummary'] = format_text($coursesummary, $course->summaryformat, ['noclean' => true, 'context' => $context], $course->id);
            } else {
                $courseinfo['coursesummary'] = '';
            }

            // Course custom fields.
            if (!empty($this->page->theme->settings->cardcustomfields)) {
                $courseinfo['cardcustomfields'] = $this->getcustomfieldcontent($course);
            } else {
                $courseinfo['cardcustomfields'] = '';
            }

            // Course contacts (e.g. list of teachers).
            if (!empty($this->page->theme->settings->cardcontacts)) {
                $courseinfo['cardcontacts'] = $this->getcontacts($course);
            } else {
                $courseinfo['cardcontacts'] = '';
            }

            // Course category.
            if (!empty($this->page->theme->settings->cardcategory)) {
                $courseinfo['cardcat'] = $this->getcatcontent($course);
                $courseinfo['cardcategory'] = get_string('category') . ' : ' . $courseinfo['cardcat'];
            } else {
                $courseinfo['cardcategory'] = '';
            }

            // Button icons and text for screen readers.
            if (is_enrolled(context_course::instance($course->id), $USER->id, '', true)) {
                $courseinfo['caption'] = get_string('courseenter', 'theme_gcweb');
                $courseinfo['playicon'] = 'fa-play-circle';
            } else {
                $courseinfo['caption'] = get_string('courseinfo', 'theme_gcweb');
                $courseinfo['playicon'] = 'fa-info-circle';
            }

            // Course button (e.g. Enrol, More info).
            $courseinfo['coursetitle'] = format_string($course->fullname, false, ['context' => $context]);
            if (empty($this->page->theme->settings->cardbutton)) {
                $courseinfo['coursetitle'] = '<span class="sr-only">' . $caption . '</span>' . $courseinfo['coursetitle'];
            }

            // URL of the course or course info if not enrolled.
            $courseinfo['courseurl'] = new moodle_url('/course/view.php', array('id' => $course->id));

            // Course image.
            $courseinfo['courseimage'] = $this->getimgurl($course);

            if ($courselistlayout > 0) {
                $content .= '<div class="col-auto mb-5 ' . $grid . '">';
                if ($columns == 1) {
                    $content .= '<div class="row border ' . ($course->visible ? 'coursevisible' : 'coursedimmed') . '">';
                } else {
                    $content .= '<div class="card h-100 ' . ($course->visible ? 'coursevisible' : 'coursedimmed') . '">';
                }
            }
            
            $courseinfo['pixicons'] = $this->getpixicons($course);

            $courseinfo['cardheader'] = (empty($this->page->theme->settings->cardheader) ? 0 : $this->page->theme->settings->cardheader);
            $courseinfo['cardfooter'] = (empty($this->page->theme->settings->cardfooter) ? 0 : $this->page->theme->settings->cardfooter);
            
            $courseinfo['course'] = $course;

            $extras = '';
            switch($courselistlayout) {
                case -3: // Expandable list (name/details).
                    $content .= html_writer::start_tag('li', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed'));
                    $tmp = $courseinfo['coursetitle'];
                    $courseinfo['coursetitle'] = '';
                    $extras = $this->coursecard($courseinfo, 1, 1); // $courselistlayout = 1, $columns = 1.
                    $courseinfo['coursetitle'] = $tmp;
                    if (!empty($extras)) {
                        $content .= '<details>';
                        $content .= '<summary>';
                        if (!empty($courseinfo['pixicons'])) {
                            $content .= '<div>' . $courseinfo['pixicons'] . '</div>';
                        }
                        $content .= $courseinfo['coursetitle'];
                        $content .= '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-sm pull-right"><span class="fa ' . $courseinfo['playicon'] . '" aria-hidden="true"></span> ' . $courseinfo['caption'] . '</a>';
                        $content .= '</summary>';
                        $content .= $extras;
                        $content .= '</details>';
                    } else {
                        if (!empty($courseinfo['pixicons'])) {
                            $content .= '<div>' . $courseinfo['pixicons'] . '</div>';
                        }
                        $content .= '<a href="' . $courseinfo['courseurl'] . '"><span  aria-hidden="true" class="fa ' . $courseinfo['playicon'] . '" aria-hidden="true"></span> ' . $courseinfo['caption'] . ': ' . $courseinfo['coursetitle'] . '</a>';
                    }
                    $content .= html_writer::end_tag('li');
                    break;

                case -2: // Table list.
                    if (!empty($this->page->theme->settings->cardcategory)) {
                        $extras .= '<td>' . $courseinfo['cardcat'] . '</td>';
                    }
                    if (!empty($this->page->theme->settings->cardcustomfields)) {
                        $extras .= '<td>'. $courseinfo['cardcustomfields'] . '</td>';
                    }
                    if (!empty($this->page->theme->settings->cardsummary)) {
                        $extras .= '<td>' . $courseinfo['coursesummary'] . '</td>';
                    }
                    if (!empty($this->page->theme->settings->cardcontacts)) {
                        $extras .= '<td>' . $courseinfo['cardcontacts'] . '</td>';
                    }
                    $content .= html_writer::start_tag('tr', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed'));
                    $content .= '<td><a href="' . $courseinfo['courseurl'] . '">' . $courseinfo['coursetitle'] . $this->getpixicons($course) . '</a></td>';
                    $content .= $extras;
                    $content .= html_writer::end_tag('tr');
                    break;

                case -1: // Masonry.
                    $content .= '<div class="card ' . $grid . '">';
                    $content .= $this->coursecard($courseinfo, $courselistlayout, $columns);
                    $content .= '</div>';
                    break;

                case 1: // Card.
                    $content .= $this->coursecard($courseinfo, $courselistlayout, $columns);
                    break;

                case 2: // Overlay (bottom).
                    if (!empty($this->page->theme->settings->cardcategory)) {
                        $extras .= '<div class="card-text small">' . $courseinfo['cardcategory'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcustomfields)) {
                        $extras .= empty($extras) ? '' : ' ';
                        $extras .= '<div class="card-text small">' . $courseinfo['cardcustomfields'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcontacts)) {
                        $extras .= '<div class="card-text small">'. $courseinfo['cardcontacts'] . '</div>';
                    }

                    if (!empty($this->page->theme->settings->cardimage)) {
                        $content .= '<div class="card-img" style="background-image: url(' . $courseinfo['courseimage'] . ');"></div>';
                        //$content .= '<img class="card-img" src="' . $courseinfo['courseimage'] . '" alt="">';
                        $content .= '<div class="card-img-overlay bottom card-bg text-white">';
                    } else {
                        $content .= '<div class="p-3 bg-dark text-white h-100">';
                    }
                    if (!empty($courseinfo['pixicons'])) {
                        $content .= '<div>' . $courseinfo['pixicons'] . '</div>';
                    }
                    if (empty($this->page->theme->settings->cardbutton)) {
                        $content .= '<h3 class="card-title h4"><a href="' . $courseinfo['courseurl'] . '">' . $courseinfo['coursetitle'] . '</a></h3>';
                    } else {
                        $content .= '<h3 class="card-title h4">' . $courseinfo['coursetitle'] . '</h3>';
                        $content .= '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-primary btn-sm mt-4 pull-right"><span class="fa ' . $courseinfo['playicon'] . ' pr-2" aria-hidden="true"></span> ' . $courseinfo['caption'] . ' <span class="sr-only">: ' . $courseinfo['coursetitle'] . '</span></a>';
                    }
                    $content .= $extras;
                    $content .= '</div>';
                    break;

                case 3: // Overlay (top).
                    if (!empty($this->page->theme->settings->cardcategory)) {
                        $extras .= '<div class="card-text small text-white">' . $courseinfo['cardcategory'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcontacts)) {
                        $extras .= '<div class="card-text small text-white">'. $courseinfo['cardcontacts'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcustomfields) && !empty($courseinfo['cardcustomfields'])) {
                        $extras .= '<div class="card-text small text-white">' . $courseinfo['cardcustomfields'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardimage)) {
                        $content .= '<div class="card-img" style="background-image: url(' . $courseinfo['courseimage'] . ');"></div>';
                        //$content .= '<img class="card-img" src="' . $courseinfo['courseimage'] . '" alt="">';
                        $content .= '<div class="card-img-overlay">';
                        $content .= '<div class="card-bg">';
                    } else {
                        $content .= '<div>';
                        $content .= '<div class="card-bg">';
                    }
                    if (!empty($courseinfo['pixicons'])) {
                        $content .= '<divclass="text-white">' . $courseinfo['pixicons'] . '</div>';
                    }
                    if (empty($this->page->theme->settings->cardbutton)) {
                        $content .= '<h3 class="card-title h4 text-white"><a href="' . $courseinfo['courseurl'] . '">' . $courseinfo['coursetitle'] . '</a></h3>';
                    } else {
                        $content .= '<h3 class="card-title h4 text-white">' . $courseinfo['coursetitle'] . '</h3>';
                        $content .= '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-primary btn-sm mt-4 pull-right"><span class="fa ' . $courseinfo['playicon'] . ' pr-2" aria-hidden="true"></span> ' . $courseinfo['caption'] . ' <span class="sr-only">: ' . $courseinfo['coursetitle'] . '</span></a>';
                    }
                    $content .= $extras;
                    $content .= '<div class="clearfix"></div>';
                    $content .= '</div>';
                    $content .= '</div>';
                    break;

                case 4: // Minimal with arrow over image.
                    if (!empty($this->page->theme->settings->cardsummary)) {
                        $extras .= '<div class="card-text">'. $courseinfo['coursesummary'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcategory)) {
                        $extras .= '<div class="card-text small">' . $courseinfo['cardcategory'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcontacts)) {
                        $extras .= '<div class="card-text small">'. $courseinfo['cardcontacts'] . '</div>';
                    }

                    $content .= '<div class="text-center">';
                    $content .= '<div class="card-body">';
                    if (empty($this->page->theme->settings->cardbutton)) {
                        $content .= '<a href="' . $courseinfo['courseurl'] . '" class="card-action d-block">';
                    }
                    if (!empty($this->page->theme->settings->cardimage)) {
                        $content .= '<div class="card-icon-wrap" style="background-image: url(' . $courseinfo['courseimage'] . ');">';
                    } else {
                        $content .= '<div class="card-icon-wrap">';
                    }
                    $content .= '<div class="card-icon">';
                    $content .= '<span class="fa-stack fa-1x">';
                    $content .= '<span class="fa fa-circle-thin fa-stack-2x bg-primary" aria-hidden="true"></span>';
                    $content .= '<span class="fa ' . $courseinfo['playicon'] . ' fa-stack-2x fa-inverse" aria-hidden="true"></span>';
                    $content .= '</span>';
                    $content .= '</div>';
                    $content .= '</div>';
                    if (!empty($courseinfo['pixicons'])) {
                        $content .= '<div>' . $courseinfo['pixicons'] . '</div>';
                    }
                    $content .= '<h3 class="mt-4 h4">' . $courseinfo['coursetitle'] . '</h3>';
                    if (empty($this->page->theme->settings->cardbutton)) {
                        $content .= '</a>';
                    }
                    $content .= $extras;
                    if (!empty($this->page->theme->settings->cardbutton)) {
                        $content .= '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-primary btn-sm mt-4"><span class="fa ' . $courseinfo['playicon'] . ' pr-2" aria-hidden="true"></span> ' . $courseinfo['caption'] . ' <span class="sr-only">: ' . $courseinfo['coursetitle'] . '</span></a>';
                    }
                    $content .= '</div>';
                    if (!empty($this->page->theme->settings->cardcustomfields)) {
                        $content .= '<div class="card-footer">';
                        $content .= '<p>' . $this->getcustomfieldcontent($course) . '</p>';
                        $content .= '</div>';
                    }
                    $content .= '</div>';
                    break;

                case 5: // Minimal with arrow to the left of course name.
                    if (!empty($this->page->theme->settings->cardcategory)) {
                        $extras .= '<div class="card-text small">' . $courseinfo['cardcategory'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcustomfields)) {
                        $extras .= '<div class="card-text small">'. $courseinfo['cardcustomfields'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardcontacts)) {
                        $extras .= '<div class="card-text small">'. $courseinfo['cardcontacts'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardsummary)) {
                        $extras .= '<div class="card-text">'. $courseinfo['coursesummary'] . '</div>';
                    }
                    $content .= '<div class="card-body">';
                    if (!empty($courseinfo['pixicons'])) {
                        $content .= '<div>' . $courseinfo['pixicons'] . '</div>';
                    }
                    if (!empty($this->page->theme->settings->cardbutton)) {
                        $content .= '<h3 class="card-title h4"><span class="fa fa-arrow-circle-right pull-left" aria-hidden="true"></span>' . $courseinfo['coursetitle'] . '</h3>';
                        $content .= '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-primary btn-sm mt-4 pull-right"><span class="fa ' . $courseinfo['playicon'] . ' pr-2" aria-hidden="true"></span> ' . $courseinfo['caption'] . ' <span class="sr-only">: ' . $courseinfo['coursetitle'] . '</span></a>';
                    } else {
                        $content .= '<h3 class="card-title h4"><span class="fa fa-arrow-circle-right pull-left" aria-hidden="true"></span><a href="' . $courseinfo['courseurl'] . '">' . $courseinfo['coursetitle'] . '</a></h3>';
                    }
                    $content .= $extras;
                    $content .= '</div>';
                    break;

                default:
                    return "Invalid layout ($courselistlayout)";
                    break;
            }
            if ($courselistlayout > 0) {
                $content .= '</div>';
                $content .= '</div>';
            }
        }
        return $header . $content . $footer;
    }

    // This makes it possible to pass parameters by reference instead of by value
    // so that search_courses() can access the filtered list of courses and totalcount.
    protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
        return $this->coursecat_courses_ml($chelper, $courses, $totalcount);
    }
    protected function coursecat_courses_ml(coursecat_helper $chelper, $courses, &$totalcount = null) {

        // Only applicable to Front page.
        $filtertag = $this->page->theme->settings->filtercoursesbytag;
        if ($this->page->bodyid == 'page-site-index' && !empty($filtertag)) {
            // Filter out courses if it doesn't contain the tag we are looking for.
            foreach($courses as $key => $course) {
                if (!$this->hastag($course->id, $filtertag)) {
                    unset($courses[$key]);
                }
            }
            // Update the total count.
            $totalcount = count($courses);
        }

        // Applicable to all course listings.
        if (!empty($this->page->theme->settings->filtercoursesbylang)) {
            // Filter out courses if forced-language doesn't match the current language.
            $lang = current_language();
            foreach($courses as $key => $course) {
                @$clang = $course->lang; // TODO: Fix ugly hack.
                if ($course->id != SITEID and !empty($clang) and $clang != $lang) {
                    unset($courses[$key]);
                }
            }
            // Update the total count.
            $totalcount = count($courses);
        }

        // Default Moodle course display.
        $courselistlayout = optional_param('layout', $this->page->theme->settings->courselistlayout, PARAM_INT);
        if (empty($courselistlayout)) { // The courselistlayout = 0.
            $content = parent::coursecat_courses($chelper, $courses, $totalcount);
            return $content;
        }

        global $CFG;
        if ($totalcount === null) {
            $totalcount = count($courses);
        }
        if (!$totalcount) {
            // Courses count is cached during courses retrieval.
            return '';
        }

        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_AUTO) {
            // In 'auto' course display mode we analyse if number of courses is more or less than $CFG->courseswithsummarieslimit.
            if ($totalcount <= $CFG->courseswithsummarieslimit) {
                $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED);
            } else {
                $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_COLLAPSED);
            }
        }

        // Prepare content of paging bar if it is needed.
        $paginationurl = $chelper->get_courses_display_option('paginationurl');
        $paginationallowall = $chelper->get_courses_display_option('paginationallowall');
        if ($totalcount > count($courses)) {
            // There are more results that can fit on one page.
            if ($paginationurl) {
                // The option paginationurl was specified, display pagingbar.
                $perpage = $chelper->get_courses_display_option('limit', $CFG->coursesperpage);
                $page = $chelper->get_courses_display_option('offset') / $perpage;
                $pagingbar = $this->paging_bar($totalcount, $page, $perpage,
                        $paginationurl->out(false, array('perpage' => $perpage)));
                if ($paginationallowall) {
                    $pagingbar .= html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => 'all')),
                            get_string('showall', '', $totalcount)), array('class' => 'paging paging-showall'));
                }
            } else if ($viewmoreurl = $chelper->get_courses_display_option('viewmoreurl')) {
                // The option for 'View more' link was specified, display more link.
                $viewmoretext = $chelper->get_courses_display_option('viewmoretext', new lang_string('viewmore'));
                $morelink = html_writer::tag('div', html_writer::link($viewmoreurl, $viewmoretext),
                        array('class' => 'paging paging-morelink'));
//                $morelink = html_writer::tag('div', html_writer::tag('a', html_writer::start_tag('i', array(
//                    'class' => 'fa-graduation-cap' . ' fa fa-fw'
//                )) . html_writer::end_tag('i') . $viewmoretext, array(
//                    'href' => $viewmoreurl,
//                    'class' => 'btn btn-primary coursesmorelink'
//                )) , array('class' => 'paging paging-morelink'));
            }
        } else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
            // There are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode.
            $pagingbar = html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => $CFG->coursesperpage)),
                get_string('showperpage', '', $CFG->coursesperpage)), array('class' => 'paging paging-showperpage'));
        }

        // Display list of courses.
        $attributes = $chelper->get_and_erase_attributes('courses');
        $content = html_writer::start_tag('div', $attributes);

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }
        $categoryid = optional_param('categoryid', 0, PARAM_INT);

        $content .= $this->view_available_courses($categoryid, $courses, $totalcount);
        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }
        if (!empty($morelink)) {
            $content .= $morelink;
        }

        $content .= html_writer::end_tag('div'); // .courses
        $content .= '<div class="clearfix"></div>';
        return $content;
    }
   /**
     * Renders html to display search result page
     *
     * @param array $searchcriteria may contain elements: search, blocklist, modulelist, tagid
     * @return string
     */
    public function search_courses($searchcriteria) {
        global $CFG;
        $content = '';
        if (!empty($searchcriteria)) {
            // print search results

            $displayoptions = array('sort' => array('displayname' => 1));
            // take the current page and number of results per page from query
            $perpage = optional_param('perpage', 0, PARAM_RAW);
            if ($perpage !== 'all') {
                $displayoptions['limit'] = ((int)$perpage <= 0) ? $CFG->coursesperpage : (int)$perpage;
                $page = optional_param('page', 0, PARAM_INT);
                $displayoptions['offset'] = $displayoptions['limit'] * $page;
            }
            // options 'paginationurl' and 'paginationallowall' are only used in method coursecat_courses()
            $displayoptions['paginationurl'] = new moodle_url('/course/search.php', $searchcriteria);
            $displayoptions['paginationallowall'] = true; // allow adding link 'View all'

            $class = 'course-search-result';
            foreach ($searchcriteria as $key => $value) {
                if (!empty($value)) {
                    $class .= 'course-search-result-'. $key;
                }
            }
            $chelper = new coursecat_helper();
            $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED_WITH_CAT)->
                    set_courses_display_options($displayoptions)->
                    set_search_criteria($searchcriteria)->
                    set_attributes(array('class' => $class));

            $courses = core_course_category::search_courses($searchcriteria, $chelper->get_courses_display_options());
            $totalcount = core_course_category::search_courses_count($searchcriteria);
            $courseslist = $this->coursecat_courses_ml($chelper, $courses, $totalcount);

            if (!$totalcount) {
                if (!empty($searchcriteria['search'])) {
                    $content .= $this->heading(get_string('nocoursesfound', '', $searchcriteria['search']));
                } else {
                    $content .= $this->heading(get_string('novalidcourses'));
                }
            } else {
                $content .= $this->heading(get_string('searchresults'). ": $totalcount");
                $content .= $courseslist;
            }

            if (!empty($searchcriteria['search'])) {
                // print search form only if there was a search by search string, otherwise it is confusing
                $content .= $this->box_start('generalbox mdl-align');
                $content .= $this->course_search_form($searchcriteria['search']);
                $content .= $this->box_end();
            }
        } else {
            // just print search form
            $content .= $this->box_start('generalbox mdl-align');
            $content .= $this->course_search_form();
            $content .= $this->box_end();
        }
        return $content;
    }
    
    private function coursecard($courseinfo, $layout, $columns) {
        $content = '';
        
        $cheader = '';
        if ($courseinfo['cardheader']) {
            // If one column, put header to the left instead of above.
            // If Category or course name is desired, put it in the header. Otherwise put them in the card content.
            switch ($courseinfo['cardheader']) {
                case 1: // Category.
                        if (!empty($this->page->theme->settings->cardcategory)) {
                            $cheader = $courseinfo['cardcat'];
                        }
                        $courseinfo['cardcategory'] = '';
                        break;
                case 2: // Course name.
                        $cheader = '<h3 class="d-inline h4">';
                        if (empty($this->page->theme->settings->cardbutton)) {
                            $cheader .= '<a href="' . $courseinfo['courseurl'] . '">' . $courseinfo['coursetitle'] . '</a>';
                            if (!empty($courseinfo['pixicons'])) {
                                $content .= '<span class="pull-right">' . $courseinfo['pixicons'] . '</span>';
                            }
                        } else {
                            $cheader .= $courseinfo['coursetitle'];
                        }
                        $cheader .= '</h3>';
                        $courseinfo['coursetitle'] = '';
                        break;
                default: // Don't do anything.
            }

        }

        // Card footer.
        // We do this before the body so that we can know what is left for the body.
        $cfooter = '';
        if ($courseinfo['cardfooter']) {
            // If Category or course name is desired, put it in the footer. Otherwise put them in the card content.
            switch ($courseinfo['cardfooter']) {
                case 1: // Enrolment button.
                        if (!empty($this->page->theme->settings->cardbutton)) {
                            $cfooter = '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-primary btn-sm ' . ($columns != 1 ? 'btn-block m-0' : ' mt-3') . '"><span class="fa ' . $courseinfo['playicon'] . ' pr-2" aria-hidden="true"></span> ' . $courseinfo['caption'] . ' <span class="sr-only">: ' . $courseinfo['coursetitle'] . '</span></a>';
                        }
                        $courseinfo['courseurl'] = '';
                        break;
                case 2: // Custom course fields.
                        if (!empty($this->page->theme->settings->cardcustomfields)) {
                            $cfooter = $cardcustomfields;
                        }
                        $courseinfo['cardcustomfields'] = '';
                        break;
                case 3: // Contacts.
                        if (!empty($this->page->theme->settings->cardcontacts) && !empty($courseinfo['cardcontacts'])) {
                            $cfooter = '<span class="small">' . $courseinfo['cardcontacts'] . '</span>';
                        }
                        $courseinfo['cardcontacts'] = '';
                        break;
                case 4: // Progress bar.
                        $cfooter = $courseinfo['progressbar'];
                        $courseinfo['progressbar'] = '';
                        break;
                default: // Don't do anything.
            }
            if (!empty($cfooter)) {
                // If one column, put footer to the left instead of above.
                $cfooter = '<div class="' . ($columns != 1 ? 'card-footer text-center' : '') . '">' . $cfooter . '</div>'; // Card-Footer.
            }
        }

        // Card header.
        // If one column, put header to the left instead of above.
        if ($columns == 1) { // Start of left column.
            $content .= '<div class="col-lg-12 col-xl-4">';
        }
        if (!empty($cheader)) { // Header.
            $content .= '<div class="card-header ' . ($columns != 1 ? 'text-center' : '') . '">' . $cheader . '</div>';
        }

        // Course image.
        if (!empty($this->page->theme->settings->cardimage)) {
            $content .= '<div class="card-img" style="background-image: url(' . $courseinfo['courseimage'] . ');"></div>';
        }

        // End of left column and start of right column - if in single column.
        if ($columns == 1) {
            $content .= '</div>';
            $content .= '<div class="col-lg-12 col-xl-8">';
        }

        // Card body.
        $content .= '<div class="card-body">';
        // If we did not used the course name in the header, add it to the card body.
        // Also, if we will be displaying a button, don't make the heading a link.
        if (!empty($courseinfo['coursetitle'])) {
            if (!empty($this->page->theme->settings->cardbutton)) {
                $content .= '<h3 class="d-inline h4">' . $courseinfo['coursetitle'] . '</h3>';
            } else {
                $content .= '<h3 class="d-inline h4"><a href="' . $courseinfo['courseurl'] . '">' . $courseinfo['coursetitle'] . '</a></h3>';
            }
        }

        $content .= $courseinfo['pixicons'];

        if (!empty($courseinfo['progressbar'])) {
            $content .= '<p class="cardprogressbar">' . $courseinfo['progressbar'] . '</p>';
        }

        if (!empty($courseinfo['courseurl']) && !empty($courseinfo['coursetitle'])) {
            $content .= '<a href="' . $courseinfo['courseurl'] . '" class="btn btn-primary btn-sm mt-4 pull-right"><span class="fa ' . $courseinfo['playicon'] . ' pr-2" aria-hidden="true"></span> ' . $courseinfo['caption'] . ' <span class="sr-only">: ' . $courseinfo['coursetitle'] . '</span></a>';
            $content .= '<div class="clearfix"></div>';
        }
        
        if (!empty($this->page->theme->settings->cardscroll)) {
            $content .= '<div class="card-content scroll">';
        } else {
            $content .= '<div class="card-content">';
        }

        if (!empty($courseinfo['cardcategory'])) {
            $content .= '<div class="card-text small cardcategory">'. $courseinfo['cardcategory'] . '</div>';
        }

        if (!empty($courseinfo['cardcustomfields'])) {
            $content .= '<div class="card-text small cardcustomfields">'. $courseinfo['cardcustomfields'] . '</div>';
        }

        if (!empty($this->page->theme->settings->cardsummary)) {
            $content .= '<div class="card-text cardsummary">'. $courseinfo['coursesummary'] . '</div>';
        }

        if (!empty($courseinfo['cardcontacts'])) {
            $content .= '<div class="small small cardcontacts">'. $courseinfo['cardcontacts'] . '</div>';
        }

        if ($columns == 1) {
            $content .= $cfooter;
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
        } else {
            $content .= '</div>';
            $content .= '</div>';
            $content .= $cfooter;
        }
        $content .= '<div class="clearfix"></div>';
        
        return $content;
    }
}