<?php
class Index extends Controller {
	function __construct() {
		parent::__construct();
			Session::init();
			$logged = Session::get('loggedIn');
	}

	function index() {
		$this->view->item = 'index';
		$this->view->render('index/index');
	}

	function settings() {
		$this->view->item = 'settings';
		$this->view->render('index/settings');
	}

	function logout() {
			Session::destroy();
			header('location: ' .URL);
			exit;
	}
}
