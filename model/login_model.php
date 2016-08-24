<?php
class Login_Model extends Model {
	public function __construct(){
		parent::__construct();
	}

	public function run($username, $password){
		$sth = $this->db->prepare("SELECT user_id FROM users WHERE username = :username AND password = :password AND activated = 'Yes'");
		$sth->bindParam(':username', $username);
		$sth->bindParam(':password', $password);
		$sth->execute();
		$user_id = $sth->fetchColumn();

		if($sth->rowCount() === 1){
			Session::init();
			Session::set('loggedIn', true);
			Session::set('username', $username);
			Session::set('user_id', $user_id);
			$sth2 = $this->db->prepare("UPDATE users SET last_active = current_timestamp() WHERE user_id = :user_id");
			$sth2->execute(array(':user_id' => $user_id));
			header('location: ' .URL. 'dashboard');
		}else{
			header('location: ' .URL. 'login');
		}
	}
}
