<?php

	/**
 * @author Stephanie Boms <steffanie07@gmail.com>
\ */

class api_data
{
	/**
	 * [up description]
	 * @return [type] [description]
	 */
	public function up()
	{
		try{
			App\Core\Database::query("CREATE TABLE IF NOT EXISTS api_data(
				id INT(11) NOT NULL AUTO_INCREMENT,
				county VARCHAR(100) NOT NULL,
				country VARCHAR(100) NOT NULL,
				town VARCHAR(100) NOT NULL,
				description longtext NOT NULL,
				address VARCHAR(100) NOT NULL,
				image VARCHAR(100) NOT NULL,
				thumbnail VARCHAR(100) NOT NULL,
				latitude VARCHAR(100) NOT NULL,
				longitude VARCHAR(100) NOT NULL,
				num_bedrooms VARCHAR(100) NOT NULL,
				num_bathrooms VARCHAR(100) NOT NULL,
				price VARCHAR(100) NOT NULL,
				property_type longtext NOT NULL,
				type VARCHAR(100) NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				INDEX(county, (6)),
				INDEX(country, (6)),
				INDEX(town, (6)),
				INDEX(address, (6)),
				INDEX(num_bedrooms, (6)),
				INDEX(num_bathrooms, (6)),
				INDEX(price, (6)),
				INDEX(type, (6)),
				PRIMARY KEY(id)) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

			//CREATE INDEX ON "transfers" ("from_account_id");
			App\Core\Database::execute();
		}
		catch(\PDOException $e){
			echo "Table api_data error:". $e->getMessage();
		}
	}
}
