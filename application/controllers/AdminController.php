<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

	public function loginAction() {
	    require $this->lang;
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/review');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
			    $msg = $this->model->error;
				$this->view->message('error', ${"txt_$msg"});
			}
            
            $this->view->redirect('admin/review');
		}
		$this->view->render('');
	}

    public function reviewAction() {
        require $this->lang;
        $vars = [
            'list' => $this->model->reviewList(),
        ];
        $this->view->render($txt_review, $vars);
    }

	public function logoutAction() {
		unset($_SESSION['admin']);
		$this->view->redirect('admin');
	}

}