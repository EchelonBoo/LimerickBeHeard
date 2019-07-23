<?php

class info extends Model{
    

    private $pageTitle;
    
    private $pageHeading;
    
    private $carousel;
    
    private $panelHead_1;
    private $panelContent_1;
    
    private $panelHead_2;
    private $panelContent_2;
    
    private $user;
    
    private $footer;
    

    function __construct($user, $pageTitle, $pageHead){
        
        parent::__construct($user->getLoggedInState());
        
        $this ->user=$user;
        

        $this -> setPageTitle($pageTitle);
        
      
        $this -> setPageHeading($pageHead);
        

        $this -> setCarousel();

        $this->setPanelHead_1();
        $this->setPanelContent_1();


        $this->setPanelHead_2();
        $this->setPanelContent_2();
        
        $this->setFooter();
        
    }
    
    
    //setters
    public function setPageTitle($pageTitle){
        
        $this -> pageTitle = $pageTitle;
        
    }
    
    public function setPageHeading($pageHead){
        
        $this -> pageHeading = $pageHead;
        
    }
    
    
    public function setCarousel(){
        
            if($this->loggedin){
                    
                    $this->carousel.='<div id="myCarousel" class="carousel slide" data-ride="carousel">';
                    $this->carousel.='<ol class="carousel-indicators">';
                    $this->carousel.='<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                    $this->carousel.='<li data-target="#myCarousel" data-slide-to="1"></li>';
                    $this->carousel.='<li data-target="#myCarousel" data-slide-to="2"></li>';
                    $this->carousel.='</ol>';
                    
                    
                    $this->carousel.='<div class="carousel-inner">';
                    $this->carousel.='<div class="item active">';
                    $this->carousel.='<img src="images/group.jpg" alt="group">';
                    $this->carousel.='<div class="carousel-caption">';
                    $this->carousel.='<h3>Capetown Trip!</h3>';
                    $this->carousel.='<p>LBH group photo!</p>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    
                    
                    $this->carousel.='<div class="item">';
                    $this->carousel.='<img src="images/kids.jpg" alt="capetown">';
                    $this->carousel.='<div class="carousel-caption">';
                    $this->carousel.='<h3>Capetown Trip!</h3>';
                    $this->carousel.='<p>Visit to primary school!</p>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    
                    
                    $this->carousel.='<div class="item">';
                    $this->carousel.='<img src="images/school.jpg" alt="beach">';
                    $this->carousel.='<div class="carousel-caption">';
                    $this->carousel.='<h3>School Workshops!</h3>';
                    $this->carousel.='<p>Promoting political engagement in CBS Secondary school!</p>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    
                    
                    $this->carousel.='<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
                    $this->carousel.='<span class="glyphicon glyphicon-chevron-left"></span>';
                    $this->carousel.='<span class="sr-only">Previous</span>';
                    $this->carousel.='</a>';
                    
                    $this->carousel.='<a class="right carousel-control" href="#myCarousel" data-slide="next">';
                    $this->carousel.='<span class="glyphicon glyphicon-chevron-right"></span>';
                    $this->carousel.='<span class="sr-only">Next</span>';
                    $this->carousel.='</a>';
                    $this->carousel.='</div>';
            }
            else{

                    
                    $this->carousel.='<div id="myCarousel" class="carousel slide" data-ride="carousel">';
                    $this->carousel.='<ol class="carousel-indicators">';
                    $this->carousel.='<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                    $this->carousel.='<li data-target="#myCarousel" data-slide-to="1"></li>';
                    $this->carousel.='<li data-target="#myCarousel" data-slide-to="2"></li>';
                    $this->carousel.='</ol>';
                    
                    
                    $this->carousel.='<div class="carousel-inner">';
                    $this->carousel.='<div class="item active">';
                    $this->carousel.='<img src="images/group.jpg" alt="group">';
                    $this->carousel.='<div class="carousel-caption">';
                    $this->carousel.='<h3>Capetown Trip!</h3>';
                    $this->carousel.='<p>LBH group photo!</p>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    
                    
                    $this->carousel.='<div class="item">';
                    $this->carousel.='<img src="images/kids.jpg" alt="capetown">';
                    $this->carousel.='<div class="carousel-caption">';
                    $this->carousel.='<h3>Capetown Trip!</h3>';
                    $this->carousel.='<p>Visit to primary school!</p>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    
                    
                    $this->carousel.='<div class="item">';
                    $this->carousel.='<img src="images/school.jpg" alt="beach">';
                    $this->carousel.='<div class="carousel-caption">';
                    $this->carousel.='<h3>School Workshops!</h3>';
                    $this->carousel.='<p>Promoting political engagement in CBS Secondary school!</p>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    $this->carousel.='</div>';
                    
                    
                    $this->carousel.='<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
                    $this->carousel.='<span class="glyphicon glyphicon-chevron-left"></span>';
                    $this->carousel.='<span class="sr-only">Previous</span>';
                    $this->carousel.='</a>';
                    
                    $this->carousel.='<a class="right carousel-control" href="#myCarousel" data-slide="next">';
                    $this->carousel.='<span class="glyphicon glyphicon-chevron-right"></span>';
                    $this->carousel.='<span class="sr-only">Next</span>';
                    $this->carousel.='</a>';
                    $this->carousel.='</div>';
      
            }
    }
    
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
            else{
                $this -> panelContent_1 = '<h4>Who are we?</h4>';
                $this -> panelContent_1.='<p>LimerickBeHeard is a youth led organization that tries to promote political youth engagement as well as trying to promote our local area with locals and foreign exchange students'; 
                $this -> panelContent_1.='<p>You are currently logged in.'; 
            }
        }      

    
    public function setPanelHead_2(){ 
            if($this->loggedin){
                $this->panelHead_2='<h3>Welcome</h3>';
            }
            else{        
                $this->panelHead_2='<h3>Login required</h3>';
            }
        }      
        
    public function setPanelContent_2(){
            
            if($this->loggedin){
                
                if ($this->user->getUserType()==='Admin'){
                    $this->panelContent_2='Thank you '.$this->user->getUserFirstName() .' for logging in successfully as an Admin to the LimerickBeHeard System. You can navigate around this website by using the links above. <br><br>Don\'t forget to logout when you are done.';
                }
                else{
                    $this->panelContent_2='Thank you '.$this->user->getUserFirstName() .' for logging in successfully as a Member to the LimerickBeHeard System. You can navigate around this website by using the links above. <br><br>Don\'t forget to logout when you are done.';
                }   
            }
            else{        
                $this->panelContent_2='You are required to login - Please use the link above to login';
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
        
    //getters
    public function getPageTitle(){return $this -> pageTitle;}
    public function getPageHeading(){return $this -> pageHeading;}
    public function getMenuNav(){return $this -> menuNav;}
    public function getCarousel(){return $this -> carousel;}
    public function getPanelHead_1(){return $this -> panelHead_1;}
    public function getPanelContent_1(){return $this -> panelContent_1;}
    public function getPanelHead_2(){return $this -> panelHead_2;}
    public function getPanelContent_2(){return $this -> panelContent_2;}
    public function getFooter(){return $this->footer;}
}

