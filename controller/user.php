<?php
class User extends Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->profile();
	}

	//Set POST values to variables, check if the recaptcha response is succesfull, check user input, go to the checkdata function or show error.
	public function create(){
		$username	= ucfirst($_POST['username']);
		$email		= $_POST['email'];
		$password	= Hash::create('md5', $_POST['password']);
		$recaptcha  = "https://google.com/recaptcha/api/siteverify";
		$response = file_get_contents($recaptcha."?secret=".SECRETKEY."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
		$data = json_decode($response);
		if($username != null &&$username < 30 && preg_match("/^[a-zA-Z0-9,_-]*$/",$username) && preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",htmlspecialchars($email)) && $password != null){
			if(isset($data->success) && $data->success==true){
				$this->checkdata($username,$email,$password);
			}else {
				$this->view->title= 'reCAPTCHA failed, are you a robot?'.header("refresh: 8; url=".URL);
				$this->view->content='Before pressing register please vink the box to verify that you are not a robot';
				$this->view->render('check/index');
			}
		}else {
			header("location: ".URL); //we will catch errors on input with an js file
		}
	}

	//Checks lenght of #username and tries to execute the model function create if it fails it should return an error
	private function checkdata($username,$email,$password){
		$checkdata = $this->model->create($username, $email, $password);
		if($checkdata == 1) {
			$header = 'MIME-Version: 1.0' . "\r\n";
 			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 			$header .= "From:".MAIL."\r\n";
 			$message = '<html><head><title></title></head><body>Welcome to Socialize ' .$username. ', <br /><br />
 						      We are really happy to see you here! <br />
 						      <a href="'.URL.'user/activate/'.sha1($email).'">Please use this link to activate your account</a>.<br /><br />
 						      Socialize admin.
 						      </body></html>';
 			mail($email, "Welcome to Socialize" , $message, $header );
			$this->view->title= $username.' you are succesfull registered' .header("refresh: 10; url=".URL);
			$this->view->content= 'We\'ve send you an email to your email adress containing a link, please click this link to activate your account.<br />Be sure to check your junk mail!';
		}else {
			$this->view->title= 'Whoa! This looks like an error!'.header("refresh: 8; url=".URL);
			$this->view->content= $checkdata;
		}
		$this->view->render('check/index');
	}

	// Activates an user bij checking the encoded email address in the url.
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

	//Loads an user profile by checking the username in the url
	public function profile($username = false){
		$username = ucfirst($username);
		$this->view->item = 'profile';
		$userinfo = $this->model->userinfo($username);
		if ($userinfo !== null) {
			$this->view->userinfo = $userinfo;
			if ($username == Session::get('username')) {
				$this->view->render('profile/private');
			}else { $this->view->render('profile/index'); }
		}else {
			$this->view->title= 'User ' .$username. ' not found!';
			$this->view->content= 'Check your spelling or you are searching for a user that does not exist!';
			$this->view->render('check/index');
		}
	}
}
