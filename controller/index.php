<?php
class Index extends Controller {
	function __construct() {
		parent::__construct();
			Session::init();
			$logged = Session::get('loggedIn');
	}

	function index() {
		$this->view->render('index/index');
	}

	function logout() {
			Session::destroy();
			header('location: ' .URL);
			exit;
	}
}
