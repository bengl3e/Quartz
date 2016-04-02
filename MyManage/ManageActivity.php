<?php
	//include 'model.php';
	include 'modelstub.php';
	include 'dbvars.php';

	class MyManageActivity
    {
		private $model;
		private $email;
		public $context;
		private $uname;
		private $name;
		private $phone;
		private $fax;
		private $hours;
		private $jobtitle;
		private $office;
		private $bio;
		private $research;
		private $awards;
		private $projects;
		private $students;
		private $personal;
		private $teaching;
		private $address;
		private $url;
		
		function __construct()
		{
			$this->getInput();
		}
		
		function process()
		{
			$this->model = new Model();
	
			if(isset($_SESSION['email']))
				$this->uname = substr($_SESSION['email'],0,strlen($_SESSION['email'])-7);	

			if (isset($_POST['saveall']) && $_POST['saveall'])
			{
				$this->name = $_POST['displayName'];
				$this->phone = $_POST['tel'];
				$this->fax = $_POST['fax'];
				$this->hours = $_POST['ofhrs'];
				$this->jobtitle = $_POST['job'];
				$this->office  = $_POST['address'];
				$this->bio = substr($_POST['bio'],0,1480);
				
				if($_POST['name'] != "" || $_POST['link'] != "" || $_POST['desc'] != "")
					$this->teaching = $this->teaching.$_POST['name'].";".$_POST['link']."; - ".$_POST['desc'].";";
				if ( isset($_POST['research']) )
					$this->research = substr($_POST['research'],0,1480);
				if ( isset($_POST['awardsEnable']) )
				{
					file_put_contents($uname."/awards.html",$_POST['awards']);
					$this->awards = $_POST['awardsEnable']; 
				}

				if ( isset($_POST['projectsEnable']) )
				{
					file_put_contents($uname."/projects.html",$_POST['projects']);
					$this->projects = $_POST['projectsEnable']; // [MNG.0006]
				}

				if ( isset($_POST['studentsEnable']) )
				{
					file_put_contents($uname."/students.html",$_POST['students']);
					$this->students = $_POST['studentsEnable']; // [MNG.0006]
				}

				if ( isset($_POST['personalEnable']) )
				{
					file_put_contents($uname."/personal.html",$_POST['personal']);
					$this->personal = $_POST['personalEnable']; 
				}
				
			}

			if (isset($_POST['clearTeach']) && $_POST['clearTeach']) 
				$this->teaching="";
			

			$res = $this->model->updateManage($this->email, $this->name, $this->phone, $this->fax, $this->hours, $this->jobtitle,
			                                  $this->office, $this->bio, $this->research, $this->awards, $this->projects, $this->students,
			                                  $this->personal, $this->teaching);
		}
		
		function show()
		{
			print("<html>");
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"MyManageStyle.css\">\n";
		
			$this->showHead();
			$this->showBody();
			$this->showFooter();
			print("</html>");

		}

		function generateActiveId($newUsername)
		{
			$date= date("Y-m-d");
			$time= date("H:i:s");
			$string= $date.$time.$newUsername;
			return md5($string);
		}
		
		function getInput()
		{
			
		}
	
		function run($email)
		{
			$this->email = $email;
			$this->process();
			$this->show();
		}

		function showHead()
		   { 
		include 'header.php';
	}

		function showBody()
		{
			print("<body href='$this->url' onload='load()'>");
			?>
			<script>
			function load()
			{
				window.location.replace($this->url);
			}
			</script>
			<?php
			echo "<div id =\"formz\">\n"; 
			$this->showForm();
			echo "</div>\n";
			print("</body>");
		}
       
		private function showFooter()
		{
		include 'footer.php';
		}
		
		function showForm()
		{
		?>
		<br>
	    <br>
	    		<br>
	
	
			<span id="title" style="font-family: Arial; font-size: 18px;"><b style = "position:relative;">Website Management Panel</b></span>
			
		<br>
			<hr width='880px'>
			<span style="text-align:right;">Welcome, <?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>!</span>	


			<hr width='880px'>
			<h3 style = "font-family:Arial; font-size:15px;">Website Settings:</h3>
			<form action="" method="POST">
			Online : <input type="radio" name="isonline" value="1" <?php if(isset($_SESSION['isonline'])) {if ($info && $info['isonline']) echo 'checked';} ?>/>
			&nbsp;&nbsp;Offline:<input type="radio" name="isonline" value="0" <?php if(isset($_SESSION['isonline'])){if (!$info || !$info['isonline']) echo 'checked'; }?> />
			<br><br><input type="submit" value="Apply" name="websettings" />
			</form>
				
			<hr width='880px'>
			<h3 style = "font-family:Arial;">Picture:</h3>
			<table style="border-style:solid; border-width:1px">
			<tr>
			<td>
			<img src="<?php echo $this->uname; ?>/picture.jpg" width="60px" height="90px"/>
			</td>
			</tr>
			</table>


			<br>
			Your picture should be approximately 230x350 pixels.<br><br> <!-- [PHOTO.0003] -->
			<form enctype="multipart/form-data" action="" method="POST">
			<input type="hidden" name="MAX_FILE_SIZE" value="400000" />
			Choose a picture to upload:
			<input name="uploadedfile" type="file" size="64" /> <br /><br>
			<input type="submit" value="Upload Picture" name="upload"/>
			</form>

			<hr width='880px'>
			<h3 style = "font-family:Arial;">General Information:</h3>
			<br><br>
			
			<form action="" method="POST">
			Display Name : <input type="text" name="displayName" value="<?php echo $this->name; ?>" size="40" /><br><br>
			Job Title : <input type="text" name="job" value="<?php echo $this->jobtitle;  ?>" size="40" /><br><br>
			Office Address : <input type="text" name="address" value="<?php echo $this->office;?>" size="40" /><br><br>
			Tel : <input type="text" name="tel" value="<?php echo $this->phone; ?>" size="40" /><br><br>
			Fax : <input type="text" name="fax" value="<?php echo $this->fax; ?>" size="40"/><br><br>
			<input type="submit" value="Save" name="saveall" />

			<hr width='880px' /><br><br>
			Office hours : <input type="text" name="ofhrs" value="<?php echo $this->hours; ?>" size="40" />
			&nbsp;&nbsp;(Use this format [DAY TT:TT - TT:TT])
			<br><br>
			<input type="submit" value="Save" name="saveall" />

			<hr width='880px'>
			<h3 style = "font-family:Arial;">Short Biography:</h3>
			<br><br>
			<textarea onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')" name="bio" rows=7 wrap="physical" cols=100></textarea>
			<br>
			<input type="submit" value="Save" name="saveall" />	
			<br><br>

			You have <B><SPAN id=myCounter>1500</SPAN></B> characters remaining.
			<h3 style = "font-family:Arial;">Teaching:</h3>

			<?php

			$clist="";
			$clist = $this->teaching;

			while ($clist != "")
			{
				$title = substr($clist,0,strpos($clist,";"));
				$clist = substr($clist,strpos($clist,";")+1);
				$link = substr($clist,0,strpos($clist,";"));
				$clist = substr($clist,strpos($clist,";")+1);
				$desc = substr($clist,0,strpos($clist,";"));
				$clist = substr($clist,strpos($clist,";")+1);
				echo $title.$desc."<br><br>";
			}
			?>
			Course Name : <input type="text" name="name" value="" size="100" /><br><br>
			Course Website Link : <input type="text" name="link" value="" size="100" /><br><br>
			Short Description : <input type="text" name="desc" value="" size="100" /><br><br>
			<input type="submit" value="Add New" name="saveall" /> 
			&nbsp;&nbsp;<input type="submit" value="Delete All" name="clearTeach" /> 
			

			<hr width='880px'>
			<h3 style = "font-family:Arial;">Research:</h3>
			Research Summary : <br>
		    <br><br>
			<textarea onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter2')" name="research" rows=7 wrap="physical" cols=100></textarea>
			<br><br>
			You have <B><SPAN id=myCounter2>1500</SPAN></B> characters remaining.</font><br><br>
			<input type="submit" value="Save" name="saveall" />	
		
			<hr width='880px'>
			<h3 style = "font-family:Arial;">Awards:</h3>
			<br><br>
			<textarea name="awards" rows=7 wrap="physical" cols=100></textarea>
			<br><br>Enabled : <input type="checkbox" name="awardsEnable" value="1" <?php if ($this->awards == "1") echo "checked"; ?> /> <!-- [MNG.0006] -->
			<br><br>
			<input type="submit" value="Save" name="saveall" />

			<hr width='880px'>
			<h3 style = "font-family:Arial;">Projects:</h3>
			<br><br>
			<textarea name="projects" rows=7 wrap="physical" cols=100></textarea>
			<br><br>Enabled : <input type="checkbox" name="projectsEnable" value="1" <?php if ($this->projects == "1") echo "checked"; ?>  /> <!-- [MNG.0006] -->
			<br><br>
			<input type="submit" value="Save" name="saveall" />
							<hr>
			<hr width='880px'>
			<h3 style = "font-family:Arial;">Students:</h3>
			<br><br>
			<textarea name="students" rows=7 wrap="physical" cols=100></textarea>
			<br><br>Enabled : <input type="checkbox" name="studentsEnable" value="1"  <?php if ($this->students == "1") echo "checked"; ?> /> <!-- [MNG.0006] -->
			<br><br>
			<input type="submit" value="Save" name="saveall" />
			
			<hr width='880px'>
			<h3 style = "font-family:Arial;">Personal:</h3>
			<br><br>
			<textarea name="personal" rows=7 wrap="physical" cols=100></textarea>
			<br><br>Enabled : <input type="checkbox" name="personalEnable" value="1"  <?php if ($this->personal == "1") echo "checked"; ?> /> <!-- [MNG.0006] -->
			<br><br>
			<input type="submit" value="Save" name="saveall" />
			</form>
		
		<?php
		}
	}
?>