<?php
class Login_Model extends Model {
	public function __construct(){
		parent::__construct();
	}

// check the values $username and $password in the database and set session variables
	public function run($username, $password){
		$sth = $this->db->prepare("SELECT user_id FROM users WHERE username = :username AND password = :password AND activated = 'Yes'");
		$sth->bindParam(':username', $username);
		$sth->bindParam(':password', $password);
		$sth->execute();
		$user_id = $sth->fetchColumn();
		$checklogin = $this->failedlogin();
		if($sth->rowCount() === 1 && $checklogin === 1){
			Session::init();
			Session::set('loggedIn', true);
			Session::set('username', $username);
			Session::set('user_id', $user_id);
			$sth2 = $this->db->prepare("UPDATE users SET last_active = current_timestamp() WHERE user_id = :user_id");
			$sth2->execute(array(':user_id' => $user_id));
			header('location: ' .URL. 'dashboard');
		}else {
			$ip = '192.168.1.10';
			$sth2 = $this->db->prepare("INSERT INTO failed_logins SET username = :username, ip_address = INET_ATON(:ip), attempted = CURRENT_TIMESTAMP");
			$sth2->execute(array(':username' => $username, ':ip' => $ip));
			return $checklogin;
		}
	}

	function failedlogin() {
		$sth = $this->db->query('SELECT MAX(attempted) AS attempted FROM failed_logins');
	  if ($sth->rowCount() > 0) {
	    $row = $sth->fetch(PDO::FETCH_ASSOC);
	    $latest_attempt = (int) date('U', strtotime($row['attempted']));
			header('location: ' .URL. 'login');

	    // get the number of failed attempts
	    $sth2 = $this->db->query('SELECT COUNT(1) AS failed FROM failed_logins WHERE attempted > DATE_SUB(NOW(), INTERVAL 30 minute)');
	    if ($sth2->rowCount() > 0) {
	      // get the returned row
	      $row = $sth2->fetch(PDO::FETCH_ASSOC);
	      $failed_attempts = (int) $row['failed'];

	      // assume the number of failed attempts was stored in $failed_attempts
				$throttle = array(4 => 2, 8 => 4, 12 => 10, 16 => 18, 30 => 'TMR');
	      krsort($throttle);
	      foreach ($throttle as $attempts => $delay) {
	        if ($failed_attempts > $attempts) {
	          // we need to throttle based on delay
	          if (is_numeric($delay)) {
	            // output delay
							$this->view = new View();
							$this->view->msg = "Login failed, wait ". $delay ." seconds to try again.";
							$this->view->render('error/index');
							http_response_code(405);
							header("refresh:".$delay."; url=".URL."login");
	          } else {
	            http_response_code(429); //throw an http error 429: Too many requests.
	          }
	          break;
	        }
	      }
	    } else { return 1;}
	  }
	}
}
