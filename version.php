<?php

// This file is part of the GCWeb for Moodle LMS theme for Moodle - https://moodle.org/
//
// GCWeb for Moodle LMS is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// GCWeb for Moodle LMS is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * WET-BOEW GCWeb theme version.
 *
 * @package   theme_gcweb
 * @copyright 2016-2026 TNG Consulting Inc.
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is the version of the plugin.
$plugin->version = 2022040100;

// This is the version of Moodle this plugin requires.
$plugin->requires = 2026100500; // Moodle 5.3.

// This is the component name of the plugin - it always starts with 'theme_'
// for themes and should be the same as the name of the folder.
$plugin->component = 'theme_gcweb';

// This is a list of plugins, this plugin depends on (and their versions).
$plugin->dependencies = [
    'theme_boost' => 0000000000
];

// This is a stable release.
$plugin->maturity = MATURITY_ALPHA;

// This is the named version.
$plugin->release = '4.0.30'; // Based on WET-BOEW GCWeb v4.0.30.
