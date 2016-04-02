<?php


class Model
{

   	var $databaseUsername = "mysqluser";
	var $password = "mysqluserpassword";
	var	$databaseName = "mydatabase";
	var	$mySQLServerName = "localhost";
	var $db_handle;
	var $db_found;
	var $link;
	var $person;
	var $users= array();  
	var $result;
	var $sql;
	var $numUsers;
	var $numPass;
	var $numEmail;

	public function getRegId($email)
	{

	}
	public function checkEmail($email)
	{
		$connected = mysql_connect('localhost', 'root', 'root'); 
	    if (!$connected) 
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($mySQLServerName, $databaseUsername, $password, $databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

		$query = "SELECT email FROM people LIMIT 1;";
		$result = mysql_query($query);

		if(mysql_num_rows($result) == 0)
			return ("email doesn't exist");
		else
			return "email exists";
	}

	public function changePass($email, $newPass)
	{
		/* return string pass changed of successful
		 * eitherwise return string fail 
		 */
		$connected = mysql_connect('localhost', 'root', 'root'); 
	    if (!$connected) 
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($mySQLServerName, $databaseUsername, $password, $databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

		
		$query = "UPDATE people 
				 	 SET password ='$newPass' 
				   WHERE email = '$email';";
		$mysqli->query($query) or die("UPDATE query failed: ".$mysql->error);
		return ("Password Successfully changed.");
		$mysqli->close();

	}

	public function setUpDatabase($q, $rootpass, $serverurl, $adminname, $adminp, $dbname, $serverhost, $rootpath, $canmail)
	{
		$conn = mysql_connect($serverurl, "root", $rootpass);

		$query = "CREATE DATABASE $dbname;";
		mysql_query($query);
		$query = "USE $dbname;";
		mysql_query($query);
		$query = "GRANT ALL ON $dbname.* TO '$adminname'@'$serverurl';";
		mysql_query($query);
		$query = "SET PASSWORD FOR '$adminname'@'$serverurl' = PASSWORD('$adminp');";
		mysql_query($query);

		$query = "CREATE TABLE `loginSet` (
		  `email` varchar(40) NOT NULL,
		  `isApproved` int(5) NOT NULL default '0',
		  `hash` varchar(100) NOT is_null(var)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
		mysql_query($query);
		$query = "INSERT INTO `loginSet` (`email`, `isApproved`, `hash`) VALUES('$adminname@bu.edu', 1, '');";
		mysql_query($query);

		$query = "CREATE TABLE `nLogin` (
		  `email` varchar(40) collate ascii_bin NOT NULL,
		  `password` varchar(100) collate ascii_bin NOT NULL,
		  `name` varchar(40) collate ascii_bin NOT NULL,
		  `buid` varchar(9) collate ascii_bin NOT NULL,
		  `isactive` tinyint(1) NOT NULL,
		  PRIMARY KEY  (`email`)
		) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;";
		mysql_query($query);
		//need to be able to change the admin password
  		$encradminp = md5($adminp);
		$query = "INSERT INTO `nLogin` (`email`, `password`, `name`, `buid`, `isactive`) VALUES('$adminname@bu.edu', '$encradminp', 'admin', 'U00000000', 2);";
		mysql_query($query);

		$query = 
		  "CREATE TABLE `webData` (
		    `email` varchar(40) NOT NULL,
		    `name` varchar(40) NOT NULL default 'Title. Name M. Last',
		    `bio` varchar(1500) NOT NULL default 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, ...anim id est laborum.',
		    `phone` varchar(15) NOT NULL default '(XXX) XXX-XXXX',
		    `fax` varchar(40) NOT NULL default '(XXX) XXX-XXXX',
		    `office` varchar(100) NOT NULL default '#XXX Street Name, BID-RMN <br> Boston, MA 02215, USA',
		    `jobtitle` varchar(40) NOT NULL default 'Job Title Here',
		    `ofhours` varchar(100) NOT NULL default 'Day TT:TT - TT:TT <br> Day TT:TT - TT:TT',
		    `isonline` tinyint(1) NOT NULL default '0',
		    `researchsum` varchar(2000) NOT NULL default 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, ...anim id est laborum.',
		    `teaching` varchar(1000) NOT NULL,
		    `reslink` varchar(100) NOT NULL,
		    `awards` varchar(5) NOT NULL,
		    `projects` varchar(5) NOT NULL,
		    `students` varchar(5) NOT NULL,
		    `personal` varchar(5) NOT NULL
		  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		mysql_query($query);
		$query = "INSERT INTO `webData` (`email`, `name`, `bio`, `phone`, `fax`, `office`, `jobtitle`, `ofhours`, `isonline`, `researchsum`, `teaching`, `reslink`, `awards`, `projects`, `students`, `personal`) VALUES('$adminname@bu.edu', 'Title. Name M. Last', 'Lorem ipsum dolor ... est laborum.', '(XXX) XXX-XXXX', '(XXX) XXX-XXXX', '#XXX Street Name, BID-RMN <br> Boston, MA 02215, USA', 'Job Title Here', 'Day TT:TT - TT:TT <br> Day TT:TT - TT:TT', 1, 'Lorem ipsum dolor sit ...anim id est laborum.', 'CS XXX : Course Title;; - Lorem ipsum dolor ... pariatur.;CS XXX : Course Title;; - Lorem ipsum dolor ... pariatur.;', '', '', '', '', '');";
		mysql_query($query);

		$query = "USE $dbname;";
		mysql_query($query);

		$query = "GRANT ALL ON $dbname.* TO '$adminname'@'bu.edu';";
		mysql_query($query);

		$query = "SET PASSWORD FOR '$adminname'@'bu.edu' = PASSWORD('$adminp');";
		mysql_query($query);

		print("Quartz is all set up! If you are admin, you are ready to begin using Quartz. Simply follow the below link to the login page and log in. If you are a professor, follow the link below to the Quartz login page. On that page, there is an option to create a new account. Choose that option and follow the instructions provided.\n");

		Echo "<html>";
		Echo "<a href=$rootpath>Go to Quartz now!</a>";
		Echo "</html>";
	}

		public function forgot ($inputEmail)
		{
	    	$link = mysql_connect('localhost', 'root', 'root'); 
	    	if (!$link) 
			die('Could not connect: ' . mysql_error()); 

			$mysqli = new mysqli($mySQLServerName, $databaseUsername, $password, $databaseName);

			if ($mysqli->connect_error)
			{
			    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
				exit();
			}

			//send Queries
			$query = "SELECT * FROM people";
			$result = $mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

			for ( $row = $result->fetch_assoc(); $row != FALSE; $row = $result->fetch_assoc() )
			{
				$email = stripslashes($row["email"]);
				if ($email==$inputEmail)
				$this->numEmail=$this->numEmail +1;
			}

			if ($this->numEmail >0)
			{
				echo ("success in forgot -> email");
				return true;
			}
			else 
			{
				echo ("fail in forgot -> email");
				return false;
			}
		
	}


	public function login ($inputUser, $inputPass)
	{
	    $connected = mysql_connect('localhost', 'root', 'root'); 
	    if (!$connected) 
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($mySQLServerName, $databaseUsername, $password, $databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}


		$query = "SELECT * FROM people";
		$result = $mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

		for ( $row = $result->fetch_assoc(); $row != FALSE; $row = $result->fetch_assoc() )
		{

			$username = stripslashes($row["username"]);
			$password = stripslashes($row["password"]);

			if ($username==$inputUser)
				$this->numUsers=$this->numUsers+1;
			if ($password==$inputPass)
				$this->numPass=$this->numPass+1;

			if (($this->numUsers >0) && ($this->numPass >0))
			{
				echo ("Login Succesful");
				return true;
			}
			else 
			{
				echo ("Incorrect input");
				return false;
			}
		}

	}

	public function addPerson($newUsername, $newPassword, $newEmail, $newBU)
	{

	    $connected = mysql_connect('localhost', 'root', 'root'); 
    	if (!connected) 
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($mySQLServerName, $databaseUsername,$password, $databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}


		$query = "CREATE TABLE IF NOT EXISTS `people`
			(`id` int NOT NULL auto_increment,
			`username` text NOT NULL,
			`password` text NOT NULL,
			`email` text NOT NULL,
			`BUID` text NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM;";
		
		$mysqli->query($query) or die('Query failed: ' . $mysqli->error);
		$query = "SELECT * FROM people";
		$result = $mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

		for ( $row = $result->fetch_assoc(); $row != FALSE; $row = $result->fetch_assoc() )
		{
			$username = stripslashes($row["name"]);
		    $emaile = stripslashes($row["email"]);
			$BUID    = stripslashes($row["BUID"]);

			if ($username==$newUsername)
				return ("Duplicate username.");
		    if ($email==$newEmail)
				return ("Duplicate email.");
			if ($BUID==$newBUID)
				return ("Duplicate BUID.");		
		}
		

		$mysqli = new mysqli($mySQLServerName, $databaseUsername, $password, $databaseName);
		print("<br></br>");
		
		if ($mysqli->connect_error)
		{
			print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

		$username1 = $newUsername;
		$password1 = $newPassword;
		$email1    = $newEmail;
		$BU1       = $newBU;

		$query = "INSERT INTO people SET username='$username1', password='$password1', email ='$email1',  BUID ='$BU1' ;";
		$mysqli->query($query) or die("INSERT query failed: ".$mysql->error);
		return ("Registration successful.");

		$mysqli->close();
	}

	private function connect()
	{
		$link = mysql_connect('localhost', 'root', 'root'); 
	    if (!$link) 
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($mySQLServerName, $databaseUsername, $password, $databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

	}

}


?>