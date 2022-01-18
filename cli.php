<?php
header("Access-Control-Allow-Orgin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "vendor/autoload.php";
use App\Controllers\ApiController;

$api = new ApiController();

return $api->index();
