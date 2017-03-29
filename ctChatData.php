<?php 

/*
Tables=>  chatroomindex   : ID,roomType,roomStatus,hashID,roomTableName,participantTableName,NOP(no. of Participants)
	  cr_<chatRoomID> : ID,data,type,PID,time // name of the table same as the one in the index under the column roomTable
 	  pl_<chatRoomID> : ID,PID,Status,rank	  // name of the table same as the one in the index under the column participantTable
*/




class ctChatData{
	 
	/* cd refers to Chat Data */
	 
	private $cdChatroomID;
	private $cdChatroomTableName;
	private $cdParticpantTableName;
	private $cdRoomStatus;  /* Status of a particular room || 0->deleted 1->normal */
	private $cdRoomType;  /* Type of Room || whether personal chat or group chat or study group chat etc */
	private $cdNOP;  /* No. of Participants*/
	private $cdP_List; /* participants' list */
	private $cdHashID; /* unique identifier for each room */
	
	private $cdChatDataID;
	private $cdChatData;
	private $cdChatDataType; /* This contains the type of chat message || text or file */
	
	private $cdP_ID;     /* Participant ID || User ID of Participant posting the data */
	private $cdP_Status;  /* Participant Status || 0 -> blocked/banned  1-> active */
	private $cdP_Rank;    /* Participant Rank || for the later purposes when adding study group ||  0->normal/member */
	
	
	/*===== Variables Set Methods =====*/
	
	public function cdChatroomTableNameSet($roomTableName){
		$this->cdChatroomTableName = $roomTableName;
	}
	
	public function cdParticpantTableName($participantTableName){
		$this->cdParticpantTableName =  $participantTableName;
	}
	
	public function cdNOPSet($no_of_participants){
		$this->cdNOP = $no_of_participants;	/* This function sets the number of particpants */
	}
	
	public function cdParticipantIdSet($participantID){
		$this->cdP_ID = $participantID;
	}
	
	public function cdParticipantSatusSet($participantStatus){
		$this->cdP_Status = $participantStatus;
	}
	
	public function cdParticipantRankSet($participantRank){
		$this->cdP_Rank = $participantRank;
	}
	
	public function cdRoomStatusSet($roomStatus){
		$this->cdRoomStatus = $roomStatus;
	}
	
	public function cdRoomTypeSet($roomType){
		$this->cdRoomType = $roomType;
	}
	
	public function cdHashIDSet($hash){
		$this->cdHashID = $hash;
	}
	
	public function cdChatDataSet($chatData){  /* This sets the chat message */ 
		$trimmedData = trim($chatData);
		$trimmedData = stripslash($trimmedData);
		$this->cdChatData = htmlspecialchars($trimmedData);
		
		if( empty( $this->cdChatData ) )
			return 0;
		else
			return 1;
	}
	
	public function cdChatParticipantListSet($participantList){
		$this->cdP_List = $participantList;
	}
	
	public function cdChatDataTypeSet($chatDataType){   /* This function sets the type of the chat message, if it is a file or text */
		$this->cdChatDataType = $chatDataType;   
	}
	
	
	/*===== Variables Get Methods =====*/
	
	public function cdChatroomIDGet(){
		return $this->cdChatroomID;
	}
	
	public function cdChatroomTableNameGet(){
		return $this->cdRoomTableName;
	}
	
	public function cdParticpantTableNameGet(){
		retrun $this->cdParticpantTableName;
	}
	
	public function cdRoomStatusGet(){
		return $this->cdRoomStatus;
	}
	
	public function cdRoomTypeGet(){
		return $this->cdRoomType;
	}
	
	public function cdNoOfParticipantsGet(){
		return $this->cdNOP;
	}
	
	public function cdParticipantListGet(){
		return $this->cdP_List;
	}
	
	public function cdHashIDGet(){
		return $this->cdHashID;
	}	
	
	public function cdChatDataIDGet(){
		return $this->cdChatDataID;
	}
	
	public static function cdChatDataGet(){
		return $this->cdChatData;
	}
	
	public function cdChatDataTypeGet(){
		return $this->cdChatDataType;
	}
	
	public function cdParticipantIDGet(){
		return $this->cdP_ID;
	}
	
	public function cdParticipantStatusGet(){
		return $this->cdP_Status;
	}
	
	public function cdParticipantRankGet(){
		return $this->cdP_Rank;
	}
	
	
	/* Static function to fetch messages from chat one by one in descending order of time */	
	public static function cdFetchChatData($roomName){
		include 'database.php';
		
		$stmt = $connection->prepare("SELECT * FROM ? ORDER by time DESC LIMIT 1");
		$stmt->bind_param('s',$rname);
		$rname = $roomName;
	}	
}
