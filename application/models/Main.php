<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	 public function reviewValidate($post) {

        if (isset($post['name']) && !empty($post['name'])) {
            if (!preg_match('/.{2,96}/', $post['name'])){
                $this->error = 'error_name_length';
                return false;
            }
        }else{
            $this->error = 'error_empty';
            return false;
        }

        if (!isset($post['phone']) && empty($post['phone'])) {
            $this->error = 'error_empty';
            return false;
        }

        if (!isset($post['question']) && empty($post['question'])) {
            $this->error = 'error_empty';
            return false;
        }

        if (isset($post['email']) && !empty($post['email'])) {
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                $this->error = 'error_email';
                return false;
            }
        }else{
            $this->error = 'error_empty';
            return false;
        }

        return true;
    }

    public function reviewAdd($post) {
        $params = [
            'name' => $post['name'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'question' => $post['question'],
            'review_date' => date('Y-m-d H:i:s'),
        ];
               
        $this->db->query("INSERT INTO review (name,phone,email,question,review_date) VALUES (:name,:phone,:email,:question,:review_date)", $params);
        return $this->db->lastInsertId();
    }
}