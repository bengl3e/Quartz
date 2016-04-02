<?php
	include 'activitydefinitions.php';
	
	class InstallationActivity
	{
	private $rootpass;
	private $serverurl;
	private $adminname;
	private $adminp;
	private $dbname;
	private $serverhost;
	private $rootpath;
	private $canmail;
	private $context;
	
	function __construct(){
		$this->getInput();
		$this->model = new Model();
	}
	
    function errorCheck()  {
    if (file_exists($this->rootpath)) {
    return 1;
    }
    else  {
     return 0;
    }         
}
    
	function process(){
    
    $isBlank = $this->checkBlanks();
    

	if ($this->context == "data saved"){
		
	 $res = $this->errorCheck();
	 if ($res == 1 ) {

	        $this->model->setUpDatabases($this->rootpass, $this->serverurl, $this->adminname, $this->adminp, $this->dbname,$this->serverhost, $this->rootpath, $this->canmail);
				
				?>
					<meta http-equiv="refresh" content="0; url=http://localhost:8888/KawaNoKami/Installation/welcomeq.php" />
					<?php
	   
	   }
	   else { 
	     ?> 
			 <script type="text/javascript">alert("File does not exist.");</script>; 
			 <meta http-equiv="refresh" content="0; url=http://localhost:8888/KawaNoKami/Installation/install.php" />
			<?php
			}
			
	   }
	
	  }
	

	   

	  
	  
	
	function show(){
	
		$this->showForm();
	}
	
	function getInput(){
		//get all the variables, to make life more readable
		if (isset($_POST['submit'])) {
				$this->rootpass = ($_POST['rootpass']);
				if($this->rootpass == 0)
					$this->rootpass = "";
				
			$this->serverurl = ($_POST['serverurl']);
			//$this->serverurl != "";
			$this->adminname = ($_POST['admin']);
		//	$this->adminname != "";
			$this->adminp = ($_POST['adminpass']);
		//	$this->adminp != "";
			$this->dbname = ($_POST['dbname']);
		//	$this->dbname != "";
			
			$this->serverhost = ($_POST['serverhost']);
		//	$this->serverhost!= "";
			// set $serverhost to "http://localhost:81/" if you had to use port 81 to resolve the Skype issue
			$this->rootpath = ($_POST['rootpath']);
			//($_POST['rootpath']);
			$this->rootpath .= "/";
			$this->canmail = 0;
			if(($_POST['canmail']) == "yes")
				$this->canmail = 1;
		$this->context = "data saved";
		}//end of if submit
	}
	
	function run(){
	$this->process();
	$this->show();
	}
	
	function checkBlanks() {
	if ($this->serverurl == "" || $this->rootpass == "" || $this->admin == ""
	    || $this->adminpass == ""|| $this->dbname == "" || $this->serverhost == "" 
	    || $this->rootpath == "" ) {
			return 0;
		}
		else if ($this->serverurl != "" || $this->rootpass != "" || $this->admin != ""
	    || $this->adminpass != ""|| $this->dbname != "" || $this->serverhost != "" 
	    || $this->rootpath != "" ){  
		return 1; 
		}
	}
	

function showForm() {
?>
<html>
	<head> <link rel="stylesheet" type="text/css" href="Style.css" ></head>
	
	<h1> Welcome to Quartz! </h1> 
	<p> Thank you for choosing the Quartz system to manage your professor and course information online. This page will instruct you on the Quartz installation process. The form below takes in all the information your system will need to provide a smooth installation of Quartz.<br>
	Here we will provide a brief explination of what each field is asking for so that your set up is as easy as possible:<br><br>
	
	MySQL Server Name: The servername that Quartz databases will be kept on. If you are running on WAMP/MAMP/LAMP this will be localhost.<br><br>
	MySQL Root User Password: The password to the server. If your server password is different from the default, enter your password. If your password is the default password enter 0. If you are unsure of the password, contact your server adminstrator.<br><br>
	Quartz Admin Name: The username of the Quartz admin. If you are the admin, please input your desired admin name. This should be the same as the name portion of your BU email. (EX: If your email is "john@bu.edu" the username should be "john") If you are a professor installing Quartz, please contact your administrator for this information.<br><br>
	Quartz Admin Password: The password of the Quartz admin. If you are the admin, please input your desired password. If you are a professor installing Quartz, please contact your administrator for this information.<br><br>
	Quartz Database Name: The main database name for Quartz. If you are the admin, choose a name. If you are a professor, contact your Quartz adminstrator for this information.<br><br>
	URL of your Webserver: This requires the URL of the webserver on which Quartz runs. In the case you are running on WAMP/MAMP/LAMP and you Apache server runs on a different port than the default, write the server URL with the name of the different port number. (EX: If your server URL is http://localhost/ and it must run on port 81, write http://localhost:81/). If you are unsure of this information, contact your Quartz administrator.<br><br> 
	Name of Quartz's subfolder: The subfolder where Quartz can be found.(EX: http://localhost/Quartz2012 or http://localhost:81/Quartz2012). If you are unsure of this information ask your Quartz administrator.<br><br>
	Does your server have the ability to send mail? field asks if your server has the capability to send an email directly. If you have LAMP/MAMP/WAMP select no. If you are unsure of this, ask your Quartz administrator. <br><br><br>

	Please do not leave any field blank, the form is not prepared to handle that situation and will give an error. In the case of that situation, or any such issue, simply come back to this page and fill out this form again. 
	
	If for some reason you must re-fill the form, you must fill out the entire form again, not just the part you wish to change.

	If you are an admin, you are able to use Quartz right after the installation. Simply use your BU email and the password you provided.
	If you are a professor, you still have to apply for a new account to use Quartz after the installation process. There will be more instructions after the form as been submitted correctly.
	</p>
	<br>


	<!--creating the form below that takes in user info-->

	<form method="post" action="<?=$_SERVER['PHP_SELF']?>" >
		MySQL Server Name: <input type= "text" name = "serverurl"><br>
		<br>
		MySQL Root User Password: <input type="text" name = "rootpass"><br>
		<br>
		Quartz Admin Name: <input type = "text" name = "admin"><br>
		<br>
		Quartz Admin Password: <input type = "text" name = "adminpass"><br>
		<br>
		Quartz Database Name: <input type="text" name = "dbname"><br>
		<br>
		URL Of your Webserver: <input type= "text" name = "serverhost"><br>
		<br>
		Name of Quartz's subfolder: <input type="text" name="rootpath"><br>
		<br>
		Does your server have the ability to send mail?: <br>
		<input type="radio" name="canmail" value="yes">	Yes<br>
		<input type="radio" name="canmail" value="no">	No<br>
		<p><input type="submit" value="Submit" name="submit" /></p>

		
	</form>
</html>
<?php }//end of showForm
}//end of class
?>