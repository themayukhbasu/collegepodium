<?php
class ctUserTagList {
	private $tlLevel0;
	private $tlLevel1;
	private $tlLevel2;
	private $tlLevel3;
	//add more levels here
	
	public function tlLevel0Set($level0tag) {
		$this->tlLevel0 = $level0tag;
	}
	public function tlLevel1Set($level1tag) {
		$this->tlLevel1 = $level1tag;
	}
	public function tlLevel2Set($level2tag) {
		$this->tlLevel2 = $level2tag;
	}
	public function tlLevel3Set($level3tag) {
		$this->tlLevel3 = $level3tag;
	}
	
	public function tlCheckLevel0Type() {
		return gettype($this->tlLevel0);
	}
	public function tlCheckLevel1Type() {
		return gettype($this->tlLevel1);
	}
	public function tlCheckLevel2Type() {
		return gettype($this->tlLevel2);
	}
	public function tlCheckLevel3Type() {
		return gettype($this->tlLevel3);
	}

	public function tlLevel0Get() {
		return $this->tlLevel0;
	}
	public function tlLevel1Get() {
		return $this->tlLevel1;
	}
	public function tlLevel2Get() {
		return $this->tlLevel2;
	}
	public function tlLevel3Get() {
		return $this->tlLevel3;
	}
	
	public function __construct() {
		$this->tlLevel0 = 0;
		$this->tlLevel1 = 0;
		$this->tlLevel2 = 0;
		$this->tlLevel3 = 0;
	}
}