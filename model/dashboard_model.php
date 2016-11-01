<?php
class Dashboard_Model extends Model {
    function __construct() {
      parent::__construct();
    }

// Returns all posts and if @param string $order is emtpy sort on post_id
    public function overview($order) {
      $sth = $this->db->prepare("SELECT post_id, post_title, post_content, post_date, post_by, username, user_id,
        COUNT(post_fav.id) AS favcount,
        GROUP_CONCAT(fuser_id SEPARATOR '|') as favuser
        FROM posts
        LEFT JOIN users
        ON post_by = user_id
        LEFT JOIN post_fav
        ON post_id = fpost_id
        GROUP BY post_id
        ORDER BY favcount DESC");
      $sth->execute();
      $output = $sth->fetchAll();
      $order == 'favposts' ? '' : arsort($output) ;
      return $output;
    }

// Returns only posts from the curent user
    function userposts() {
      $sth = $this->db->prepare("SELECT post_id, post_title, post_content, post_date, post_by, username, user_id,
        COUNT(post_fav.id) AS favcount,
        GROUP_CONCAT(fuser_id SEPARATOR '|') as favuser
        FROM posts
        LEFT JOIN users
        ON post_by = user_id
        LEFT JOIN post_fav
        ON post_id = fpost_id
        WHERE post_by = :User_id
        GROUP BY post_id
        ORDER BY favcount DESC");
      $sth->bindParam(':User_id', Session::get('user_id'));
      $sth->execute();
      return $sth->fetchAll();
    }

// Make post with the $ptitle and $pcontent p = post
    function post($ptitle, $pcontent) {
      $sth = $this->db->prepare("INSERT INTO posts (post_title, post_content, post_date, post_by) VALUES (:Post_title, :Post, NOW(), :Post_by)");
      $sth->bindParam(':Post_title', $ptitle);
      $sth->bindParam(':Post', $pcontent);
      $sth->bindParam(':Post_by', Session::get('user_id'));
      $sth->execute();
    }

// Insert userid and post-id into post_fav to let the user mark a post as favourite
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

// Delete the post only if post_by == user_id
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
