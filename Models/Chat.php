<?php

class Chat extends Model{
	
        private $db;              
        private $user;
        private $postArray;       
        private $chatMessages;    


	//constructor
	function __construct($user,$postArray,$pageTitle,$pageHead,$database) {
            parent::__construct($user->getLoggedinState());
            $this->user=$user;

           
            $this->db=$database;



            
            $this->postArray=$postArray;


            $this->setChatMessages();


	} 



        public function submitChatMsg(){
            
            
            $chatMsg=$this->db->real_escape_string($this->postArray['chatMsg']);
            $senderID=$this->db->real_escape_string($this->user->getUserID());
            $senderFirstName=$this->db->real_escape_string($this->user->getUserFirstName());
            $senderLastName=$this->db->real_escape_string($this->user->getUserLastName());
            //construct the SQL insert query
            $sql='INSERT INTO chat (senderID,senderFirstName,senderLastName,message) ';
            $sql.="VALUES ('$senderID','$senderFirstName','$senderLastName','$chatMsg')";

            
            $rs=$this->db->query($sql);

            
            if ($rs){return 'TRUE';}else{return 'FALSE';}
        }



        public function setChatMessages(){
            //
            $this->chatMessages='';  
            if($this->loggedin){  
                    //SQL
                    $sql='SELECT * FROM chat ORDER BY msgID DESC LIMIT 0,3;';
                    $this->chatMessages='';
                    if((@$rs=$this->db->query($sql))&&($rs->num_rows)){  
                       
                        $this->chatMessages.= '<table class="table table-bordered">';
                        while ($row = $rs->fetch_assoc()) { 
                                $this->chatMessages.='<tr><td>';

                                  
                                    $this->chatMessages.='<p><b>'.$row['senderID'].': '.$row['senderFirstName'].' '.$row['senderLastName'].' has Sent you a message.</b>'.'<p><b>Their Message: </b><em>'.$row['message'].'</em><p><b>Date/Time of Message: </b>'.$row['datetimestamp'];

                                    $this->chatMessages.= '</td></tr>';  

                                }
                        $this->chatMessages.= '</table>';

                    }
                    else{  
                         if (!$rs->num_rows){
                            $this->chatMessages.= '<br>No records have been returned - resultset is empty - Nr Rows = '.$rs->num_rows. '<br>';
                            }
                            else{
                            $this->chatMessages.= '<br>SQL Query has FAILED - possible problem in the SQL - check for syntax errors<br>';
                            }
                    }
                   
                    $rs->free();
                }  
                else{
                    $this->chatMessages='Please log in!. ';
                }
        }


        public function getChatMessages(){return $this->chatMessages;}

}
