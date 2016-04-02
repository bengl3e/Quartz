<?php

$databaseUsername = "quartzadmin";
$password = "kevin1301";
$databaseName = "mydatabase";
$mySQLServerName = "localhost";
$defaultText = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, ...anim id est laborum.";

class Model
{

   	var $databaseUsername = "quartzadmin";
	var $password = "kevin1301";
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
	var $defaultText = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, ...anim id est laborum.";

	public function getHome($uri)
	{
		return "in getHome";
	}

	public function getTeaching($uri)
	{
		return "in getTeaching";
	}

	public function getResearch($uri)
	{
		return "in getResearch";
	}

	public function getAwards($uri)
	{
		return "in getAwards";
	}

	public function getPersonal($uri)
	{
		return "in getPersonal";
	}

	public function getActiveId()
	{
		$random = "012345678";

		return $random;
	}

	public function getPhotoDest()
	{
		return "";
	}

	public function updateManage($email, $name, $phone, $fax, $hours, $jobtitle, $office, $bio, $research, $awards, $projects, $students, $personal, $teaching)
	{
		
		$connected = mysql_connect('localhost', 'root', '');
		if(!$connected)
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($this->mySQLServerName, $this->databaseUsername, $this->password, $this->databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

		$query = "UPDATE professor
					 SET name = '$name', phone='$phone', fax='$fax', hours='$hours', 
					     job = '$jobtitle', office='$office'
				   WHERE email='$email';";
		$mysqli->query($query) or die("UPDATE query failed updateManage: ".$mysqli->error);

		$query = "UPDATE professor
					 SET bio = '$bio', research='$research', awards = '$awards', projects = '$projects', students = '$students',
					     personal = '$personal', teaching = '$teaching'
				   WHERE email='$email';";
		$mysqli->query($query) or die("UPDATE query failed updateManage: ".$mysqli->error);

		$mysqli->close();
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

		$query = "SELECT email FROM professor LIMIT 1;";
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

		
		$query = "UPDATE professor 
				 	 SET password ='$newPass' 
				   WHERE email = '$email';";
		$mysqli->query($query) or die("UPDATE query failed: ".$mysql->error);
		return ("Password Successfully changed.");
		$mysqli->close();

	}

	public function setUpDatabases($q, $rootpass, $serverurl, $adminname, $adminp, $dbname, $serverhost, $rootpath, $canmail)
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

		$query = 
		  "CREATE TABLE IF NOT EXISTS `professor` (
		  	'id'			int						  		  NOT NULL AUTO_INCREMENT,
		    `email` 		varchar(40) 	collate ascii_bin NOT NULL,
		    'password'		varchar(20)		collate ascii_bin NOT NULL,
		    'BUID'			char(8)		    collate ascii_bin NOT NULL,
		    'isApproved'	tinyint(1)						  NOT NULL default '0',
		    `name`			varchar(40) 					  NOT NULL default 'Title. Name M. Last',
		    `bio` 			varchar(1500) 					  NOT NULL default '$defaultText',
		    `phone` 		varchar(15) 					  NOT NULL default '(XXX) XXX-XXXX',
		    `fax` 			varchar(40) 					  NOT NULL default '(XXX) XXX-XXXX',
		    `office` 		varchar(100) 				      NOT NULL default '#XXX Street Name, BID-RMN <br> Boston, MA 02215, USA',
		    `job`	 		varchar(40) 					  NOT NULL default 'Job Title Here',
		    `hours` 		varchar(100) 					  NOT NULL default 'Day TT:TT - TT:TT <br> Day TT:TT - TT:TT',
		    `isOnline` 		tinyint(1) 						  NOT NULL default '0',
		    `research`	 	varchar(2000) 					  NOT NULL default '$defaultText',
		    `teaching` 		varchar(100)					  NOT NULL default '',
		    `url`	 		varchar(100)					  NOT NULL default '',
		    `awards` 		varchar(20) 					  NOT NULL default '',
		    `projects` 		varchar(20) 					  NOT NULL default '',
		    `students` 		varchar(20) 					  NOT NULL default '',
		    `personal` 		varchar(20) 					  NOT NULL default '',
		    PRIMARY KEY (id)
		  ) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;";
		$mysqli->query($query) or die('CREATE query failed: ' . $mysqli->error);
		
		$encradminp = md5($adminp);
		$query = "INSERT INTO 'professor' ('email','password','name','BUID')
					   VALUES ('$adminname@bu.edu','$encradminp','admin','00000000');";
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


			$query = "SELECT email FROM professor";
			$result = $mysqli->query ($query) or die('SELECT query failed: ' . mysql_error());

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
	   
		
		if (isset($_GET['logout']) && $_GET['logout'] == 1) 
        { 
            $_SESSION['usertype'] = 0;
            session_destroy();
        }
         
        if (isset($_POST['submit'])) // [LOGIN.0005]
        {
        	echo ($_POST['User']);
       
        	if (!isset($_POST['User']) | !isset($_POST['Pass'])) // [LOGIN.0004]
            {  
                $_SESSION['nologin'] = 1;
                echo '<script language="javascript">';
				echo 'alert("In model.php login, User and Pass not set")';
				echo '</script>';
				return "false";
            }
	        else
	        {
	        	$connected = mysql_connect('localhost', 'root', ''); 
		   		if (!$connected) 
					die('Could not connect: ' . mysql_error()); 

				$mysqli = new mysqli($this->mySQLServerName, $this->databaseUsername, $this->password, $this->databaseName);

				if ($mysqli->connect_error)
				{
			  	  print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
					exit();
					return "false";
				}

				return "true";

				$_SESSION['nologin'] = 0;
	        }

		}
	}

	public function checkLogin($inputEmail, $inputPass)
	{
		if (isset($_SESSION['nologin']) && $_SESSION['nologin'] == 1)
		{
			echo '<script language="javascript">';
			echo 'alert("In model, checkLogin")';
			echo '</script>';
			return false;
		}             	
		else
		{
			return true;
		}
		
	}

	public function addPerson($newUsername, $newPassword, $newEmail, $newBU)
	{

	    $connected = mysql_connect('localhost', 'root', ''); 
    	if (!$connected) 
			die('Could not connect: ' . mysql_error()); 

		$mysqli = new mysqli($this->mySQLServerName, $this->databaseUsername, $this->password, $this->databaseName);

		if ($mysqli->connect_error)
		{
		    print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

		
		$query = 
		  "CREATE TABLE IF NOT EXISTS `professor` (
		  	`id`			int						  	 	  NOT NULL AUTO_INCREMENT,
		    `email` 		varchar(40) 					  NOT NULL,
		    `password`		varchar(20)						  NOT NULL,
		    `BUID`			char(8)		    				  NOT NULL,
		    `isApproved`	tinyint(1)						  NOT NULL default '0',
		    `name`			varchar(40) 					  NOT NULL default 'Title. Name M. Last',
		    `bio` 			varchar(1500) 					  NOT NULL default '$this->defaultText',
		    `phone` 		varchar(15) 					  NOT NULL default '(XXX) XXX-XXXX',
		    `isActive`		tinyint(1)						  NOT NULL default  '0',
		    `fax` 			varchar(40) 					  NOT NULL default '(XXX) XXX-XXXX',
		    `office` 		varchar(100) 				      NOT NULL default '#XXX Street Name, BID-RMN <br> Boston, MA 02215, USA',
		    `job`	 		varchar(40) 					  NOT NULL default 'Job Title Here',
		    `hours` 		varchar(100) 					  NOT NULL default 'Day TT:TT - TT:TT <br> Day TT:TT - TT:TT',
		    `isOnline` 		tinyint(1) 						  NOT NULL default '0',
		    `research`	 	varchar(2000) 					  NOT NULL default 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, ...anim id est laborum.',
		    `url`	 		varchar(100)					  NOT NULL default '',
		    `awards` 		varchar(20) 					  NOT NULL default '',
		    `projects` 		varchar(20) 					  NOT NULL default '',
		    `students` 		varchar(20) 					  NOT NULL default '',
		    `personal` 		varchar(20) 					  NOT NULL default '',
		    PRIMARY KEY (id)
		  ) ENGINE=MyISAM;";
		
		$mysqli->query($query) or die('CREATE query failed: ' . $mysqli->error);
		

		$query = "SELECT name, email, BUID FROM professor";
		$result = $mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

		for ( $row = $result->fetch_assoc(); $row != FALSE; $row = $result->fetch_assoc() )
		{
			$username 	= stripslashes($row["name"]);
		    $email 		= stripslashes($row["email"]);
			$BUID    	= stripslashes($row["BUID"]);	
		}
		

		$mysqli = new mysqli($this->mySQLServerName, $this->databaseUsername, $this->password, $this->databaseName);
		print("<br></br>");
		
		if ($mysqli->connect_error)
		{
			print("PHP unable to connect to MySQL server; error (" . $mysqli->connect_errno . "): ". $mysqli->connect_error);
			exit();
		}

		$query = "INSERT INTO professor
						  SET name='$newUsername', password='$newPassword', email ='$newEmail',  BUID ='$newBU' ;";
		$result = $mysqli->query($query) or die("INSERT query failed: ".$mysql->error);
		return ("Registration successful.");

		$mysqli->close();
	}

	public function addCourse()
	{
		return;
	}

}


?>