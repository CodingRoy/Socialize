<?php
class Login extends Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->view->item = 'login';
		$this->view->render('login/index');
	}

	function run(){
		$password = Hash::create('md5', $_POST['password']);
		$username = ucfirst($_POST['username'])
		$this->model->run($username, $password);
	}
}
