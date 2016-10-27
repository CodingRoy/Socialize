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

    function index($order = false) {
      $this->view->item = 'dashboard';
      $this->view->overview = $this->model->overview($order);
      $this->view->render('dashboard/index');
    }

    function userposts($type = false) {
      switch ($type) {
        case "user":
          $type = "user_id";
          break;
        case "favourites":
          $type = "fuser_id";
          break;
        default:
          $this->index();
          exit;
      }
      $this->view->item = 'dashboard';
      $this->view->overview = $this->model->userposts($type);
      $this->view->render('dashboard/index');
    }

    function post() {
      $ptitle = ucfirst($_POST['Post_title']);
      $pcontent = str_replace("\r\n" , '', $_POST['Post']);
      $pcontent = filter_var(ucfirst($pcontent), FILTER_SANITIZE_SPECIAL_CHARS); //No special Characters
      if (preg_match("/^[a-zA-Z0-9 ?!#-]*$/",$ptitle)) {
        $this->model->post($ptitle, $pcontent);
        header('location: ' .URL. 'dashboard');
      }
    }

    function favposts() {
      $this->view->item = 'dashboard';
      $this->view->overview = $this->model->favposts();
      $this->view->render('dashboard/index');
    }

    function delete($post_id) {
      $postdel = $this->model->delete($post_id);
      if($postdel === 1) {
        header('location: ' .URL. 'dashboard');
      }else {
        $this->view->title= 'Not allowed!' .header("refresh: 6; url=".URL."dashboard");
        $this->view->content= "It looks like you're trying to delete a post that's not yours!" ;
        $this->view->render('check/index');
      }
    }
}
