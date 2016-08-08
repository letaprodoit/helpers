<?php
/**
 * Helper Classes
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	Log.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Global functions used by various services
 *
 */	
class TSP_Log
{
    public static function info($msg)
    {
        if (file_exists(TSP_Settings::$file_debug))
        {
            file_put_contents(TSP_Settings::$file_debug, $msg."\n", FILE_APPEND);
        }
        else
        {
            file_put_contents(TSP_Settings::$file_debug, $msg."\n");
        }
    }

    public static function write($msg)
    {
        echo $msg."<br>\n";
    }
}
