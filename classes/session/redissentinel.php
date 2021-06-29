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
 * Redis based session handler.
 *
 * @package    cachestore_redissentinel
 * @copyright  2017 Matt Clarkson <mattc@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace cachestore_redissentinel\session;

defined('MOODLE_INTERNAL') || die();

/**
 * Session class for redissentinel
 *
 * Class redissentinel
 * @package cachestore_redissentinel\session
 */
class redissentinel extends \core\session\redis {

    protected $hosts = array();
    protected $master_group = 'mymaster';

    /**
     * Create new instance of handler.
     */
    public function __construct() {
        global $CFG;
        parent::__construct();

        if (isset($CFG->session_redissentinel_hosts)) {
            $this->hosts = $CFG->session_redissentinel_hosts;
        }

        if (isset($CFG->session_redissentinel_master_group)) {
            $this->master_group = $CFG->session_redissentinel_master_group;
        }
    }

    /**
     * Init function.
     */
    public function init () {
        $sentinel = new \cachestore_redissentinel\sentinel($this->hosts);
        $master = $sentinel->get_master_addr($this->master_group);
        if (!empty($master)) {
            $this->host = $master->ip;
            $this->port = $master->port;
        }
        parent::init();
    }
}
