<?php

class APIModel{

	public function get_id_from_name($prof_name){
		$query = "select id from people where username = '".$prof_name."';";
		$this->mysqlconnect();
		
		$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
		for ( $row = $result->fetch_assoc(); $row != FALSE;
				$row = $result->fetch_assoc() )
		{
			$id_to_send = $row['id'];
		}
		return $id_to_send;
	}


	public function	getHomeData($login_session){
		//return("getHomeData");
		$prof_id = $this->get_id_from_name($login_session);
		
		$query = "select name, job, idpic, address, telephone, faxer, hotmail, hours, history from teacher where id = ".$prof_id.";";
		
		$this->mysqlconnect();
		$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
		//return ($result);
		for ( $row = $result->fetch_assoc(); $row != FALSE;
				$row = $result->fetch_assoc() )
		{
			$name = $row['name'];
			$job = $row['job'];
			$idpic = $row['idpic'];
			$address = $row['address'];
			$telephone = $row['telephone'];
			$faxer = $row['faxer'];
			$hotmail = $row['hotmail'];
			$hours = $row['hours'];
			$history = $row['history'];
		}
		$name = "<span style='font-size:20px; font-weight:bold'>".$name."</span>";
		$job = "<br><span style='font-size:14px;'><i>".$job."</i></span>";
		$line = "<hr noshade width='440px' align='left'><h5>Contact Information: </h5>";
		$idpic = "<img style='position: right;' height='350' width='280' src='../".$idpic."'>";
		$contact_info = "<span style='font-size:14px;'>".$address."<br>".$telephone." , ".$faxer."<br>".$hotmail."<br><h5>Office Hours: </h5>".$hours."</span>";
		$bio = "<h5>Short Biography: </h5><span style='font-size:12px; text-align: justify;'>".$history."</span>";
		return ($name." ".$job." ".$line." "." ".$contact_info." ".$bio." ");
	}
	
	public function getTeachingData($login_session){
		//return("getHomeData");
		$prof_id = $this->get_id_from_name($login_session);
		
		$query = "select coursename, coursedescription, linktocoursepage  from courses where IDT = ".$prof_id.";";
		
		$this->mysqlconnect();
		$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
		//return ($result);
		for ( $row = $result->fetch_assoc(); $row != FALSE;
				$row = $result->fetch_assoc() )
		{
			$coursename = $row['coursename'];
			$coursedescription = $row['coursedescription'];
			$linktocoursepage = $row['linktocoursepage'];
		}
		return ($coursename." ".$coursedescription." <a href='".$linktocoursepage."'>".$linktocoursepage."</a>");
	}
	
	public function getResearchData($login_session){
		//return("getHomeData");
		$prof_id = $this->get_id_from_name($login_session);
		
		$query = "select arearesearch  from teacher where id = ".$prof_id.";";
		
		$this->mysqlconnect();
		$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
		//return ($result);
		for ( $row = $result->fetch_assoc(); $row != FALSE;
				$row = $result->fetch_assoc() )
		{
			$arearesearch = $row['arearesearch'];
		}
		return ($arearesearch);
	}
	
	public function getAwardsData($login_session){
		//return("getHomeData");
		$prof_id = $this->get_id_from_name($login_session);
		
		$query = "select acolades  from teacher where id = ".$prof_id.";";
		
		$this->mysqlconnect();
		$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
		//return ($result);
		for ( $row = $result->fetch_assoc(); $row != FALSE;
				$row = $result->fetch_assoc() )
		{
			$acolades = $row['acolades'];
		}
		return ($acolades);
	}
	
	public function getPersonalData($login_session){
		//return("getHomeData");
		$prof_id = $this->get_id_from_name($login_session);
		
		$query = "select pers  from teacher where id = ".$prof_id.";";
		
		$this->mysqlconnect();
		$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
		//return ($result);
		for ( $row = $result->fetch_assoc(); $row != FALSE;
				$row = $result->fetch_assoc() )
		{
			$pers = $row['pers'];
		}
		return ($pers);
	}
	
	//connect to my database
	public function mysqlconnect(){

	//login to people table
		$this->databaseUsername = "root";
		$this->password = "root";
		$this->databaseName = "mydatabase";
		$this->mySQLServerName = "localhost";

		$this->mysqli = new mysqli($this->mySQLServerName, $this->databaseUsername,
			$this->password, $this->databaseName);

		if ($this->mysqli->connect_error)
		{
			print("PHP unable to connect to MySQL server; error (" . $this->mysqli->connect_error . "): "
				. $this->mysqli->connect_error);

			exit();
		}
	}
}

?>