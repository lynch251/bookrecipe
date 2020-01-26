<?php
require_once('PDO/Manager.php');
class userPDO extends Manager
{
	public function login($email, $pwd)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM user WHERE email = :email');
		$req->execute(array(
			'email' => htmlspecialchars($email)
		));
		$result = $req->fetch();
		return $result;
	}
	public function logout()
	{
		// Supprimer les variables de session et de session
		$_SESSION = array();
		session_destroy();
		// Suppression des cookies de connexion automatique
		//setcookie('login', '');
		//setcookie('pass_hache','');
	}
	public function setUser($email, $pwd)
	{
		$db = $this->dbConnect();
		$pass_hache = password_hash($pwd, PASSWORD_DEFAULT);
		//Insertion
		$req = $db->prepare('INSERT INTO user (email, pwd) VALUES(:email, :pwd)');
		$setUserSuccess = $req->execute(array(
			'email' => $email,
			'pwd' => $pass_hache
		));
		$req->closeCursor();
		return $setUserSuccess;
	}
	public function getOne($email)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_user, email FROM user WHERE email = :email');
		$req->execute(array(
			'email' => $email
		));
		if ($donnees = $req->fetch())
		{
			$user[] = new User($donnees['email'], $donnees['id_user']);
		}
		return $user;
	}
	public function getUser($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_user, email, pwd FROM user WHERE id_user = :id_user');
		$req->execute(array(
			'id_user' => $id
		));
		if ($donnees = $req->fetch())
		{
			$user = new User($donnees['id_user'], $donnees['email'], $donnees['pwd']);
		}
		return $user;
	}
	public function getUserCheck($id)
	{

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT is_check FROM user WHERE id_user = :id_user');
		$req->execute(array(
			'id_user' => $id
		));
		$donnees = $req->fetch();
			return $donnees['is_check'];

	}
	public function getAll()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id_user, email, is_admin, is_check FROM user');
		$req->execute();

		while ($donnees = $req->fetch())
		{
			$user[] = new User($donnees['id_user'], $donnees['email'], $donnees['is_admin'], $donnees['is_check']);
		}
		return $user;
	}
	public function delete($id_user)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM user WHERE id_user = :id_user');
		$req->execute(array(
			'id_user' => $id_user
		));
		if ($req) {
			return $req;
		}
	}
	public function updateAdminOne($id_user, $is_check)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE user SET is_check = :is_check WHERE id_user = :id_user');
		$setUserSuccess = $req->execute(array(
			'id_user' => $id_user,
			'is_check' => $is_check
		));
		if ($setUserSuccess) {
			return $setUserSuccess;
		}
	}
}
