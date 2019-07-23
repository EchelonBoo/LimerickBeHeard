<?php
class Home extends Model{
	
        private $pageTitle;

        private $pageHeading;

        private $panelHead_1;
        private $panelContent_1;

        private $jumbotron;

        private $panelHead_2;
        private $panelContent_2;
        
        private $footer;

        private $user;

	//constructor
	function __construct($user,$pageTitle,$pageHead){
            parent::__construct($user->getLoggedInState());
            $this->user=$user;


          
            $this->setPageTitle($pageTitle);

            
            $this->setPageHeading($pageHead);

            $this -> setJumbotron();

            
            $this->setPanelHead_1();
            $this->setPanelContent_1();


            
            $this->setPanelHead_2();
            $this->setPanelContent_2();
            
            $this->setFooter();
	} 

        
        public function setPageTitle($pageTitle){ 
                $this->pageTitle=$pageTitle;
        }  

        public function setPageHeading($pageHead){ 
                $this->pageHeading=$pageHead;
        }  

   
        public function setJumbotron(){

                    if($this->loggedin){

                        if ($this->user->getUserType()==='Admin'){
                            $this->jumbotron.='<div class="jumbotron">';
                            $this->jumbotron.='<h1 class = "display-4"> Welcome! </h1>';
                            $this->jumbotron.='<p class = "lead">Welcome to the LimerickBeHeard home page.</p> ';
                            $this->jumbotron.='<hr class = "my-4">';
                            $this->jumbotron.='<p>You are logged in as an Admin</p>';
                            $this->jumbotron.='</div>';
                        }
                        else{ 
                            $this->jumbotron.='<div class="jumbotron">';
                            $this->jumbotron.='<h1 class = "display-4"> Welcome! </h1>';
                            $this->jumbotron.='<p class = "lead">Welcome to the LimerickBeHeard home page.</p> ';
                            $this->jumbotron.='<hr class = "my-4">';
                            $this->jumbotron.='<p>You are logged in as a member</p>';
                            $this->jumbotron.='</div>';
                        }
                    }
                    else{

                            $this->jumbotron.='<div class="jumbotron">';
                            $this->jumbotron.='<h1 class = "display-4"> Welcome! </h1>';
                            $this->jumbotron.='<p class = "lead">Welcome to the LimerickBeHeard home page.</p> ';
                            $this->jumbotron.='<hr class = "my-4">';
                            $this->jumbotron.='<p>New member?Click the button below to register!</p>';
                            $this->jumbotron.='<p class = "lead"><a href="'.$_SERVER['PHP_SELF'].'?pageID=memberRegister">Register</a></p>';
                            $this->jumbotron.='</div>';
                    }
            }

        //Panel 1
        public function setPanelHead_1(){
                $this->panelHead_1='<h3>LimerickBeHeard</h3>';
        }

        public function setPanelContent_1(){
          if($this->loggedin){

                if ($this -> user -> getUserType( )=== 'Admin'){
                    $this -> panelContent_1 ='<h4>Overview</h4>';
                    $this -> panelContent_1.='<p>You can use this system to chat to other admins and members and also view all of the members currently registered';
                    $this -> panelContent_1.='<p>You are currently logged in.';
                }
                else{
                    $this -> panelContent_1 ='<h4>Overview</h4>';
                    $this -> panelContent_1.='<p>You can use this system to chat to other members and your admins';
                }
            }

            else {
                $this -> panelContent_1 = '<h4>Who are we?</h4>';
                $this -> panelContent_1.='<p>LimerickBeHeard is a youth led organization that tries to promote political youth engagement as well as trying to promote our local area with locals and foreign exchange students';
                $this -> panelContent_1.='<p>You will need to log in to access resources.<br><br>';
            }
        }

        //Panel 2
        public function setPanelHead_2(){ 
              if($this->loggedin){
                  $this-> panelHead_2 ='<h3>Welcome</h3>';
              }
              else{
                  $this-> panelHead_2 ='<h3>What can you do?</h3>';
              }
          }

        public function setPanelContent_2(){
              if($this->loggedin){

                  if ($this ->user->getUserType()==='Admin'){
                      $this -> panelContent_2 ='Thank you '.$this->user->getUserFirstName() .' for logging in successfully as an Admin to the LimerickBeHeard System. You can navigate around this website by using the links above. <br><br>Don\'t forget to logout when you are done.';
                  }
                  else{
                      $this -> panelContent_2='Thank you '.$this->user->getUserFirstName() .' for logging in successfully as a Member to the LimerickBeHeard System. You can navigate around this website by using the links above. <br><br>Don\'t forget to logout when you are done.';
                  }
              }
              else{
                  $this -> panelContent_2='<p>To access the majority of this pages resources you will need to log in. Once logged in you can message other members and admins.</p><p>If you are a new member here please click the button above to register an new account.</p>';
                  $this->panelContent_2.='<p> If you have any questions or there is a problem with this website please see the Contact Us page.</p>';
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

        public function getPageTitle(){return $this-> pageTitle;}
        public function getPageHeading(){return $this-> pageHeading;}
        public function getMenuNav(){return $this-> menuNav;}
        public function getJumbotron(){return $this -> jumbotron;}
        public function getPanelHead_1(){return $this-> panelHead_1;}
        public function getPanelContent_1(){return $this-> panelContent_1;}
        public function getPanelHead_2(){return $this-> panelHead_2;}
        public function getPanelContent_2(){return $this-> panelContent_2;}
        public function getFooter(){return $this->footer;}




}
