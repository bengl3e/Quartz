<?php

    $usestub = true;
    
    if ($usestub) 
    {
    	include_once "modelstub.php";
    }
    else 
    {
    	include_once "model.php";
    }
    
	class Model
	{

		public function updateManage($email, $name, $phone, $fax, $hours, $jobtitle,
			                                  $office, $bio, $research, $awards, $projects, $students,
			                                  $personal, $teaching)
		{
		    return true;                                	                                  
		 } 
        
	}
?>