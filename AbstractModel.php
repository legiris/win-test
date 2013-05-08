<?php

class AbstractModel
{	
	static protected $database;
	
	/**
	 * pripojeni k databazi
	 */
	public static function getConnection()
	{	
		if (!self::$database) {
			self::$database = new PDO('mysql:host=localhost;dbname=test', 'root', '');
		}
		return self::$database;			
	}	

	/**
	 * nastaveni modu pro vypis chyb a upozorneni
	 * @param boolean $value
	 */
	public static function setDebug($value)
	{
		if ($value === true) {
			self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}	
	}

	/**
	 * nastaveni znakove sady
	 * @param string $characterSet
	 */
	public static function setCharacter($characterSet)
	{
		self::$database->query('SET CHARACTER SET '. $characterSet);
	}		
	
}