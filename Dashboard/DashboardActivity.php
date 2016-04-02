<?php
	include 'activitydefinitions.php';
	class DashboardActivity
    {
	private $num_emails;
	private $statusarr;
	private $model;
	private $people;
	private $person;
	private $message1;
	private $subject1;
	private $pointer=0;
	private $newEmail;
	private $ActStat;
	private $newvers;
	private $contact;
	private $item;
	private $mailnum;
	private $context;
	
		function __construct(){
		$this->model = new Model();
		$this->getInput();
		}
		function show(){
		echo "<html>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"MySite.css\">\n";
		$this->showHead();
		?>
		<br>
		<div id = "Admin" style ="font-family:Arial; font-weight:bold; font-size:18px; margin-left:0px;"> 
		User Administration Panel </div>
	    <br>
		<?php
		$this->showMain();
		
		if ($this->context== "showform2"){
		$this->showaddForm();
		}
		if ($this->context == "showform3"){
		$this->showeform3();
		}
		?>
		<br>
		<br>
		<br>
        <br>
		<?php
		$this->showFooter();
		echo "</html>"; 
		}

		private function showHead(){
		print("<head>");
		include 'header.php';
		print("</head>");
	}
	    private function showFooter() {
	    include 'footer.php';
	    }

		
		function showMain(){

echo "<table border=\"1\" style=\"width:300px; font-family:Arial; font-size:19px;\">\n"; 
echo "  <tr>\n"; 
echo "  <th>Email</th>\n"; 
echo "  <th>Create</th>\n"; 
echo "  <th>Activate</th>\n";
echo "  <th>Version </th>\n";
echo "  <th>Contact </th>\n";
echo "  </tr>\n"; 
for ($counter=0; $counter<$this->num_emails; ++$counter) {
echo "<td>" .$this->people[$counter] . "</td>"; 
 echo "<td> <form  action='' method='POST'>"; 
    echo "<input type='hidden' name='item' value='" . ($counter-1) . "' />";
   echo "<input class='z' type='submit' name='delete'  value='Delete'> </form>";
echo "</td>";

$res = $this->statusarr[$counter];
if ($res== true){

 echo "<td> <form name=\"statusstuff\" action='admindashboard.php' method='POST'>"; 
    echo "<input type='hidden' name='item' value='" . $counter . "' />";
   echo "<input type=\"submit\" value=\"Deactivate\" name=\"status\">\n";
echo "</td>";

}
 else{

 echo "<td> <form  action='admindashboard.php' method='POST'>"; 
    echo "<input type='hidden' name='item' value='" . $counter . "' />";
	echo "<input type=\"submit\" value=\"Activate\" name=\"status\">\n";
echo "</td>";
 }
$version = $this->model->getVersion($this->people[$counter]);
echo "<td>$version</td>\n"; 
 echo "<td>
 <form>
<a href='mailto:".$this->people[$counter]."' tsarget='_blank'>Contact</a>
</td>";

echo "</tr>\n"; 
}
echo "</table>\n";
echo "<form name=\"addStuff\" action=\"admindashboard.php\" method=\"POST\">\n"; 
echo "<input type=\"submit\" value=\"Add\" name=\"submit\" onclick=\"\"/>\n";
echo "<input type=\"submit\" value=\"Send Email to all\" name=\"submit5\" onclick=\"\"/>\n";
echo "</form>";
		}
		
	function showaddForm(){
echo "<form name=\"addpeople\" action=\"admindashboard.php\" method=\"POST\">\n"; 
echo "Email: <input type=\"email\" name=\"newEmail\"><br>\n"; 

echo "Activation Status: <input type='radio' name='newact' value='1'>Active
<input type='radio' name='newact' value='0'>Inactive<br>\n"; 

echo "Version <input type=\"text\" name=\"newvers\"><br>\n"; 
echo "Contact <input type=\"text\" name=\"contact\"><br>\n"; 
echo "<button type=\"submit\" name=\"submit2\" value=\"Submit\">Add People</button></td>\n"; 
echo "</form> \n";		
	}
	function showeform3(){
echo "<form name=\"emailform\" action=\"admindashboard.php\" method=\"POST\">\n"; 
	echo "Subject:<br>\n"; 
	echo "<input type=\"text\" name=\"subject\" value=\"Enter Your subject.\"><br>\n"; 
	echo "<form action=\"\">\n"; 
	echo "<textarea name=\"myTextBox\" cols=\"50\" rows=\"5\">\n"; 
	echo "Enter Your Email Content.\n"; 
	echo "</textarea>\n"; 
	echo "<br />\n";
	echo "<button type=\"submit\" name=\"submit4\" value=\"Submit\">Send Email(s)</button></td>\n"; 
	echo "</form> \n";	
		
	}
	function process(){
	$this->statusarr = $this->model->getActivationStatuses();
	$this->people = $this->model->getUsers();
	if ($this->context == "reversing"){
		$res = $this->model->reverse($this->people[$this->item]);
		if ($res == "succeeded") {
			if($this->statusarr[$this->item])
			{
			$this->statusarr[$this->item]= 0;
			}else{
			$this->statusarr[$this->item]=1;
			}
		} else{
		echo "failure in reversing";
		}
	}
	if ($this->context == "sendingemail"){
	for ($counter=0; $counter<$this->num_emails; ++$counter) {
	$to = $this->people[$counter];
	$subject = $this->subject1;
	$message = $this->message1;
	mail($to,$subject, $message);
	}
	
	}
	if ($this->context == "deleting"){
	  $pointy = $this->item+1;
	  $res = $this->model->deletemail($this->people[$pointy]);
	  if ($res == "succeeded"){
	  unset($this->people[$pointy]);
	  $this->people = array_values($this->people);
	  }
	  else {
	  echo "API ERROR";
	  }

	}
	if ($this->context == "adding people") {
		array_push($this->people,$this->newEmail);
		print_r($this->people);
		array_push($this->statusarr,$this->ActStat);
		print_r($this->statusarr);
		echo("Person Added");
		}
	$this->num_emails = count($this->people);
	}
	function getInput(){
		
		if (isset($_POST['delete'])){
		$this->item = ($_POST['item']);
		$this->context = "deleting";
		} else if (isset($_POST['status'])){
		$this->item = ($_POST['item']);
		$this->context = "reversing";
		}else if (isset($_POST['submit'])){
			$this->context ="showform2";
		} else 	if (isset($_POST['submit2'])){
			$this->newEmail = ($_POST['newEmail']);
			if (!isset($_POST['newact'])){
			$this->ActStat = 0;
			} else {
			$this->ActStat = ($_POST['newact']);
			}
			$this->newvers = ($_POST['newvers']);
			$this->contact = ($_POST['contact']);
			$this->context = "adding people";
		}else if (isset($_POST['submit4'])){
			$this->subject1 = ($_POST['subject']);
			$this->message1 = ($_POST['myTextBox']);
			$this->context = "sendingemail";
		}else if (isset($_POST['submit5'])){
		echo ($this->mailnum);
		
		$this->context = "showform3";
		}
		else{
		$this->context = "first form";
		}
	}
	
	
		function run(){
		$this->process();
		$this->show();
		}
	}
	?>
	
	