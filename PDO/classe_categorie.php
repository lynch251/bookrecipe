<?php
class Categorie
{
  private $id_categorie;
  private $intitule_categorie;

  public function __construct($id_categorie, $intitule_categorie)
  {
    $this->id_categorie = $id_categorie;
    $this->intitule_categorie = $intitule_categorie;
  }
  public function getIdCategorie()
  {
    return $this->id_categorie;
  }
  public function getIntituleCategorie()
  {
    return $this->intitule_categorie;
  }
}

 ?>
