<?php

class Event extends Model{
	
        private $db;               
        private $user;
        private $pageID;
        private $pageTitle;        
        private $pageHeading;      
        private $postArray;        
        private $panelHead_1;      
        private $panelHead_2;      

        private $panelContent_1;   
        private $panelContent_2;   
        
        private $footer;

        
	//constructor
	function __construct($user,$postArray,$pageTitle,$pageHead,$database,$pageID) {   
            parent::__construct($user->getLoggedinState());
            $this->user=$user;

            $this->pageID=$pageID;
            

            $this->db=$database;
            

            $this->setPageTitle($pageTitle);
            

            $this->setPageHeading($pageHead);


            $this->postArray=$postArray;

            $this->setPanelHead_2();
            $this->setPanelContent_2();
        

            $this->setPanelHead_1();
            $this->setPanelContent_1();
            
            $this->setFooter();

            
	} 
      
        //setter methods
        public function setPageTitle($pageTitle){    
                $this->pageTitle=$pageTitle;
        }        

        public function setPageHeading($pageHead){ 
                $this->pageHeading=$pageHead;
        } 
        
        //Panel 1
        public function setPanelHead_1(){

            switch ($this->pageID) {         
                case 'eventViewEdit':
                      $this->panelHead_1='<h3>View Upcoming Events</h3>';   
                    break;
                case 'eventView':
                      $this->panelHead_1='<h3>View Events</h3>';   
                    break;
                case 'eventAdd':
                    $this->panelHead_1='<h3>Add a New Event Below</h3>';   
                    break;
                case 'eventEdit':
                      $this->panelHead_1='<h3>Edit Upcoming Events</h3>';   
                    break;
                case 'eventDelete':
                      $this->panelHead_1='<h3>Delete an Event Below</h3>';   
                    break;
                default:
                      $this->panelContent_1='Invalid Choice';
                    break;
                }
            
        }
        
        public function setPanelContent_1(){
            
            switch ($this->pageID) {            
                case 'eventViewEdit':
                      $this->panelContent_1=file_get_contents('forms/form_event_select.html');
                    break;
                case 'eventView':
                      $this->panelContent_1='All of the upcoming events are displayed on the right-hand side of the screen.';
                      $this->panelContent_1.='For more information or tickets please email us<a href = "mailto: limerickbeheard@gmail.com"> here.</a>';
                    break;
                case 'eventAdd':
                    $this->panelContent_1=file_get_contents('forms/form_event_add.html');
                    break;
                case 'eventEdit':
                    switch ($this->postArray['btn']){
                    case 'eventSave':
                        
                        $eventID=$this->db->real_escape_string($this->postArray['EventID']);
                        break;
                    default :
                        
                        $eventID=$this->db->real_escape_string($this->postArray['selectedEventID']);
                        break;
                    }
                    $sql="SELECT EventID,EventName,EventDate,EventDescription FROM event WHERE EventID='".$eventID."'"; 
                    //display the edit form
                    $this->panelContent_1=$this->dbEditForm($sql);
                    break;
                case 'eventDelete':
                      $this->panelContent_1=file_get_contents('forms/form_event_delete.html');
                    break;
                default:
                      $this->panelContent_1='Invalid Choice';
                    break;
                }

        }     

        //Panel 2
        public function setPanelHead_2(){ 

            switch ($this->pageID) {      
                case 'eventViewEdit':
                      $this->panelHead_2='<h3>Edit Upcoming Events</h3>';
                    break;
                case 'eventView':
                      $this->panelHead_2='<h3>Upcoming Events</h3>';
                    break;
                case 'eventAdd':
                      $this->panelHead_2='<h3>Results</h3>';
                    break;
                case 'eventEdit':
                      $this->panelHead_2='<h3>Edit Result</h3>';
                    break;
                case 'eventDelete':
                      $this->panelHead_2='<h3>Results</h3>';
                    break;
                default:
                      $this->panelHead_2='<h3>Event</h3>';
                    break;
                }
            
        }    
        
        public function setPanelContent_2(){
            
            

            $this->panelContent_2='';  
            switch ($this->pageID) { 
                case 'eventViewEdit':  

                        if ($this->postArray['btn']){  
                            switch ($this->postArray['btn']){  
                                case 'viewSelected':
                                   
                                    $eventID=$this->db->real_escape_string($this->postArray['eventCode']);
                                    
                                    
                                    $sql='SELECT EventID,EventName,EventDate,EventDescription FROM event WHERE EventID="'.$eventID.'"';
                                    
                                    
                                    $this->panelContent_2.='<p>Selected Event: '.$this->postArray['eventCode'].'</p></br>';
                                    $this->panelContent_2.=$this->dbViewEditQuery($sql);
                                    break;
                                case 'viewAll':
                                    
                                    $sql='SELECT EventID,EventName,EventDate,EventDescription FROM event';
                                    
                                    
                                    $this->panelContent_2.=$this->dbViewEditQuery($sql);
                                    break;
                                default:
                                    
                                    $this->panelContent_2.='<p>Please select a EVENT or ALL EVENT to view</p></br>';
                                    break;
                            }
                        }
                        else{ 
                            
                            $this->panelContent_2.='<p>Please select a EVENT or ALL EVENT to view</p></br>';
                        }
                break;         
                case 'eventView':
                        
                        $sql='SELECT EventID,EventName,EventDate,EventDescription FROM event';  
                        $this->panelContent_2.=$this->dbViewQuery($sql);

                    break;                   
                case 'eventEdit':

                    if ($this->postArray['btn']==='eventSave'){  
                        
                        $eventID=$this->db->real_escape_string($this->postArray['EventID']);
                        $eventName=$this->db->real_escape_string($this->postArray['EventName']);
                        $eventDate=$this->db->real_escape_string($this->postArray['EventDate']);
                        $eventDescription=$this->db->real_escape_string($this->postArray['EventDescription']);

                        //construct the INSERT SQL
                        $sql="UPDATE event ";
                        $sql.="SET ";
                        $sql.="EventName='".$eventName."', ";
                        $sql.="EventDate='".$eventDate."', ";
                        $sql.="EventDescription='".$eventDescription."' ";
                        $sql.="WHERE EventID='".$eventID."'";
                        
                        //
                        $this->postArray['selectedEventID']=$eventID;
                        
                        if(($this->db->query($sql)===TRUE)&&($this->db->affected_rows===1)){
                            $this->panelContent_2.='Changes to Event : '.$eventID.' Successfully Saved in DB';
                            
                        }
                        else{
                            $this->panelContent_2.='No changes to made to event record';
                        }
                    }
                    else{                              
                        $this->panelContent_2.='Please make required changes in event Edit form';
                    }
                    


                    break;
                case 'eventDelete':
                    if(isset($this->postArray['btn'])){
                        $sql="DELETE FROM event WHERE EventID='".$this->postArray['selectedEventID']."'"; 
                        
                        if(($this->db->query($sql)===TRUE)&&($this->db->affected_rows===1)){
                            $this->panelContent_2.='Event : '.$this->postArray['selectedEventID'].' DELETED Successfully';
                        }
                        else{ //the DELETE query has failed
                            $this->panelContent_2.='Unable to DELETE event - possible invalid Event ID Code or related records in the RESULTS table related to this event';
                        }
                    }
                    else{  //the button has not been pressed yet
                        $this->panelContent_2.='Please enter a new event ID the in form.';
                    }
                    break;                    
                case 'eventAdd':
                    if(isset($this->postArray['btn'])){
                        
                        //escape any special characters entered in the form
                        $eventID=$this->db->real_escape_string($this->postArray['EventID']);
                        $eventName=$this->db->real_escape_string($this->postArray['EventName']);
                        $eventDate=$this->db->real_escape_string($this->postArray['EventDate']);
                        $eventDescription=$this->db->real_escape_string($this->postArray['EventDescription']);

                        
                        //construct the INSERT SQL
                        $sql="INSERT INTO event (EventID,EventName,EventDate,EventDescription) ";
                        $sql.="VALUES (";
                        $sql.="'".$eventID."',";
                        $sql.="'".$eventName."',";
                        $sql.="'".$eventDate."',";
                        $sql.="'".$eventDescription."'";
                        $sql.=")";
                        
                        //execute the INSERT SQL and check that the new row is inserted OK
                        if(($this->db->query($sql)===TRUE)&&($this->db->affected_rows===1)){
                            $sql='SELECT EventID,EventName,EventDate,EventDescription FROM event WHERE EventID="'.$eventID.'"';
                            $this->panelContent_2.='<p>New Event Added Successfully: '.$eventID.'</p></br>';
                            $this->panelContent_2.=$this->dbViewQuery($sql);
                        }
                        else{
                            $this->panelContent_2.='Unable to add new event - possible duplicate Event ID or invalid Event Description ID Code';
                            
                            
                            
                        }
                    }
                    else{ 
                        $this->panelContent_2.='Please enter new event details in form';
                    }
                    break;
                default : 
                    $this->panelContent_2.='Please select a valid menu option';      
                    break; 
                } 
  
        }
        
       
       
        private function dbViewEditQuery($sql){
                            
                            
                            
                            $returnString='';
                            if((@$rs=$this->db->query($sql))&&($rs->num_rows)){  
                               
                                
                                $returnString.= '<table class="table table-bordered">';
                                $returnString.='<tr><th>EventID</th><th>EventName</th><th>EventDate</th><th>Event Description</th><th>Select</th></tr>';
                                while ($row = $rs->fetch_assoc()) { 
                                        $returnString.='<tr>';
                                           foreach($row as $key=>$value){
                                                    $returnString.= "<td>$value</td>";
                                            }
                                            
                                            $returnString.= '<td>';
                                            $returnString.= '<form action="'.$_SERVER["PHP_SELF"].'?pageID=eventEdit" method="post">';
                                            $returnString.= '<input type="submit" type="button" class="btn btn-info btn-sm" value="Edit" name="btn">';
                                            $returnString.= '<input type="hidden" value="'.$row['EventID'].'" name="selectedEventID">';   
                                            $returnString.= '</form>';
                                            $returnString.= '</td>';
                                            $returnString.= '</tr>';  
                                        }
                                $returnString.= '</table>';   
                            }  
                            else{  
                            
                                    $returnString.= '<br>No records available to view - please try again<br>';
                                    
                            }
                            
                            $rs->free();
                            return $returnString;
        }
        
        private function dbEditForm($sql){
            $returnString='';
            
            if((@$rs=$this->db->query($sql))&&($rs->num_rows===1)){     
                
                $row=$rs->fetch_assoc();
                

                
                    $returnString.='<form method="post" action="index.php?pageID=eventEdit">';
                    $returnString.='<div class="form-group">';
                    $returnString.='<label for="EventID">EventID</label><input required readonly type="text" class="form-control" value="'.$row['EventID'].'" id="EventID" name="EventID" pattern="[A-Z0-9]{5,10}" title="EventID - Upper Case Letters and digits, 5-10 characters">';
                    $returnString.='<label for="EventName">EventName</label><input required type="text" class="form-control" value="'.$row['EventName'].'" id="EventName" name="EventName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="Event Title (up to 45 Characters)">';
                    $returnString.='<label for="EventDate">EventDate</label><input required type="text" class="form-control" value="'.$row['EventDate'].'" id="EventDate" name="EventDate" title="EventDate (Integer Value)" >';
                    $returnString.='<label for="EventDescription">Event Description ID</label><input required type="text" class="form-control" value="'.$row['EventDescription'].'"  id="EventDescription" name="EventDescription" title="Enter a valid Event Description ID">';
                    $returnString.='</div>';
                    $returnString.='<button type="submit" class="btn btn-success" name="btn" value="eventSave">Save Changes</button>';
                    $returnString.='</form>'; 
            }
            else{
                $returnString.='Invalid event selection - Event may already have been deleted.';
            }
                    return $returnString;
        }
        
        private function dbViewQuery($sql){
                            
                            $returnString='';
                            if((@$rs=$this->db->query($sql))&&($rs->num_rows)){  
                                
                                $returnString.= '<table class="table table-bordered">';
                                $returnString.='<tr><th>EventID</th><th>EventName</th><th>EventDate</th><th>Event Description</th></tr>';
                                while ($row = $rs->fetch_assoc()) { 
                                        $returnString.='<tr>';
                                           foreach($row as $key=>$value){
                                                    $returnString.= "<td>$value</td>";
                                            }
                                            $returnString.= '</tr>';  
                                        }
                                $returnString.= '</table>';   
                            }  
                            else{  
                            
                                    $returnString.= '<br>No records available to view - please try again<br>';
                                    
                            }
                            
                            $rs->free();
                            return $returnString;
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
        public function getPanelHead_1(){return $this->panelHead_1;}
        public function getPanelContent_1(){return $this->panelContent_1;}
        public function getPanelHead_2(){return $this->panelHead_2;}
        public function getPanelContent_2(){return $this->panelContent_2;}
        public function getFooter(){return $this->footer;}

        

        
}
        