<?php
require_once ("ctPostData.php");

class ctFileData {
	private $fdFileName;
	private $fdFileType;
	private $fdFileSize;
	private $fdFileTempName;
	private $fdFileError;
	private $fdFileExt;
	
	private $fdUploadLoc;
	
	public function fdFileNameSet($fileName) {
		$this->fdFileName = htmlspecialchars($fileName);
	}
	public function fdFileTypeSet($fileType) {
		$this->fdFileType = htmlspecialchars($fileType);
	}
	public function fdFileSizeSet($fileSize) {
		$this->fdFileSize = $fileSize;
	}
	public function fdFileTempNameSet($fileTempName) {
		$this->fdFileTempName = htmlspecialchars($fileTempName);
	}
	public function fdFileErrorSet($fileError) {
		$this->fdFileError = htmlspecialchars($fileError);
	}
	public function fdFileExtSet ($fileExt) {
		$this->fdFileExt = $fileExt;
	}

	public function fdFileNameGet() {
		return $this->fdFileName;
	}
	public function fdFileTypeGet() {
		return $this->fdFileType;
	}
	public function fdFileURIGet() {
		return $this->fdUploadLocGet().$this->fdFileNameGet();
	}
	
	public function fdFileSizeGet() {
		return $this->fdFileSize;
	}
	public function fdFileTempNameGet() {
		return $this->fdFileTempName;
	}
	public function fdFileErrorGet() {
		return $this->fdFileError;
	}
	public function fdFileExtGet() {
		return $this->fdFileExt;
	}
	public function fdUploadLocGet() {
		return $this->fdUploadLoc;
	}
	
	public function __construct( $type = 0 ) {
		

		/* !!!! CODE BREAKS HERE !!!! */
		try{
			$hash = substr(bin2hex(openssl_random_pseudo_bytes(rand(1,999999))),0,80);  /* creating a hash of size 80 */
			
		}
		catch(Exception $e) {
			echo '<br/>Message: ' .$e->getMessage();
		}
		
		$folder = "uploads/".$hash;
		mkdir($folder);
		if ( $type === 1 )	{
			$this->fdUploadLoc = "feedback/" ; //upload location
		}
		else $this->fdUploadLoc = $folder;
		
	}
}

function fileTypeMatch ($fdFileInstance) {
	
//	echo "<br/> DEBUG 5";
	//BAD FUNCTION
	//This is not a safe way to check. MIME data is client side and easy to spoof
	//The PDF, docx etc. is even worse. Security issues MUST be handled. See also Issue 5
	if ((($fdFileInstance->fdFileExtGet()=='.jpg' || $fdFileInstance->fdFileExtGet() == '.jpeg' ) && ($fdFileInstance->fdFileTypeGet()=='image/jpeg'))||($fdFileInstance->fdFileExtGet()== '.png' && $fdFileInstance->fdFileTypeGet()=='image/png'))	{
		//echo "<br/>DEBUG 7";
		return 1;
	}
	elseif ($fdFileInstance->fdFileExtGet()=='.pdf'||$fdFileInstance->fdFileExtGet()=='.docx'||$fdFileInstance->fdFileExtGet()=='.odt'||$fdFileInstance->fdFileExtGet()=='.pptx')	{
	return 1;
	}
	else return 0;
}