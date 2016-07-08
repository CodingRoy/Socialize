<?php
class Dashboard extends Controller {
    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' .URL. 'login');
            exit;
        }
    }

    function index() {
        $this->view->item = 'dashboard';
        $this->view->overview = $this->model->overview();
        $this->view->render('dashboard/index');
    }

    function post() {
        $this->model->post();
        header('location: ' .URL. 'dashboard');
    }

    function profile(){
      $this->view->item = 'profile';
      $this->view->render('dashboard/profile');
    }

    function logout() {
        Session::destroy();
        header('location: ' .URL);
        exit;
    }
}
