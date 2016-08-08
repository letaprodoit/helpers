<?php
/**
 * Helper Classes
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	class.Settings.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Settings used by the TheSoftwarePeople\Helper package
 *
 */	

class TSP_Settings
{
	public static $live            = false;
	public static $debug           = true;
	public static $notify_admin    = true;
	
    public static $cookie_prefix_default = "tsp-";
	public static $cookie_prefix_encoded = "Encoded: ";

	public static $date_format_default     = "m/d/Y";
	public static $date_format_database    = "Y-m-d H:i:s";
	public static $date_format_pretty      = "F d, Y";
	public static $date_format_simple      = "F Y";

	public static $smtp_host = "smtp.mandrillapp.com";
	public static $smtp_port = 587;
	public static $smtp_user = null;
	public static $smtp_pass = null;

    public static $dir_sep     = "/";
    public static $dir_upload  = "/uploads";
	public static $dir_cache   = "/cache";
	public static $file_debug  = "/log-debug.log";
    public static $file_error  = "/log-error.log";

	public static $database_mysql 	= "mysql";
	public static $database_mysqli 	= "mysqli";
	public static $database_mssql 	= "mssql";
	public static $database_mongo 	= "mongo";

	public static $password_salt 	= "aq7#^NMr";

    public $databases   = null;
    public $users       = null;
    public $apis        = null;
    public $checksums   = null;
    public $contacts    = null;
}