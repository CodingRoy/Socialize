<?php
class Error extends Controller {
	function __construct(){
		parent::__construct();
	}

// main eerror page
	function index(){
		$this->view->msg = 'Error! Page not found!';
		$this->view->render('error/index');
	}
}
