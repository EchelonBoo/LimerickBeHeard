<?php
class Login extends Model{
	//class properties
        private $db;
        private $user;
        private $pageTitle;
        private $pageHeading;
        private $postArray;  
        private $panelHead_1;
        private $panelContent_1;
        private $panelHead_2;
        private $panelContent_2;
        private $footer;

        
	function __construct($postArray,$pageTitle,$pageHead,$database, $user)
	{   
            parent::__construct($user->getLoggedinState());
            
            $this->db=$database;

            $this->user=$user;     
            
            
            $this->setPageTitle($pageTitle);
            
            
            $this->setPageHeading($pageHead);

            
            $this->postArray=$postArray;
            
           
            $this->setPanelHead_1();
            $this->setPanelContent_1();


            
            $this->setPanelHead_2();
            $this->setPanelContent_2();
        
            $this->setFooter();
	}
      
        //setter methods
        public function setPageTitle($pageTitle){     
                $this->pageTitle=$pageTitle;
        }       

        public function setPageHeading($pageHead){  
                $this->pageHeading=$pageHead;
        }  
        
       
        public function setPanelHead_1(){
            if($this->loggedin){                
                $this->panelHead_1='<h3>Login Successful</h3>'; 
            }
            else{        
                $this->panelHead_1='<h3>Login Form</h3>'; 
            }       
        }
        
        public function setPanelContent_1(){
            if($this->loggedin){  
                    $this->panelContent_1='Welcome - your login has been successful';      
                }
                else{                                  
                    $this->panelContent_1 = file_get_contents('forms/form_login.html');   
                } 
        }    

        //Panel 2
        public function setPanelHead_2(){ 
            if($this->loggedin){
                $this->panelHead_2='<h3>Result</h3>';   
            }
            else{        
                $this->panelHead_2='<h3>Result</h3>'; 
            }
        }    
        
        public function setPanelContent_2(){
       
            if($this->loggedin){
                 $this->panelContent_2= "Welcome ".$this->user->getUserFirstName()." - Your Login has been successful! - You are logged in as a ". $this->user->getUserType();
            }
            else{
                
                $this->panelContent_2='Please enter your login details. Login attempts='.$this->user->getLoginAttempts();
            }
            
            
                 

        }  
        
        public function setFooter(){
            if($this->loggedin){
            $this->footer='<div class="navbar navbar-default navbar-fixed-bottom">';
            $this->footer.='<div class="container">';
            $this->footer.='<p class="navbar-text pull-left">';
            $this->footer.='Please Log In to access resources!</p>';
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


        public function getPageTitle(){return $this->pageTitle;}
        public function getPageHeading(){return $this->pageHeading;}
        public function getMenuNav(){return $this->menuNav;}
        public function getPanelHead_1(){return $this->panelHead_1;}
        public function getPanelContent_1(){return $this->panelContent_1;}
        public function getPanelHead_2(){return $this->panelHead_2;}
        public function getPanelContent_2(){return $this->panelContent_2;}
        public function getFooter(){return $this->footer;}
        public function getUser(){return $this->user;}

        
}
        