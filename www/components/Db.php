<?php

class Db {
	
	public function getConnection(){
		
		$paramsPath = ROOT.'/config/db_params.php';
		$params = include($paramsPath);
		
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		
		try{
			$db = new PDO($dsn, $params['user'], $params['password']);
			$db->exec("set names utf8");
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
			
		return $db;
		
	}
	
}