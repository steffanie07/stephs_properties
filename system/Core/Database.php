<?php
namespace App\Core;

/**
 * @author Stephanie Boms <steffanie07@gmail.com>
 *
 */

class Database{

	private static $stmt;
	private static $error;
	private static $db_conn;

	private const DB_HOST = "localhost";
	private const DB_NAME = "properties";
	private const DB_PORT = "3306";
	private const DB_USER = "root";
	private const DB_PASS = "";


	





	/*
	===========================================================================================
	database connection start
	===========================================================================================
	*/

	/**
	 * [db_conn description]
	 * @return [type] [description]
	 */
	public static function db_conn()
	{
		//Config::getConnect();

		$dsn = 'mysql:host='.self::DB_HOST.';port='.self::DB_PORT.';dbname='.self::DB_NAME;
		$options = array(
			\PDO::ATTR_PERSISTENT=>TRUE,
			\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
		);

		

		/*
		=======================================================================================
		connecting to the database
		=======================================================================================
		*/
		try{
		return new \PDO($dsn, self::DB_USER, self::DB_PASS);
		}
		catch(\PDOException $e){
			echo self::$error = $e->getMessage();
			throw new \Exception("Error reading database configuration files");
		}
	}



	/*
	==========================================================================================
	database query setup
	==========================================================================================
	*/

	/**
	 * [query description]
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public static function query($query)
	{
		self::$stmt = self::db_conn()->prepare($query, [\PDO::ATTR_CURSOR=>\PDO::CURSOR_FWDONLY]);
	}
	
	/*
	==========================================================================================
	database bind the statement
	==========================================================================================
	*/

	/**
	 * [bindStatement description]
	 * @param  [type] $param [description]
	 * @param  [type] $value [description]
	 * @param  [type] $type  [description]
	 * @return [type]        [description]
	 */
	public static function bindStatement($param, $value, $type=NULL)
	{
		if(is_null($type)){
			switch (TRUE) {
				case is_int($value):
					$type = \PDO::PARAM_INT;
					break;

				case is_bool($value):
					$type = \PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = \PDO::PARAM_NULL;
					break;
				
				default:
					$type = \PDO::PARAM_STR;
					break;
			}
		}

	self::$stmt->bindValue($param, $value, $type);
	}


	/*
	==========================================================================================
	EXECUTING THE STATEMENT
	==========================================================================================
	*/

	/**
	 * [execute description]
	 * @return [type] [description]
	 */
	 public static function execute()
	 {
	 	return self::$stmt->execute();
	 }
	

	/*
	=========================================================================================
	FETCHING ALL DATA AT ONCE
	=========================================================================================
	*/

	/**
	 * [fetchAll description]
	 * @return [type] [description]
	 */
	public static function fetchAll()
	{
		self::execute();
		return self::$stmt->fetchAll(\PDO::FETCH_OBJ);
	}


	/**
	 * [fetchColumn description]
	 * @return [type] [description]
	 */
	public static function fetchColumn()
	{
		self::execute();
		return self::$stmt->fetchAll(\PDO::FETCH_COLUMN);
	}


	/*
	=========================================================================================
	FETCH ONLY A SINGLE DATA
	=========================================================================================
	*/

	/**
	 * [fetchSingle description]
	 * @return [type] [description]
	 */
	public static function fetchSingle()
	{
		self::execute();
		return self::$stmt->fetch(\PDO::FETCH_OBJ);
	}


	/**
	 * [fetchSingle description]
	 * @return [type] [description]
	 */
																			
	public static function numCounter()
	{
		self::execute();
		return self::$stmt->fetchColumn();
		

	}

	



}
?>
