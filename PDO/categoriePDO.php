<?php
require_once('Manager.php');
class CategoriePDO extends Manager
{
  public function getAll()
  {
    $categorie = array();
    $db = $this->dbConnect();
    $req = $db->query('SELECT * FROM categorie ORDER BY intitule_categorie asc');
    while ($donnees = $req->fetch())
    {
      //$recipe[] = $donnees['title'], ;
      $categorie[] = new Categorie($donnees['id_categorie'], $donnees['intitule_categorie']);
    }
    return $categorie;
  }
  public function getOne($idCategorie)
  {
    $categorie = array();
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM categorie ORDER BY intitule_categorie asc WHERE id_categorie = :id_categorie');
    $req->execute(array(
      'id_categorie' => $idCategorie
    ));
    if ($donnees = $req->fetch())
    {
      //$recipe[] = $donnees['title'], ;
      $categorie[] = new Categorie($donnes['id_categorie'], $donnees['intitule_categorie']);
    }
    return $categorie;
  }
  public function getOneId($intitule_categorie)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id_categorie FROM categorie WHERE intitule_categorie = :intitule_categorie');
    $req->execute(array(
      'intitule_categorie' => $intitule_categorie
    ));
    if ($donnees = $req->fetch())
    {
      //$recipe[] = $donnees['title'], ;
      $id_categorie = new Categorie($donnees['id_categorie'], $donnees['intitule_categorie']);
    }
    return $id_categorie;
  }
}
?>
