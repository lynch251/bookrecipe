<!-- MODELE -->
<?php
class User
{
	private $_id_user;
	private $_email;
	private $_pwd;
	private $_is_admin;
	private $_is_check;
	// Constructeur
	public function __construct($id_user, $email, $pwd)
	{
		$this->_id_user = $id_user;
		$this->_email = $email;
		$this->_pwd = $pwd;
		$this->_is_admin=null;
		$this->_is_check=null;
	}
	// Accesseur ou getters
	public function getId()
	{
		return $this->_id_user;
	}
	public function getEmail()
	{
		return $this->_email;
	}
	public function getPwd()
	{
		return $this->_pwd;
	}
	public function getIsCheck()
	{
		return $this->_is_check;
	}
	public function getIsAdmin()
	{
		return $this->_is_admin;
	}
	// Constructeurs ou Setters
	public function setId_user($set_id_user)
	{
		$this->_id_user = $set_id_user;
	}
	public function setEmail($set_email)
	{
		$this->_email = $set_email;
	}
	public function setPwd($set_pwd)
	{
		$this->_pwd = $set_pwd;
	}
	public function setIsCheck($is_check)
	{
		$this->_is_check = $is_check;
	}
	public function setIsAdmin($is_check)
	{
		$this->_is_admin = $is_admin;
	}
	public function deleteUser($id_user)
	{
		include('connexion_bdd.php');
		$req = $bdd->prepare('DELETE FROM user WHERE id_user = :id_user');
		$req->execute(array(
			'id_user' => $id_user));
	}
	public function modifyUser($modify_email, $modify_pwd)
	{
		include('connexion_bdd.php');
		$req = $bdd->prepare('UPDATE user SET email = :email, pwd = :pwd');
		$req->execute(array(
			'email' => $modify_email,
			'pwd' => $modify_pwd));
	}

}
