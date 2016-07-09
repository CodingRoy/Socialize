<?php
class Dashboard_Model extends Model {
    function __construct() {
        parent::__construct();
    }

    public function overview() {
        $sth = $this->db->prepare("SELECT * FROM posts LEFT JOIN users ON post_by = user_id ORDER BY post_date DESC");
        $sth->execute();
        return $sth->fetchAll();
    }

    function post() {
        $sth = $this->db->prepare("INSERT INTO posts (post_title, post_content, post_date, post_by) VALUES (:Post_title, :Post, NOW(), :Post_by)");
        $sth->bindParam(':Post_title', ucfirst($_POST['Post_title']));
        $sth->bindParam(':Post', ucfirst($_POST['Post']));
        $sth->bindParam(':Post_by', Session::get('user_id'));
        $sth->execute();
    }
}
