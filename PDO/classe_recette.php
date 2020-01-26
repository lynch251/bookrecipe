<!-- MODELE -->
<?php
class Recette
{
	private $_id;
	private $_title;
	private $_description;
	private $_date_creation_recipe;
	private $_mark_recipe;
	private $_picture_recipe;
	private $_id_user;
	private $_ingredients;

	// Constructeur
	public function __construct($id, $title, $description, $date_creation_recipe, $mark_recipe, $id_user, $ingredients, $picture_recipe)
	{
		$this->_id = $id;
		$this->_title = $title;
		$this->_description = $description;
		$this->_date_creation_recipe = $date_creation_recipe;
		$this->_mark_recipe = $mark_recipe;
		$this->_id_user = $id_user;
		$this->_ingredients = $ingredients;
		$this->_picture_recipe = $picture_recipe;
	}
	// Accesseur ou getters
	public function getId()
	{
		return $this->_id;
	}
	public function getTitle()
	{
		return $this->_title;
	}
	public function getDescription()
	{
		return $this->_description;
	}
	public function getDateCreationRecipe()
	{
		return $this->_date_creation_recipe;
	}
	public function getMarkRecipe()
	{
		return $this->_mark_recipe;
	}
	public function getPictureRecipe()
	{
		return $this->_picture_recipe;
	}
	public function getIdUser()
	{
		return $this->_id_user;
	}
	public function getIngredients()
	{
		return $this->_ingredients;
	}

	// Constructeurs ou Setters
	public function setId($set_id)
	{
		$this->_id = $set_id;
	}
	public function setTitle($set_title)
	{
		$this->_title = $set_title;
	}
	public function setDescription($set_decription)
	{
		$this->_description = $set_description;
	}
	public function setDateCreationRecipe($set_dateCreationRecipe)
	{
		$this->_date_creation_recipe = $set_dateCreationRecipe;
	}
	public function setMarkRecipe($set_markRecipe)
	{
		$this->_mark_recipe = $set_markRecipe;
	}
	public function setPictureRecipe($set_pictureRecipe)
	{
		$this->_picture_recipe = $set_pictureRecipe;
	}
	public function deleteRecipe($id_recipe)
	{
		include('connexion_bdd.php');
		$req = $bdd->prepare('DELETE FROM recette WHERE id_recipe = :id_recipe');
		$req->execute(array(
			'id_recipe' => $id_recipe));
	}
	public function modifyRecipe($title, $description)
	{
		include('connexion_bdd.php');
		$req = $bdd->prepare('UPDATE recette SET title = :title, description = :description');
		$req->execute(array(
			'title' => $title,
			'description' => $description));
	}

}
