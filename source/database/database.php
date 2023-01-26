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
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }
    
    /**
     * given an author, returns the number of posts made by that author
     */
    public function getPostCountFromUser($author) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS post_count FROM post WHERE author = ?");
        $stmt->bind_param("s", $author);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["post_count"];
    }

    /**
     * returns n posts
     */
    public function getPosts($n) {
        $stmt = $this->db->prepare("SELECT `author`,`string`,user_info.user_image, data FROM `post`,user_info WHERE user_info.user_id=post.author ORDER BY RAND() LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Given a username returns the number of followers that user has
     */
    public function getFollowerCount($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS follower_count FROM user_followers_followed WHERE user_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["follower_count"];
    }

    public function getFollowedCount($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) As followed_count from user_followers_followed WHERE follower_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["followed_count"];
    }

    /** 
     * add a post to the db
    */   
    public function addPost($string, $author){
        $data = date("Y-m-d");
        $id = $this->getNewId("post_id", "post");
        $stmt = $this->db->prepare("INSERT INTO post (post_id, author, string, data, esame_id) VALUES (?, ?, ?, ?, null);");
        $stmt->bind_param("ssss", $id, $author, $string, $data);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Returns the followers of the user with the given username
     */
    public function getFollowers($username) {
        $stmt = $this->db->prepare("SELECT follower_id FROM user_followers_followed WHERE user_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns the users followed by the user with the given username
     */
    public function getFollowing($username) {
        $stmt = $this->db->prepare("SELECT user_id FROM user_followers_followed WHERE follower_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all posts made by the user with the given username
     * The are ordered from the most recent to the least recent
     */
    public function getAllUserPosts($username) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE author = ? ORDER BY data DESC");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}  
?>