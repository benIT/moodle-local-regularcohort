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
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once('classes/manager.php');
defined('MOODLE_INTERNAL') || die();
$context = context_system::instance();
require_login();
require_capability('local/regularcohort:manage', $context);global $PAGE;
$manager = new local_regularcohort_manager();
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_regularcohort'));
$PAGE->set_heading(get_string('synchronize', 'local_regularcohort'));
$PAGE->set_pagelayout("standard");
$PAGE->set_url("/local");
echo $OUTPUT->header();
$manager->synchronizeUsers();
echo '
 <i class="fa fa-check fa-5x" aria-hidden="true"></i> <br><br>
 <a class="btn btn-info" href="/cohort/index.php">'.get_string('check_cohort_membership', 'local_regularcohort').'</a>';
echo $OUTPUT->footer();