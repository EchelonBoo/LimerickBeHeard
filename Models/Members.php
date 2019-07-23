<?php

class Members extends Model{

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
      
        
        public function setPageTitle($pageTitle){   
                $this->pageTitle=$pageTitle;
        }        

        public function setPageHeading($pageHead){ 
                $this->pageHeading=$pageHead;
        }  
        
        //Panel 1
        public function setPanelHead_1(){

            switch ($this->pageID) {          
                case 'membersView':
                      $this->panelHead_1='<h3>Please Select a Member or View All</h3>';   
                    break;
  
                case 'memberDelete':
                      $this->panelHead_1='<h3>Delete a Member From the System</h3>';   
                    break;
                default:
                      $this->panelContent_1='Invalid Choice';
                    break;
                }
            
        }
        
        public function setPanelContent_1(){
            
            switch ($this->pageID) {          
                case 'membersView':
                      $this->panelContent_1=file_get_contents('forms/form_Member.html');
                    break;
                case 'memberDelete':
                      $this->panelContent_1='If you would like to remove another member click the return link below.<br><Br>';
                      $this->panelContent_1.='<p class = "lead"><a href="'.$_SERVER['PHP_SELF'].'?pageID=membersView">Return</a></p>';
                    
                    break;
                default:
                      $this->panelContent_1='Invalid Choice';
                    break;
                }

        }        

   
        public function setPanelHead_2(){ 

            switch ($this->pageID) {           
                case 'membersView':
                      $this->panelHead_2='<h3>View/Delete Members</h3>';
                    break;
                case 'membersDelete':
                      $this->panelHead_2='<h3>Results</h3>';
                    break;
                default:
                      $this->panelHead_2='<h3>Members</h3>';
                    break;
                }
            
        } 
        
        public function setPanelContent_2(){
            $this->panelContent_2='';  
            switch ($this->pageID) {       
                case 'membersView':  

                        if ($this->postArray['btn']){ 
                            switch ($this->postArray['btn']){  //check which button has been pressed
                                 case 'viewSelected':
                                    
                                    $memberID=$this->db->real_escape_string($this->postArray['memberCode']);
                                    
                                   
                                    $sql='SELECT memberID,FirstName,LastName FROM member WHERE memberID="'.$memberID.'"';
                                    
                                    $this->postArray['selectedMemberID']=$memberID;
                                    
                                   
                                    $this->panelContent_2.='<p>Selected Member: '.$this->postArray['memberCode'].'</p></br>';
                                    $this->panelContent_2.=$this->ViewDeleteMembers($sql);
                                    break;
                                case 'viewAll':
                                   
                                    $sql='SELECT memberID,FirstName,LastName FROM member';
                                    
                                   
                                    $this->panelContent_2.=$this->ViewDeleteMembers($sql);
                                    break;
                                default:
                                    
                                    $this->panelContent_2.='<p>Please select the member or members to view and delete:</p></br>';
                                    break;
                            }
                        }
                        else{ 
                            $this->panelContent_2.='<p>Please select a member or all members to view</p></br>';
                        }
                        break;       
                        
                case 'memberDelete':
                    if(isset($this->postArray['btn'])){
                       
                        $sql="DELETE FROM member WHERE MemberID='".$this->postArray['selectedmemberID']."'"; 
                        
                        if(($this->db->query($sql)===TRUE)&&($this->db->affected_rows===1)){
                            $this->panelContent_2.='Member : '.$this->postArray['selectedmemberID'].' DELETED Successfully';
                        }
                        else{ 
                            $this->panelContent_2.='Error - Unable to delete selected member. Please try again.';
                        }
                    }
                    else{  
                        $this->panelContent_2.='Enter a member ID:';
                    }
                    break;                    
                
                default :  
                    $this->panelContent_2.='Please select a valid menu option';      
                    break; 
                }   
  
        } 
        
            
       
        private function ViewDeleteMembers($sql) {
        
        $returnString='';
        if((@$rs=$this->db->query($sql))&&($rs->num_rows)){ 
                                
            $returnString.= '<table class="table table-bordered">';
            $returnString.='<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Select</th></tr>';
            while ($row = $rs->fetch_assoc()) { 
                    $returnString.='<tr>';
                    foreach($row as $key=>$value){
                            $returnString.= "<td>$value</td>";
                    }
                    //Edit button
                    $returnString.= '<td>';
                    $returnString.= '<form action="'.$_SERVER["PHP_SELF"].'?pageID=memberDelete" method="post">';
                    $returnString.= '<input type="submit" type="button" class="btn btn-danger btn-sm" value="Delete" name="btn">';
                    $returnString.= '<input type="hidden" value="'.$row['memberID'].'" name="selectedmemberID">';
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

        public function setFooter(){
            if($this->loggedin){
            $this->footer='<div class="navbar navbar-default navbar-fixed-bottom">';
            $this->footer.='<div class="container">';
            $this->footer.='<p class="navbar-text pull-left">';
            $this->footer.='Please Log In to access resources!</p>';
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
        