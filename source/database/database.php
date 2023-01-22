<?php

class DatabaseManager {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error) {
            die("Connessione fallita al db");
        }
    }

    public function __destruct()
    {
        $this->db->close();
    }
    
    public function addUser($nickname, $email, $passw, $name, $surname, $date, $residence) {
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

    public function login($email, $passw) {
        $stmt = $this->db->prepare("SELECT * FROM user U WHERE U.email = ? AND U.password = ?");
        $stmt->bind_param("ss", $email, $passw);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}  
?>