<?php

namespace application\lib;

use PDO;

class Db {

	protected $db;
	
	public function __construct() {
		$config = require 'application/config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
		$this->db->exec("set names utf8");
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_null($val)) {
					$type = PDO::PARAM_NULL;
				} elseif (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val ?? NULL, $type);
			}
		}
		$stmt->execute();
		//$this->debugQuery($stmt, $sql, $params);
		return $stmt;
	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

	// private function debugQuery($stmt, $sql = null, $params = null) {
	// 		$error_array = $stmt->errorInfo();
	// 		if(!empty($params)) $fullquery = $this->getFullQuery($sql, $params);
	// 		if($error_array && !empty($error_array[1])){
	// 			if(!empty($fullquery)) {
	// 				file_put_contents(__DIR__.'/db_error.log', date('Y-m-d H:i:s') . PHP_EOL . $fullquery . PHP_EOL . print_r($error_array, true) . PHP_EOL, FILE_APPEND);
	// 			} else {
	// 				file_put_contents(__DIR__.'/db_error.log', date('Y-m-d H:i:s') . PHP_EOL . $sql . PHP_EOL . print_r($error_array, true) . PHP_EOL, FILE_APPEND);
	// 			}
	// 		} else {
	// 			if(!empty($fullquery)) {
	// 				file_put_contents(__DIR__.'/db_error.log', date('Y-m-d H:i:s') . PHP_EOL . $fullquery . PHP_EOL, FILE_APPEND);
	// 			} else {
	// 				file_put_contents(__DIR__.'/db_error.log', date('Y-m-d H:i:s') . PHP_EOL . $sql . PHP_EOL, FILE_APPEND);
	// 			}
	// 		}
	// 	}
		
	// 	private function getFullQuery($sql, $params) {
	// 		if(!empty($params)) {
	// 			$keys = array();
	// 			foreach ($params as $key => $value) {
	// 				if (is_string($key)) {
	// 					$keys[] = '/:'.$key.'/';
	// 				} else {
	// 					$keys[] = '/[?]/';
	// 				}
	// 				if(is_string($value)) {
	// 					$params[$key] = '"'.$value.'"';
	// 				} elseif(is_null($value)) {
	// 					$params[$key] = 'NULL';
	// 				}
	// 			}
	// 			$query = preg_replace($keys, $params, $sql);
	// 		}
	// 		return $query;
	// 	}

}