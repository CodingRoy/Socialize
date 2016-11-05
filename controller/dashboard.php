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

// show certain posts by checking the @param string $order
    function index($order = false) {
      $this->view->item = 'dashboard';
      switch ($order) {
        case 'user':
          $this->view->overview = $this->model->userposts();
          $this->view->render('dashboard/index');
          break;
        case 'favourites':
          $this->view->overview = $this->model->overview($order);
          $this->view->render('dashboard/favourites');
          break;
        default:
          $this->view->overview = $this->model->overview($order);
          $this->view->render('dashboard/index');
          break;
      }
    }

// sets $_POST values to @params string $ptitle, $pcontent
    function post() {
      $ptitle = ucfirst($_POST['Post_title']);
      $pcontent = str_replace("\r\n" , '', $_POST['Post']);
      $pcontent = filter_var(ucfirst($pcontent), FILTER_SANITIZE_SPECIAL_CHARS); //No special Characters
      if (preg_match("/^[a-zA-Z0-9 ?!#-]*$/",$ptitle)) {
        $this->model->post($ptitle, $pcontent);
        header('location: ' .URL. 'dashboard');
      }
    }

// mark post as favourite with @param int $post_id
    function fav($post_id) {
      $this->model->fav($post_id);
      header('location: ' .URL. 'dashboard#'.$post_id);
    }

// check model to delete a post
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
