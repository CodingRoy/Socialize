<?php
class View {
	function __construct(){
	}

	public function render($name){
			require 'view/header.php';
			require 'view/' .$name. '.php';
			require 'view/footer.php';
		}
	}
}
