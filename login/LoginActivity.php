<?php

include 'model.php';

class LoginActivity
{
  	var $context;
	var $newUserName;
	var $newPassword;
    var $model;

	function __construct()
	{	   	
		$this->getInput();
	}

	private function showHead()
	{
		?>
		<head>
		<link rel="stylesheet" type="text/css" href="Login.css">
		</head>
		<?php
		include 'header.php';
	}

	private function showForm()
	{
		?>
		<center>
		<div style="position: relative; <?php if (strstr($_SERVER['HTTP_USER_AGENT'],"Mozilla") != "") echo 'top:-15px;'; ?> width: 945px; height: 400px; background: url('images/Body.jpg');">
		<div style="position: relative; top: 50px; background: url('images/Login.jpg'); width: 550px; height: 257px;">
	    <form method="POST" action="login.php">
	    <div class="loginu">
	        Username: <input type="text" name="User" value="" size="50" />
	    </div>
	    <div class="loginp">
	        Password:   <input type="password" name="Pass" value="" size="50" />
	    </div>
	    <div class="loginl">
	        <a href="forgot.php">Forgot Password?</a><br> <!-- [LOGIN.0001] --> 
	        <a href="register.php">Create a new account.</a> <!-- [LOGIN.0002] -->
	    </div>
	    <div class="logins">
	        <input type="reset" value="Reset" name="Reset" /> &nbsp;
	        <input type="submit" value="Login" name="submit" />
	    </div>
	    <div class="logine">
	        <?php
	            if (isset($_SESSION['nologin']) && $_SESSION['nologin'] == 1)
	            	echo 'Error : Incorrect username or password.';
	            $_SESSION['nologin'] = 0;
	        ?>
	    </div>
	    </form>
		</div>
		</div>
		</center>
		<?php
	}
	
	private function showBody()
	{
		print("<body>");
		$this->showForm();
		print("</body>");
	}

	private function showFooter()
	{
		?>
		<center>

		<div style="position: relative; 
		<?php 
			if (strstr($_SERVER['HTTP_USER_AGENT'],"Mozilla")) 
				echo 'top:-15px;'; 
		?> 
		background: url(<?php print("images/Footer.jpg"); ?>); 
		width: 945px; height: 100px;">
		</div>
		</center>

		<?php
	}

	private function showHTML()
	{
		print("<html>");
		$this->showHead();
		$this->showBody();
		$this->showFooter();
		print("</html>");
	}


 	private function getInput()
 	{
		if(isset($_POST["User"]))
		{
			$this->context = "Success! Data submitted";
			$this->newUserName= ($_POST["User"]);
			$this->newPassword = ($_POST["Pass"]);
		}
		else
		{
			$this->context = "No data was submitted";
		}

	}

	
	private function checkForm()
	{
		if((!isset($this->newUserName) || $this->newUserName == '') || (!isset($this->newPassword) || $this->newPassword == ''))	
		{
			echo ($this->newUsername);
			return "false";
		}
		else
		{
			return "true";
		}
	}

	public function processData()
	{
 		if($this->context == "Success! Data submitted")
 		{
 			$this->model = new Model();
 		
 			if($this->checkForm() == "true")
 			{
 				$res = $this->model->login($this->newUserName, $this->newPassword);
 				echo($res);
 				if($res == "true")
 				{
 					?>
					<meta http-equiv="refresh" content="0; url=welcome.php" />
					<?php
					echo"success..?";
 				}
 				else
 				{
 					echo"youfailed";
 				}
 			}
 		}
 	}
	
	
  	public function run()
  	{
 		$this->processData();
 		$this->showHTML();

 	}

 }
?>

