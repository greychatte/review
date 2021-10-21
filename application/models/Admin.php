<?php

namespace application\models;

use application\core\Model;
use application\lib\Browser;

class Admin extends Model {

	public function loginValidate($post) {
		$config = require 'application/config/admin.php';
        if ($config['login'] != $post['login'] || $config['password'] != $post['password']) {
            $login = preg_match("/^[a-zA-Z0-9_]+$/si", $post['login']);
            $password = preg_match("/[0-9a-zA-Z!@#$%^&*+_-]{6,32}/", $post['password']);
            if(empty($post['login']) || !$login) {
                $this->error = 'error_login';
                return false;
            }
    		$params = [
    			'login' => $post['login'],
    		];
    		$hash = $this->db->column("SELECT password FROM users WHERE login = :login", $params);

            $verify = password_verify($post['password'], $hash);
            if(empty($post['password']) || !$password || !$verify) {
                $this->error = 'error_password';
                return false;
            }
        } 
        $_SESSION['admin'] = 1;
    	return true;
	}

    public function reviewList() {
        $result = $this->db->row("SELECT * FROM review ORDER BY review_id DESC");
        return $result;
    }


}