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
    
    /**
     * it insert a user into the db
     */
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
    
    public function checkValueInDb($table, $field, $id) {
        $stmt = $this->db->prepare("SELECT * FROM $table A WHERE A.$field = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return !empty($result->fetch_all(MYSQLI_ASSOC));
    }

    private function getNewId($field, $table){
        $stmt = $this->db->prepare("SELECT Max($field) FROM $table");
        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);
        $id = $array[0]["Max($field)"] + 1;
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
    
    /**
     * given an author, returns all the posts of that author
     */
    public function getPostFromUser($author) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE author = ?");
        $stmt->bind_param("s", $author);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * returns n posts
     */
    public function getPosts($n) {
        $stmt = $this->db->prepare("SELECT `author`,`string`,user_info.user_image FROM `post`,user_info WHERE user_info.user_id=post.author ORDER BY RAND() LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}  
?>