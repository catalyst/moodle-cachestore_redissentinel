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
 * Redis Cache Store - Add instance form
 *
 * @package   cachestore_redissentinel
 * @copyright 2017 Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/cache/forms.php');

/**
 * Form for adding instance of Redis Cache Store.
 *
 * @copyright   2017 Catalyst IT
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cachestore_redissentinel_addinstance_form extends cachestore_addinstance_form {
    /**
     * Builds the form for creating an instance.
     */
    protected function configuration_definition() {
        $form = $this->_form;
        global $siteenvironmentid;

        $form->addElement('text', 'server', get_string('server', 'cachestore_redissentinel'), array('size' => 24));
        $form->setType('server', PARAM_TEXT);
        $form->addHelpButton('server', 'server', 'cachestore_redissentinel');
        $form->addRule('server', get_string('required'), 'required');
        $form->setDefault('server', 'redis-local,redis-remote-a,redis-remote-b');

        $form->addElement('text', 'master_group', get_string('master_group', 'cachestore_redissentinel'), array('size' => 24));
        $form->setType('master_group', PARAM_TEXT);
        $form->addRule('master_group', get_string('required'), 'required');
        $form->setDefault('master_group', 'mymaster');

        $form->addElement('text', 'prefix', get_string('prefix', 'cachestore_redissentinel'), array('size' => 16));
        $form->setType('prefix', PARAM_TEXT); // We set to text but we have a rule to limit to alphanumext.
        $form->addHelpButton('prefix', 'prefix', 'cachestore_redissentinel');
        $form->setDefault('prefix', isset($siteenvironmentid) ? $siteenvironmentid : '');
        $form->addRule('prefix', get_string('prefixinvalid', 'cachestore_redissentinel'), 'regex', '#^[a-zA-Z0-9\-_]+$#');
    }
}
