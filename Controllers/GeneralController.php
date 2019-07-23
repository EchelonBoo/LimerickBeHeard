<?php

class GeneralController extends Controller {

    
    private $postArray;     
    private $getArray;      
    private $viewData;          
    private $controllerObjects;         
    private $user; 
    private $db;
    private $pageTitle;

    

    function __construct($user,$db) { 
        parent::__construct($user->getLoggedinState());
        $this->user=$user;

        
        $this->postArray = array();
        $this->getArray = array();
        $this->viewData=array();
        $this->controllerObjects=array();
        $this->db=$db;
        $this->pageTitle='LimerickBeHeard';
    }



    public function run() {  
        $this->getUserInputs();
        $this->updateView();
    }



    public function getUserInputs() { 
   
        $this->getArray = filter_input_array(INPUT_GET) ; 

        
        $this->postArray = filter_input_array(INPUT_POST);  

    }



    public function updateView() { 
        if (isset($this->getArray['pageID'])) { 
            switch ($this->getArray['pageID']) {
                case "home":

                    $home = new Home($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$home,$navigation);

                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    $data['pageTitle'] =    $home->getPageTitle();
                    
                    $data['pageHeading'] =  $home->getPageHeading();
                    
                    $data['jumbotron'] =    $home -> getJumbotron();
                    
                    $data['panelHeadRHS'] = $home->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $home->getPanelHead_1();
                    $data['stringLHS'] =    $home->getPanelContent_1();     
                    $data['stringRHS'] =    $home->getPanelContent_2();     
                    
                    $data['footer'] = $home->getFooter();

                    $this->viewData = $data;  
                    
                    include_once 'views/view_jumbotron_2_panel.php';  
                    
                    break;
                
                case "adminRegister":
                    
                    $register = new Register($this->postArray,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->db,$this->user,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$register,$navigation);

                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    $data['pageTitle'] = $register->getPageTitle();
                    
                    $data['pageHeading'] = $register->getPageHeading();
                    
                    $data['panelHeadRHS'] = $register->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $register->getPanelHead_1(); 
                    $data['stringLHS'] = $register->getPanelContent_1();     
                    $data['stringRHS'] = $register->getPanelContent_2(); 
                    
                    $data['footer'] = $register->getFooter();
                    
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break;
                
                case "memberRegister":
                        
                        $register = new Register($this->postArray,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->db,$this->user,$this->getArray['pageID']);
                        $navigation = new Navigation($this->user, $this->getArray['pageID']);
                        array_push($this->controllerObjects,$register,$navigation);

                        
                        $data['menuNav'] = $navigation->getMenuNav();     
                        
                        $data['pageTitle'] = $register->getPageTitle();
                        
                        $data['pageHeading'] = $register->getPageHeading();
                        
                        $data['panelHeadRHS'] = $register->getPanelHead_2(); 
                        $data['panelHeadLHS'] = $register->getPanelHead_1(); 
                        $data['stringLHS'] = $register->getPanelContent_1();     
                        $data['stringRHS'] = $register->getPanelContent_2();  
                        
                        $data['footer'] = $register->getFooter();
                        
                        $this->viewData = $data;  
                        
                        include_once 'views/view_navbar_2_panel.php'; 
                        
                        break;
                    
                case 'info':
                        
                          $info = new info($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));
                          $navigation = new Navigation($this->user, $this->getArray['pageID']);
                          array_push($this->controllerObjects,$info,$navigation);


                          
                          $data['menuNav'] = $navigation->getMenuNav();       
                          
                          $data['pageTitle'] =    $info->getPageTitle();
                          
                          $data['pageHeading'] =  $info->getPageHeading();
                          
                          $data['carousel'] =    $info -> getCarousel();
                          
                          $data['panelHeadRHS'] = $info->getPanelHead_2(); 
                          $data['panelHeadLHS'] = $info->getPanelHead_1();
                          $data['stringLHS'] =    $info->getPanelContent_1();     
                          $data['stringRHS'] =    $info->getPanelContent_2();     
                          
                          $data['footer'] = $info->getFooter();

                          include_once 'views/view_carousel_2_panel.php';  
                          
                          break;
                      
                case 'login':

                    if(isset($this->postArray['btnLogin'])){  
                        $this->loggedin=$this->user->login($this->postArray['userID'], $this->postArray['password']);
                        if(!$this->loggedin){ 
                            $this->user->setLoginAttempts($this->user->getLoginAttempts()+1); 
                        }
                    }

                    $login = new Login($this->postArray,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->db,$this->user);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$login,$navigation);

                    
                    $data['menuNav'] = $navigation->getMenuNav();  
                    
                    $data['pageTitle'] = $login->getPageTitle();
                    
                    $data['pageHeading'] = $login->getPageHeading();
                    
                    $data['panelHeadRHS'] = $login->getPanelHead_2(); 
                    $data['stringRHS'] = $login->getPanelContent_2();   
                    
                    $data['panelHeadLHS'] = $login->getPanelHead_1(); 
                    $data['stringLHS'] = $login->getPanelContent_1();    
                    $data['footer'] = $login->getFooter();
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php'; 

                    break;
                    
                case 'contact':
                     
                    $contact = new Contact($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$contact,$navigation);


                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    $data['pageTitle'] =    $contact->getPageTitle();
                    
                    $data['pageHeading'] =  $contact->getPageHeading();
                    
                    $data['panelHeadRHS'] = $contact->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $contact->getPanelHead_1(); 
                    $data['stringLHS'] =    $contact->getPanelContent_1();     
                    $data['stringRHS'] =    $contact->getPanelContent_2();     
                    
                    $data['footer'] = $contact->getFooter();

                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break;
                
                case "logout": 
                        
                        $this->user->logout(FALSE);
                        $this->loggedin=FALSE;

                        
                        $home = new Home($this->user, $this->pageTitle, 'HOME');
                        $navigation = new Navigation($this->user, 'home');
                        array_push($this->controllerObjects,$home,$navigation);

                        
                        $data['menuNav'] = $navigation->getMenuNav();      
                        
                        $data['pageTitle'] = $home->getPageTitle();
                        
                        $data['pageHeading'] = $home->getPageHeading();
                        
                        $data['jumbotron'] =    $home -> getJumbotron();
                        
                        $data['panelHeadLHS'] = $home->getPanelHead_1(); 
                        $data['panelHeadRHS'] = $home->getPanelHead_2();
                        $data['stringLHS'] = $home->getPanelContent_1();     
                        $data['stringRHS'] = $home->getPanelContent_2();     
                      
                        $this->viewData = $data;  


                        
                        include_once 'views/view_jumbotron_2_panel.php'; 
                        
                        break;
                default:
                    //no page selected
                    $home = new Home($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));

                      $navigation = new Navigation($this->user, $this->getArray['pageID']);

                      array_push($this->controllerObjects,$home,$navigation);

                      $data['menuNav'] = $navigation->getMenuNav(); 
                     
                      $data['pageTitle'] =    $home->getPageTitle();
                      
                      $data['pageHeading'] =  $home->getPageHeading();
                   
                      $data['jumbotron'] =    $home -> getJumbotron();
                      
                      $data['panelHeadRHS'] = $home->getPanelHead_2(); 
                      $data['panelHeadLHS'] = $home->getPanelHead_1(); 
                      $data['stringLHS'] =    $home->getPanelContent_1();     
                      $data['stringRHS'] =    $home->getPanelContent_2();     
                      
                      $data['footer'] = $home->getFooter();



                    $this->viewData = $data;  
                    
                  include_once 'views/view_jumbotron_2_panel.php';
                  
                    break;
            }
        }
        else {
                    $home = new Home($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));

                    $navigation = new Navigation($this->user, $this->getArray['pageID']);

                    array_push($this->controllerObjects,$home,$navigation);


                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    $data['pageTitle'] =    $home->getPageTitle();
                    
                    $data['pageHeading'] =  $home->getPageHeading();
                    
                    $data['jumbotron'] =    $home -> getJumbotron();
                    
                    $data['panelHeadRHS'] = $home->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $home->getPanelHead_1();
                    $data['stringLHS'] =    $home->getPanelContent_1();     
                    $data['stringRHS'] =    $home->getPanelContent_2();   
                    
                    $data['footer'] = $home->getFooter();

                    $this->viewData = $data;  
                    
            include_once 'views/view_jumbotron_2_panel.php';
        }
    }






    public function debug() {   //Diagnostics/debug information - dump the application variables if DEBUG mode is on
            echo '<section>';
            echo '<!-- The Debug SECTION -->';
            echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV

            echo '<h2>General Controller Class - Debug information</h2><br>';

            echo '<div class="container">';  //INNER DIV
            //SECTION 1
            echo '<section style="background-color: #AAAAAA">';
            echo '<h3>General Controller (CLASS) properties</h3>';
            echo '<section style="background-color: #BBBBB">';
            echo '<h4>User Logged in Status:</h4>';
            echo '<section style="background-color: #FFFFFF">';
            if ($this->loggedin) {
                echo 'User Logged In state is TRUE ($loggedin) <br>';
            } else {
                echo 'User Logged In state is FALSE ($loggedin) <br>';
            }
            echo '</section>';

            echo '<h4>$postArray Values</h4>';
            echo '<pre>';
            var_dump($this->postArray);
            echo '</pre>';
            echo '<br>';

            echo '<h4>$getArray Values</h4>';
            echo '<pre>';
            var_dump($this->getArray);
            echo '</pre>';
            echo '<br>';

            echo '<h4>$data Array Values</h4>';
            echo '<pre>';
            var_dump($this->viewData);
            echo '</pre>';
            echo '<br>';
            echo '</section>';
            echo '</section>';


            //SECTION 2
            echo '<section style="background-color: #AAAAAA">';
            echo '<h3>SERVER - Super Global Arrays</h3>';

            echo '<section style="background-color: #AAAAAA">';
            echo '<h4>$_GET Arrays</h4>';
            echo '<section style="background-color: #FFFFFF">';
            echo '<table class="table table-bordered"><thead><tr><th>KEY</th><th>VALUE</th></tr></thead>';
            foreach ($_GET as $key => $value) {
                echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
            }
            echo '</table>';
            echo '</section>';

            echo '<h4>$_POST Array</h4>';
            echo '<section style="background-color: #FFFFFF">';
            echo '<table class="table table-bordered"><thead><tr><th>KEY</th><th>VALUE</th></tr></thead>';
            foreach ($_POST as $key => $value) {
                echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
            }
            echo '</table>';
            echo '</section>';
            echo '</section>';
            echo '</section>';

            echo '</div>';  //END INNER DIV
            echo '</div>';  //END outer DIV
            echo '</section>';

    }



}


