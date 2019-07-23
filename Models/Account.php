<?php

class Account extends Model{

        private $db;
        private $user;
        private $pageID;
        private $pageTitle;
        private $pageHeading;
        private $postArray;  
        private $panelHead_1;
        private $panelContent_1;
        private $panelHead_2;
        private $panelContent_2;
        private $footer;
 
        
	function __construct($postArray,$pageTitle,$pageHead,$database, $user, $pageID)
	{   
            parent::__construct($user->getLoggedinState());
            
            $this->db=$database;
            $this->pageID=$pageID;
            $this->user=$user;     
            
           
            $this->setPageTitle($pageTitle);
            
           
            $this->setPageHeading($pageHead);

           
            $this->postArray=$postArray;
            
           
            $this->setPanelHead_2();
            $this->setPanelContent_2();
            
           
            $this->setPanelHead_1();
            $this->setPanelContent_1();
            
            $this->setFooter();

	}
      
        
        public function setPageTitle($pageTitle){     
                $this->pageTitle=$pageTitle;
        }       

        public function setPageHeading($pageHead){  
                $this->pageHeading=$pageHead;
        }  
        
        
        public function setPanelHead_1(){
           switch ($this->pageID) {         
                case 'accountEdit':
                      $this->panelHead_1='<h3>Edit My Account Details</h3>';   
                    break;
                case 'accountPasswordChange':
                    $this->panelHead_1='<h3>Change My Password</h3>';   
                    break;
                default:
                      $this->panelContent_1='Invalid Choice';
                    break;
                }  
        }
        
        public function setPanelContent_1(){
           $this->panelContent_1='';
           switch ($this->pageID) {  
               
                case 'accountEdit':
                    
                    $this->panelContent_1.=$this->user->editAccountForm();              
                    break;
                    
                case 'accountPasswordChange':
                    $this->panelContent_1 = file_get_contents('forms/form_user_password_change.html');  
                    break;
                
                default:
                      $this->panelContent_1 = 'Error';
                    break;
                }          
        }       

        
        public function setPanelHead_2(){      
            
            $this->panelHead_2='<h3>Result</h3>'; 
            
        }     
        
        public function setPanelContent_2(){
            if (isset($this->postArray['btn'])){               
                
                switch ($this->postArray['btn']){
                    case 'accountSave':
                        
                        if($this->user->getUserType()==='Admin'){ // admin is logged in 
                            
                            
                            $adminID=$this->db->real_escape_string($this->postArray['AdminID']);
                            $firstName=$this->db->real_escape_string($this->postArray['FirstName']);
                            $lastName=$this->db->real_escape_string($this->postArray['LastName']);
                            $email=$this->db->real_escape_string($this->postArray['Email']);  
                            $mobile=$this->db->real_escape_string($this->postArray['Mobile']);   

                            
                            $sql="UPDATE admin SET FirstName = '$firstName',LastName = '$lastName',email='$email',mobile='$mobile' WHERE AdminID = '$adminID';"; 
                        }
                        else{

                            
                            $memberID=$this->db->real_escape_string($this->postArray['MemberID']);
                            $firstName=$this->db->real_escape_string($this->postArray['FirstName']);
                            $lastName=$this->db->real_escape_string($this->postArray['LastName']);
                            $email=$this->db->real_escape_string($this->postArray['Email']);  
                            $mobile=$this->db->real_escape_string($this->postArray['Mobile']);   

                            //generate the SQL
                            $sql="UPDATE member SET FirstName = '$firstName',LastName = '$lastName',email = '$email',mobile = '$mobile' WHERE MemberID = '$memberID'";

                        }
                           
                        if($this->user->saveUpdate($sql)){
                            $this->panelContent_2='Updates saved successfully ';
                        }
                        else{
                            $this->panelContent_2='No updates have been saved - no changes were detected to record data.';
                        }
                        
                        break;
                    case 'savePasswordChange':
                        
                        $pass1=$this->db->real_escape_string($this->postArray['newPass1']);   
                        $pass2=$this->db->real_escape_string($this->postArray['newPass2']);
                        $oldPass=$this->db->real_escape_string($this->postArray['oldPass']);
                        
                        //fopllow the procedure to change the password
                        if($pass1===$pass2){ 
                            
                            if($this->user->verifyPassword($oldPass)){
                                
                                if($this->user->changePassword($pass1)){ 
                                $this->panelContent_2.='Password Changed Successfully - use the new password next time you log in. ';
                                }
                                else{
                                    $this->panelContent_2.='Password has not been changed. A database error has occurred - contact the administrator';
                                }
                            }
                            else { 
                                $this->panelContent_2.='Password NOT Changed - Your old password has not been verified - please try again';
                            }
                        }
                        else{ 
                            $this->panelContent_2.='Password NOT Changed - new passwords entered must match - please try again' ;
                        }
                        break;
                    default:
                        $this->panelContent_2.='Invalid Choice';
                        break;
                }    
            }
            else{  
                $this->panelContent_2='Please enter details of required changes in the form';
            }           
        } 
       
        public function setFooter(){
            if($this->loggedin){
            $this->footer='<div class="navbar navbar-default navbar-fixed-bottom">';
            $this->footer.='<div class="container">';
            $this->footer.='<p class="navbar-text pull-left">';
            $this->footer.='Please log out when your finished!</p>';
            $this->footer.='<a class="navbar-btn btn-success btn pull-right" href = "'.$_SERVER['PHP_SELF'].'?pageID=logout" >';
            $this->footer.='<span class="glyphicon glyphicon-chevron-right"></span>  Log Out </a>';
            $this->footer.='</div>';
            $this->footer.='</div>';
            }
            else{
                           $this->footer='<div class="navbar navbar-default navbar-fixed-bottom">';
            $this->footer.='<div class="container">';
            $this->footer.='<p class="navbar-text pull-left">';
            $this->footer.='Please Log In to access resources!</p>';
            $this->footer.='<a class="navbar-btn btn-success btn pull-right" href = "'.$_SERVER['PHP_SELF'].'?pageID=login" >';
            $this->footer.='<span class="glyphicon glyphicon-chevron-right"></span>  Log In </a>';
            $this->footer.='</div>';
            $this->footer.='</div>';
            }
        }

        //getter methods
        public function getPageTitle(){return $this->pageTitle;}
        public function getPageHeading(){return $this->pageHeading;}
        public function getMenuNav(){return $this->menuNav;}
        public function getPanelHead_1(){return $this->panelHead_1;}
        public function getPanelContent_1(){return $this->panelContent_1;}
        public function getPanelHead_2(){return $this->panelHead_2;}
        public function getPanelContent_2(){return $this->panelContent_2;}
        public function getUser(){return $this->user;}
        public function getFooter(){return $this->footer;}

        
}//end class
        