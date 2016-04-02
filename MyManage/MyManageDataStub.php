<?php

class MyManageDataStub{

	public function	getPhotoDest(){
		return("upload/koala.jpg");
	}
	
	public function savePicDest($dest){
		return ($dest);
	}
	
	public function saveGenSettings($dname,$jtitle,$address,$telephone,$email,$fax,$office_hours,$bio){
		return($dname." ".$jtitle." ".$address." ".$telephone." ".$email." ".$fax." ".$office_hours." ".$bio);
	}
	
	public function saveResearch($research){
		return($research);
	}
	
	public function saveAwards($awards){
		return($awards);
	}
	
	public function saveWebSettings($setting){
		return($setting);
	}
	
	public function saveStudents($student){
		return($student);
	}
	
	public function savePersonal($personal){
		return($personal);
	}
	
	public function saveProjects($projects){
		return($projects);
	}
	
	public function AddCourse($c_name, $c_description, $c_link){
		return($c_name.$c_description.$c_link);
	}
}