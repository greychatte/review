<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($title, $vars = []) {
		extract($vars);
		$path = 'application/views/'.$this->path.'.php';
		$lang = 'ru';
		if (file_exists('application/config/languages/'.$lang.'.php')) {
			require 'application/config/languages/'.$lang.'.php';
		} else {
			require 'application/config/languages/ru.php';
		}
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/'.$this->layout.'.php';
		}
	}

	public function redirect($url) {
		header('location: /'.$url);
		exit;
	}

	public static function errorCode($code) {
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit;
	}

	public function message($status, $message, $url = false, $ans = false) {
	    $params = ['status' => $status, 'message' => $message];
	    if($url) $params['url'] = $url;
	    if($ans) $params['ans'] = $ans;
		exit(json_encode($params, JSON_UNESCAPED_UNICODE));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

}	