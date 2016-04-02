<?php
//include '../DATA_API/apimodeled.php';
include 'modelstub.php';
//include 'activitydefinitions.php';


class MySiteActivity
{
	private $data_model;
	private $submit_type;
	private $login_session;
	private $context;

	function __construct(){
		$this->getInput();
		//$this-> model = new Model();
	}

	private function showHead(){
		include 'header.php';
	}

	private function showBar(){
echo "	<div id = \"navbar\">\n"; 
echo "    <br>\n"; 
echo "	<div id = \"home\"> <a class = \"h\" href =\"MySite.php\"> Home </a></div>\n"; 
echo "	<br>\n"; 
echo "\n"; 
echo "	<div id = \"teaching\"> <a class = \"t\" href = \"?p=teaching\"> Teaching </a> </div>\n"; 
echo "	<br>\n"; 
echo "\n"; 
echo "	<div id = \"research\"> <a class = \"r\" href =\"?p=research\"> Research </a></div>\n"; 
echo "	<br>\n"; 
echo "\n"; 
echo "	<div id = \"awards\"> <a class = \"a\" href =\"?p=awards\"> Awards </a></div>\n"; 
echo "	<br>\n"; 
echo "\n"; 
echo "	<div id = \"personal\"><a class = \"p\" href =\"?p=personal\">  Personal </a></div>\n"; 
echo "   \n"; 
echo "	<div class=\"line-separator\"></div>\n"; 
echo "	\n"; 
$this->showFooter();
echo "	</div>\n";
//
	}
	
	private function showHome(){
echo "\n"; 
echo "    <div id = \"contact\"> <div id =\"subtitle\"> Contact Information: </div>\n"; 
echo "    <p>Boston, MA \n"; 
echo "      <br>\n"; 
echo "   Tel: (899) 234-4356\n"; 
echo "   <br>\n"; 
echo "   Fax: (713) 233-5667 \n"; 
echo "   <br>\n"; 
echo "   Email: MThompson@bu.edu </p>\n"; 
echo "     </div>\n"; 
echo "    \n"; 
echo "    <div id = \"office\"> <div id = \"subtitle\">Office Hours: </div>\n"; 
echo "    <p> MCS 124</p> \n"; 
echo "    </div>\n"; 
echo "\n"; 
echo "     <div id = \"bio\"> <div id = \"subtitle\"> Short Biography: </div>\n"; 
echo "     <br>\n"; 
echo "      I went to MIT...graduated from Harvard...blah blah blah... \n"; 
echo "     </div>\n"; 
echo "\n"; 
echo "      <div class =\"Heading\">\n"; 
echo "      <div id = \"Ho\"> Home </div>\n"; 
echo "    <div id = \"Name\"> Michael Thompson </div>\n";  
echo "  <div class =\"pic\"> <img src =\"profilepic.jpg\" /></div>\n";
	}
	
	private function showTeach() {
	
echo "	 <div id = \"award2\"> Course List: </div>\n"; 
echo "    <div id =\"subtitle\"> Math 123 </div>\n"; 
echo "    <p>Teaches Calculus, integrals...</p>\n"; 
echo "    \n"; 
echo "    <div id = \"office\"> <div id = \"subtitle\">Link to course site: </div>\n"; 
echo "   <br>\n"; 
echo "    <a href =\"math.com\"> www.bumath.com </a>\n"; 
echo "    \n";
	}
	
	private function showResearch() {
	
	echo "	\n"; 
echo "	 <div id = \"award2\"> Research: </div>\n"; 
echo " <div id = \"contact\">\n"; 
echo "    <p>I research that math is awesome!</p>\n";
echo "</div> \n";
	 
	}
	private function showAwards() {
		
echo " <div id = \"award2\"> Awards: </div>\n"; 
echo "	<div class =\"info2\">\n"; 
echo "    <p>Won Golden Math Awards in 1981.</p>\n"; 
echo "    </div>  \n";
	
	
	}
	private function showPersonal() {
			
echo "  <div id = \"award2\"> Personal:</div>\n"; 
echo "	<div class =\"info2\">\n"; 
echo "    <p>I am from Arizona and I have 2 kids.</p>\n"; 
echo "    </div>  \n";
	}
	
	private function showBody(){
		print("<body>");
		//$this->showBar();
		print('<div class ="info">');
				if(!isset($_GET["p"])){	
					$this->showHome();
				}
		else
		{
			if($this->submit_type == 'teaching')
			{	
				$this->showTeach();
			}
			else if ($this->submit_type == 'research')
			{
			$this->showResearch();
			}
			else if ($this->submit_type == 'awards')
			{
			$this->showAwards();
			}
			else
			{
				$this->showPersonal();
			}
		}
		print('</div>');
		//$this->showFooter();
		print("</body>");
	}
	
	 private function showFooter(){
	 include 'footer.php';
	}
	
	private function showForm(){
		print("<html>");
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"MySite.css\">\n";
		$this->showBar();
		$this->showHead();		
		$this->showBody();	
		//$this->showFooter();
		print("</html>");
	}
	
	private function getInput(){
		if(isset($_GET["p"])){
			$this->context = "Data was submitted";
			$this->submit_type = ($_GET["p"]);
		}
		else{
			$this->context = "No data was submitted";
		}
	}
		
	private function processData(){
		$data_model = new Model();
	}
	 
	
	public function run(){
		//$this->processData();
		$this->showForm();
	}
}	