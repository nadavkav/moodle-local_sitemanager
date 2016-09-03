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

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_sitemanager', get_string('pluginname', 'local_sitemanager'));
    $ADMIN->add('localplugins', $settings);
/*
    $adminsetting = new admin_setting_configtext('remotesite', get_string('remotesite', 'local_sitemanager'),
        get_string('remotesite_desc', 'local_sitemanager'), '');
    $adminsetting->plugin = 'local_sitemanager';
    $settings->add($adminsetting);

    $adminsetting = new admin_setting_configtext('wstoken', get_string('wstoken', 'local_sitemanager'),
        get_string('wstoken_desc', 'local_sitemanager'), '');
    $adminsetting->plugin = 'local_sitemanager';
    $settings->add($adminsetting);
*/
}
