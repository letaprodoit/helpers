<?php
/**
 * Helper Classes
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	class.Config.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Global functions used by various services
 *
 */	


class TSP_Config
{
    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param object conn - The database connection
     *
     * @return none
     *
     */
    function __construct($conn = null) 
    {
        $this->conn = $conn;
    }

    /**
     * Function to get a config value
     *
     * @since 1.0.0
     *
     * @param string find - The config value to find
     *
     * @return obj config value
     *
     */
    public static function get($find)
    {
        list($null, $var, $key) = preg_split("/\./", $find, 3);

        $arr = TSP_Settings::$$var;

        if ($var == 'debug')
        {
            return TSP_Settings::$debug;
        }
        else if (!is_array($arr) || (is_array($arr) && empty($key)))
        {
            return $arr;
        }
        else
        {
            if (isset($arr[$key]))
                return $arr[$key];
        }
        
        return "";
    }
}