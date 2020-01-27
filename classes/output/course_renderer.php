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
 * @package    theme_noanme
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
require_once ($CFG->dirroot . '/course/renderer.php');
global $PAGE;

/**
 * Course renderer class.
 *
 * @package    theme_gcweb
 * @copyright  2019 TNG Consulting Inc. - www.tngconsulting.ca
 * @copyright  2016 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer  {
    protected $countcategories = 0;


    /*
     * Available courses
     */
    public function view_available_courses($categoryid = 0, $courses = null, $totalcount = null) {
        global $CFG, $OUTPUT, $PAGE;
        $PAGE->theme->settings->courselistlayout = optional_param('layout', $PAGE->theme->settings->courselistlayout, PARAM_INT);
        $PAGE->theme->settings->titletooltip = false;

        $rcourseids = array_keys($courses);
        // Number of courses per row.
        if (in_array($PAGE->theme->settings->courselistlayout,[8,10,11])) {
            // Layouts with 1 courses per row.
            $acourseids = array_chunk($rcourseids, 1);
        } else if (in_array($PAGE->theme->settings->courselistlayout,[1, 2, 3])) {
            // Layouts with 2 courses per row.
            $acourseids = array_chunk($rcourseids, 2);
        } else if (in_array($PAGE->theme->settings->courselistlayout,[9,12])) {
            // Masonry.
            $acourseids = array_chunk($rcourseids, count($rcourseids));
        } else {
            // Layouts with 3 courses per row.
            $acourseids = array_chunk($rcourseids, 3);
        }

        if ($categoryid != 0) {
            $newcourse = get_string('availablecourses');
        } else {
            $newcourse = null;
        }
        $header = '
            <div id="category-course-list">
                <div class="courses category-course-list-all">
                    <div class="class-list"><h4>' . $newcourse . '</h4></div>';
        $content = '';
        $footer = '
                    <hr>
                </div>
            </div>';
        if (count($rcourseids) > 0) {
            $noimgurl = $OUTPUT->image_url('noimg', 'theme');
            $systemcontext = $PAGE->bodyid;
            foreach ($acourseids as $courseids) {
                $content .= '<div class="container-fluid">';
                switch ($PAGE->theme->settings->courselistlayout) {
                    case 2:
                        $content .= '<div class="row card-deck">';
                        break;
                    case 9:
                        $content .= '<div class="card-columns">';
                        break;
                    case 12:
                        $content .= '<div class="table-responsive">';
                        $content .= '<table class="table table-sm table-hover">';
                        $content .= '<thead><tr>';
                        $content .= '<th scope="col" style="width:30%">Course</th>';
                        $content .= '<th scope="col" style="width:15%">Category</th>';
                        $content .= '<th scope="col" style="width:55%">Summary</th>';
                        $content .= '</tr></thead><tbody>';
                        break;
                    default:
                        $content .= '<div class="row">';
                }
                $rowcontent = '';
                foreach ($courseids as $courseid) {
                    $course = get_course($courseid);
//                    $trimtitlevalue = $PAGE->theme->settings->trimtitle;
//                    $trimsummaryvalue = $PAGE->theme->settings->trimsummary;
                    $summary = $course->summary;
//                    $summary = format_text($course->summary, FORMAT_HTML, ['noclean'=>true, 'context' => context_system:instance()]);
//                    $summary = file_rewrite_pluginfile_urls($course->summary, 'pluginfile.php', $context->id, 'course','section', $section->id);
//                    $summary = format_text($summary, $course->summaryformat, array('para' => false, 'context' => $context));

                    $trimtitle = format_string($course->fullname);
                    $courseurl = new moodle_url('/course/view.php', array(
                        'id' => $courseid
                    ));

                    // Course completion Progress bar
                    if (\core_completion\progress::get_course_progress_percentage($course) && isloggedin() && $systemcontext == 'page-site-index') {
                        $comppc = \core_completion\progress::get_course_progress_percentage($course);
                        $comppercent = number_format($comppc, 0);
                        $hasprogress = true;
                    }else {
                        $comppercent = 0;
                        $hasprogress = false;
                    }

                    // Course completion Progress bar
                    if ($course->enablecompletion == 1 && isloggedin() && $systemcontext == 'page-site-index') {
                        $completiontext = get_string('coursecompletion', 'completion');
                        $compbar = "<div class='progress'>";
                        $compbar .= "<div class='progress-bar progress-bar-info barfill' role='progressbar' aria-valuenow='{$comppercent}' ";
                        $compbar .= " aria-valuemin='0' aria-valuemax='100' style='width: {$comppercent}%;'>";
                        $compbar .= "{$comppercent}%";
                        $compbar .= "</div>";
                        $compbar .= "</div>";
                        $progressbar = $compbar;
                    } else {
                        $progressbar = '';
                        $completiontext = '';
                    }
                    if ($course instanceof stdClass) {
                        $course = new core_course_list_element($course);
                    }
                    // print enrolmenticons
                    $pixcontent = '';
                    if ($icons = enrol_get_course_info_icons($course)) {
                        $pixcontent .= html_writer::start_tag('div', array('class' => 'enrolmenticons'));
                        foreach ($icons as $pix_icon) {
                            $pixcontent .= $this->render($pix_icon);
                        }
                        $pixcontent .= html_writer::end_tag('div');
                    }
                    // display course category if necessary (for example in search results)
                    if ($cat = core_course_category::get($course->category, IGNORE_MISSING)) {
                        $catcontent = html_writer::start_tag('div', array('class' => 'coursecat'));
                        $catcontent .= get_string('category').': '.
                                html_writer::link(new moodle_url('/course/index.php', array('categoryid' => $cat->id)),
                                        $cat->get_formatted_name(), array('class' => $cat->visible ? '' : 'dimmed'));
                        $catcontent .= $pixcontent;
                        $catcontent .= html_writer::end_tag('div');
                    } else {
                        $catcontent = '';
                    }

                    // Load from config if usea a img from course summary file if not exist a img then a default one ore use a fa-icon.
                    $imgurl = '';
                    $context = context_course::instance($course->id);
                    foreach ($course->get_course_overviewfiles() as $file) {
                        $isimage = $file->is_valid_image();
                        $imgurl = file_encode_url("$CFG->wwwroot/pluginfile.php", '/' . $file->get_contextid() . '/' . $file->get_component() . '/' . $file->get_filearea() . $file->get_filepath() . $file->get_filename() , !$isimage);
                        if (!$isimage) {
                            $imgurl = $noimgurl;
                        }
                    }
                    if (empty($imgurl)) {
                        $imgurl = $PAGE->theme->setting_file_url('headerdefaultimage', 'headerdefaultimage', true);
                        if (!$imgurl) {
                            $imgurl = $noimgurl;
                        }
                    }

                    $customfieldcontent = '';

                    // Display custom fields.
                    if ($course->has_custom_fields()) {
                        $handler = \core_course\customfield\course_handler::create();
                        $customfields = $handler->display_custom_fields_data($course->get_custom_fields());
                        $customfieldcontent = \html_writer::tag('div', $customfields, ['class' => 'customfields-container']);
                    }

                    if ($PAGE->theme->settings->titletooltip) {
                        $tooltiptext = 'data-toggle="tooltip" data-placement= "top" title="' . format_string($course->fullname) . '"';
                    } else {
                        $tooltiptext = '';
                    }

                    switch ($PAGE->theme->settings->courselistlayout) {

                        case 1:
                            $rowcontent .= '<div class="card mb-3" style="width: 50%;">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '  <div class="row no-gutters">';
                            $rowcontent .= '    <div class="col-md-4">';
                            $rowcontent .= '      <img src="' . $imgurl . '" class="card-img" alt="">';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '    <div class="col-md-8">';
                            $rowcontent .= '      <div class="card-body">';
                            $rowcontent .= '        <h4 class="card-title"><a ' . $tooltiptext . ' href="' . $courseurl . '">' . $trimtitle . '</a></h4>';
                            $rowcontent .= '        <p class="card-text">' . $summary . '</p>';
                            $rowcontent .= '        <p class="card-text">' . $catcontent . ' ' . $customfieldcontent . '</p>';
                            $rowcontent .= '      </div>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '  </div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 2:
                            $rowcontent .= '<div class="card mb-3" style="width: 50%;">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '  <div class="row p-3">';
                            $rowcontent .= '    <div class="col-md-5">';
                            $rowcontent .= '      <img src="' . $imgurl . '" class="card-img" alt="">';
                            $rowcontent .= '        <h4 class="card-title"><a href="' . $courseurl . '"' . $tooltiptext . '>' . $trimtitle . '</a></h4>';
                            $rowcontent .= '        <p class="card-text"><small>' . $catcontent . '</small></p>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '    <div class="col-md-6">';
                            $rowcontent .= '      <div class="card-body">';
                            $rowcontent .= '        <p class="card-text">' . $summary . '</p>';
                            $rowcontent .= '        <p class="card-text">' . $customfieldcontent . '</p>';
                            $rowcontent .= '      </div>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '  </div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 3:
                            $rowcontent .= '<div class="col-lg-6 mb-4">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="card">';
                            $rowcontent .= '    <img class="card-img" style="height: 280px;width:auto;" src="' . $imgurl . '" alt="">';
                            $rowcontent .= '    <div class="card-img-overlay bottom bg-dark text-white">';
                            $rowcontent .= '        <h3 class="card-title"><a href="' . $courseurl . '"' . $tooltiptext . '>' . $trimtitle . '</a></h3>';
                            $rowcontent .= '        <p class="card-text">' . $catcontent . ' ' . $customfieldcontent . '</p>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 4:
                            $rowcontent .= '<div class="col-lg-4 mb-5">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="card">';
                            $rowcontent .= '    <img class="card-img" style="height: 250px;width:auto;" src="' . $imgurl . '" alt="">';
                            $rowcontent .= '    <div class="card-img-overlay bottom bg-dark text-white">';
                            $rowcontent .= '        <h3 class="card-title"' . $tooltiptext . '>' . $trimtitle . '</h3>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= '    <div class="btn-group btn-group-justified btn-hgroup-sm mrgn-bttm-md">';
                            $rowcontent .= '        <a href="' . $courseurl . '" role="button" class="btn btn-default"><span class="fa fa-info-circle"></span> More information</a>';
                            $rowcontent .= '        <a href="' . $courseurl . '" role="button" class="btn btn-default"><span class="fa fa-play-circle"></span> Get started</a>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 5:
                            $rowcontent .= '<div class="col-lg-4 mb-5">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="card"><a ' . $tooltiptext . ' href="' . $courseurl . '">';
                            $rowcontent .= '    <div class="card-body">';
                            $rowcontent .= '        <a ' . $tooltiptext . ' href="' . $courseurl . '">';
                            $rowcontent .= '            <img src="' . $imgurl . '" class="card-img-top" style="height:auto;">';
                            $rowcontent .= '            <h4 class="card-title"><h4>' . $trimtitle . '</h4>';
                            $rowcontent .= '        </a>';
                            $rowcontent .= '        <p class="card-text">' . $summary . '</p>';
                            $rowcontent .= '        <p class="card-text">' . $catcontent . ' ' . $customfieldcontent . '</p>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 6:
                            $rowcontent .= '<div class="col-lg-4 mb-5">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="card" style="height:200px;overflow-y:hidden;"><a href="' . $courseurl . '"' . $tooltiptext . '>';
                            $rowcontent .= '    <img class="card-img" style="width:100%;overflow-y:hidden" src="' . $imgurl . '" alt="">';
                            $rowcontent .= '    <div class="card-img-overlay" >';
                            $rowcontent .= '        <h3 class="card-title"><span class="text-white" style="background-color:rgba(0,0,0,0.5);">' . $trimtitle . '</span></h3>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</a></div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 7:
                            $rowcontent .= '<div class="col-md-4 mb-4">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed4'));
                            $rowcontent .='<div class="card text-center">';
                            $rowcontent .='    <a ' . $tooltiptext . ' href="' . $courseurl . '" class="card-action">';
                            $rowcontent .='    <div class="card-body">';
                            $rowcontent .='        <div class="card-icon-wrap" style="height:50px;background-image: url(' . $imgurl . ');background-repeat: no-repeat;background-size:cover; background-position:center;">';
                            $rowcontent .='            <div class="card-icon">';
                            $rowcontent .='                <span class="fa-stack fa-1x">';
                            $rowcontent .='                    <i class="fa fa-circle-thin fa-stack-2x bg-primary" style="border-radius: 50%;"></i>';
                            $rowcontent .='                    <i class="fa fa-arrow-circle-right fa-stack-2x fa-inverse"></i>';
                            $rowcontent .='                </span>';
                            $rowcontent .='             </div>';
                            $rowcontent .='         </div>';
                            $rowcontent .='         <div class="mt-4"><h4 style="text-shadow:  -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white">' . $trimtitle . '</h4></div>';
                            $rowcontent .='     </div>';
                            $rowcontent .='     <div class="card-footer">';
                            $rowcontent .='         <p>' . $customfieldcontent . '</p>';
                            $rowcontent .='     </div>';
                            $rowcontent .='     </a>';
                            $rowcontent .='</div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 8:
                            $rowcontent .= '<div class="card col-md-12 mb-4">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="row">';
                            $rowcontent .= '    <div class="col-md-3">';
                            $rowcontent .= '      <img src="' . $imgurl . '" class="card-img p-4" alt="">';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '    <div class="col-md-9">';
                            $rowcontent .= '      <div class="card-body">';
                            $rowcontent .= '        <h4 class="card-title"><a href="' . $courseurl . '"' . $tooltiptext . '>' . $trimtitle . '</a></h4>';
                            $rowcontent .= '        <p class="card-text"><small>' . $catcontent . '</small></p>';
                            $rowcontent .= '        <p class="card-text">' . $summary . '</p>';
                            $rowcontent .= '        <p class="card-text">' . $customfieldcontent . '</p>';
                            $rowcontent .= '      </div>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 8:
                            $rowcontent .= '<div class="card col-md-12 mb-4">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="row">';
                            $rowcontent .= '    <div class="col-md-3">';
                            $rowcontent .= '      <img src="' . $imgurl . '" class="card-img p-4" alt="">';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '    <div class="col-md-9">';
                            $rowcontent .= '      <div class="card-body">';
                            $rowcontent .= '        <h4 class="card-title"><a href="' . $courseurl . '"' . $tooltiptext . '>' . $trimtitle . '</a></h4>';
                            $rowcontent .= '        <p class="card-text"><small>' . $catcontent . '</small></p>';
                            $rowcontent .= '        <p class="card-text">' . $summary . '</p>';
                            $rowcontent .= '        <p class="card-text">' . $customfieldcontent . '</p>';
                            $rowcontent .= '      </div>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 9: // Masonry.
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="card">';
                            $rowcontent .= '    <div class="card-body">';
                            $rowcontent .= '        <a ' . $tooltiptext . ' href="' . $courseurl . '">';
                            $rowcontent .= '        <img src="' . $imgurl . '" class="card-img" alt="">';
                            $rowcontent .= '        <h4 class="card-title">' . $trimtitle . '</h4>';
                            $rowcontent .= '        </a>';
                            $rowcontent .= '        <p class="card-text"><small>' . $catcontent . '</small></p>';
                            $rowcontent .= '        <p class="card-text">' . $summary . '</p>';
                            $rowcontent .= '        <p class="card-text">' . $customfieldcontent . '</p>';
                            $rowcontent .= '    </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= '</a>';
                            $rowcontent .= html_writer::end_tag('div');
                            break;

                        case 10:
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'col-12 d-flex flex-sm-row flex-column class-fullbox hoverhighlight coursevisible' : 'col-12 d-flex flex-sm-row flex-column class-fullbox hoverhighlight coursedimmed1'));
                            $rowcontent .= '
                                    <div class="col-md-2">
                                        <a ' . $tooltiptext . ' href="' . $courseurl . '">
                                           <img src="' . $imgurl . '" class="img-fluid" alt="Responsive image" style="width:180px">
                                        </a>
                                    </div>';
                            $rowcontent .= '<div class="col-md-4">';
                            $rowcontent .= '
                                            <a ' . $tooltiptext . ' href="' . $courseurl . '">
                                                <div class="course-title-fullbox">
                                                    <h4>' . $trimtitle . '</h4>
                                            </a>
                                        </div>';
                            if ($course->has_course_contacts()) {
                                $rowcontent .= html_writer::start_tag('ul', array('class' => 'teacherscourseview'));
                                foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                                    $name = $coursecontact['rolename'] . ': ' . $coursecontact['username'];
                                    $rowcontent .= html_writer::tag('li', $name);
                                }
                                $rowcontent .= html_writer::end_tag('ul');
                            }
                            $rowcontent .= '</div>';
                            $rowcontent .= '<div class="col-md-6">
                                    <div class="course-summary">
                                    ' . $catcontent . '
                                    ' . $customfieldcontent . '
                                    ' . $summary . '
                                    </div>
                                    </div>';
                            $rowcontent .= html_writer::end_tag('div');
                            break;

                        case 11:
                            $rowcontent .= html_writer::start_tag('div', array(
                                'class' => $course->visible ? 'coursevisible col-md-12 d-flex flex-sm-row flex-column coursestyle9row' : 'coursedimmed9 col-md-12 d-flex flex-sm-row flex-column coursestyle9row'
                            ));
                            $rowcontent .= '
                                <div class="col-md-6">
                                    <h4><a href="' . $courseurl . '">' . $trimtitle . '</a></h4>';
                            if ($systemcontext !== 'page-site-index') {
                                $rowcontent .= '<div class="course-summary">' . $summary . '</div>';
                            }
                            $rowcontent .= '</div>';
                                if ($systemcontext !== 'page-site-index') {
                                    $rowcontent .= '
                                        <div class="col-md-6 row">
                                            <div class="col-md-6">
                                              ' . $catcontent . '
                                              ' . $customfieldcontent . '
                                            </div>
                                            <div class="col-md-6">';
                                    if ($course->has_course_contacts()) {
                                        $rowcontent .= html_writer::start_tag('ul', array(
                                            'class' => 'teacherscourseview'
                                        ));
                                        foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                                            $name = $coursecontact['rolename'] . ': ' . $coursecontact['username'];
                                            $rowcontent .= html_writer::tag('li', $name);
                                        }
                                        $rowcontent .= html_writer::end_tag('ul');
                                    }

                                    $rowcontent .= '
                                            </div>
                                        </div>';
                                }
                            if ($systemcontext == 'page-site-index' && $course->enablecompletion == 1) {

                                $rowcontent .= '
                                    <div class="col-md-6 row">
                                        <div class="col-md-4 text-right">
                                          ' . $completiontext  . '
                                        </div>
                                        <div class="col-md-8">
                                          '. $progressbar . '
                                        </div>
                                    </div>';
                            }
                            $rowcontent .= '</div>';
                            break;

                        case 12: // Table
                            $rowcontent .= html_writer::start_tag('tr', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<td><a href="' . $courseurl . '"' . $tooltiptext . '>' . $trimtitle . '</a></td>';
                            $rowcontent .= '<td>' . $catcontent . '</small></td>';
                            $rowcontent .= '<td>' . $summary . $customfieldcontent . '</td>';
                            $rowcontent .= html_writer::end_tag('tr');
                            break;

                        case 13:
                            $rowcontent .= '<div class="card col-md-4 mb-4">';
                            $rowcontent .= html_writer::start_tag('div', array('class' => $course->visible ? 'coursevisible' : 'coursedimmed3'));
                            $rowcontent .= '<div class="row">';
                            $rowcontent .= '      <img src="' . $imgurl . '" class="card-img p-4" style="height:140px;width:100%;object-fit:cover;object-position: 100% 0%;" alt="">';
                            $rowcontent .= '      <div class="card-body">';
                            $rowcontent .= '        <h4 class="card-title"><a href="' . $courseurl . '"' . $tooltiptext . '>' . $trimtitle . '</a></h4>';
                            $rowcontent .= '        <p class="card-text"><small>' . $catcontent . '</small></p>';
                            $rowcontent .= '        <p class="card-text">' . $customfieldcontent . '</p>';
                            $rowcontent .= '      </div>';
                            $rowcontent .= '</div>';
                            $rowcontent .= html_writer::end_tag('div');
                            $rowcontent .= '</div>';
                            break;

                        case 13: // display course contacts. See core_course_list_element::get_course_contacts().
                            $enrollbutton = get_string('getstarted', 'theme_gcweb');
                            $rowcontent .= '<div class="col-md-4">';
                            $rowcontent .= '
                                <div class="tilecontainer">
                                    <figure class="coursestyle2">
                                    <div class="class-box-courseview" style="height:230px;background-image: url(' . $imgurl . ');background-repeat: no-repeat;background-size:cover; background-position:center;">
                                ';
                            $rowcontent .= html_writer::start_tag('div', array(
                                'class' => $course->visible ? 'coursevisible' : 'coursedimmed2'
                            ));
                            $rowcontent .= '
                                <figcaption>
                                    <h3>' . $trimtitle . '</h3>
                                    <div class="course-card">
                                    ' . $catcontent . '
                                    ' . $customfieldcontent . '
                                    <button type="button" class="btn btn-primary btn-sm coursestyle2btn">' . $enrollbutton . '   <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                    ';
                            if ($course->has_course_contacts()) {
                                $rowcontent .= html_writer::start_tag('ul', array(
                                    'class' => 'teacherscourseview'
                                ));
                                foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                                    $name = $coursecontact['rolename'] . ': ' . $coursecontact['username'];
                                    $rowcontent .= html_writer::tag('li', $name);
                                }
                                $rowcontent .= html_writer::end_tag('ul');
                            }
                            $rowcontent .= '
                                </div>

                                </figcaption>
                                    <a ' . $tooltiptext . ' href="' . $courseurl . '" class="coursestyle2url"></a>
                                </div>
                            </figure>
                            </div>
                            </div>
                            ';
                            break;

                        case 14:
                            $rowcontent .= '<div class="col-md-4">';
                            $rowcontent .= html_writer::start_tag('div', array(
                                'class' => $course->visible ? 'coursevisible' : 'coursedimmed1'
                            ));
                            $rowcontent .= '<div class="class-box">';
                            $rowcontent .= '
                                    <a ' . $tooltiptext . ' href="' . $courseurl . '">
                                        <div class="courseimagecontainer">
                                            <div class="course-image-view" style="background-image: url(' . $imgurl . ');background-repeat: no-repeat;background-size:cover; background-position:center;"></div>
                                            <div class="course-overlay">
                                                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="course-title">
                                            <h4>' . $trimtitle . '</h4>
                                        </div>
                                    </a>
                                    <div class="course-summary">' . $catcontent . ' ' . $customfieldcontent;
                            if ($course->has_course_contacts()) {
                                $rowcontent .= html_writer::start_tag('ul', array('class' => 'teacherscourseview'));
                                foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                                    $name = $coursecontact['rolename'] . ': ' . $coursecontact['username'];
                                    $rowcontent .= html_writer::tag('li', $name);
                                }
                                $rowcontent .= html_writer::end_tag('ul');
                            }
                            $rowcontent .= '
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            break;

                        case 15:
                            $rowcontent .= '<div class="col-md-4">';
                            $rowcontent .= html_writer::start_tag('div', array(
                                'class' => $course->visible ? 'coursevisible' : 'coursedimmed4'
                            ));
                            $rowcontent .= '<div class="class-box4">';
                            $rowcontent .= '
                                    <a ' . $tooltiptext . ' href="' . $courseurl . '">
                                        <div class="courseimagecontainer">
                                            <div class="course-image-view" style="background-image: url(' . $imgurl . ');background-repeat: no-repeat;background-size:cover; background-position:center;">
                                            </div>
                                            <div class="course-overlay">
                                                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="course-title4"><h4>' . $trimtitle . '</h4></div>
                                    </a>
                                    <div class="course-summary4">
                                    ' . $catcontent . '
                                    ' . $customfieldcontent . '
                                    ' . $summary . '
                                    ';
                            if ($course->has_course_contacts()) {
                                $rowcontent .= html_writer::start_tag('ul', array(
                                    'class' => 'teacherscourseview'
                                ));
                                foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                                    $name = $coursecontact['rolename'] . ': ' . $coursecontact['username'];
                                    $rowcontent .= html_writer::tag('li', $name);
                                }
                                $rowcontent .= html_writer::end_tag('ul');
                            }
                            $rowcontent .= '
                                            </div>
                                        </div>
                                    </div>
                                    </div>';
                            break;

                    }
                }
                $content .= $rowcontent;
                if($PAGE->theme->settings->courselistlayout == 12) {
                    $content .= '</tbody></table>';
                }
                $content .= '</div>'; // Custom div.
                $content .= '</div>'; // Class container-fluid.
            }
        }
        $coursehtml = $header . $content . $footer;
        return $coursehtml;
    }

    // This makes it possible to pass parameters by reference instead of by value
    // so that search_courses() can access the filtered list of courses and totalcount.
    protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
        return $this->coursecat_courses_ml($chelper, $courses, $totalcount);
    }
    protected function coursecat_courses_ml(coursecat_helper $chelper, $courses, &$totalcount = null) {
        global $PAGE;
        
        if (!empty($PAGE->theme->settings->filtercoursesbylang)) {
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
        if (empty($PAGE->theme->settings->courselistlayout)) {
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
                    $class .= ' course-search-result-'. $key;
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
}
