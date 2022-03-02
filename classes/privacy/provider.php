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

/**
 * Privacy Subsystem implementation for theme_gcweb.
 *
 * @package   theme_gcweb
 * @copyright 2016-2022 TNG Consulting Inc. <www.tngconsulting.ca>
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_gcweb\privacy;

defined('MOODLE_INTERNAL') || die();

/**
 * The WET-BOEW GCWeb theme does not store any data.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
