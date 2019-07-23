<?php


class AdminController extends Controller {

    private $postArray;    
    private $getArray;      
    private $viewData;          
    private $controllerObjects;
    private $user; 
    private $db;
    private $pageTitle;

    //methods

    function __construct($user,$db) { 
        parent::__construct($user->getLoggedinState());

        $this->postArray = array();
        $this->getArray = array();
        $this->viewData=array();
        $this->controllerObjects=array();
        $this->user=$user;
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
                    
                    include_once 'views/view_jumbotron_2_panel.php';  //load the view
                    
                    break;
                
                case "messages":
                        
                        $messages= new Messages ($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));

                        $navigation = new Navigation($this->user, $this->getArray['pageID']);
                        array_push($this->controllerObjects,$messages,$navigation);
                      
                        $data['menuNav'] = $navigation->getMenuNav();       
                        
                        $data['pageTitle'] = $messages->getPageTitle();
                        
                        $data['pageHeading'] = $messages->getPageHeading();
                        
                        $data['panelHeadLHS'] = $messages->getPanelHead_1();
                        $data['panelHeadRHS'] = $messages->getPanelHead_2();
                        
                        $data['stringLHS'] = $messages->getPanelContent_1();     
                        $data['stringRHS'] = $messages->getPanelContent_2(); 
                        
                        $data['footer'] = $messages->getFooter();
                        
                        $chat = new Chat($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db);
                        array_push($this->controllerObjects,$chat);
                        if (isset($this->postArray['btnChat'])){$chat->submitChatMsg();}
                       
                        $this->viewData = $data; 
                        
                        include_once 'views/view_navbar_2_panel_chat.php'; //load the view
                        break;
                        
                case "chat":

                    $chat = new Chat($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db);
                    array_push($this->controllerObjects,$chat);
                    echo $chat->getChatMessages();     
                    break;
                
                case "members":
                    
                    $members = new members($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);                     
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$members,$navigation);

                      
                    $data['menuNav'] = $navigation->getMenuNav();      
                      
                    $data['pageTitle'] = $members->getPageTitle();
                      
                    $data['pageHeading'] = $members->getPageHeading();
                      
                    $data['panelHeadLHS'] = $members->getPanelHead_1();
                    $data['panelHeadRHS'] = $members->getPanelHead_2();
                      
                    $data['stringLHS'] = $members->getPanelContent_1();     
                    $data['stringRHS'] = $members->getPanelContent_2();
                      
                    $data['footer'] = $members->getFooter();
                      
                    $this->viewData = $data;  
                      
                    include_once 'views/view_navbar_2_panel.php'; 
                      
                    break;
                
                case 'membersView':
                    
                    $members = new Members($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$members,$navigation);


                    
                    $data['menuNav'] = $navigation->getMenuNav(); 
                    
                    $data['pageTitle'] = $members->getPageTitle();
                    
                    $data['pageHeading'] = $members->getPageHeading();
                    
                    $data['panelHeadRHS'] = $members->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $members->getPanelHead_1(); 
                    
                    $data['panelHeadMID'] = $members->getPanelHead_2();
                    $data['stringLHS'] = $members->getPanelContent_1();     
                    $data['stringMID'] = $members->getPanelContent_2();     
                    $data['stringRHS'] = $members->getPanelContent_2();    
                    
                    $data['footer'] = $members->getFooter();
                    
                    $this->viewData = $data; 
                    
                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break; 
                
                case 'memberDelete':
                    
                    $members = new Members($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$members,$navigation);


                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    $data['pageTitle'] = $members->getPageTitle();
                    
                    $data['pageHeading'] = $members->getPageHeading();
                    
                    $data['panelHeadRHS'] = $members->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $members->getPanelHead_1(); 
                    
                    $data['panelHeadMID'] = $members->getPanelHead_2();
                    $data['stringLHS'] = $members->getPanelContent_1();     
                    $data['stringMID'] = $members->getPanelContent_2();     
                    $data['stringRHS'] = $members->getPanelContent_2();     
                    
                    $data['footer'] = $members->getFooter();
                    
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break; 
                    
                case "event":
                      
                      $event = new UnderConstruction($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));
                      $navigation = new Navigation($this->user, $this->getArray['pageID']);
                      array_push($this->controllerObjects,$event,$navigation);

                      
                      $data['menuNav'] = $navigation->getMenuNav();       
                      
                      $data['pageTitle'] = $event->getPageTitle();
                      
                      $data['pageHeading'] = $event->getPageHeading();
                      
                      $data['panelHeadRHS'] = $event->getPanelHead_3();
                      $data['panelHeadLHS'] = $event->getPanelHead_1();
                      $data['panelHeadMID'] = $event->getPanelHead_2();
                      $data['stringLHS'] = $event->getPanelContent_1();     
                      $data['stringMID'] = $event->getPanelContent_2();    
                      $data['stringRHS'] = $event->getPanelContent_3();     
                      
                      $data['footer'] = $event->getFooter();
                      
                      $this->viewData = $data;  
                      
                      include_once 'views/view_navbar_3_panel.php';
                      
                      break;
                  
                case "eventEdit":
                    
                    $event = new Event($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$event,$navigation);
                    
                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    
                    $data['pageTitle'] = $event->getPageTitle();
                    
                    $data['pageHeading'] = $event->getPageHeading();
                    
                    $data['panelHeadRHS'] = $event->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $event->getPanelHead_1(); 
                    
                    $data['panelHeadMID'] = $event->getPanelHead_2();
                    $data['stringRHS'] = $event->getPanelContent_2();     
                    $data['stringMID'] = $event->getPanelContent_2();     
                    $data['stringLHS'] = $event->getPanelContent_1();     
                    
                    $data['footer'] = $event->getFooter();
                    
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break;   
                  
                case "eventAdd":
                    
                    $event = new Event($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$event,$navigation);
                    
                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    
                    $data['pageTitle'] = $event->getPageTitle();
                    
                    $data['pageHeading'] = $event->getPageHeading();
                    
                    $data['panelHeadRHS'] = $event->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $event->getPanelHead_1(); 
                    
                    $data['panelHeadMID'] = $event->getPanelHead_2();
                    $data['stringRHS'] = $event->getPanelContent_2();     
                    $data['stringMID'] = $event->getPanelContent_2();    
                    $data['stringLHS'] = $event->getPanelContent_1();     
                    
                    $data['footer'] = $event->getFooter();
                    
                    $this->viewData = $data;  
                    //update the view
                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break; 
                
                case "eventViewEdit":
                    
                    $event = new Event($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$event,$navigation);
                    
                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    
                    $data['pageTitle'] = $event->getPageTitle();
                    
                    $data['pageHeading'] = $event->getPageHeading();
                    
                    $data['panelHeadRHS'] = $event->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $event->getPanelHead_1();
                    
                    $data['panelHeadMID'] = $event->getPanelHead_2();
                    $data['stringRHS'] = $event->getPanelContent_2();    
                    $data['stringMID'] = $event->getPanelContent_2();     
                    $data['stringLHS'] = $event->getPanelContent_1();    
                    
                    $data['footer'] = $event->getFooter();
                    
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php';
                    
                    break;
                
                case "eventDelete":
                    
                    $event = new Event($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$event,$navigation);
                    
                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    
                    $data['pageTitle'] = $event->getPageTitle();
                    
                    $data['pageHeading'] = $event->getPageHeading();
                    
                    $data['panelHeadRHS'] = $event->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $event->getPanelHead_1(); 
                    $data['panelHeadMID'] = $event->getPanelHead_2();
                    $data['stringRHS'] = $event->getPanelContent_2();    
                    $data['stringMID'] = $event->getPanelContent_2();     
                    $data['stringLHS'] = $event->getPanelContent_1();     
                    
                    $data['footer'] = $event->getFooter();
                    
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php';
                    
                    break;
                                
                case "eventView":
                    
                    $event = new Event($this->user,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$event,$navigation);
                    
                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    
                    $data['pageTitle'] = $event->getPageTitle();
                    
                    $data['pageHeading'] = $event->getPageHeading();
                    
                    $data['panelHeadRHS'] = $event->getPanelHead_2();
                    $data['panelHeadLHS'] = $event->getPanelHead_1(); 
                    
                    $data['panelHeadMID'] = $event->getPanelHead_2();
                    $data['stringRHS'] = $event->getPanelContent_2();     
                    $data['stringMID'] = $event->getPanelContent_2();     
                    $data['stringLHS'] = $event->getPanelContent_1();     
                    
                    $data['footer'] = $event->getFooter();
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php';
                    
                    break;
                
                case "accountEdit":
                    
                    $account = new Account($this->postArray,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->db,$this->user,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$account,$navigation);

                    
                    $data['menuNav'] = $navigation->getMenuNav();
                    
                    $data['pageTitle'] = $account->getPageTitle();
                    
                    $data['pageHeading'] = $account->getPageHeading();
                    
                    $data['panelHeadRHS'] = $account->getPanelHead_2();
                    $data['panelHeadLHS'] = $account->getPanelHead_1(); 
                    $data['stringLHS'] = $account->getPanelContent_1();     
                    $data['stringRHS'] = $account->getPanelContent_2();     
                    
                    $data['footer'] = $account->getFooter();
                    $this->viewData = $data;  
                    
                    include_once 'views/view_navbar_2_panel.php'; 
                    
                    break; 
                
                case "accountPasswordChange":
                    
                    $account = new Account($this->postArray,$this->pageTitle, strtoupper($this->getArray['pageID']),$this->db,$this->user,$this->getArray['pageID']);
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$account,$navigation);

                    
                    $data['menuNav'] = $navigation->getMenuNav();       
                    
                    $data['pageTitle'] = $account->getPageTitle();
                    
                    $data['pageHeading'] = $account->getPageHeading();
                    
                    $data['panelHeadRHS'] = $account->getPanelHead_2(); 
                    $data['panelHeadLHS'] = $account->getPanelHead_1(); 
                    $data['stringLHS'] = $account->getPanelContent_1();     
                    $data['stringRHS'] = $account->getPanelContent_2();     
                    
                    $data['footer'] = $account->getFooter();
                    
                    $this->viewData = $data;  
                    
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
                    
                    $data['footer'] = $home->getFooter();
                    
                    $this->viewData = $data;  

                    
                    include_once 'views/view_jumbotron_2_panel.php'; 

                    break;
                
                default:
                    
                    $home = new Home($this->user, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->user, $this->getArray['pageID']);
                    array_push($this->controllerObjects,$home,$navigation);

                    
                    $data['menuNav'] = $navigation->getMenuNav();     
                    
                    $data['pageTitle'] = $home->getPageTitle();
                    
                    $data['pageHeading'] = $home->getPageHeading();

                    $data['jumbotron'] = $home-> getJumbotron();

                    $data['panelHeadLHS'] = $home->getPanelHead_1();
                    $data['panelHeadRHS'] = $home->getPanelHead_2();


                    $data['stringLHS'] = $home->getPanelContent_1();     
                    $data['stringRHS'] = $home->getPanelContent_2();     
                    
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
          
          $data['pageTitle'] = $home->getPageTitle();
          
          $data['pageHeading'] = $home->getPageHeading();

          $data['jumbotron'] = $home-> getJumbotron();

          $data['panelHeadLHS'] = $home->getPanelHead_1(); 
          $data['panelHeadRHS'] = $home->getPanelHead_2();


          $data['stringLHS'] = $home->getPanelContent_1();     
          $data['stringRHS'] = $home->getPanelContent_2();     
          
          $data['footer'] = $home->getFooter();

          $this->viewData = $data;  
          include_once 'views/view_jumbotron_2_panel.php'; 


        }
    }
    public function debug() {   //Diagnostics/debug information - dump the application variables if DEBUG mode is on
            echo '<section>';
            echo '<!-- The Debug SECTION -->';
            echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV

            echo '<h2>Admin Controller Class - Debug information</h2><br>';

            echo '<div class="container">';  //INNER DIV
            //SECTION 1
            echo '<section style="background-color: #AAAAAA">';
            echo '<h3>Event Description Controller (CLASS) properties</h3>';
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
