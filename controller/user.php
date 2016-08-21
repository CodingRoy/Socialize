<?php
class User extends Controller {
	function __construct(){
		parent::__construct();
	}

	public function create(){
		$username	= ucfirst($_POST['username']);
		$email		= $_POST['email'];
		$password	= Hash::create('md5', $_POST['password']);
		$recaptcha  = "https://google.com/recaptcha/api/siteverify";
		$response = file_get_contents($recaptcha."?secret=".SECRETKEY."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
		$data = json_decode($response);

		if(isset($data->success) AND $data->success==true){
			$this->checkdata($username,$email,$password);
		}else {
			$this->view->title= "reCAPTCHA failed, are you a robot?";
			$this->view->content='Before pressing register please vink the box to verify that you are not a robot';
			$this->view->render('check/index');
		}
	}

	//This function needs to be improved, check for username lenght and valid email scheduled for Socialize 0.6.0
	private function checkdata($username,$email,$password){
		if($username != null && $email != null && $password != null){
			if($this->model->create($username, $email, $password) == 1){
				$this->view->title= $username.' you are succesfull registered' .header("refresh: 10; url=".URL);
				$this->view->content='We have send you an email to your email adress containing a link, please click this link to activate your account. <br /> Be sure to check your junk mail!';
			}else {
				$this->view->title= $username.' you are not registered' .header("refresh: 6; url=".URL);
				$this->view->content='Please try again later, or use another email address.';
				die;
			}
			$header = 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$header .= "From: noreply@Socialize\r\n";
			$message = '<html><head><title></title></head><body>Welcome to Socialize ' .$username. ', <br /><br />
						      We are really happy to see you here! <br />
						      <a href="'.URL.'user/activate/'.sha1($email).'">Please use this link to activate your account</a>.<br /><br />
						      Socialize admin.
						      </body></html>';
			mail($email, "Welcome to Socialize" , $message, $header );
			$this->view->render('check/index');
		}else{
		  header("location: ".URL);
		}
	}

	public function activate($email){
	  if($this->model->activate($email) == 1){
      $this->view->title= 'You are succesfully activated' .header("refresh: 6; url=".URL);
      $this->view->content= 'You can now log in!';
	  }else {
      $this->view->title= 'Oops looks like an error!' .header("refresh: 6; url=".URL);
      $this->view->content= 'You are already activated, if not notify one of our admins!';
	  }
	  $this->view->render('check/index');
	}

	function profile($username = false){
		$this->view->item = 'profile';
		if ($this->model->userinfo($username) !== null) {
			$this->view->userinfo = $this->model->userinfo($username);
			if ($username == Session::get('username')) {
				$this->view->render('profile/private');
			} else { $this->view->render('profile/index'); }
		} else {
			$this->_error($username);
		}
	}

	private function _error($username){
		$this->view->title= 'User ' .$username. ' not found!';
		$this->view->content= 'Check your spelling or you are searching for a user that does not exist!';
		$this->view->render('check/index');
	}
}
