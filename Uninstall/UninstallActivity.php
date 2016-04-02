<?php
	include 'modelStub.php';
	
	class UninstallActivity
	{
	private $rootpass;
	private $serverurl;
	private $adminuser;
	private $adminpass;
	private $dbname;
	private $serverhost;
	private $rootpath;
	private $mail;
	private $context;
	private $delete;
	private $model;
	
	function __construct(){
		$this->getInput();
	}
	function getInput(){
		//get all the variables, to make life more readable
		if (isset($_POST['Yes'])){
		$this->context = "scrap data";
		}
		
	}
	function show(){
	$this->showForm();
	}
	function showForm() {
	?>
	<html>
		<head> <link rel="stylesheet" type="text/css" href="Style.css" ></head>
		
		<h1> Uninstalling Quartz</h1> 
		<p>Are you sure you want to uninstall Quartz? If you do, all your data will be erased.</p>
		<!--creating the form below that takes in user info-->

		<form method="post" action="<?=$_SERVER['PHP_SELF']?>" >
			<p><input type="submit" value="Yes" name="Yes" /></p>
		
		</form>
	</html>
	<?php }
	function process(){

	if ($this->context == "scrap data"){
	$this->model = new Model();

	$this->delete = $this->model->deleteDatabases();
				echo "";
				if($this->delete == 1) {
				?>
					<meta http-equiv="refresh" content="0; url=http://localhost:8888/KawaNoKami/Uninstall/Bye.php" />
				
				<?php
				}
	}
	
	}
	function run(){
	$this->process();
	$this->show();
	}


}
?>