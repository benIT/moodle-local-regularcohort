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
 * @package     local
 * @subpackage  regularcohort
 * @copyright   2017 benIT
 * @author      benIT <benoit.works@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * When user auto registered, core\event\user_created is not triggered,
 * we have to subscribe to 'core\event\user_updated' that is triggered when user confirm account.
 * @see user/lib.php:36: $triggerevent is set to false
 */

defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname' => 'core\event\user_created',
        'callback' => 'local_regularcohort_observer::add_user_to_regular_cohort',
    ),
    array(
        'eventname' => 'core\event\user_updated',
        'callback' => 'local_regularcohort_observer::add_user_to_regular_cohort',
    )
);