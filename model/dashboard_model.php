<?php
class Dashboard_Model extends Model {
    function __construct() {
      parent::__construct();
    }

    public function overview() {
      $sth = $this->db->prepare("SELECT *,
        COUNT(post_fav.id) AS favcount
        FROM posts
        LEFT JOIN users
        ON post_by = user_id
        LEFT JOIN post_fav
        ON post_id = fpost_id
        GROUP BY post_id
        ORDER BY post_date DESC");
      $sth->execute();
      return $sth->fetchAll();
    }

    function post($ptitle, $pcontent) {
      $sth = $this->db->prepare("INSERT INTO posts (post_title, post_content, post_date, post_by) VALUES (:Post_title, :Post, NOW(), :Post_by)");
      $sth->bindParam(':Post_title', $ptitle);
      $sth->bindParam(':Post', $pcontent);
      $sth->bindParam(':Post_by', Session::get('user_id'));
      $sth->execute();
    }

    function fav($post_id) {
      $sth = $this->db->prepare("INSERT INTO post_fav (fpost_id, fuser_id)
        SELECT :Post_id, :User_id
        WHERE EXISTS (
          SELECT post_id
          FROM posts
          WHERE post_id = :Post_id)
        AND NOT EXISTS (
          SELECT id
          FROM post_fav
          WHERE fpost_id = :Post_id
          AND  fuser_id = :User_id)
        LIMIT 1");
      $sth->bindParam(':Post_id', $post_id);
      $sth->bindParam(':User_id', Session::get('user_id'));
      $sth->execute();
    }

    function delete($post_id) {
      try {
      $sth = $this->db->prepare("DELETE FROM posts WHERE post_id = :Post_id AND post_by = :User_id");
      $sth->bindParam(':Post_id', $post_id);
      $sth->bindParam(':User_id', Session::get('user_id'));
      $sth->execute();
      return $sth->rowcount();
      } catch(PDOException $e) {
        $error = $sth->errorInfo();
        return $error[2];
      }
    }
}
