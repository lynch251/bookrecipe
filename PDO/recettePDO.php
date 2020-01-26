<?php
require_once('Manager.php');
class RecettePDO extends Manager
{
	public function getAllRecipe()
	{
		$recipe = array();
		$db = $this->dbConnect();
		$req = $db->query('SELECT id_recipe, title, description, ingredients, DATE_FORMAT(date_creation_recipe, \'%d/%m/%Y à %Hh%imin%ss\') as date_creation_recipe, mark_recipe, picture_recipe, id_user FROM recette ORDER BY date_creation_recipe desc');
		while ($donnees = $req->fetch())
		{
			//$recipe[] = $donnees['title'], ;
			$recipe[] = new Recette($donnees['id_recipe'], $donnees['title'], $donnees['description'], $donnees['date_creation_recipe'], $donnees['mark_recipe'], $donnees['id_user'], $donnees['ingredients'], $donnees['picture_recipe']);
		}
		return $recipe;
	}
	public function getAll($id_categorie)
	{
		  $recipe = array();
			$db = $this->dbConnect();
			$req = $db->prepare('SELECT id_recipe, title, description, ingredients, DATE_FORMAT(date_creation_recipe, \'%d/%m/%Y à %Hh%imin%ss\') as date_creation_recipe, mark_recipe, picture_recipe, id_user FROM recette WHERE id_categorie = :id_categorie ORDER BY date_creation_recipe desc');
			$req->execute(array(
				'id_categorie' => $id_categorie
			));
			while ($donnees = $req->fetch())
			{
				//$recipe[] = $donnees['title'], ;
				$recipe[] = new Recette($donnees['id_recipe'], $donnees['title'], nl2br($donnees['description']), $donnees['date_creation_recipe'], $donnees['mark_recipe'], $donnees['id_user'], nl2br($donnees['ingredients']), $donnees['picture_recipe']);
			}
			return $recipe;
	}
	public function setAll($title, $description, $date_creation_recipe, $id_user, $idCategorie, $ingredients)
	{
			$db = $this->dbConnect();
			$req = $db->prepare('INSERT INTO recette (title, description, date_creation_recipe, id_user, id_categorie, ingredients) VALUES (:title, :description, :date_creation_recipe, :id_user, :id_categorie, :ingredients)');
			$req->execute(array(
				'title' => $title,
				'description' => $description,
				'date_creation_recipe' => $date_creation_recipe,
				'id_user' => $id_user,
				'id_categorie' => $idCategorie,
				'ingredients' => $ingredients
			));
			$req->closeCursor();
			return $req;
	}
	public function getOne($id_recipe)
	{
		$recipe ;
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM recette WHERE id_recipe = :id_recipe');
			$req->execute(array(
				'id_recipe' => $id_recipe));
		if ($donnees = $req->fetch())
		{
			//$recipe[] = $donnees['title'], ;
			$recipe = new Recette($donnees['id_recipe'], $donnees['title'], $donnees['description'], $donnees['date_creation_recipe'], $donnees['mark_recipe'], $donnees['id_user'], $donnees['ingredients'], $donnees['picture_recipe']);
		}
		return $recipe;
	}
	public function modifyOne($id_recipe, $title, $description, $id_user, $ingredients)
	{
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE recette SET title = :title, description = :description, ingredients = :ingredients WHERE id_recipe = :id_recipe AND id_user = :id_user');
			$modifyOneSuccess = $req->execute(array(
				'title' => $title,
				'description' => $description,
				'id_recipe' => $id_recipe,
				'id_user' => $id_user,
				'ingredients' => $ingredients
			));
			$req->closeCursor();
			if ($modifyOneSuccess)
			{
				return $modifyOneSuccess;
			}
			return $modifyOneSuccess;
	}
	public function modifyOnePicture($id_recipe, $id_user)
	{
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE recette SET picture_recipe = :picture_recipe WHERE id_recipe = :id_recipe AND id_user = :id_user');
			$modifyOneSuccess = $req->execute(array(
				'id_recipe' => $id_recipe,
				'id_user' => $id_user,
				'picture_recipe' => 'public/images/'.$id_recipe.'.jpg'
			));
				return $modifyOneSuccess;
	}
	public function modifyOneDescription($id_recipe, $modify_description, $id_user)
	{
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE recette SET description = :description WHERE id_recipe = :id_recipe AND id_user = :id_user');
			$modifyOneSuccess = $req->execute(array(
				'id_recipe' => $id_recipe,
				'id_user' => $id_user,
				'description' => $description
			));
			$req->closeCursor();
			return $modifyOneSuccess;
	}
	public function modifyOneIngredients($id_recipe, $modify_ingredients, $id_user)
	{
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE recette SET ingredients = :ingredients WHERE id_recipe = :id_recipe AND id_user = :id_user');
			$modifyOneSuccess = $req->execute(array(
				'id_recipe' => $id_recipe,
				'id_user' => $id_user,
				'ingredients' => $ingredients
			));
			$req->closeCursor();
			return $modifyOneSuccess;
	}
	public function modifyOneTitle($id_recipe, $modify_title, $id_user)
	{
			$db = $this->dbConnect();
			$req = $db->prepare('UPDATE recette SET title = :title WHERE id_recipe = :id_recipe AND id_user = :id_user');
			$modifyOneSuccess = $req->execute(array(
				'id_recipe' => $id_recipe,
				'id_user' => $id_user,
				'title' => $modify_title
			));
			return $modifyOneSuccess;
	}
	public function setMark($id_recipe, $mark)
	{
		$db = $this->dbConnect();
		// Insert mark in DDB
		$req = $db->prepare('INSERT INTO note (value, id_recipe) VALUES (:value,:id_recipe)');
		$setMark = $req->execute(array(
			'id_recipe' => $id_recipe,
			'value' => $mark
		));
		$req->closeCursor();
		// Updating average mark
		$req0 = $db->prepare('SELECT COUNT(id_mark) as sommeNotes,sum(value) as totalNotes  FROM note WHERE id_recipe = :id_recipe');
		$req0->execute(array('id_recipe' => $id_recipe
		));
		$res0 = $req0->fetch();
		$sommeDesNotes = $res0["sommeNotes"];
		$totalDesNotes = $res0["totalNotes"];

				// Processing
				$average = $totalDesNotes/$sommeDesNotes;

		// Updating

		$req = $db->prepare('UPDATE recette SET mark_recipe = :mark_recipe WHERE id_recipe = :id_recipe');
		$setMarkSuccess = $req->execute(array(
			'id_recipe' => $id_recipe,
			'mark_recipe' => $average
		));
		$req->closeCursor();
		return $setMarkSuccess;
	}
	public function deleteRecipe($id_recipe)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM recette WHERE id_recipe = :id_recipe');
		$req->execute(array(
			'id_recipe' => $id_recipe));
	}
	public function setClock($clock_recipe)
	{

	}
}
