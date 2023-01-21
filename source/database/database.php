<?php

class DatabaseManager {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error) {
            die("Connessione fallita al db");
        }
        

    }
    
    public function AddUser($nickname, $email, $passw, $name, $surname, $date, $residence) {
        $user_query = $this->db->prepare("INSERT INTO user (user_id, password, email)
                        VALUES (?, ?, ?);");
        $user_query->bind_param("sss", $nickname, $passw, $email);
        $first_result = $user_query->execute();

        $user_info_query = $this->db->prepare("INSERT INTO user_info(user_id, name, surname, date_of_birth, birthplace, uni_residence)
                                            VALUES(?, ?, ?, ?, ?, ?);");                     
        $user_info_query->bind_param("ssssss", $nickname, $name, $surname, $date, $residence, $residence);
        $second_result = $user_info_query->execute();

        return $first_result == true && $second_result == true;
    }
}
    
?>