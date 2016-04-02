<?php

    $usestub = true;

    if ( $usestub )
    {
        include_once "modelstub.php";
    }
    else
    {
        include_once "model.php";
    }
		class Model{
		public $result;
		public $addpresult;
		public $datacheck;
		public $emailcheck;
		
	public function	getActivationStatuses(){ //1=activated account. 0 = deactivated account
	$array = array(0,1,1,0);
	return $array;
	}
	public function getVersion(){
	return 2;
	}
	public function deletemail($email){
	return "succeeded";
	}
	public function reverse($email) {
	return "succeeded";
	}
	public function getUsers(){
	$array = array ("abcd@bu.edu", "pieman@aol.com", "diezombies52@pie.com", "cynthiac256@gmail.com");
	return $array;
	}
	
		/*function storeRegistrationData()
		{
		return "somerandomlongassstringthatIdontknowwhatitdoes";
		}
		function queueEmailForAdmin($email,$subject,$body){
		return true;
		}
		function activateAccount($regid){
		return 1;
		}
		*/
		}
?>
