<?php
include 'ctUserTagList.php';


class ctUserData implements JsonSerializable {
	private $udName;
	private $udEmail;
	private $udCountry;
	private $udTagList; //this will be country specific
	private $udSex;
	private $udDOB;
	private $udContactNo;
	private $udUserLevel;
	
	//set methods (secured to prevent XSS)
	public function udNameSet($name) {
		if ( gettype( $name ) === 'string' ) {
			$this->udName = htmlspecialchars($name);
			return 1;
		}
		else return 0;
	}
	public function udEmailSet($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			$this->udEmail = $email;
		else trigger_error("Invalid email",E_USER_NOTICE);
	}
	public function udCountrySet($country) {
		$this->udCountry = $country;
	}
	public function udTagListSet($tagList) {
		/*
		here, we will dump a set of tags to the profile of a user
		depending on country, tags will be decided, so a user can 
		have as many or as few tags in their list
		*/
		if (is_object($tagList)) {
			$this->udTagList = $tagList;
		}
		else trigger_error("Invalid tag list",E_USER_NOTICE);
	}
	public function udSexSet($sex) {
		if (strtolower($sex)==="male" or strtolower($sex)==="female" or strtolower($sex)==="other")
			$this->udSex = strtolower($sex);
		else trigger_error("Invalid gender",E_USER_NOTICE);
	}
	public function udDOBSet($date) {
		$this->udDOB = $date;
	}
	public function udContactNoSet($number) {
		$this->udContactNo = $number;
	}
	
	//get methods
	public function udNameGet(){
		return $this->udName;
	}
	public function udEmailGet(){
		return $this->udEmail;
	}
	public function udTagListGet(){
		return $this->udTagList; //THIS RETURNS AN OBJECT. BE CAREFUL.
	}
	public function udSexGet(){
		return $this->udSex;
	}
	public function udDOBGet(){
		return $this->udDOB; //this can also return an object in the future
	}
	public function udContactNoGet() {
		return $this->udContactNo;
	}
	public function udCountryGet() {
		return $this->udCountry;
	}
	
	
	public function __construct() {
		$this->udUserLevel = 0;
	}
	
	public function jsonSerialize()
    {
        return [
            'ctUserClass' => [
                'udName' => $this->udName,
                'udEmail' => $this->udEmail,
				'udCountry' => $this->udCountry,
				'udSex' => $this->udSex,
				'udDOB' => $this->udDOB,
				'udContactNo' => $this->udContactNo,
				'udUserLevel' => $this->udUserLevel
            ]
        ];
    }
	
	public static function udFetchName(){
		include 'database.php';
		$stmt = $connection->prepare("SELECT email, ID, name FROM register");
		$success = $stmt->execute();
		if ( !$success ) return 0;
		$i = 0;
		while ($result= $stmt->get_result())
			$data[$i++] = $result->fetch_array(MYSQLI_ASSOC);
		$stmt->close();
		
		if ( mysqli_num_rows( $result ) === 0 ) return 0;
		
		return $data;
	}
	
	public static function udFetchData($userID){
			$stmt = $connection->prepare("SELECT email, userlevel, country, dob, sex, name, contactno, level0tag, level1tag, level2tag
									  FROM register 
									  WHERE ID = ?");
		$stmt->bind_param('i',$ID);
		$ID = $user_ID;
		$stmt->bind_result($arr['email'], $arr['userlevel'], $arr['country'],$arr['dob'], $arr['sex'], $arr['name'],
							$arr['contactno'], $arr['level0tag'], $arr['level1tag'], $arr['level2tag']);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
}
	
		
	