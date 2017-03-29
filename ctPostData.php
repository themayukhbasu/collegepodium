<?php

/*##################################################################

ctPostData.php -  Class for Data Posted [Data includes :  queries || discussions || notices ]

Variables:
	> pdPrimTag  - Primary tag. Can Refer to University level
	> pdSecTag   - Secondary Tag. Can Refer to College Level
	> pdTerTag   - Tertiary Tag. Can refer to Stream
	
	> pdPostTitle  - Title of posts/data  *NOTE : used in post.php
	> pdPostData   - Data/content of posts/data *Note : used in post.php
	> pdPostPriv  - Privacy  of the data/post 
	
	> pdPostUID  - User id 
	> pdPostUsername - Username
	> pdPostRealName - Real name of the user
	
	> pdPostType - type of post [notice/query/discussion]
	
	> pdIsOP - ????
	> pdOPID - ????
	
	> pdVote - data of voting
###################################################################*/

class ctPostData {
	private $pdPrimTag;
	private $pdSecTag;
	private $pdTerTag;

	private $pdPostTitle;
	private $pdPostData;

	//private $pdFileData;

	private $pdPostPriv;
	
	private $pdPostUID;
	private $pdPostUsername;
	private $pdPostRealName;
	
	private $pdPostType;
	
	private $pdIsOP;
	private $pdOPID;
	
	private $pdVote;
	
	//these should be validated during SQL calls. don't add htmlspecialchars here
	public function pdPrimTagSet($primTagID) {		          /* Setting of University*/		
		$this->pdPrimTag = $primTagID;
	}
	public function pdSecTagSet($secTagID) {		          /* Setting of College*/	
		$this->pdSecTag = $secTagID;
	}
	public function pdTerTagSet($terTagID) {		          /* Setting of Stream*/	
		$this->pdTerTag = $terTagID;
	}
	
	//these methods though need htmlspecialchars
	public function pdPostTitleSet($postTitle) {
		$trimmedTitle = trim( $postTitle );   		/* Removes the blank spaces and trims the whole thing*/
		$trimmedTitle = stripslashes($trimmedTitle);  /* Removes the escape sequences (\) to avoid running of codes*/
		$this->pdPostTitle = htmlspecialchars( $trimmedTitle );  /* Changes the the special characters into html codes (eg: &,*,$ etc)*/
		if ( empty( $this->pdPostTitle ) ) return 0;
		else return 1;
	}
	public function pdPostDataSet( $postData ) {
		$trimmedData = trim($postData);
		$trimmedData = stripslashes($trimmedData);
		$this->pdPostData = htmlspecialchars( $trimmedData );
		if ( empty( $this->pdPostData ) ) return 0;
		else return 1;
	}

	/*public function pdFileDataSet($fileData) {
		$this->pdFileData = $fileData; //consider cloning
	}*/

	public function pdPostPrivSet($postPriv) {
		$this->pdPostPriv = htmlspecialchars($postPriv);
	}
	public function pdIsOPSet ($isOP) {
		if ($isOP === 0 or $isOP === false) 
			$this->pdIsOP = 0;
	}
	
	public function pdOPIDSet ($OPID) {
		if ($this->pdIsOP === 0)
			$this->pdOPID = $OPID; //only set if post isn't OP
	}	

	public function pdPostTypeSet ($postType) {
		if (strtolower($postType)==="notice" or strtolower($postType)==="query" or strtolower($postType)==="discuss")
			$this->pdPostType = $postType; //no need to escape, already checking ^
	}
	
	public function pdPostUIDSet ($UID) {
		$this->pdPostUID = (int)$UID;
	}
	
	public function pdPostUsernameSet ($postUsername) {
		$this->pdPostUsername = $postUsername;
	}
	
	public function pdPostRealNameSet ($postName) {
		$this->pdPostRealName = $postName;
	}
	
	public function pdVoteSet($vote) {
		if (is_integer($vote))
			$this->pdVote = $vote;
	}
	
	public function pdVoteIncrement($margin) {
		if (is_integer($margin))
			$this->pdVote += $margin;
	}
	
	//get methods
	public function pdPrimTagGet() {
		return $this->pdPrimTag;
	}
	public function pdSecTagGet() {
		return $this->pdSecTag;
	}
	public function pdTerTagGet() {
		return $this->pdTerTag;
	}

	public function pdPostTitleGet() {
		return $this->pdPostTitle;
	}

	public function pdPostDataGet() {
		return $this->pdPostData;
	}

	/*public function pdFileDataGet() {
		return $this->pdFileData;
	}*/

	public function pdPostPrivGet() {
		return $this->pdPostPriv;
	}
	
	public function pdIsOPGet() {
		return $this->pdIsOP;
	}
	
	public function pdOPIDGet() {
		return $this->pdOPID;
	}

	public function pdPostTypeGet() {
		return $this->pdPostType;
	}
	
	public function pdPostUIDGet() {
		return $this->pdPostUID;
	}
	
	public function pdPostUsernameGet() {
		return $this->pdPostUsername;
	}
	
	public function pdVoteGet() {
		return $this->pdVote;
	}
	
	public function pdPostRealNameGet () {
		return $this->pdPostRealName;
	}
	
	public function __construct() {
		

		$this->pdPrimTag = -1;
		$this->pdSecTag = -1;
		$this->pdTerTag = -1;
		


		$this->pdFileData = new ctFileData;  /* !!!! CODE BREAKS HERE !!!! */
		

		
		$this->pdIsOP = 1;
		$this->pdOPID = 0;
		$this->pdVote = 0;
		$this->pdPostType = "notice";
		
	}
}
/* END of class ctPostData */

function pdFetchPostPrimtag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT gtName FROM globaltag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function pdFetchPostSectag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT stName FROM sectag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function pdFetchPostTertag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ttName FROM terttag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function pdFetchPost($primtag, $sectag, $tertag, $sort, $limval, $type) {
	
	if ($primtag == 0 and $sectag == 0 and $tertag == 0) return 0;
	include 'database.php';
	if ( strtolower( trim( $type ) ) === 'notice'  || strtolower( trim( $type ) ) === 'query' || strtolower( trim( $type ) )=== 'discuss' ) {
		$query = "SELECT * FROM data WHERE ( primtag = ? AND ( sectag = ? AND tertag = ? ) )
									  AND is_op = ? AND privacy <> ? AND type = ?";
		if ( $sort == 0 ) $query = $query. " ORDER by time DESC LIMIT 1 OFFSET ?";
		else $query = $query. " ORDER by votecount DESC LIMIT 1 OFFSET ?";
		
		$stmt = $connection->prepare($query);
		$stmt->bind_param('iiiiisi', $prim, $sec, $ter, $isop, $priv,  $datType, $offset);

		$offset = $limval; 
		$prim = $primtag;
		$sec = $sectag;
		$ter = $tertag;
		$isop = 1;
		$priv = -1;
		$datType = strtolower( trim( $type ) );
	}
	else {
		//get everything
		$query = "SELECT * FROM data WHERE ( primtag = ? AND ( sectag = ? AND tertag = ? ) )
									  AND is_op = ? AND privacy <> ?";
		if ( $sort == 0 ) $query = $query. " ORDER by time DESC LIMIT 1 OFFSET ?";
		else $query = $query. " ORDER by votecount DESC LIMIT 1 OFFSET ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('iiiiii', $prim, $sec, $ter, $isop, $priv, $offset);

		$offset = $limval; 
		$prim = $primtag;
		$sec = $sectag;
		$ter = $tertag;
		$isop = 1;
		$priv = -1;
	}
	$success = $stmt->execute();
	if ( !$success ) return 0;
    $result = $stmt->get_result();
	$arr = $result->fetch_array(MYSQLI_ASSOC);
	$stmt->close();
	if ( mysqli_num_rows( $result ) === 0 ) return 0;
	$arr['primtag'] = pdFetchPostPrimtag( $arr['primtag'] );
	$arr['sectag'] = pdFetchPostSectag( $arr['sectag'] );
	$arr['tertag'] = pdFetchPostTertag( $arr['tertag'] );
	return $arr;
}

function pdDeletePost ( $postid ) {
	include 'database.php';
	$stmt = $connection->prepare( "UPDATE data
								   SET privacy = ?
								   WHERE ( ID = ? OR 
											( op_id = ? AND is_op = ? )
										) " );
	$stmt->bind_param( 'iiii', $privacy , $ID , $op_id , $is_op );
	if ( $stmt == false ) return 0;
	$privacy = -1;
	$ID = $postid;
	$op_id = $postid;
	$is_op = 0;
	$result = $stmt->execute();
	if ( $result == false) return 0;
	else return 1;
}

function pdFetchPostData ($postid, $limval) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT * FROM data
								  WHERE ( op_id = ? OR ID = ? )
								  AND privacy <> ?
								  ORDER by time ASC
								  LIMIT 1
								  OFFSET ?"
								);
	$stmt->bind_param('iiii', $opid, $ID, $priv, $offset);
								
	$offset = $limval;
	$opid = $postid;
	$ID = $postid;
	$priv = -1;
	
	$success = $stmt->execute();
	if ( !$success ) return 0;
	$result = $stmt->get_result();
	$arr = $result->fetch_array(MYSQLI_ASSOC);
	
	$stmt->close();
	
	$arr['primtag'] = pdFetchPostPrimtag( $arr['primtag'] );
	$arr['sectag'] = pdFetchPostSectag( $arr['sectag'] );
	$arr['tertag'] = pdFetchPostTertag( $arr['tertag'] );
	
	return $arr;
}

function pullPostDB ($valpass) {
	//insecure method but no need to fix since every variable is sessiondata (secure)
	/*$x=mysqli_connect("localhost","root","","a1864584_ct") or die("fail");
	$y=mysqli_query($x,   "SELECT ID, userid, username, privacy, time, file, post, title, userrealname
						FROM data
						WHERE
						primtag = '".$_SESSION['primtag']."' AND
						 (sectag = '".$_SESSION['sectag']."' OR
						 tertag = '".$_SESSION['tertag']."'
						)
						AND is_op = 1
						ORDER BY time DESC");
	$it = 0; //loop iterator
	while($it < 10){
		$arr[$it]=mysqli_fetch_array($y); //dump data
		$it++;
	}*/
	$arr = pdFetchPost($_SESSION['primtag'],$_SESSION['sectag'], $_SESSION['tertag']);
	//echo $arr;
	$valpass=(int)$valpass; //get
	$jsonEncode = json_encode($arr[$valpass]); //json encode SQL query returned array
	return $jsonEncode; //will be processed by AJAJ method
}

/*function validateTag ($primtag, $sectag, $tertag) {	
	$ptag = (int)
}
	/*
	include 'database.php';
	$postArray = array();
	$stmt = $connection->prepare($x,   "SELECT ID, userid, username, privacy, time, file, post, title, userrealname
						FROM data
						WHERE
						primtag = ? AND
						 (sectag = ? OR
						 tertag = ?
						)
						AND is_op = ?
						ORDER BY time DESC");
	$stmt->bind_param('iiii', $ptag, $stag, $ttag, $op);
	$ptag = mysqli_real_escape_string($primtag);
	$stag = mysqli_real_escape_string($sectag);
	$ttag = mysqli_real_escape_string($tertag);
	$op = 1;
	$stmt->execute();
	$stmt->bind_result($ID, $userid, $username, $privacy, $time, $file, $post, $title, $userrealname);
	$it = 0; //loop iterator
	while($it < 10){
		$stmt->fetch();
		$bindResults = array($ID, $userid, $username, $privacy, $time, $file, $post, $title, $userrealname);
		array_push($postArray, $bindResults);
		$it++;
	*/
include_once 'ctFileData.php';
