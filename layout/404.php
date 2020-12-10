<?php
// This file is part of the WET-BOEW-Moodle theme for Moodle - https://moodle.org/
//
// WET-BOEW-Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Contact Form is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Contact Form.  If not, see <https://www.gnu.org/licenses/>.

/**
 * This the "404 Page Not Found" page.
 *
 * @package    theme_gcweb
 * @copyright  2016-2020 TNG Consulting Inc. - www.tngconsulting.ca
 * @author     Michael Milette
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');

if (empty(get_local_referer(false))) {
    $PAGE->set_url('/theme/gcweb/layout/404.php');
} else {
    $PAGE->set_url(get_local_referer(false));
}

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('popup');
$PAGE->set_title(get_string('err404title', 'theme_gcweb'));
$PAGE->navbar->add('');

$extraheader = '
<link rel="stylesheet" href="' . $CFG->wwwroot . '/GCWeb/css/theme-srv.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
<style>
#page {margin-top: 0px;}
#gcwu-sig, #wmms {height: 2em;}
.wb-inv {display:none;}
#wmms {float:right;}
body {font-family: "Noto Sans",sans-serif;font-size: 16px;}
.h2, h2 {margin-top: 38px;font-weight: 700;font-size: 26px;}
#region-main {border:none;}
</style>
';
$header = $OUTPUT->header();
$header = str_replace('</head>', $extraheader, $header) . '</head>';

// Display page.
echo $header;
echo get_string('err404body', 'theme_gcweb', $CFG->wwwroot);
echo $OUTPUT->footer();
