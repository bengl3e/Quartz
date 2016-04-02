<?php
	include 'model.php';

	class TestActivity
	{
		private $model;
		private $email = "syum@bu.edu";
		public $context;
		private $uname;
		private $dname = "Seungheon Yum";
		private $phone = "1588-5588";
		private $fax = "123-456-7890";
		private $hours = "12:00 ~ 5:00";
		private $job = "intern engineer";
		private $bio = "this is bio";
		private $research = "my research";
		private $awards = "my awards";
		private $office ="my office";
		private $projects = "my projects";
		private $students = "there are my studets :]";
		private $personal = "this is my personal life";
		private $teaching = "im taking cs 411 as my course!";
		private $address = "700 comm ave";
		private $url = "cs411.com";

		public function run()
		{
			$this->model = new Model();
			$this->testUpdateManage($this->email);
			$this->testGetNameByEmail($this->email);
		}

		private function testGetNameByEmail($email)
		{
			$string = $this->model->getNameByEmail($email);
			echo("\n"); echo("testing getNameByEmail"); echo("\n");
			echo ("email is: ".$email);
			echo('<br>');
			echo("should return: Seungheon Yum"); echo("\n");
			echo("returned value: ".$string); echo("\n");

		}

		private function testUpdateManage($email)
		{
			echo("\n"); echo("testing updateManage");echo("\n");
			$string = $this->model->updateManage($this->email, $this->dname, $this->phone, $this->fax, $this->hours, $this->job, $this->office, $this->bio, $this->research, $this->awards, $this->projects, $this->students, $this->personal, $this->teaching);		
			return $string;
		}



	}

	$activity = new TestActivity();
	$activity->run();

	
?>