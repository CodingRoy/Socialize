<?php
class Controller {
	function __construct(){
		Session::init();
		$this->view = new View();
	}

	public function loadModel($name){
		$path = 'model/' . $name . '_model.php';

		if (file_exists($path)){
			require 'model/' . $name . '_model.php';
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}
}
