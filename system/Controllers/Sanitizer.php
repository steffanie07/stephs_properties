<?php

namespace App\Controllers;
/**
 * @author Stephanie Boms <steffanie07@gmail.com>
 * @package Assignment
 */
trait Sanitizer
{
	/*
	=========================================================================================
	sanitizing user input
	=========================================================================================
	*/
	/**
	 * [sanitizeString description]
	 * @param  [type] $var [description]
	 * @return [type]      [description]
	 */
	public static function sanitizeString($var)
	{	
		$var = strip_tags($var);
		$var= htmlentities($var);
		$var= stripslashes($var);
		$var = filter_var($var, FILTER_SANITIZE_STRING);
		return $var;
	}



	// creating csrf token
	public static function crfToken(){
		if(empty($_SESSION['crf_token'])){
			$_SESSION['crf_token'] = bin2hex(random_bytes(32));
			htmlentities($_SESSION['crf_token'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); 
		}

		return $_SESSION['crf_token'];
	}


	public static function tokenTime(){
		if(empty($_SESSION['token_time'])){
			$_SESSION['token_time'] = time() + 3600;
		}
		return $_SESSION['token_time'];
	}

	public static function checkToken($var){
		if(!empty($var) && time() < Sanitizer::tokenTime()){
			if(hash_equals($var, Sanitizer::crfToken())){
				return Sanitizer::crfToken();
			}
			else{
				echo "You need to refresh this page <a href=''>Click here</a>";
				unset($_SESSION['token_time']);
				unset($_SESSION['crf_token']);
			}
		}
		else{
			unset($_SESSION['token_time']);
			unset($_SESSION['crf_token']);
			echo "Page expired, click here to <a href=''>Refresh</a>";
		}
	}


	// destroying session
	public static function destroySession(){
	$_SESSION=array();
	if (session_id() != '' || isset($_COOKIE[session_name()]));
	setcookie(session_name(), '', time() - 2592000, '/');
	session_destroy();
	}
			
	//generating session ID
	public static function sameSessionId(){
	session_id();
	session_regenerate_id();
	}


}
