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
      $ptitle = ucfirst($_POST['Post_title']);
      $pcontent = filter_var(ucfirst($_POST['Post']), FILTER_SANITIZE_SPECIAL_CHARS); //No special Characters
      if (preg_match("/^[a-zA-Z0-9 !#-]*$/",$ptitle)) {
        $this->model->post($ptitle, $pcontent);
        header('location: ' .URL. 'dashboard');
      }
    }
}
