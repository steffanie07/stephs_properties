<?php
namespace App\Controllers;
/**
 * @author Stephanie Boms <steffanie07@gmail.com>
 * @package Assignment
 */
use App\Models\TablesCreator;

class CreateTable
{
	/**
	 * [runMigrations description]
	 * @return [type] [description]
	 */
	public static function runMigrations()
	{
		return TablesCreator::migrations();
	} 

}
