<?php
class About extends Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->view->item = 'about';
		$this->view->render('about/index');
	}
}
