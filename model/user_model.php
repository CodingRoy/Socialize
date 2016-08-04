<?php
class User_Model extends Model {
  function __construct() {
    parent::__construct();
  }

  public function create($username, $email, $password) {
    $sth = $this->db->prepare("INSERT into users (`username`, `password`, `email`, `registration_date`) "
        . "VALUES (:username, :password, :email, CURDATE())");
    $sth->bindParam(':username', $username);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':password', $password);
    $sth->execute();
    if ($sth->rowcount() == 1) {
      return 1;
    } else {
      return 0;
    }
  }

  public function activate($email) {
    $sth = $this->db->prepare("UPDATE users SET activated='Yes' WHERE sha1(email) = :email");
    $sth->bindParam(':email', $email);
    $sth->execute();
    if ($sth->rowcount() == 1) {
      return 1;
    } else {
      return 0;
    }
  }

  public function userinfo($username) {
    $sth = $this->db->prepare("SELECT * FROM users WHERE username = :Username");
    $sth->bindParam(':Username', $username);
    $sth->execute();
    if ($sth->rowcount() == 1) {
      return $sth->fetchAll();
    } else {
      return null;
    }
  }
}
