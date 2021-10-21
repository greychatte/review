<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'default';
    }

    public function reviewAction() {
        require $this->lang;
        if (!empty($_POST)){
            if (!$this->model->reviewValidate($_POST)) {
                $msg = $this->model->error;
                $this->view->message('error', ${"txt_$msg"});
            }

            $id = $this->model->reviewAdd($_POST);
            if (!$id) {
                $this->view->message('error', $txt_sql_error);
            }
            $this->view->message('success', $txt_review_added, '/review');
        }
        $this->view->render('');
    }
}