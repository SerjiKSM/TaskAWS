<?php

class Role implements AdminInterface
{
	
	public function getRole()
	{
		User::checkLogged();
		$userRole = User::getUserRole($_SESSION['logged_user_id']);
		return $userRole['role'];
	}
	
}