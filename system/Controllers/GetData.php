<?php
namespace App\Controllers;

use App\Models\ApiData;
use App\Controllers\Validator as Validator;



class GetData extends Controller
{
	use Validator;

	/**
	 * [startApplication description]
	 * @return [type] [description]
	 */
	public static function startApplication()
	{
		if(isset($_GET['page_no']) && isset($_GET['token']) && $_GET['page_no'] != ""){
			if(Validator::checkToken($_GET['token'])){
				$page_no = Validator::sanitizeString($_GET['page_no']);
			}
		}
		else{
			$page_no = 1;
		}
		$content = ApiData::getData($page_no);
		self::view("homepage", $content);
	}



	/**
	 * [searchQuery description]
	 * @return [type] [description]
	 */
	public static function searchQuery()
	{
		if(isset($_POST['search']) && isset($_POST['token']) && $_POST['search'] != ""){
			if(Validator::checkToken($_POST['token'])){
				$search = Validator::sanitizeString($_POST['search']);
				$content = ApiData::searchData($search);
				self::view("search", $content);
			}
		}
	}


	/**
	 * [view description]
	 * @return [type] [description]
	 */
	public static function view($view, $data =[]){
		extract($data);
		require_once "system/Views/".$view.".php";
	}

}
