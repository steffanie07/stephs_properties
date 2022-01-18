<?php

namespace App\Models;


use App\Core\Database;


class TablesCreator
{
	/**
	 * [migrations description]
	 * @return [type] [description]
	 */
	public static function migrations()
	{
		self::createMigrationTable();

		$existingMigrations =  self::getAllMigrations();

		$applyMigrations = [];

		$files = scandir(dirname(__DIR__)."/migrations");

		$newMigrations = array_diff($files, $existingMigrations);

		$ignoreArray = ['.', '..'];

		foreach ($newMigrations as $migration) {

			if(in_array($migration, $ignoreArray)){
				continue;
			}

			/*this get the class name from each file inside the migrations folder*/
			echo $getClass = pathinfo($migration, PATHINFO_FILENAME);


			if(file_exists(dirname(__DIR__)."/migrations/".$migration)){
				require_once dirname(__DIR__)."/migrations/".$migration;
				$classInstance = new  $getClass();
				$classInstance->up();

				echo json_encode([
					"Table"=> $getClass." migration completed"
				], JSON_PRETTY_PRINT);

			}

			$applyMigrations[] = $migration;
		}

		if(!empty($applyMigrations)){
			self::saveMigrations($applyMigrations);
		}else{
			echo json_encode([
					"message"=> "All table migration completed"
				], JSON_PRETTY_PRINT);
		}
	}


	/**
	 * [createMigrationTable description]
	 * @return [type] [description]
	 */
	public static function createMigrationTable()
	{
		try {
			Database::query("CREATE TABLE IF NOT EXISTS `table_migrations`(
				`id` INT AUTO_INCREMENT PRIMARY KEY,
				`migration` VARCHAR(255) NOT NULL,
				`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
				) ENGINE=INNODB");
			Database::execute();
		} 
		catch (\PDOException $e) {
			echo  "Table table_migrations error: ".$e->getMessage();
		}
	}


	/**
	 * [getAllMigrations description]
	 * @return [type] [description]
	 */
	public static function getAllMigrations()
	{
		Database::query("SELECT migration FROM table_migrations");
		return Database::fetchColumn();
	}


	/**
	 * [saveMigrations description]
	 * @param  array  $migrations [description]
	 * @return [type]             [description]
	 */
	public static function saveMigrations(array $migrations)
	{
		foreach ($migrations as $migration) {
			Database::query("SELECT count(id) FROM table_migrations WHERE migration = :migration");
			Database::bindStatement(":migration", $migration);
			$counter = Database::numCounter();
			if(!$counter){
				Database::query("INSERT INTO table_migrations (migration) VALUES (:migration)");
				Database::bindStatement(":migration", $migration);
				Database::execute();
			}
		}
	}


}
