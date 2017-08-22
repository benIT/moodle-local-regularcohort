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
require_capability('local/regularcohort:manage', $context);

$manager = new local_regularcohort_manager();

global $PAGE;
$PAGE->set_url("/local");
$PAGE->set_pagelayout("standard");
$PAGE->set_context($context);

$PAGE->set_title(get_string('pluginname', 'local_regularcohort'));
$PAGE->set_heading(get_string('status', 'local_regularcohort'));
echo $OUTPUT->header();

$okIcon = '<img alt="ok" src="pix/right.png">';
$koIcon = '<img alt="ko" src="pix/wrong.png">';

echo html_writer::start_tag('table');
$message = $manager->getCohortRegular() ? $okIcon : $koIcon;
echo html_writer::start_tag('tr');
echo html_writer::tag('td', get_string('check_regular_cohort', 'local_regularcohort'));
echo html_writer::tag('td', $message);
echo html_writer::end_tag('tr');

echo html_writer::start_tag('tr');
$message = $manager->getCohortExceptional() ? $okIcon : $koIcon;
echo html_writer::tag('td', get_string('check_exceptional_cohort', 'local_regularcohort'));
echo html_writer::tag('td', $message);
echo html_writer::end_tag('tr');

echo html_writer::start_tag('tr');
$message = $manager->isEnable() ? $okIcon : $koIcon;
$message = $manager->isEnable() ? $okIcon : $koIcon;
echo html_writer::tag('td', get_string('check_enable', 'local_regularcohort'));
echo html_writer::tag('td', $message);
echo html_writer::end_tag('tr');


echo html_writer::end_tag('table');

echo html_writer::tag('a', get_string('access_setting', 'local_regularcohort'), [
    'target' => '_blank',
    'class' => 'btn btn-info',
    'href' => '/admin/settings.php?section=local_regularcohort']);


echo html_writer::tag('h2', get_string('synchronize', 'local_regularcohort'));

if ($manager->isEnable()) {
    echo html_writer::tag('a', get_string('synchronize_button', 'local_regularcohort'), [
        'class' => 'btn btn-primary',
        'href' => 'synchronize.php']);

} else {
    echo html_writer::tag('p', get_string('synchronize_button_hidden', 'local_regularcohort'));
}
echo $OUTPUT->footer();