<?php

class Error extends Controller {
	function __construct(){
		parent::__construct();
	}

	function index($url){
		$this->view->msg = $url. ' not found!';
		$this->view->render('error/index');
	}
}
