<?php

class User
{
	public function checkPostData($postData)
	{
	
		return htmlspecialchars(strip_tags($postData));
	}
	
	public function checkName($name)
	{
		if (strlen($name) >= 3) {
			return true;
		}
		return false;
	}
	
	public function register($name, $password)
	{
		$db = new Db();
		$dbConnection = $db->getConnection();
		
		$sql = 'INSERT INTO users (name, password) '
			. 'VALUES (:name, :password)';
		
		$result = $dbConnection->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		
		return $result->execute();
	}
	
	public function checkPassword($password)
	{
		if (strlen($password) >= 5) {
			return true;
		}
		return false;
	}
	
	public function checkUserData($name)
	{
		$db = new Db();
		$dbConnection = $db->getConnection();
		
		$sql = 'SELECT `id`, `name`, `password`, `role` FROM `users` WHERE name = :name';
		$result = $dbConnection->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->execute();
		$user = $result->fetch();
		
		if($user){
			return $user;
		}
		
		return false;
		
	}
	
	public static function auth($user)
	{
		$_SESSION['logged_user_id'] = $user['id'];
		$_SESSION['logged_user_name'] = $user['name'];
		$_SESSION['logged_user_role'] = $user['role'];
	}
	
	public static function checkLogged()
	{
		if(isset($_SESSION['logged_user_name'])){
			return $_SESSION['logged_user_name'];
		}
		header("Location: /page/login");
		return true;
	}
	
	public static function isRole()
	{
		if(isset($_SESSION['logged_user_role'])){
			return $_SESSION['logged_user_role'];
		}
		header("Location: /page/error");
		return true;
	}
	
	public static function getUserRole($id)
	{
		$id = intval($id);
		
		if($id){
			$db = new Db();
			$dbConnection = $db->getConnection();
			$sql = 'SELECT `role` FROM users WHERE id = :id';
			$result = $dbConnection->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();
			return $result->fetch();
		}
	}
	
	public function getUsers()
	{
		$db = new Db();
		$dbConnection = $db->getConnection();
		$result = $dbConnection->query('SELECT `id`, `name` FROM `users`');
		
		return $result->fetchAll();
	}
		
}













