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

require_once($CFG->dirroot . '/lib/externallib.php');

class local_sitemanager_external extends external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function get_plugin_settings_parameters() {
        return new external_function_parameters(
            array(
                'plugin' => new external_value(PARAM_TEXT, 'plugin of type TEXT '),
                'key' => new external_value(PARAM_TEXT, 'key of type TEXT', VALUE_OPTIONAL),
            )
        );
    }

    /**
     * Get all the plugin settings.
     * The Mobile app relies in this function to detect if the site is using the local_mobile plugin.
     *
     * @param $plugin
     * @param null $key
     * @return array of settings
     */
    public static function get_plugin_settings($plugin, $key = null) {

        // Validate parameters passed from web service.
        $params = self::validate_parameters(
            self::get_plugin_settings_parameters(), array('plugin' => $plugin, 'key' => $key)
        );

        // Warnings array, it can be empty at the end but is mandatory.
        $warnings = array();
        $settings = array();

        $pluginsettings = (array)get_config($params['plugin'], $params['key']);

        if ($params['key'] == null) {
            // Get all the plugin settings.
            foreach ($pluginsettings as $key => $val) {
                $settings[] = array(
                    //'plugin' => $params['plugin'],
                    'key' => $key,
                    'value' => $val,
                );
            }
        } else {
            // Get that specific key setting.
            $settings[] = array(
                //'plugin' => $params['plugin'],
                'key' => $params['key'],
                'value' => $pluginsettings[0],
            );
        }

        $results = array(
            'settings' => $settings,
            'warnings' => $warnings
        );
        return $results;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_plugin_settings_returns() {
        return new external_single_structure(
            array(
                'settings' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            //'plugin' => new external_value(PARAM_NOTAGS, 'plugin name'),
                            'key' => new external_value(PARAM_NOTAGS, 'setting key'),
                            'value' => new external_value(PARAM_RAW, 'setting value'),
                        )
                    )
                ),
                'warnings' => new external_warnings(),
            )
        );
    }

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function set_plugin_settings_parameters() {
        return new external_function_parameters(
            array(
                'settings' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'key'   => new external_value(PARAM_TEXT, 'plugin setting name (key)'),
                            'value' => new external_value(PARAM_RAW, 'plugin setting value'),
                        )
                    )
                ),
                'plugin' => new external_value(PARAM_TEXT, 'plugin', VALUE_OPTIONAL),
            )
        );
    }

    /**
     * Set one or more plugin settings.
     *
     * @param array $settings - One or more settings (key:value) array.
     * @param string $plugin - Plugin name. (null value > set global settings)
     *
     * @return array $result
     */
    public static function set_plugin_settings($settings = array(), $plugin = null) {

        // Validate parameters passed from web service.
        $params = self::validate_parameters(
            self::set_plugin_settings_parameters(), array('plugin' => $plugin, 'settings' => $settings)
        );

        // Warnings array, it can be empty at the end but is mandatory.
        $warnings = array();
        $status = true;

        foreach ($params['settings'] as $setting) {
            // NOTE: $setting->vlue == null will delete $setting->name
            var_dump($setting);
            if (!set_config($setting['key'], $setting['value'], $plugin)) {
                // 'warningcode'=>1 = Item was not set.
                $warnings[] = array('warningcode'=>1, 'item'=>$setting['key'], 'message'=> 'Error using value='.$setting['value']);
                $status &= false;
            }
        }

        $results = array(
            'status' => $status,
            'warnings' => $warnings
        );
        return $results;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function set_plugin_settings_returns() {
        return new external_single_structure(
            array(
                'status' => new external_value(PARAM_BOOL, 'True if successful, False (-1) for failure'),
                'warnings' => new external_warnings(),
            )
        );
    }
}
