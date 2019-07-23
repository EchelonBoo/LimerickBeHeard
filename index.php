<?php


session_start(); 
include_once 'Config/config.php';
include_once 'Config/database.php';


include_once 'Classlib/Controller.php';
include_once 'Classlib/Model.php';

include_once 'Controllers/MainController.php';
include_once 'Controllers/AdminController.php';
include_once 'Controllers/MemberController.php';
include_once 'Controllers/GeneralController.php';


include_once 'Models/Home.php';
include_once 'Models/UnderConstruction.php';
include_once 'Models/Navigation.php';
include_once 'Models/Register.php';
include_once 'Models/Session.php';
include_once 'Models/User.php';
include_once 'Models/Login.php';
include_once 'Models/Info.php';
include_once 'Models/Contact.php';
include_once 'Models/Members.php';
include_once 'Models/Account.php';
include_once 'Models/Messages.php';
include_once 'Models/Chat.php';
include_once 'Models/Event.php';



@$db=new mysqli($DBServer,$DBUser,$DBPass,$DBName);
@$db->query("SET NAMES 'utf8'"); 
if($db->connect_errno){  
    $msg='Error making connection to MySQL Server using MySQLi- check your server is running and you have the correct host IP address.<br>MySQLi Error message: '.$conn->connect_error.'<br>';
    exit($msg);
}


$session=new Session();
$session->setChatEnabledState(TRUE);

$user=new User($session,$db);

if($user->getLoggedInState()){

    switch($user->getUserType()){
        case "Admin":
            $controller=new AdminController($user,$db);
        break;

        case "Member":  
            $controller=new MemberController($user,$db);
        break;

        default :  
            $controller=new GeneralController($user,$db);
        break;
    }

}
else{

    $controller=new GeneralController($user,$db);
}


$controller->run();



//Debug information
if(DEBUG_MODE){ //two METHODS of getting debug info from the MainController CLass are illustrated here:
    //Comment out whichever method you dont want to use.

    $controller->debug();

    echo '<pre><h5>SESSION Class</h5>';
    var_dump($session);
    echo '</pre>';

    echo '<pre><h5>USER Class</h5>';
    var_dump($user);
    echo '</pre>';

    echo '<pre><h5>$_COOKIE Array</h5>';
    var_dump($_COOKIE);
    echo '</pre>';

    echo '<pre><h5>$_SESSION Array</h5>';
    var_dump($_SESSION);
    echo '</pre>';

};

echo '</body></html>'; //end of HTML Document

//close the DB Connection
$db->close();
