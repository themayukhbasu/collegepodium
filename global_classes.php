<?php

/*
main php for all classes (related to tags)
Include this whenever you need to add tags or handle tags
The way we'll be saving tags is dumping details in a .json file and
saving name, ID and json file link in the MySQL table
The JSON file will have all details, including name (not ID though)
*/

class ctGlobalTag implements JsonSerializable {
	private  $gtType; //type of object. will be university, college etc for now mostly
	private $gtName; //name of body
	/*
	basic fields for address
	mainly made for flexibility
	*/
	private $gtAddress; 
	private $gtCity;
	private $gtState;
	private $gtCountry;
	private $gtPhone; //might be useful
	private $gtLevel; //0-indexing; 0-primary, 1-secondary, 2-tertiary (i.e. 0-univ, 1-college, 2-dept)
	//WHEN YOU ADD A VARIABLE, DON'T FORGET TO ADD IT TO jsonSerialize()
	//you also need valid getters & setters
	
	//set methods
	public function gtTypeSet($type){
		$this->gtType = htmlspecialchars($type);
	}
	
	public function gtNameSet($name){
		$this->gtName = htmlspecialchars($name);
	}
	
	public function gtCitySet($city){
		$this->gtCity = htmlspecialchars($city);
	}
	
	public function gtStateSet($state){
		$this->gtState = htmlspecialchars($state);
	}

	public function gtAddressSet($add){
		$this->gtAddress = htmlspecialchars($add);
	}

	public function gtCountrySet($country){
		$this->gtCountry = htmlspecialchars($country);
	}	
	
	public function gtPhoneSet($phone){
		$this->gtPhone = htmlspecialchars($phone);
	}
	
	public function gtLevelSet($level){
		if ($level > 4) trigger_error("Database error. Maximum nesting level is 4",E_USER_ERROR);
		else $this->gtLevel = $level; //don't need here, we are checking if this is an int anyway when committing to DB
	}
	
	public function gtSet($type, $name, $city, $state, $add, $country, $phone, $level){
		$this->gtTypeSet($type);
		$this->gtNameSet($name);
		$this->gtCitySet($city);
		$this->gtStateSet($state);
		$this->gtAddressSet($add);
		$this->gtCountrySet($country);
		$this->gtPhoneSet($phone);
		$this->gtLevelSet($level);
	}
	
	//get methods
	public function gtTypeGet(){
		return $this->gtType;
	}
	
	public function gtNameGet(){
		return $this->gtName;
	}
	
	public function gtCityGet(){
		return $this->gtCity;
	}

	public function gtAddressGet(){
		return $this->gtAddress;
	}

	public function gtCountryGet(){
		return $this->gtCountry;
	}	
	
	public function gtPhoneGet(){
		return $this->gtPhone;
	}	
	
	public function gtLevelGet(){
		return $this->gtLevel;
	}
	
	
	function __construct(){
		$this->gtAddress = "NONE";
		$this->gtPhone = "NONE";
		$this->gtCity = "NONE";
		$this->gtCountry = "NONE";
		$this->gtState = "NONE";
		$this->gtType = "NONE";
		$this->gtName = "NONE";
		$this->gtLevel = -1;
	}
	
	public function jsonSerialize()
    {
        return [
            'ctGlobalTag' => [
                'gtName' => $this->gtName,
                'gtType' => $this->gtType,
				'gtAddress' => $this->gtAddress,
				'gtCity' => $this->gtCity,
				'gtState' => $this->gtState,
				'gtCountry' => $this->gtCountry,
				'gtPhone' => $this->gtPhone
            ]
        ];
    }
}


include_once 'gt_databse_insert.php';

