<?php
class Navigation extends Model{

        private $pageID;   
        private $menuNav;  
        private $user;

	//constructor
	function __construct($user,$pageID) {
            parent::__construct($user->getLoggedInState());
            $this->user=$user;
            $this->pageID=$pageID;
            $this->setmenuNav();

	}  

       
        public function setmenuNav(){


          $this->menuNav='';


          $dropdownMenuRegister='<li class="dropdown">';
          $dropdownMenuRegister.='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Register<span class="caret"></span></a>';
          $dropdownMenuRegister.='<ul class="dropdown-menu">';
          $dropdownMenuRegister.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=adminRegister">Admin Register</a></li>';
          $dropdownMenuRegister.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=memberRegister">Member Register</a></li>';
          $dropdownMenuRegister.='</ul></li>';
          
          
             //dropdown menu items for My Account
            $dropdownMenuAccount='<li class="dropdown">';
            $dropdownMenuAccount.='<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account<span class="caret"></span></a>';
            $dropdownMenuAccount.='<ul class="dropdown-menu">';
            $dropdownMenuAccount.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=accountEdit">Edit My Details</a></li>';
            $dropdownMenuAccount.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=accountPasswordChange">Change My Password</a></li>';
            $dropdownMenuAccount.='</ul></li>'; 
            
            //dropdown menu items for Event page
            $dropdownMenuEvent='<li class="dropdown">';
            $dropdownMenuEvent.='<a class="dropdown-toggle" data-toggle="dropdown" href="#">Event<span class="caret"></span></a>';
            $dropdownMenuEvent.='<ul class="dropdown-menu">';
            
            $dropdownMenuEvent.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventAdd">Add an Event</a></li>';
            $dropdownMenuEvent.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventViewEdit">View/Edit Event</a></li>';
            $dropdownMenuEvent.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventDelete">Delete an Event</a></li>';
            $dropdownMenuEvent.='</ul></li>'; 
          
          
          

            if($this->loggedin){  
                if ($this->user->getUserType()==='Admin'){
                  switch($this ->pageID){

                      case "home":

                            //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Remove Members</a></li>';
                            $this->menuNav.="$dropdownMenuEvent";
                            $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                            break;

                     case "messages":

                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                            //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Remove Members</a></li>';
                            $this->menuNav.="$dropdownMenuEvent";;
                            $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                            break;

                    case "event":
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Remove Members</a></li>';
                            //$this->menuNav.="$dropdownMenuEvent";;
                            $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                            break;

                    case "members":

                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                            //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Remove  Members</a></li>';
                            $this->menuNav.="$dropdownMenuEvent";;
                            $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                            break;

                   case "account":

                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Remove Members</a></li>';
                            $this->menuNav.="$dropdownMenuEvent";;
                            //$this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                            break;

                   default:

                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Remove  Members</a></li>';
                            $this->menuNav.="$dropdownMenuEvent";;
                            $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                            $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                            break;
                    }
                }
                else{ 

                    switch( $this ->pageID){

                        case "home":

                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                          //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventView">Events</a></li>';
                          $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                          break;

                        case "messages":

                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                          //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventView">Events</a></li>';
                          $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                          break;

                        case "eventView":

                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                          //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventView">Events</a></li>';
                          $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                          break;                      
                      
                        case "account":

                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventView">Events</a></li>';
                          //$this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                          break;

                        default:

                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">Chat</a></li>';
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=eventView">Events</a></li>';
                          $this->menuNav.="$dropdownMenuAccount";  //the My Account drop down menu
                          $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=logout">Log Out</a></li>';

                        break;
                    }
                }  
            }

            else{ 

                  switch ($this->pageID) {
                    case "home":
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=info">Information</a></li>';
                        $this->menuNav.="$dropdownMenuRegister";
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=contact">Contact Us</a></li>';
                        break;

                    case "info":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=info">Information</a></li>';
                        $this->menuNav.="$dropdownMenuRegister";
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=contact">Contact Us</a></li>';
                        break;

                    case "register":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=info">Information</a></li>';
                        //$this->menuNav.="$dropdownMenuRegister";
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=contact">Contact Us</a></li>';
                        break;

                    case "login":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=info">Information</a></li>';
                        $this->menuNav.="$dropdownMenuRegister";
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=contact">Contact Us</a></li>';
                        break;

                    case "contact":
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=info">Information</a></li>';
                        $this->menuNav.="$dropdownMenuRegister";
                        $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a></li>';
                        //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=contact">Contact Us</a></li>';
                        break;
                    default:
                       $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a></li>';
                       $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=info">Information</a></li>';
                       $this->menuNav.="$dropdownMenuRegister";
                       $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a></li>';
                       $this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=contact">Contact Us</a></li>';
                       break;

            } 

        }
    }

        public function getMenuNav(){return $this->menuNav;}    
}
