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
 * @package    local_sitemanager
 * @copyright  2016 Nadav Kavalerchik <nadavkav@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(
    'local_sitemanager_get_plugin_settings' => array(
        'classname' => 'local_sitemanager_external',
        'methodname' => 'get_plugin_settings',
        'classpath' => 'local/sitemanager/externallib.php',
        'description' => 'Get plugin settings.',
        'type' => 'read',
        // TODO: Choose a better core-level capability: https://docs.moodle.org/dev/Roles#Core-level_Capabilities
        'capabilities' => 'local_sitemanager:update',
    ),
    'local_sitemanager_set_plugin_settings' => array(
        'classname' => 'local_sitemanager_external',
        'methodname' => 'set_plugin_settings',
        'classpath' => 'local/sitemanager/externallib.php',
        'description' => 'Set plugin settings.',
        'type' => 'write',
        // TODO: Choose a better core-level capability: https://docs.moodle.org/dev/Roles#Core-level_Capabilities
        'capabilities' => 'local_sitemanager:update',
    ),

);
