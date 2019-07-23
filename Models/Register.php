<?php
class Register extends Model{

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


	function __construct($postArray,$pageTitle,$pageHead,$database, $user,$pageID)
	 {
            parent::__construct($user->getLoggedinState());

            $this->db=$database;

            $this->user=$user;

            $this->pageID=$pageID;

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


            switch($this->pageID){

              case 'adminRegister':
                    $this->panelHead_1='<h3> Administrator Register Form </h3>';
                    break;

             case 'memberRegister':
                  $this->panelHead_1='<h3> Member Registration Form </h3>';
                  break;

             default:
                  $this->panelContent_1='Error - Invalid Option';
                  break;

            }


        }

        public function setPanelContent_1(){

            switch($this->pageID){

                case 'adminRegister':
                      $this->panelContent_1=file_get_contents('forms/form_register.html');
                      break;

                case 'memberRegister':
                      $this->panelContent_1=file_get_contents('forms/form_registerMember.html');
                      break;

                default:
                $this->panelContent_1='Error - Invalid Option';
                break;
            }



        }

     
        public function setPanelHead_2(){ 

            $this->panelHead_2='<h3>Registration Result</h3>';

        }

        public function setPanelContent_2(){


        switch($this->pageID){
          case 'adminRegister':
                  if (isset($this->postArray['btn1'])){

                      if ($this->postArray['adminPass1']===$this->postArray['adminPass2']){  
                    //process the registration data
                              $this->panelContent_2='Passwords Match<br>';
                              $this->panelContent_2.='You have entered the following details:<br><br>';
                              $this->panelContent_2.='User ID   : '.$this->postArray['adminID'].'<br>';
                              $this->panelContent_2.='Firstname : '.$this->postArray['adminFirstName'].'<br>';
                              $this->panelContent_2.='Lastname  : '.$this->postArray['adminLastName'].'<br>';
                              $this->panelContent_2.='Email     : '.$this->postArray['adminEmail'].'<br>';
                              $this->panelContent_2.='Mobile    : '.$this->postArray['adminMobile'].'<br>';


                              if ($this->user->register($this->postArray)){
                                $this->panelContent_2.='Your Registration has been successful - please log in<br>';
                        	     }
                               else{
                                 $this->panelContent_2.='Registration failed, please try again.<br>';
                               }

                             }
                       else{
                            $this->panelContent_2='Passwords DONT Match<br>';
                            $this->panelContent_2.='Password1 : '.$this->postArray['adminPass1'].'<br>';
                            $this->panelContent_2.='Password2 : '.$this->postArray['adminPass2'].'<br>';
                }
            }
          case 'memberRegister':
            	if (isset($this->postArray['btn2'])){

                if ($this->postArray['memberPass1']===$this->postArray['memberPass2']){  
          //process the registration data
                    $this->panelContent_2='Passwords Match<br>';
                    $this->panelContent_2.='User ID   : '.$this->postArray['memberID'].'<br>';
                    $this->panelContent_2.='Firstname : '.$this->postArray['memberFirstName'].'<br>';
                    $this->panelContent_2.='Lastname  : '.$this->postArray['memberLastName'].'<br>';
                    $this->panelContent_2.='Email     : '.$this->postArray['memberEmail'].'<br>';
                    $this->panelContent_2.='Mobile    : '.$this->postArray['memberMobile'].'<br>';
                    $this->panelContent_2.='Password1 : '.$this->postArray['memberPass1'].'<br>';
                    $this->panelContent_2.='Password2 : '.$this->postArray['memberPass2'].'<br>';

                    if ($this->user->MemberRegister($this->postArray)){
                      $this->panelContent_2.='REGISTRATION SUCCESSFUL - please log in<br>';
                     }
                     else{
                       $this->panelContent_2.='REGISTRATION NOT SUCCESSFUL<br>';
                     }

                   }
               else{
                  $this->panelContent_2='Passwords DONT Match<br>';
                  $this->panelContent_2.='User ID   : '.$this->postArray['memberID'].'<br>';
                  $this->panelContent_2.='Firstname : '.$this->postArray['memberFirstName'].'<br>';
                  $this->panelContent_2.='Lastname  : '.$this->postArray['memberLastName'].'<br>';
                  $this->panelContent_2.='Email     : '.$this->postArray['memberEmail'].'<br>';
                  $this->panelContent_2.='Mobile    : '.$this->postArray['memberMobile'].'<br>';
                  $this->panelContent_2.='Password1 : '.$this->postArray['memberPass1'].'<br>';
                  $this->panelContent_2.='Password2 : '.$this->postArray['memberPass2'].'<br>';
      }
        break;
  }

          }
        }

        public function setFooter(){
            
            $this->footer='<div class="navbar navbar-default navbar-fixed-bottom">';
            $this->footer.='<div class="container">';
            $this->footer.='<p class="navbar-text pull-left">';
            $this->footer.='Please Log In to access resources!</p>';
            $this->footer.='<a class="navbar-btn btn-success btn pull-right" href = "'.$_SERVER['PHP_SELF'].'?pageID=login" >';
            $this->footer.='<span class="glyphicon glyphicon-chevron-right"></span>  Log In </a>';
            $this->footer.='</div>';
            $this->footer.='</div>';
        }



        public function getPageTitle(){return $this->pageTitle;}
        public function getPageHeading(){return $this->pageHeading;}
        public function getMenuNav(){return $this->menuNav;}
        public function getPanelHead_1(){return $this->panelHead_1;}
        public function getPanelContent_1(){return $this->panelContent_1;}
        public function getPanelHead_2(){return $this->panelHead_2;}
        public function getPanelContent_2(){return $this->panelContent_2;}
        public function getPanelHead_3(){return $this->panelHead_3;}
        public function getPanelContent_3(){return $this->panelContent_3;}
        public function getUser(){return $this->user;}
        public function getFooter(){return $this->footer;}

}
