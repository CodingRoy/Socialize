<?php
class User_Model extends Model {
  function __construct() {
    parent::__construct();
  }

  public function create($username, $email, $password) {
    $sth = $this->db->prepare("INSERT into users (`username`, `email`, `password`, `registration_date`) "
        . "VALUES (:username, :email, :password, CURDATE())");
    $sth->bindParam(':username', $username);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':password', Hash::create('md5', $_POST['password']));
    $sth->execute();
    if ($sth->rowcount() == 1) {
      return 1;
    } else {
      return 0;
    }
  }

  public function activate($email) {
    $sth = $this->db->prepare("UPDATE users SET activated='1' WHERE sha1(email) = :email");
    $sth->bindParam(':email', $email);
    $sth->execute();
    if ($sth->rowcount() == 1) {
      return 1;
    } else {
      return 0;
    }
  }
}
