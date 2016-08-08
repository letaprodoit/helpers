<?php
/**
 * The Database class
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	DatabaseConn.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Class to store Connection objects
 *
 */
class TSP_DatabaseConn
{
	/**
	 * The DB's name
	 *
	 * @var string
	 */
	public $name;
	/**
	 * The DB's user
	 *
	 * @var string
	 */
	public $user;
	/**
	 * The DB's user's password
	 *
	 * @var string
	 */
	public $pass;
	/**
	 * The DB's host
	 *
	 * @var string
	 */
	public $host;
	/**
	 * The DB's port
	 *
	 * @var integer
	 */
	public $port;
	/**
	 * The DB's type
	 *
	 * @var string
	 */
	public $type;
	
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @param string $name - The DB's name
	 * @param string $user - The DB's user
	 * @param string $pass - The DB's password
	 * @param string $host - The DB's host
	 * @param integer $port - Optional - The DB's port
	 * @param string $type - Optional - The DB's type
	 *
	 * @return none
	 *
	 */
	function __construct($name, $user, $pass, $host = "localhost", $port = 3306, $type = "mysqli")
	{
		$this->name = $name;
		$this->user = $user;
		$this->pass = $pass;
		$this->host = $host;
		$this->port = $port;
		$this->type = $type;
	}//endfunc
}//endclass
?>