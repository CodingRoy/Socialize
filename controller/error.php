<?php

class Error extends Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->view->msg = 'Error! Page not found!';
		$this->view->render('error/index');
	}
}
