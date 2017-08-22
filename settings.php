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
$context = context_system::instance();
require_login();
if ($hassiteconfig) {
    $admin_settingpage = new admin_settingpage('local_regularcohort', get_string('pluginname', 'local_regularcohort'));

    $admin_settingpage->add(new admin_setting_heading('heading', get_string('settings', 'local_regularcohort'), '
<a target="_blank" class="btn btn-info" href="/local/regularcohort/">'.get_string('status', 'local_regularcohort').'</a> <a class="btn btn-info" target="_blank" href="/cohort/index.php">'.get_string('check_cohort_membership', 'local_regularcohort').'</a>
', ''));


    $admin_settingpage->add(new admin_setting_configtext(
        'local_regularcohort/regularcohortname',
        get_string('regular_cohort_name', 'local_regularcohort'),
        get_string('regular_cohort_description', 'local_regularcohort'),
        'regular-user-cohort',
        PARAM_TEXT
    ));

    $admin_settingpage->add(new admin_setting_configtext(
        'local_regularcohort/exceptionalcohortname',
        get_string('exceptional_cohort_name', 'local_regularcohort'),
        get_string('exceptional_cohort_description', 'local_regularcohort'),
        'exceptional-user-cohort',
        PARAM_TEXT
    ));

    $ADMIN->add('localplugins', $admin_settingpage);
}