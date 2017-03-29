<?php
class ctNoteData {
	private $ndPrimTag;
	private $ndSecTag;
	private $ndTerTag;
	private $ndQuarTag;
	
	private $ndNoteTitle;
	private $ndNoteData;

	//private $ndFileData;

	private $ndNotePriv;
	
	private $ndNoteUID;
	private $ndNoteUsername;
	private $ndNoteRealName;
	
	private $ndNoteType;
	
	private $ndNoteTeacher;
	private $ndNoteSubject;
	private $ndNotePeriod;
	
	private $ndIsOP;
	private $ndOPID;
	
	private $ndVote;
	
	//these should be validated during SQL calls. don't add htmlspecialchars here
	public function ndPrimTagSet($primTagID) {
		$this->ndPrimTag = $primTagID;
	}
	public function ndSecTagSet($secTagID) {
		$this->ndSecTag = $secTagID;
	}
	public function ndTerTagSet($terTagID) {
		$this->ndTerTag = $terTagID;
	}
	public function ndQuarTagSet($quarTagID) {
		$this->ndQuarTag = $quarTagID;
	}
	
	//these methods though need htmlspecialchars
	public function ndNoteTitleSet($NoteTitle) {
		$trimmedTitle = trim( $NoteTitle );
		$this->ndNoteTitle = htmlspecialchars( $trimmedTitle );
		if ( empty( $this->ndNoteTitle ) ) return 0;
		else return 1;
	}
	
	public function ndNoteDataSet( $NoteData ) {
		$trimmedData = trim($NoteData);
		$this->ndNoteData = htmlspecialchars( $trimmedData );
		if ( empty( $this->ndNoteData ) ) return 0;
		else return 1;
	}

	/*public function ndFileDataSet($fileData) {
		$this->ndFileData = $fileData; //consider cloning
	}*/

	public function ndNotePrivSet($notePriv) {
		$this->ndNotePriv = htmlspecialchars($notePriv);
	}
	public function ndIsOPSet ($isOP) {
		if ($isOP === 0 or $isOP === false) 
			$this->ndIsOP = 0;
	}
	
	public function ndOPIDSet ($OPID) {
		if ($this->ndIsOP === 0)
			$this->ndOPID = $OPID; //only set if Note isn't OP
	}	

	public function ndNoteTypeSet ($noteType) {
		if (strtolower($noteType)==="notice" or strtolower($noteType)==="query" or strtolower($noteType)==="discuss")
			$this->ndNoteType = $noteType; //no need to escape, already checking ^
	}
	
	public function ndNoteUIDSet ($UID) {
		$this->ndNoteUID = (int)$UID;
	}
	
	public function ndNoteUsernameSet ($noteUsername) {
		$this->ndNoteUsername = $noteUsername;
	}
	
	public function ndNoteTeacherSet ($noteTeacher) {
		$this->ndNoteTeacher = $noteTeacher;
	}
	
	public function ndNoteSubjectSet ($noteSubject) {
		$this->ndNoteSubject = $noteSubject;
	}

	public function ndNotePeriodSet ($notePeriod) {
		$this->ndNotePeriod = $notePeriod;
	}

	public function ndNoteRealNameSet ($noteName) {
		$this->ndNoteRealName = $noteName;
	}
	
	public function ndVoteSet($vote) {
		if (is_integer($vote))
			$this->ndVote = $vote;
	}
	
	public function ndVoteIncrement($margin) {
		if (is_integer($margin))
			$this->ndVote += $margin;
	}
	
	//get methods
	public function ndPrimTagGet() {
		return $this->ndPrimTag;
	}
	public function ndSecTagGet() {
		return $this->ndSecTag;
	}
	public function ndTerTagGet() {
		return $this->ndTerTag;
	}
	public function ndQuarTagGet() {
		return $this->ndQuarTag;
	}
	
	public function ndNoteTitleGet() {
		return $this->ndNoteTitle;
	}
	
	public function ndNoteTeacherGet() {
		return $this->ndNoteTeacher;
	}
	
	public function ndNoteSubjectGet() {
		return $this->ndNoteSubject;
	}
	
	public function ndNotePeriodGet() {
		return $this->ndNotePeriod;
	}
	
	public function ndNoteDataGet() {
		return $this->ndNoteData;
	}

	/*public function ndFileDataGet() {
		return $this->ndFileData;
	}*/

	public function ndNotePrivGet() {
		return $this->ndNotePriv;
	}
	
	public function ndIsOPGet() {
		return $this->ndIsOP;
	}
	
	public function ndOPIDGet() {
		return $this->ndOPID;
	}

	public function ndNoteTypeGet() {
		return $this->ndNoteType;
	}
	
	public function ndNoteUIDGet() {
		return $this->ndNoteUID;
	}
	
	public function ndNoteUsernameGet() {
		return $this->ndNoteUsername;
	}
	
	public function ndVoteGet() {
		return $this->ndVote;
	}
	
	public function ndNoteRealNameGet () {
		return $this->ndNoteRealName;
	}
	
	public function __construct() {
		$this->ndPrimTag = -1;
		$this->ndSecTag = -1;
		$this->ndTerTag = -1;
		
		$this->ndFileData = new ctFileData;
		$this->ndIsOP = 1;
		$this->ndOPID = 0;
		$this->ndVote = 0;
		$this->ndNoteType = "notice";
	}
}

function ndFetchNotePrimtag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT gtName FROM globaltag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function ndFetchNoteSectag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT stName FROM sectag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function ndFetchNoteTertag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ttName FROM terttag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function ndSectagPredFetch ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT stParentID, stParentName FROM sectag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$primData = $result->fetch_array(MYSQLI_NUM);
	
	$stmt->close();
	return $primData;
}

function ndTertagPredFetch ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ttParentID, ttParentName FROM terttag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$secData = $result->fetch_array(MYSQLI_NUM);
	
	$stmt->close();
	return $secData;
}

function ndFetchNoteQuartag ( $ID ) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT qtName FROM quartag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	$stmt->bind_result($tag1);
	$stmt->fetch();
	$stmt->close();
	return $tag1;
}

function ndNotePrimList ( $primtag ) {
	include 'database.php';
	
	$stmt = $connection->prepare("SELECT note_id FROM noteintended WHERE note_tag = ?
								  AND note_tag_level = ?
								  ORDER BY time DESC");
	$stmt->bind_param('ii', $prim, $lev);
	$prim = $primtag;
	$lev = 0;
	$stmt->execute();
	
    $result = $stmt->get_result();
	$arr = array();
	while ($tag = $result->fetch_array(MYSQLI_NUM)) $arr = array_merge($arr, $tag);
	$stmt->close();
	return $arr;
}

function ndNoteSecList ( $sectag ) {
	include 'database.php';
	
	$stmt = $connection->prepare("SELECT note_id FROM noteintended WHERE note_tag = ?
								  AND note_tag_level = ?
								  ORDER BY time DESC");
	$stmt->bind_param('ii', $sec, $lev);
	$sec = $sectag;
	$lev = 1;
	$stmt->execute();
	
    $result = $stmt->get_result();
	$arr = array();
	while ($tag = $result->fetch_array(MYSQLI_NUM)) $arr = array_merge($arr, $tag);
	$stmt->close();
	return $arr;
}

function ndNoteTertList ( $tertag ) {
	include 'database.php';
	
	$stmt = $connection->prepare("SELECT note_id FROM noteintended WHERE note_tag = ?
								  AND note_tag_level = ?
								  ORDER BY time DESC");
	$stmt->bind_param('ii', $ter, $lev);
	$ter = $tertag;
	$lev = 2;
	$stmt->execute();
	
    $result = $stmt->get_result();
	$arr = array();
	while ($tag = $result->fetch_array(MYSQLI_NUM)) $arr = array_merge($arr, $tag);
	$stmt->close();
	return $arr;
}

function ndNoteQuarList ( $quartag ) {
	include 'database.php';
	
	$stmt = $connection->prepare("SELECT note_id FROM noteintended WHERE note_tag = ?
								  AND note_tag_level = ?
								  ORDER BY time DESC");
	$stmt->bind_param('ii', $quar, $lev);
	$quar = $quartag;
	$lev = 3;
	$stmt->execute();
	
    $result = $stmt->get_result();
	$arr = array();
	while ($tag = $result->fetch_array(MYSQLI_NUM)) $arr = array_merge($arr, $tag);
	$stmt->close();
	return $arr;
}

function ndListSavedNotes($user) {
	require 'session.php';
	$elapsedTime = time() - @$_SESSION['notes']['saved']['time'];
	if ( $elapsedTime < 1200 && isset( $_SESSION['notes']['saved']['list'] ) )
		return $_SESSION['notes']['saved']['list'];
	include 'database.php';
	$stmt = $connection->prepare("SELECT note_id FROM savenotes
								  WHERE user_id = ? AND priority > ?");
	$stmt->bind_param('ii', $userID, $priority);
	$userID = $user;
	$priority = 0;
	$success = $stmt->execute();
	if ( !$success ) return 0;
	$result = $stmt->get_result();
	$notesArr = array();
	$notesArr = $result->fetch_all(MYSQLI_ASSOC);
	$notesID = array();
	$i = 0;
	foreach ( $notesArr as $ID ) {
		$notesID[$i++] = $ID['note_id'];
	}
	$stmt->close();
	$_SESSION['notes']['saved']['list'] = $notesID;
	$_SESSION['notes']['saved']['time'] = time();
	return $notesID;
}

function ndFetchNote($primtag, $sectag, $tertag, $limval) {
	include 'database.php';
	//Get list of IDs specified by prim, sec, tertag
	$primSet = ndNotePrimList($primtag);
	$secSet = ndNoteSecList($sectag);
	$terSet = ndNoteTertList($tertag);
	//merge in order. If I'm asking for tertag, it means I want results from that first
	$IDArr = array_merge( $terSet, $secSet, $primSet );
	//get notes with specified ID. Obviously fetches just one row.
	$stmt = $connection->prepare("SELECT * FROM notes WHERE ID = ?
								  AND is_op = ? AND privacy <> ?");
	$stmt->bind_param('iii', $ID, $isop, $priv);
	@$ID = $IDArr[$limval];
	$offset = $limval; 
	$isop = 1;
	$priv = -1;
	$success = $stmt->execute();
	if ( !$success ) return 0;
    $result = $stmt->get_result();
	//fetch result
	$arr = $result->fetch_array(MYSQLI_ASSOC);
	$stmt->close();
	
	//detect level of the row we are fetching
	foreach ( $primSet as $j ) {
		if ( @$j === $ID ) {
			$lev = 0;
			break;
		}
	}
	foreach ( $secSet as $j ) {
		if ( @$j === $ID ) {
			$lev = 1;
			break;
		}
	}
	
	foreach ( $terSet as $j ) {
		if ( @$j === $ID ) {
			$lev = 2;
			break;
		}
	}
	
	//generate the names of tags according to level
	if ( isset( $arr ) ) {	
		if ( @$lev === 0 ) {
			$arr['primtag'] = ndFetchNotePrimtag( $primtag );
			$arr['sectag'] = '';
			$arr['tertag'] = '';
		}
		if ( @$lev === 1 ) {
			$arr['sectag'] = ndFetchNoteSectag( $sectag );
			$primData = ndSectagPredFetch( $sectag );
			$arr['primtag'] = $primData[1];
			$arr['tertag'] = '';
		}
		if ( @$lev === 2 ) {
			$arr['tertag'] = ndFetchNoteTertag( $tertag );
			$secData = ndTertagPredFetch( $tertag );
			$arr['sectag'] = $secData[1];
			$primData = ndSectagPredFetch( $secData[0] );
			$arr['primtag'] = $primData[1];
		}
	}
	
	//Get note files
	$arrFile = ndGetNoteFile( $ID );
	if ( isset( $arrFile ) && isset( $arr ) ) {
		@$arr = array_merge($arr, $arrFile) ;
		return $arr;
	}
	return 0;
}

function ndGetNoteByID ( $ID ) {
	include 'database.php';
	//get notes with specified ID. Obviously fetches just one row.
	$stmt = $connection->prepare("SELECT * FROM notes WHERE ID = ?
								  AND is_op = ? AND privacy <> ?
								  LIMIT 1");
	$stmt->bind_param('iii', $noteID, $isop, $priv);
	$noteID = $ID;
	$isop = 1;
	$priv = -1;
	$success = $stmt->execute();
	if ( !$success ) return 0;
    $result = $stmt->get_result();
	//fetch result
	$arr = $result->fetch_array(MYSQLI_ASSOC);
	$stmt->close();
	
	
	//generate the names of tags according to level
	/*if ( isset( $arr ) ) {	
		if ( @$lev === 0 ) {
			$arr['primtag'] = ndFetchNotePrimtag( $primtag );
			$arr['sectag'] = '';
			$arr['tertag'] = '';
		}
		if ( @$lev === 1 ) {
			$arr['sectag'] = ndFetchNoteSectag( $sectag );
			$primData = ndSectagPredFetch( $sectag );
			$arr['primtag'] = $primData[1];
			$arr['tertag'] = '';
		}
		if ( @$lev === 2 ) {
			$arr['tertag'] = ndFetchNoteTertag( $tertag );
			$secData = ndTertagPredFetch( $tertag );
			$arr['sectag'] = $secData[1];
			$primData = ndSectagPredFetch( $secData[0] );
			$arr['primtag'] = $primData[1];
		}
	}
	*/
	//Get note files
	$arrFile = ndGetNoteFile( $ID );
	if ( isset( $arrFile ) && isset( $arr ) ) {
		@$arr = array_merge($arr, $arrFile) ;
		return $arr;
	}
	return 0;
}

function ndGetNoteFile ( $ID ) {
	include 'database.php';
	//get all files with specific note ID
	$stmt = $connection->prepare("SELECT note_file FROM notefile WHERE note_id = ?
								  ORDER by time DESC");
	$stmt->bind_param('i', $fileID);
	$fileID = $ID;
	$stmt->execute();
    $result = $stmt->get_result();
	$arrFile = array();
	//Get files one by one and recursively merge since there can be multiple files
	while ( $file = $result->fetch_array(MYSQLI_ASSOC) ) {
		$arrFile = array_merge_recursive($arrFile, $file);
	}
	$stmt->close();
	return $arrFile;
}

function ndSearchNote($searchString) {
	require 'session.php';
	$valid = @$_SESSION['notes']['search'][strtolower( $searchString )]['valid'];
	if ( $valid === 1 && isset( $_SESSION['notes']['saved'][strtolower( $searchString )] ) )
		return $_SESSION['notes']['saved'][strtolower( $searchString )];
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID FROM notes
								  WHERE is_op = ? AND privacy <> ?
								  AND LOWER(title) LIKE ?");
	$stmt->bind_param('iis', $isop, $priv, $string);
	$isop = 1;
	$priv = -1;
	$string = '%'.strtolower( $searchString ).'%';
	$success = $stmt->execute();
	if ( !$success ) return 0;
    $result = $stmt->get_result();
	//fetch result
	$notesArr = $result->fetch_all(MYSQLI_ASSOC);
	$notesID = array();
	$i = 0;
	foreach ( $notesArr as $ID ) {
		$notesID[$i++] = $ID['ID'];
	}
	$stmt->close();
	return $notesID;
}

function ndAdvSearchNote($searchString,$username,$userrealname,$type,$teacher,$subject,$period){
	require 'session.php';
	$valid = @$_SESSION['notes']['search'][strtolower( $searchString )]['valid'];
	if ( $valid === 1 && isset( $_SESSION['notes']['saved'][strtolower( $searchString )] ) )
		return $_SESSION['notes']['saved'][strtolower( $searchString )];
	include 'database.php';
	
	$q = "SELECT ID FROM notes WHERE is_op = ? AND privacy <> ?";
	if(!empty($username)){
		$q = $q. " AND username LIKE '%".$username."%' ";
	}
	if(!empty($userrealname)){
		$q = $q." AND userrealname LIKE '%".$userrealname."%' ";
	}
	if(!empty($type)){
		$q = $q." AND type LIKE '%".$type."%' ";
	}
	if(!empty($teacher)){
		$q = $q." AND teacher LIKE '%".$teacher."%' ";
	}
	if(!empty($subject)){
		$q = $q." AND subject LIKE '%".$subject."%' ";
	}
	if(!empty($period)){
		$q = $q." AND period LIKE '%".$period."%' ";
	}
	$q = $q." AND LOWER(title) LIKE ?";
	
	$stmt->bind_param('iis', $isop, $priv, $string);
	$isop = 1;
	$priv = -1;
	$string = '%'.strtolower( $searchString ).'%';
	$success = $stmt->execute();
	$notesArr = $result->fetch_all(MYSQLI_ASSOC);
	$notesID = array();
	$i = 0;
	foreach ( $notesArr as $ID ) {
		$notesID[$i++] = $ID['ID'];
	}
	
	$stmt->close();
	return $notesID;
	/*
	if ( !$success ) return 0;
    $result = $stmt->get_result();
	while($x=$result->fetch_array(MYSQLI_ASSOC)){
		$notesID[] =$x;
	}
	
	$stmt->close();
	return $notesID;
	*/
}

function ndDeleteNote ( $Noteid ) {
	include 'database.php';
	$stmt = $connection->prepare( "UPDATE notes
								   SET privacy = ?
								   WHERE ( ID = ? OR 
											( op_id = ? AND is_op = ? )
										) " );
	$stmt->bind_param( 'iiii', $privacy , $ID , $op_id , $is_op );
	if ( $stmt == false ) return 0;
	$privacy = -1;
	$ID = $Noteid;
	$op_id = $Noteid;
	$is_op = 0;
	$result = $stmt->execute();
	if ( $result == false) return 0;
	else return 1;
}

/*function validateTag ($primtag, $sectag, $tertag) {	
	$ptag = (int)
}
	/*
	include 'database.php';
	$noteArray = array();
	$stmt = $connection->prepare($x,   "SELECT ID, userid, username, privacy, time, file, Note, title, userrealname
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
	$stmt->bind_result($ID, $userid, $username, $privacy, $time, $file, $note, $title, $userrealname);
	$it = 0; //loop iterator
	while($it < 10){
		$stmt->fetch();
		$bindResults = array($ID, $userid, $username, $privacy, $time, $file, $note, $title, $userrealname);
		array_push($noteArray, $bindResults);
		$it++;
	*/
include_once 'ctFileData.php';
