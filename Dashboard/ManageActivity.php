<?php
	include 'activitydefinitions.php';
	class MyManageActivity
    {
	private $web;
	private $model;
	public $context;
	private $dname;
	private $job;
	private $addr;
	private $tele;
	private $fax;
	private $email;
	private $bio;
	private $cname;
	private $url;
	private $desc;
	private $research;
	private $award;
	private $projects;
	private $students;
	private $personal;
	function __construct(){
		$this->getInput();
		$this->model = new Model();
	}
		function process(){
			if ($this->context == "editing"){
			$this->model->getOldData();
			} else{
			$this->context = "new";
			}
		}
		function show(){
		include 'header.php';
		$this->showNewForm();
		}
		function getInput(){
		if(isset($_POST["submit"])) {
		$this->web = $_POST["web"];
		$this->dname=$_POST["name"];
		$this->job=$_POST["job"];
		$this->addr=$_POST["addr"];
		$this->tele=$_POST["tele"];
		$this->fax=$_POST["fax"];
		$this->email=$_POST["email"];
		$this->bio=$_POST["bio"];
		$this->cname=$_POST["cname"];
		$this->url=$_POST["url"];
		$this->desc=$_POST["desc"];
		$this->research=$_POST["rese"];
		$this->award=$_POST["award"];
		$this->projects=$_POST["proj"];
		$this->students=$_POST["stu"];
		$this->personal=$_POST["pers"];
		$this->research=$_POST["resesub"];
		$this->context = "submitted";
		}
		}//end of getInput
		function run(){
		$this->process();
		$this->show();
		}
		function showNewForm(){
echo "\n"; 
echo "		?>\n"; 
echo "						<form id=\"web_settings\" method=\"POST\">\n"; 
echo "					<b> Web Settings:</b><br>\n"; 
echo "						<input type=\"radio\" name=\"setting\" value=\"online\">Online<br>\n"; 
echo "						<input type=\"radio\" name=\"setting\" value=\"offline\">Offline<br>\n"; 
echo "						<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "				</form>\n"; 
echo "				\n"; 
echo "				<br>\n"; 
echo "				<hr>\n"; 
echo "				<b>Picture:</b><br>\n"; 
echo "				<form action=\"upload_file.php\" method=\"post\" id=\"picture\" enctype=\"multipart/form-data\">\n"; 
echo "					<label for=\"file\">Picture:</label>\n"; 
echo "					<input type=\"file\" onchange=\"readURL(this);\" name=\"file\" id=\"file\"><br>\n"; 
echo "					<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "					<img id=\"prof_pic\" src=<?php\n"; 
echo "											($this->model->getPhotoDest());\n"; 
echo "											?>\n"; 
echo "										alt=\"your image\" width=\"150\" height=\"200\"/>\n"; 
echo "				</form>\n"; 
echo "				<br>\n"; 
echo "				<hr>\n"; 
echo "				<form id=\"GI\" method=\"POST\">\n"; 
echo "					<b> General Information:</b><br>\n"; 
echo "						Display Name:<input type=\"text\" name=\"name\" value=\"\"><br>\n"; 
echo "						Job Title:<input type=\"text\" name=\"job\" value=\"\"><br>\n"; 
echo "						Office Address:<input type=\"text\" name=\"addr\" value=\"\"><br>\n"; 
echo "						Telephone:<input type=\"text\" name=\"tele\" value=\"\"><br>\n"; 
echo "						Fax:<input type=\"text\" name=\"fax\" value=\"\"><br>\n"; 
echo "						Email:<input type=\"email\" name=\"email\" value=\"\"><br>\n"; 
echo "						Short Biography: <br><textarea rows=\"5\" cols=\"60\" id=\"bio\" name=\"bio\"></textarea>\n"; 
echo "						<br>\n"; 
echo "						<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "				</form>\n"; 
echo "				<br>\n"; 
echo "				<hr>\n"; 
echo "				<b>Teaching</b>\n"; 
echo "				<br>\n"; 
echo "				Add a course to the list \n"; 
echo "				<br>\n"; 
echo "				Name:<input type=\"text\" name=\"cname\" value=\"\"><br>\n"; 
echo "				URL:<input type=\"url\" name=\"url\" value=\"\"><br>\n"; 
echo "				Short description:<br><textarea rows=\"3\" cols=\"50\" id=\"desc\" name=\"desc\"></textarea> \n"; 
echo "				<br>\n"; 
echo "				<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "				<br>\n"; 
echo "				<hr>\n"; 
echo "				<b> Research </b>\n"; 
echo "				<br>Use HTML tags to format better. <br>\n"; 
echo "				Research Description <br>\n"; 
echo "				<textarea rows=\"3\" cols=\"50\" id=\"rese\" name=\"rese\"></textarea>\n"; 
echo "				<br>\n"; 
echo "				<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "								<hr>\n"; 
echo "				<b> Awards </b>\n"; 
echo "				<br>Use HTML tags to format better. <br>\n"; 
echo "				List of Awards<br>\n"; 
echo "				<textarea rows=\"3\" cols=\"50\" id=\"award\" name=\"award\"></textarea>\n"; 
echo "				<br>\n"; 
echo "				<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "								<hr>\n"; 
echo "				<b> Projects </b>\n"; 
echo "				<br>Use HTML tags to format better. <br>\n"; 
echo "				List of Projects <br>\n"; 
echo "				<textarea rows=\"3\" cols=\"50\" id=\"proj\" name=\"proj\"></textarea>\n"; 
echo "				<br>\n"; 
echo "				<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "								<hr>\n"; 
echo "				<b> Students </b>\n"; 
echo "				<br>Use HTML tags to format better. <br>\n"; 
echo "				List of Students <br>\n"; 
echo "				<textarea rows=\"3\" cols=\"50\" id=\"stu\" name=\"stu\"></textarea>\n"; 
echo "				<br>\n"; 
echo "				<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "								<hr>\n"; 
echo "				<b> Personal </b>\n"; 
echo "				<br>Use HTML tags to format better. <br>\n"; 
echo "				Short Personal Paragraph <br>\n"; 
echo "				<textarea rows=\"3\" cols=\"50\" id=\"pers\" name=\"pers\"></textarea>\n"; 
echo "				<br>\n"; 
echo "				<button type=\"submit\" name=\"submit\" value=\"Submit\">Save</button>\n"; 
echo "				<br>\n"; 
echo "				<hr>\n"; 
echo "				<button>Preview Web Page</button><br>\n"; 
echo "				<form><button type=\"submit\" name=\"submit\" value=\"Submit\">Save All</button> <br>\n"; 
echo "				\n"; 
echo "				<button></form>Upload All</button>\n"; 
echo "				\n";
		}
	
	}//end of activity
?>