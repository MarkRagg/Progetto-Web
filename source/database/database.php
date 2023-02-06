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
        
        $user_info_query = $this->db->prepare("INSERT INTO user_info(user_info_count, user_id, name, surname, date_of_birth, birthplace, uni_residence, user_image)
                                            VALUES(?, ?, ?, ?, ?, ?, ?, null);");                     
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
        $id = strval($id);
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
        $stmt = $this->db->prepare("SELECT name, surname, date_of_birth, uni_residence, corso_id, user_image, descrizione FROM user_info WHERE user_id = ?");
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
    public function getPosts($id, $n) {
        $stmt = $this->db->prepare("SELECT post.*, user_info.user_image FROM user_followers_followed LEFT JOIN post ON post.author = user_followers_followed.user_id LEFT JOIN user_info on post.author=user_info.user_id WHERE user_followers_followed.follower_id = ? ORDER by post.data DESC limit ?;");
        $stmt->bind_param("si",$id, $n);
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
    public function addPost($string, $author, $img){
        $data = date("Y-m-d");
        $id = $this->getNewId("post_id", "post");
        $stmt = $this->db->prepare("INSERT INTO post (post_id, author, string, data, esame_id, immagine) VALUES (?, ?, ?, ?, null, ?);");
        $stmt->bind_param("sssss", $id, $author, $string, $data, $img);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Returns the followers of the user with the given username
     */
    public function getFollowers($username) {
        $stmt = $this->db->prepare("SELECT follower_id AS username FROM user_followers_followed WHERE user_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns the users followed by the user with the given username
     */
    public function getFollowing($username) {
        $stmt = $this->db->prepare("SELECT user_id AS username FROM user_followers_followed WHERE follower_id = ?");
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

    /**
     * register a like to a post
     */
    public function likePost($post_id, $user_id, $reaction_type){
        $stmt = $this->db->prepare("INSERT INTO `post_user_reaction`(`pur_id`, `user_id`, `post_id`, `reaction_id`) 
                                    VALUES (?, ?, ?, ?)");
        $id = $this->getNewId("pur_id", "post_user_reaction");
        $stmt->bind_param("ssss", $id, $user_id, $post_id, $reaction_type);
        $result = $stmt->execute();
        return $result;
    }

    public function getPostLikes($post_id){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS likes FROM post_user_reaction WHERE post_id = ? AND reaction_id = 1");
        $stmt->bind_param("s", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["likes"];
    }

    /**
     * Returns all info about a course given it's id
     */
    public function getCourseInfo($course_id) {
        $stmt = $this->db->prepare("SELECT * FROM corsi WHERE corso_id = ?");
        $stmt->bind_param("s", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    /**
     * Returns all info about a university given it's id
     */
    public function getUniInfo($uni_id) {
        $stmt = $this->db->prepare("SELECT * FROM universita WHERE uni_id = ?");
        $stmt->bind_param("i", $uni_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    /**
     * Returns the number of users subscribed to the course with the given id
     */
    public function getSubCount($course_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as subCount FROM user_info WHERE corso_id = ?");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC)["subCount"];
    }

    /**
     * Returns the number of classes in the course with the given id
     */
    public function getClassCount($course_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS classCount FROM esami WHERE corso_id = ?");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC)["classCount"];
    }

    public function removeLike($post_id, $reaction_type, $user_id){
        $stmt = $this->db->prepare("DELETE FROM post_user_reaction WHERE post_id = ? and reaction_id = ? and user_id = ?");
        $stmt->bind_param("sss", $post_id, $reaction_type, $user_id);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Returns all classes belonging to the course with the given id
     */
    public function getClassesFromCourse($course_id) {
        $stmt = $this->db->prepare("SELECT * FROM esami WHERE corso_id = ?");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all users subscribed to the course with the given id
     */
    public function getSubsFromCourse($course_id) {
        $stmt = $this->db->prepare("SELECT user_id, name, surname, date_of_birth, birthplace, uni_residence, user_image FROM user_info WHERE corso_id = ?;");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*
     * returns if the current user has reacted the post
     */
    public function hasReacted($post_id, $user_id, $reaction_type){
        $stmt = $this->db->prepare("SELECT * FROM post_user_reaction WHERE post_id = ? AND user_id = ? and reaction_id = ?");
        $stmt->bind_param("sss", $post_id, $user_id, $reaction_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $res = $result->fetch_all(MYSQLI_ASSOC);
        return !empty($res);
    }

    public function getNotificationsByUser($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM notifiche WHERE user_2_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function addFollower($user_followed, $user_follower) {
        $stmt = $this->db->prepare("INSERT INTO user_followers_followed (follower_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_follower, $user_followed);
        $result = $stmt->execute();
        return $result;
    }

    public function isUserSubbedToCourse($user_id, $course_id) {
        $stmt = $this->db->prepare("SELECT * FROM user_info WHERE user_id = ? AND corso_id = ?");
        $stmt->bind_param("ss", $user_id, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return !empty($result->fetch_all(MYSQLI_ASSOC));
    }

    public function isUserSubbed($user_id) {
        $stmt = $this->db->prepare("SELECT corso_id FROM user_info WHERE user_id=?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->fetch_array(MYSQLI_ASSOC)["corso_id"] !== NULL);
    }

    public function subUserToCourse($user_id, $course_id) {
        $stmt = $this->db->prepare("UPDATE user_info SET corso_id=? WHERE user_id=?");
        $stmt->bind_param("is", $course_id, $user_id);
        return $stmt->execute();
    }

    public function unsubUserFromCourse($user_id, $course_id) {
        $stmt = $this->db->prepare("UPDATE user_info SET corso_id=NULL WHERE user_id=? AND corso_id=?");
        $stmt->bind_param("ss", $user_id, $course_id);
        return $stmt->execute();
    }

    public function getPost($post_id) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE post_id=?");
        $stmt->bind_param("s", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function getComments($post_id) {
        $stmt = $this->db->prepare("SELECT * FROM comment WHERE post_id=?");
        $stmt->bind_param("s", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns true if follower_id is following followed_id
     */
    public function isUserFollowing($follower_id, $followed_id) {
        $stmt = $this->db->prepare("SELECT * FROM user_followers_followed WHERE follower_id = ? AND user_id = ?");
        $stmt->bind_param("ss", $follower_id, $followed_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return !empty($result->fetch_all(MYSQLI_ASSOC));
    }
    
    /**
     * Removes follower_id from followed_id's followers
     */
    public function removeFollower($follower_id, $followed_id) {
        $stmt = $this->db->prepare("DELETE FROM user_followers_followed WHERE follower_id = ? AND user_id = ?");
        $stmt->bind_param("ss", $follower_id, $followed_id);
        return $stmt->execute();
    }

    /**
     * Add notification from apis
     */
    public function addNotification($user_1_id, $user_2_id, $post_id, $tipology) {
        $stmt = $this->db->prepare("INSERT INTO notifiche (user_1_id, user_2_id, post_id, tipologia) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $user_1_id, $user_2_id, $post_id, $tipology);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * remove a notification by notification_id
     */
    public function removeNotification($notification_id) {
        $stmt = $this->db->prepare("DELETE FROM notifiche WHERE notifica_id = ?");
        $stmt->bind_param("s", $notification_id);
        $result = $stmt->execute();
        return $result;
    }

    public function addComment($comment, $postid, $author){
        $data = date("Y-m-d");
        $stmt = $this->db->prepare("INSERT INTO comment (comment_id, author, post_id, post_comment, data_commento) VALUES (?, ?, ?, ?, ?)");
        $id = $this->getNewId("comment_id", "comment");
        $stmt->bind_param("sssss", $id, $author, $postid, $comment, $data);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Returns the number of courses in a university
     */
    public function getCourseCount($uni_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS courseCount FROM corsi WHERE uni_id=?;");
        $stmt->bind_param("i", $uni_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC)["courseCount"];
    }

    /**
     * Returns info about all courses in a university
     */
    public function getCoursesFromUni($uni_id) {
        $stmt = $this->db->prepare("SELECT * FROM corsi WHERE uni_id=?;");
        $stmt->bind_param("i", $uni_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all universities
     */
    public function getAllUnis() {
        $result = $this->db->query("SELECT * FROM universita;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns the id of the university a course belongs to
     */
    public function getUniFromCourse($course_id) {
        $stmt = $this->db->prepare("SELECT * FROM universita, corsi WHERE corso_id = ? AND universita.uni_id=corsi.uni_id;");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC)["uni_id"];
    }

    public function setImageToUser($image_str, $user_id) {
        $stmt = $this->db->prepare("UPDATE user_info SET user_image=? WHERE user_id=?");
        $stmt->bind_param("ss", $image_str, $user_id);
        return $stmt->execute();
    }

    public function getPostReactionInfo($post_id, $numReaction){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS info FROM post_user_reaction WHERE post_id = ? AND reaction_id = ?");
        $stmt->bind_param("ss", $post_id, $numReaction);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["info"];
    }

    public function getPostComments($post_id){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS comment FROM comment WHERE post_id = ?");
        $stmt->bind_param("s", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["comment"];
    }

    public function getMorePosts($id, $num, $from){
        $stmt = $this->db->prepare("SELECT post.*, user_info.user_image FROM user_followers_followed LEFT JOIN post ON post.author = user_followers_followed.user_id LEFT JOIN user_info on post.author=user_info.user_id WHERE user_followers_followed.follower_id = ? ORDER by post.data DESC limit ? OFFSET ?;");
        $stmt->bind_param("sss", $id, $num, $from);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Returns the number of posts that belong to class with the given id
     */
    public function getPostCountFromClass($class_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as post_count FROM post WHERE esame_id=?;");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC)["post_count"];
    }

    /**
     * Returns all posts that belong to class with the given id
     */
    public function getPostsFromClass($class_id) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE esame_id=?;");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Returns info about the class with the given id
     */
    public function getClassInfo($class_id) {
        $stmt = $this->db->prepare("SELECT * FROM esami WHERE esame_id=?;");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    /**
     * Returns all reactions present in the database
     */
    public function getAllReactions() {
        $result = $this->db->query("SELECT * FROM reaction;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns the count of all reactions for a post
     */
    public function getAllReactionCount($post_id) {
        $reactions = $this->getAllReactions();
        foreach ($reactions as $reaction) {
            $result["num_".$reaction["reaction_info"]] = $this->getPostReactionInfo($post_id, $reaction["reaction_id"]);
        }
        return $result;
    }
}  
?>