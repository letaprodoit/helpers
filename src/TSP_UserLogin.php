<?php
/**
 * The UserLogin class
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	class.UserLogin.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Class to store user login objects
 */
class TSPSVC_UserLogin
{
	/**
	 * The user name
	 *
	 * @var string
	 */
	public $name;
	/**
	 * The user password
	 *
	 * @var string
	 */
	public $pass;
	/**
	 * The login URL
	 *
	 * @var string
	 */
	public $URL;
	
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @param string $name - The user name
	 * @param string $pass - The user password
	 * @param string $url - The login URL
	 *
	 * @return none
	 *
	 */
	function __construct($name, $pass, $url)
	{
		$this->name = $name;
		$this->pass = $pass;	
		$this->URL = $url;
	}//endfunc
}//endclass
?>