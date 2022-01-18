<?php

namespace App\Models;
/**
 * @author Stephanie Boms <steffanie07@gmail.com>
 * @package Assignment
 */

use App\Core\Database;
use App\Controllers\Validator as Validator;

class ApiData
{
	use Validator;
	/**
	 * [getData description]
	 * @return [type] [description]
	 */
	public static function getData($page_no)
	{  
        // get the total record per page
        $per_page = 10;
        // set the offset
        $offset = ($page_no-1) * $per_page;
        // get the previous page
        $previous_page = $page_no - 1;
        // get the next page
        $next_page = $page_no + 1;
        // set the adjacent
        $adjacent = "2";



        Database::query("SELECT COUNT(*) FROM api_data");
        $total_records = Database::numCounter();
        $total_records = $total_records;
        
        $total_no_of_pages = ceil($total_records / $per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1


		Database::query("SELECT * FROM api_data LIMIT $offset, $per_page");
		$data = Database::fetchAll();
		
        return [
            "data" => $data,
            "page_no" => $page_no,
            "previous_page" => $previous_page,
            "next_page" => $next_page,
            "total_no_of_pages" => $total_no_of_pages,
        ];
		
	}

    /**
     * [searchData description]
     * @return [type] [description]
     */
    public static function searchData($search)
    {
        echo $search = "%".$search ."%";

        Database::query("SELECT * FROM api_data  WHERE 
            town LIKE :town 
            OR num_bedrooms LIKE :num_bedrooms 
            OR price LIKE :price 
            OR property_type LIKE :property_type 
            OR type LIKE :type
            ");
       
        Database::bindStatement(":town", $search);
        Database::bindStatement(":num_bedrooms", $search);
        Database::bindStatement(":price", $search);
        Database::bindStatement(":property_type", $search);
        Database::bindStatement(":type", $search);
        $data = Database::fetchAll();
        return $data;
    }





    /**
     * [store description]
     * @return [type] [description]
     */
	public static function store($data)
    {
    	$date = date('Y-m-d h:i:s');

    	echo "Saving to database.......\n";
        
        foreach($data as $key => $value){

        	$title =  Validator::sanitizeString($value['property_type']['title']);
        	$description =  Validator::sanitizeString($value['property_type']['description']);

        	$type_description = json_encode(["type" => $title, "description" => $description]);

        	Database::query("INSERT INTO api_data (county, country, town, description, address, image, thumbnail, latitude, longitude, num_bedrooms, num_bathrooms, price, property_type, type) 

        		VALUES (:county, :country, :town,:description,:address, :image, :thumbnail, :latitude, :longitude, :num_bedrooms, :num_bathrooms, :price, :property_type, :type) ");
        
            Database::bindStatement(":county", Validator::sanitizeString($value['country']));
            Database::bindStatement(":country", Validator::sanitizeString($value['county']));
            Database::bindStatement(":town", Validator::sanitizeString($value['town']));
            Database::bindStatement(":description", Validator::sanitizeString($value['description']));
            Database::bindStatement(":address", Validator::sanitizeString($value['address']));
            Database::bindStatement(":image", Validator::sanitizeString($value['image_full']));
            Database::bindStatement(":thumbnail", Validator::sanitizeString($value['image_thumbnail']));
            Database::bindStatement(":latitude", Validator::sanitizeString($value['latitude']));
            Database::bindStatement(":longitude", Validator::sanitizeString($value['longitude']));
            Database::bindStatement(":num_bedrooms", Validator::sanitizeString($value['num_bedrooms']));
            Database::bindStatement(":num_bathrooms", Validator::sanitizeString($value['num_bathrooms']));
            Database::bindStatement(":price", Validator::sanitizeString($value['price']));
            Database::bindStatement(":property_type", $type_description);
            Database::bindStatement(":type", Validator::sanitizeString($value['type']));
            Database::execute();
        }

        echo "Database insertion Completed \n";

    }

}
