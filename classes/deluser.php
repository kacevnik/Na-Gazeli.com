<?php 
    
    class DelUser{
        //global $db;
        private $admin_session = "";
        private $pass = "";
        private $kod = "";
        private $sql = "";
        
        public function __construct($admin){
            $this->admin_session =  $admin;            
            $this->pass = substr($this->admin_session, 0, 32);
            $this->kod  = substr($this->admin_session, 32, 32);
            $this->sql  = "SELECT avatar FROM voditel WHERE pass='".$this->pass."' AND kod='".$this->kod."'";
        }
        public function numRows(){
            echo $this->sql;
            //mysql_query()   
        }
        
    }
    
    $del = new DelUser(222);
    $del->numRows();
    
?>