<!-- Ajouter une recette-->
<div class="col-lg-6 offset-lg-3"></br><h3>Modifier une recette</h3>
<?php
if (isset($_GET['id_recipe']))
{
    echo '
  <form action="index.php?page=modifyRecipe&id_recipe='.$_GET['id_recipe'].'" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="titre">Titre</label>
      <input name="modify_title" type="text" class="form-control" placeholder="'.$recipe->getTitle().'">
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Recette</label>
      <textarea name="modify_description" class="form-control" rows="5" placeholder="'.$recipe->getDescription().'"></textarea>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Ingrédients</label>
      <textarea name="modify_ingredients" class="form-control" rows="5" placeholder="'.$recipe->getIngredients().'"></textarea>
    </div>
     <div class="form-group">
     <label for="exampleFormControlTextarea1">Image</label>
     <img src="'.$recipe->getPictureRecipe().'" alt="Image de la recette"/>
      Joindre un fichier (.jpg ou jpeg, taille max 3Mo) :
      <input name="picture" type="file">
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
  </form>
  ';
}?>
</div>
</br>
