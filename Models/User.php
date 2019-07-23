<?php

class User extends Model {

    private $session;
    private $db;
    private $userID;
    private $userFirstName;
    private $userLastName;
    private $userType;
    private $postArray;
    private $chatEnabled; 

    //constructor
    function __construct($session,$database)
      {
        parent::__construct($session->getLoggedinState());
        $this->db=$database;
        $this->session=$session;
        //get properties from the session object
        $this->userID=$session->getUserID();
        $this->userFirstName=$session->getUserFirstName();
        $this->userLastName=$session->getUserLastName();
        $this->userType=$session->getUserType();
        $this->postArray=array();
        $this->chatEnabled=$session->getChatEnabledState();
      }
    //end METHOD - Constructor

    public function login($userID, $password) {
       
        $password = hash('ripemd160', $password);
        $SQL1="SELECT FirstName,LastName FROM admin WHERE AdminID='$userID' AND Password='$password'";
        $SQL2="SELECT FirstName,LastName FROM member WHERE MemberID='$userID' AND Password='$password'";
        $rs1=$this->db->query($SQL1); 
        $rs2=$this->db->query($SQL2); 

        if(($rs1->num_rows===1)OR($rs2->num_rows===1)){

            if(($rs1->num_rows===1)AND($rs2->num_rows===0)){ 
                $row=$rs1->fetch_assoc(); 
                $this->session->setUserID($userID);
                $this->session->setUserFirstName($row['FirstName']);
                $this->session->setUserLastName($row['LastName']);
                $this->session->setUserType('Admin');
                $this->session->setLoggedinState(TRUE);

                $this->userID=$userID;
                $this->userFirstName=$row['FirstName'];
                $this->userLastName=$row['LastName'];
                $this->userType='Admin';


                $this->loggedin=TRUE;
                return TRUE;
            }
            elseif (($rs2->num_rows===1)AND($rs1->num_rows===0)){ 
                $row=$rs2->fetch_assoc(); 
                $this->session->setUserID($userID);
                $this->session->setUserFirstName($row['FirstName']);
                $this->session->setUserLastName($row['LastName']);
                $this->session->setUserType('Member');
                $this->session->setLoggedinState(TRUE);

                $this->userID=$userID;
                $this->userFirstName=$row['FirstName'];
                $this->userLastName=$row['LastName'];
                $this->userType='Member';

                $this->loggedin=TRUE;
                return TRUE;
            }
            else {  
                $this->session->setLoggedinState(FALSE);
                $this->loggedin=FALSE;
                return FALSE;
            }
        }
        else{ //invalid login credentials entered
            $this->session->setLoggedinState(FALSE);
            $this->loggedin=FALSE;
            return FALSE;
        }

        //close the resultsets
        $rs1->close();
        $rs2->close();
    }
    //end METHOD - User login

    public function logout(){
        //
        $this->session->logout();
    }
    //end METHOD - User login

    public function register($postArray){
        
        $AdminID=$this->db->real_escape_string($postArray['adminID']);
        $firstName=$this->db->real_escape_string($postArray['adminFirstName']);
        $lastName=$this->db->real_escape_string($postArray['adminLastName']);
        $email=$this->db->real_escape_string($postArray['adminEmail']);
        $mobile=$this->db->real_escape_string($postArray['adminMobile']);
        $password=$this->db->real_escape_string($postArray['adminPass1']);
        //encrypt the password
        $password = hash('ripemd160', $password);
        
        $sql="INSERT INTO admin (adminID,FirstName,LastName,Email,Mobile,PassWord) VALUES ('$AdminID','$firstName','$lastName','$email','$mobile','$password')";
        //execute the insert querys
        $rs=$this->db->query($sql);
        
        if ($rs){return TRUE;}else{return FALSE;}
    }
    //end METHOD - Register User
    public function MemberRegister($postArray){
        
        $MemberID=$this->db->real_escape_string($postArray['memberID']);
        $firstName=$this->db->real_escape_string($postArray['memberFirstName']);
        $lastName=$this->db->real_escape_string($postArray['memberLastName']);
        $email=$this->db->real_escape_string($postArray['memberEmail']);
        $mobile=$this->db->real_escape_string($postArray['memberMobile']);
        $password=$this->db->real_escape_string($postArray['memberPass1']);
        
        $password = hash('ripemd160', $password);
        
        $sql="INSERT INTO member (memberID,FirstName,LastName,Email,Mobile,PassWord) VALUES ('$MemberID','$firstName','$lastName','$email','$mobile','$password')";
        //execute the insert querys
        $rs=$this->db->query($sql);
        
        if ($rs){return TRUE;}else{return FALSE;}
    }

    public function editAccountForm(){

        $returnString='';
        if($this->getUserType()==='Admin'){
        $sql="SELECT AdminID,FirstName,LastName,Email,Mobile FROM admin WHERE AdminID='".$this->getUserID()."'";

        if((@$rs=$this->db->query($sql))&&($rs->num_rows===1)){  
                $row=$rs->fetch_assoc();
                
                $returnString.='<form method="post" action="index.php?pageID=accountEdit">';
                $returnString.='<div class="form-group">';
                $returnString.='<label for="AdminID">Admin ID</label><input required readonly type="text" class="form-control" value="'.$row['AdminID'].'" id="AdminID" name="AdminID"  title="This field cannot be edited">';
                $returnString.='<label for="FirstName">FirstName</label><input required type="text" class="form-control" value="'.$row['FirstName'].'" id="FirstName" name="FirstName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="FirstName (up to 45 Characters)">';
                $returnString.='<label for="LastName">LastName</label><input required type="text" class="form-control" value="'.$row['LastName'].'" id="LastName" name="LastName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="LastName (up to 45 Characters)">';
                $returnString.='<label for="Email">Email</label><input required type="text" class="form-control" value="'.$row['Email'].'" id="Email" name="Email" pattern="[a-zA-Z0-9óáé@_\.\- ]{1,45}" title="email (up to 45 Characters)">';
                $returnString.='<label for="Mobile">Mobile</label><input required type="text" class="form-control" value="'.$row['Mobile'].'" id="Mobile" name="Mobile" pattern="[0-9()- ]{1,45}" title="mobile (up to 45 Characters)">';

                $returnString.='</div>';
                $returnString.='<button type="submit" class="btn btn-success" name="btn" value="accountSave">Save Changes</button>';
                $returnString.='</form>'; 
        }
            else{
                $returnString.='Invalid selection '.$sql;
            }
            
        }
        else{ //student is logged in
            $sql="SELECT MemberID,FirstName,LastName,Email,Mobile FROM member WHERE MemberID='".$this->getUserID()."'" ;
            if((@$rs=$this->db->query($sql))&&($rs->num_rows===1)){  
                $row=$rs->fetch_assoc();

                
                $returnString.='<form method="post" action="index.php?pageID=accountEdit">';
                $returnString.='<div class="form-group">';
                $returnString.='<label for="MemberID">Member ID</label><input required readonly type="text" class="form-control" value="'.$row['MemberID'].'" id="MemberID" name="MemberID"  title="This field cannot be edited">';
                $returnString.='<label for="FirstName">FirstName</label><input required type="text" class="form-control" value="'.$row['FirstName'].'" id="FirstName" name="FirstName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="FirstName (up to 45 Characters)">';
                $returnString.='<label for="LastName">LastName</label><input required type="text" class="form-control" value="'.$row['LastName'].'" id="LastName" name="LastName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="LastName (up to 45 Characters)">';
                //$returnString.='<label for="County">County</label><input required type="text" class="form-control" value="'.$row['County'].'" id="County" name="County" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="County (up to 45 Characters)">';
                $returnString.='<label for="Email">Email</label><input required type="text" class="form-control" value="'.$row['Email'].'" id="Email" name="Email" pattern="[a-zA-Z0-9óáé@_\.\- ]{1,45}" title="email (up to 45 Characters)">';
                $returnString.='<label for="Mobile">Mobile</label><input required type="text" class="form-control" value="'.$row['Mobile'].'" id="Mobile" name="Mobile" pattern="[0-9()- ]{1,45}" title="mobile (up to 45 Characters)">';
                $returnString.='</div>';
                $returnString.='<button type="submit" class="btn btn-default" name="btn" value="accountSave">Save Changes</button>';
                $returnString.='</form>'; 
            }
            else{
                $returnString.='Invalid selection ';
            }
        }
        return $returnString;
    }    
    public function saveUpdate($sql){

        if((@$rs=$this->db->query($sql)===TRUE)&&($this->db->affected_rows===1)){ 
            return TRUE;
        }
        else{
            return FALSE;
        }        
    }
    public function verifyPassword($password){
        
        $password = hash('ripemd160', $password);
        
        
        if($this->getUserType()==='Admin'){ 
            $sql ="SELECT * FROM admin WHERE AdminID='$this->userID' AND PassWord='$password'";
        }
        else{ //student is logged in
            $sql="SELECT  * FROM member WHERE MemberID='$this->userID' AND PassWord='$password'";
        }
        
        
        if( (@$rs=$this->db->query($sql))&&($rs->num_rows===1)){ 
            return TRUE;  
        }
        else{
            return FALSE;
        }  
        
    }
    public function changePassword($password){

        $password = hash('ripemd160', $password);

        if($this->getUserType()==='Admin'){ 
            $sql="UPDATE admin SET password = '$password'  WHERE AdminID = '$this->userID'"; 
        }
        else{ 
            $sql="UPDATE member SET password = '$password'  WHERE MemberID = '$this->userID'"; 
        }
        
        if((@$rs=$this->db->query($sql)===TRUE)&&($this->db->affected_rows===1)){ 
            return $sql;
        }
        else{
            return $sql;
        }  
        
    }    

    public function setLoginAttempts($num){$this->session->setLoginAttempts($num);}
    public function setChatEnabledState($state){$this->session->setChatEnabledState($state);}

    public function getLoggedInState(){return $this->session->getLoggedinState();}//end METHOD - getLoggedInState
    public function getUserID(){return $this->userID;}
    public function getUserFirstName(){return $this->userFirstName;}
    public function getUserLastName(){return $this->userLastName;}
    public function getUserType(){return $this->userType;}
    public function getLoginAttempts(){return $this->session->getLoginAttempts();}
    public function getChatEnabledState(){return $this->chatEnabled;}  
}
