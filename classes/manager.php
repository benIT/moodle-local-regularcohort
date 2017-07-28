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
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/cohort/lib.php');

class local_regularcohort_manager
{
    /**
     * @var mixed
     */
    private $cohortRegular;

    /**
     * @var mixed
     */
    private $cohortExceptional;

    /**
     * @var bool
     */
    private $enable;

    public function __construct()
    {
        global $DB;
        $regularCohortName = get_config('local_regularcohort', 'regularcohortname');
        $exceptionalCohortName = get_config('local_regularcohort', 'exceptionalcohortname');
        $this->cohortRegular = $DB->get_record('cohort', ['idnumber' => $regularCohortName]);
        $this->cohortExceptional = $DB->get_record('cohort', ['idnumber' => $exceptionalCohortName]);
        $this->enable = $this->cohortRegular && $this->cohortExceptional ? true : false;
    }

    /**
     * add the user identified by userid tot the regular user cohort if the user is not already member and is not member of exceptional cohort.
     * @param $userId
     * @throws Exception
     */
    public function addUserToRegularCohort($userId)
    {
        if ($this->isEnable()) {
            if (!$this->cohortRegular) {
                throw new \Exception("cannot found regular cohort");
            }
            if (!$this->cohortExceptional) {
                throw new \Exception("cannot found regular cohort");
            }


            if (cohort_is_member($this->cohortExceptional->id, $userId)) {
                if (cohort_is_member($this->cohortRegular->id, $userId)) {
                    cohort_remove_member($this->cohortRegular->id, $userId);
                }
            } else {
                if (!cohort_is_member($this->cohortRegular->id, $userId)) {
                    cohort_add_member($this->cohortRegular->id, $userId);
                }
            }
        }
    }

    /**
     * synchronize all users with cohorts.
     * can take a lot time depending of users number
     */
    public function synchronizeUsers()
    {
        global $DB, $CFG;
        $users = $DB->get_recordset_sql('SELECT id FROM mdl_user WHERE deleted=0 and id<>:guestid ORDER BY id ASC',
            ['guestid' => $CFG->siteguest]
        );
        foreach ($users as $user) {
            $this->addUserToRegularCohort($user->id);
        }
    }

    /**
     * @return mixed
     */
    public function getCohortRegular()
    {
        return $this->cohortRegular;
    }

    /**
     * @param mixed $cohortRegular
     */
    public function setCohortRegular($cohortRegular)
    {
        $this->cohortRegular = $cohortRegular;
    }

    /**
     * @return mixed
     */
    public function getCohortExceptional()
    {
        return $this->cohortExceptional;
    }

    /**
     * @param mixed $cohortExceptional
     */
    public function setCohortExceptional($cohortExceptional)
    {
        $this->cohortExceptional = $cohortExceptional;
    }

    /**
     * @return bool
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

}