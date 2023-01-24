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
        
        $id = $this->getNewId("user_info_count", "user_info");
        
        $user_info_query = $this->db->prepare("INSERT INTO user_info(user_info_count, user_id, name, surname, date_of_birth, birthplace, uni_residence)
                                            VALUES(?, ?, ?, ?, ?, ?, ?);");                     
        $user_info_query->bind_param("sssssss",$id, $nickname, $name, $surname, $date, $residence, $residence);
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

    public function checkValueInDb($table, $column, $id) {
        $stmt = $this->db->prepare("SELECT * FROM $table A WHERE A.$column = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return !empty($result->fetch_all(MYSQLI_ASSOC));
    }

    private function getNewId($i, $z){
        $stmt = $this->db->prepare("SELECT Max($i) FROM $z");
        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);
        $id = $array[0]["Max($i)"] + 1;
        return $id;
    }

    /**
     * Returns a user's data given their username
     */
    public function getUserInfo($user_id) {
        $stmt = $this->db->prepare("SELECT name, surname, date_of_birth, uni_residence, corso_id, user_image FROM user_info WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}  
?>