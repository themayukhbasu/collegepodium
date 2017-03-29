<?php

class FeedbackContent {
	private $userID;
	private $userName;
	private $feedbackTitle;
	private $feedbackData;
	private $feedbackComponent;
	private $feedbackFile;
	
	public function __construct( $feedbackTitle, $feedbackData, $feedbackComponent, $file ) {
		include_once 'session.php';
		if ( !isset( $_SESSION['userid'] ) ) return 0;
		$this->userID = $_SESSION['userid'];
		$this->userName = $_SESSION['name'];
		
		$this->feedbackTitle = htmlspecialchars( stripslashes( trim( $feedbackTitle ) ) );
		$this->feedbackData = htmlspecialchars( stripslashes( trim( $feedbackData ) ) );
		$this->feedbackComponent = htmlspecialchars( stripslashes( trim( $feedbackComponent ) ) );
		
		$this->feedbackFile = $file;
	}

	public function insertDB() {
		if ( $this->feedbackTitle === '' || $this->feedbackData === '' || $this->feedbackComponent === 0 ) {
			return 0;
		}
		include 'database.php';
		/*$connection= new mysqli("localhost","root","","mvp_feedback");*/
		if ($connection->connect_error) {
			die();
			return 0;
		}	
		$stmt = $connection->prepare("INSERT into feedback
									  ( userID, userName, title, summary, component, file )
									  VALUES ( ?, ?, ?, ?, ?, ? )");
		
		$stmt->bind_param( 'isssss', $uID, $uName, $fTitle, $fSummary, $fComponent, $fFile );
		
		$uID = $this->userID;
		$uName = $this->userName;
		$fTitle = $this->feedbackTitle;
		$fSummary = $this->feedbackData;
		$fComponent = $this->feedbackComponent;
		
		if ( is_string( $this->feedbackFile ) ) 
			$fFile = $this->feedbackFile;
		else $fFile = $this->feedbackFile->fdFileURIGet();
		
		$result = $stmt->execute();
		
		if ( !$result ) return 0;
		
		$stmt->close();
		$connection->close();
		
		return 1;
	}
}