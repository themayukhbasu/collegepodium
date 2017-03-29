<?php
abstract class SavePage{
	protected $user;
	protected $pageID;
}

class SaveNote extends SavePage {
	
	protected $notePriority;
	
	public function __construct( $userID, $noteID, $priority = 1 ) {
		$this->user = ( int )$userID;
		$this->pageID = ( int )$noteID;
		$this->notePriority = ( int )$priority;
	}
	
	public function isAlreadySaved( ) {
		include 'database.php';
		$stmt = $connection->prepare("SELECT priority FROM savenotes 
									  WHERE user_id = ? AND note_id = ?");
		$stmt->bind_param('ii', $userID, $noteID);
		$userID = $this->user;
		$noteID = $this->pageID;
		$stmt->execute();
		$result = $stmt->get_result();
		if ( $result->num_rows === 0 ) return 0;
		$priority = $result->fetch_array(MYSQLI_ASSOC)['priority'];
		return $priority;
	}
	
	public function currentPriority() {
		return self::isAlreadySaved();
	}
	
	public function unsaveNote() {
		if ( $this->notePriority < 0 )
			return self::saveNote();
		else return 0;
	}
	
	public function saveNote() {
		include 'database.php';
		$isSaved = self::isAlreadySaved();
		if ( $isSaved === 0 ) {
			$stmt = $connection->prepare("INSERT INTO savenotes
										  (user_id, note_id, priority)
										  VALUES (?, ?, ?)");
			$stmt->bind_param('iii', $userID, $noteID, $priority);
			$userID = $this->user;
			$noteID = $this->pageID;
			$priority = $this->notePriority;
			$result = $stmt->execute();
		}
		elseif ( $isSaved != $this->notePriority ) {
			$stmt = $connection->prepare("UPDATE savenotes SET
										  priority = ?
										  WHERE user_id = ? AND note_id = ?");
			$stmt->bind_param('iii', $priority, $userID, $noteID);
			$userID = $this->user;
			$noteID = $this->pageID;
			$priority = $this->notePriority;
			$result = $stmt->execute();
		}
		else return 1;
		if ( !$result ) return 0;
		else return 1;
	}
}