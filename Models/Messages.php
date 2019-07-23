<?php
class Messages extends Model{
    
        private $pageTitle;
        private $pageHeading;
        private $panelHead_1;
        private $panelContent_1;
        private $panelHead_2;
        private $panelContent_2;
        private $user;
        private $footer;
    
    
	function __construct($user,$pageTitle,$pageHead){   
            parent::__construct($user->getLoggedInState());
            $this->user=$user;
    
            $this->setPageTitle($pageTitle);

            $this->setPageHeading($pageHead);

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
        
        
        public function setPanelHead_1(){
            $this->panelHead_1='<h3>How to use this system:</h3>';
        }
        
        public function setPanelContent_1(){
            $this->panelContent_1='<p>On this page you have access to a chat room. You can send messages between other logged in members. You can view the ten most recent messages</p>';
            
        }
        
        public function setPanelHead_2(){
            $this->panelHead_2='<h3>LimerickBeHeard Chat Room:</h3>';
        }
        
        public function setPanelContent_2(){
            if($this->loggedin){
                $this->panelContent_2='';
                if($this->user->getChatEnabledState()===TRUE){
                    $this->panelContent_2.= file_get_contents('forms/form_chat.html');  
                }
                else{
                    $this->panelContent_2.='Chat is not enabled!-'.$this->user->getChatEnabledState();
                    $this->panelContent_2.= file_get_contents('forms/form_chat_enable.html');  
                }
                
            }
            else{        
                $this->panelContent_2='';
                $this->panelContent_2.='<p>Please log in or register</p>'; 
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
        
        public function getPageTitle(){return $this->pageTitle;}
        public function getPageHeading(){return $this->pageHeading;}
        public function getMenuNav(){return $this->menuNav;}
        public function getPanelHead_1(){return $this->panelHead_1;}
        public function getPanelContent_1(){return $this->panelContent_1;}
        public function getPanelHead_2(){return $this->panelHead_2;}
        public function getPanelContent_2(){return $this->panelContent_2;}
        public function getFooter(){return $this->footer;}
  
}
