<?php
namespace App\Controllers;

/**
 * @author Stephanie Boms <steffanie07@gmail.com>
 * @package Assignment
 */

use App\Controllers\Sanitizer as Sanitizer;

trait Validator{
	
	use Sanitizer;

	/*session Id*/
	public static function sessionId(){
		Sanitizer::sameSessionId();
	}

	/*destroy session*/
	public static function destroySession(){
		Sanitizer::destroySession();
	}

	/*security token*/
	public static function crfToken(){
		return Sanitizer::crfToken();
	}

	public static function selfURL(){
		return Sanitizer::selfURL();
	}

	/*security token exprire time*/
	public static function tokenTime(){
		return Sanitizer::tokenTime();
	}

	public static function checkToken($var){
		return Sanitizer::sanitizeString(Sanitizer::checkToken($var));
	}
	
	
	/**
	 * [sanitizeString description]
	 * @param  [type] $var [sanitizing user input]
	 * @return [type]      [description]
	 */
	public static function sanitizeString($var){
		return Sanitizer::sanitizeString($var);
	}

	
	

}


?>
