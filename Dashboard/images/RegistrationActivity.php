<?php
	include 'activitydefinitions.php';
			$headerincludedfrom = "register.php";
            include 'dbvars.php';

            include 'header.php';
	class RegistrationActivity
    {
	private $name;
	private $email;
	private $email2;
	private $pass;
	private $pass2;
	private $buid;
	private $model;
	private $context;
	
	function __construct(){
		$this->getInput();
		$this->model = new Model();
	}
	function process() {
	if ($this->context == "submitting"){
		$res = $this->processform();
		if ($res == true){
				$output = $this->model->addPerson($this->name, $this->email, $this->pass, $this->buid);
				if ($output == "Registration successful."){
				echo "Congratulations on registering!. Click this link to activate your account.";
					//$_SESSION['login'] = $this->name;
				?>
					<meta http-equiv="refresh" content="0; url=http://localhost:81/welcome.php" />
					<?php					
						//header("Location: welcome.php");
				}// end of model addperson result check.
				else{
					print("Api error encountered.");
				}
			}
			
		}
	}
	function getInput(){
		if (isset($_POST['submit'])){
				$this->name=$_POST['name']; 
				$this->email=$_POST['email']; 
				$this->email2=$_POST['email2']; 
				$this->pass=$_POST['pass']; 
				$this->pass2=$_POST['pass2']; 
				$this->buid=$_POST['buid']; 
				$this->context = "submitting";
		}//end of if submit
		else {
		$this->context = "showform";
		}
	}//end of getinput.
	function run (){
		$this->process();
		$this->show();
		//$this->show();
		}
	function show(){
		$this->showheader();
		$this->showForm();
		echo ("</html>");
		}
		/* mail function.
		function sendRegMail(){
		$subject = "Quartz Registration";
		$message = "
		<html>
		<head>
		<title> QUARTZ REGISTRATION </title>
		</head>
		<body>
		<p>
		Congratulations on registering!. Click this link to activate your account"
		
		
		mail($_POST['email'],$subject,$txt);
		}
		*/
		function showheader(){
	echo ("<html>");
	echo ("<head>");
	echo ("</head>");
	echo("<div style='position: relative; background: url(http://localhost:8888/Quartz/pics/Header.jpg);
	width: 945px; height: 120px;'>");
	echo("</div>");
	}
		function processform(){
			if (isset($_POST['submit'])){
				if ((!isset($this->name)||($this->name== ""))||
					(!isset($this->email)||$this->email=="")||
				    (!isset($this->email2)||$this->email2 =="") ||
					(!isset($this->pass) || $this->pass =="") ||
					(!isset($this->pass2) || $this->pass2 =="") ||
					(!isset($this->buid) || $this->buid =="") ||
					(substr($this->email,strlen($this->email)-7,7) != "@bu.edu")
					){
                    if ($this->name== '')
                    {
                        $_SESSION['frmerror'] = 1;
						return false;

                    }
                    else if (!isset($this->email)||$this->email=='')
                    {
                        $_SESSION['frmerror'] = 2;
						return false;
                    }
                    else if ($this->email2 != $this->email)
                    {
                        $_SESSION['frmerror'] = 4;
						return false;
                    }
                    else if (!isset($this->pass) || $this->pass =='')
                    {
                        $_SESSION['frmerror'] = 8;
						return false;
                    }
                    else if ($this->pass2 != $this->pass)
                    {
                        $_SESSION['frmerror'] = 16;
						return false;
                    }
                    else if (!isset($this->buid) || $this->buid =='')
                    {
                        $_SESSION['frmerror'] = 32;
						return false;
                    }
                    else if (substr($this->email,strlen($this->email)-7,7) != "@bu.edu")
                    {
                        $_SESSION['frmerror'] = 4;
						return false;
                    }
					else if ((strlen($this->buid !=9))){
					$_SESSION['frmerror'] = 32;
					return false;
					}
					else if(!(is_numeric(substr($this->buid,1,9))) || substr($this->buid, 0,1) != 'U') {
						$_SESSION['frmerror'] = 32;
						return false;
					}
					
					return false;
                    //Since an error was encountered display the registration form again.
					}//end of inner if
				else {
					$_SESSION['frmerror'] = 0;
					$context = "registered";
					return true;
				}
			} //end of first big if
		}//end of function. 
	function showForm() {
?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST"> 
	<body>
        <center>
            <div style="position: relative; <?php if (strstr($_SERVER['HTTP_USER_AGENT'],"Mozilla") != "") echo 'top:-15px;'; ?> width: 945px; height: 520px; background: url('images/Body.jpg');">

                <div style="position: relative; top: 50px; background: url('images/Register.jpg'); width: 701px; height: 413px;">

                    <div style="font-size:20; font-family:Arial; position:absolute; top:25px; left:30px; color:white;">
                    </div>

                    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">



                    <table border="0" style="position:absolute; top:59px; left:51px; font-family:Arial; font-size: 11px; height: 276px;">

						<!-- <tr>


                        </tr> -->

						<tr> <!-- [REGF.0002] -->

                            <td>Name: </td>

                            <td><input type="text" name="name" value="<?php echo (isset($_POST['name'])?$_POST['name']:""); ?>" size="40" />

                                <br>

                                <div class="regsubt">Please enter your first name.
                                    <?php if (isset($_SESSION['frmerror']) && ( $_SESSION['frmerror'] == 1 ) && isset($_POST['submit'])) echo '******'; ?>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>BU e-mail: </td>

                            <td><input type="text" name="email" value="<?php echo (isset($_POST['email'])?$_POST['email']:""); ?>" size="40" />

                                <br>

                                <div class="regsubt">Please enter your BU email address eg. john@bu.edu.

                                    <?php if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] == 2) && isset($_POST['submit'])) echo '******'; ?>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>Confirm e-mail: </td>

                            <td><input type="text" name="email2" value="<?php echo (isset($_POST['email2'])?$_POST['email2']:""); ?>" size="40" />

                                <br>

                                <div class="regsubt">Confirm your email address.

                                    <?php if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] == 4) && isset($_POST['submit'])) echo '******'; ?>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>Password: </td> <!-- [REGF.0001] -->

                            <td><input type="password" name="pass" value="<?php echo (isset($_POST['pass'])?$_POST['pass']:""); ?>"  size="40"/>

                                <br>

                                <div class="regsubt">Your password should have atleast 2 special characters.

                                    <?php if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] == 8) && isset($_POST['submit'])) echo '******'; ?>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>Confirm password: </td> <!-- [REGF.0001] -->

                            <td><input type="password" name="pass2" value="<?php echo (isset($_POST['pass2'])?$_POST['pass2']:""); ?>"  size="40"/>

                                <br>

                                <div class="regsubt">Re-type your password.

                                    <?php if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] == 16) && isset($_POST['submit'])) echo '******'; ?>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>BU ID number: </td>

                            <td><input type="text" name="buid" value="<?php echo (isset($_POST['buid'])?$_POST['buid']:""); ?>"  size="9"/>

                                <br>

                                <div class="regsubt">Please enter your 9 digit BUID.

                                    <?php if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] == 32) && isset($_POST['submit'])) echo '******'; ?>

                                </div>

                            </td>

                        </tr>

                        <tr> <td></td>

                            <td>

                                <br>

                                <div style="font-size:11px; color:red; top:2px">

                                    <?php

                                        if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] == -1) && isset($_POST['submit'])) echo '*The username is already in use.';

                                        else if (isset($_SESSION['frmerror']) && ($_SESSION['frmerror'] != 0) && isset($_POST['submit'])) echo '*Errors were encountered in these items.';

                                    ?>

                                </div>

                            </td>

                        </tr>

                    </table>

                    <div style="position:absolute; bottom:30px; right:35px;">

                        <input type="reset" value="Reset" name="reset" /> &nbsp;

                        <input type="submit" value="Submit" name="submit" onclick=""/>

						<?php  echo $_SESSION['frmerror'];?>
                    </div>

                    </form>

                </div>

            </div>

        </center>
		</body>
<?php }

		}