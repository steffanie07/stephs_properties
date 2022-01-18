<?php
namespace App\Controllers;

use Model\Model as Model;
session_start();

class Controller{
/*this should load model*/
	public function model($model){
		require_once "../app/Models/".$model.".php";
		return new $model();
	}

	public static function view($view, $data =[]){
		extract($data);
		require_once "system/Views/".$view.".php";
	}
}


?>