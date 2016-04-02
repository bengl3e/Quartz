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
          
        public function queueEmailForAdmin($to, $subject, $message, $headers){ 
        return ("Admin was emailed."); 
        } 
        public function changePass($pass){ 
        return "pass changed"; 
        } 
        public function addPerson($newUsername, $newPassword, $newEmail, $newBU){ 
        $this->result = ("Registration successful."); 
        return "Registration successful."; 
        } 
        public function checkEmail($email){ //checks if the email is in the database 
        $this->emailcheck = true; 
        return true; 
        } 
        public function getActiveId(){ 
        return "thislongassstringIdontknowwhatitsdoing"; 
        } 
        public function sendMail($id,$email){ 
        return "Email has been sent"; 
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