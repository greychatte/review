<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;
	public $lang;

	public function __construct($route) {
		$this->route = $route;
        $this->view = new View($route);
		if (!$this->checkAcl()) {
            if ($route['controller'] == 'admin') {
                $this->view->redirect('admin');
            }
			View::errorCode(403);
		}
		$this->model = $this->loadModel($route['controller']);
		$this->lang = $this->selectLang();
	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function selectLang() {
		//$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
		// $lang = 'ua';
		$lang = 'ru';
		if (file_exists('application/config/languages/' . $lang . '.php')) {
			return 'application/config/languages/' . $lang . '.php';
		} else {
			return 'application/config/languages/ru.php';
		}
	}

	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}

}