<?php

class Contact extends Model{

    private $pageTitle;

    private $pageHeading;

    private $panelHead_1;
    private $panelContent_1;

    private $panelHead_2;
    private $panelContent_2;
    
    private $footer;

    private $user;


    function __construct($user, $pageTitle, $pageHead){

        parent::__construct($user->getLoggedInState());

        $this ->user=$user;


        $this -> setPageTitle($pageTitle);


        $this -> setPageHeading($pageHead);




        $this->setPanelHead_1();
        $this->setPanelContent_1();


        $this->setPanelHead_2();
        $this->setPanelContent_2();
        
        $this-> setFooter();

    }


    //setters
    public function setPageTitle($pageTitle){

        $this->pageTitle = $pageTitle;

    }

    public function setPageHeading($pageHead){

        $this->pageHeading = $pageHead;

    }



    public function setPanelHead_1(){
                $this->panelHead_1='<h3>Contact us!</h3>';
        }

    public function setPanelContent_1(){

                $this->panelContent_1 = '<h4><b>How to get in touch:</b></h4>';

                $this->panelContent_1.='<p>You can book us for the following:</p>';

                $this->panelContent_1.='<ul style="list-style-type:disc;">
                                                <li>Youth Politics Presentations</li>
                                                <li>Limerick Treasure Hunt/ Tour</li>
                                                <li>Public Speaking Workshops</li></ul>';


                $this->panelContent_1.='<h5><br><b>Email Us:</b></h5>';
                $this->panelContent_1.='<p>If you would like to contact the LimerickBeHeard group you can email us <a href = "mailto: limerickbeheard@gmail.com">here.</a></p>';

                $this->panelContent_1.='<h5><br><b>Our Address:</b></h5>';
                $this->panelContent_1.='<p>Limerick Youth Service <br> 5 Lower Glentworth Street <br>Limerick, Rep. of Ireland </p>';

                $this->panelContent_1.='<h5><br><b>Our Phone Number:</b></h5>';
                $this->panelContent_1.='<p>Telephone: +353 (0)61 412 444<br><br><br><br><br><br><br></p>';

        }


    public function setPanelHead_2(){ 

                $this->panelHead_2='<h3>View from Cape Point!</h3>';

        }

    public function setPanelContent_2(){
            

                $this->panelContent_2='<img src="images/capetown.jpg" alt="capetown">';
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
    public function getPanelHead_1(){return $this -> panelHead_1;}
    public function getPanelContent_1(){return $this -> panelContent_1;}
    public function getPanelHead_2(){return $this -> panelHead_2;}
    public function getPanelContent_2(){return $this -> panelContent_2;}
    public function getFooter(){return $this->footer;}
}
