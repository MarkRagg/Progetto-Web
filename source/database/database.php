<?php

class DatabaseManager {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error) {
            die("Connessione fallita al db");
        }
        

    }
    
    public function AddUser() {
      
    }
}
    
?>