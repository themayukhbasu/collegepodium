elseif(isset($_POST["search"]))
	{
		$search = explode(" ",$_POST["search"]);
		$query="select * from `clients` where ";
		foreach($search as $value)
		{    
			$query.="`dump`  like '%".$value."%' and ";
		}
		$query.="1"; 
	}