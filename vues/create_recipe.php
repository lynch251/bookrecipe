<!-- Ajouter une recette-->
<div class="row">
<div class="col-lg-6 offset-lg-3"></br><h3>Ajouter une recette</h3>
<?php if (isset($_GET['create_recipe']))
{
	 switch($_GET['page'])
	{
		case 0:
		{
			echo '
			<div class="alert alert-danger" role="alert">
			  Erreur de saisie !
			</div>
			';
		}
		break;
		case 1:
		{
			echo '
			<div class="alert alert-success" role="alert">
			  Recette ajoutée !
			</div>
			';
		}
		break;
		case 2:
		{
			echo '
			<div class="alert alert-danger" role="alert">
			  Merci de renseigner tous les champs !
			</div>
			';
		}
	}
}?>
<form action="index.php?page=create_recipe" method="post">
  <div class="form-group">
    <label for="titre">Titre</label>
    <input name="add_title" type="text" class="form-control" placeholder="Titre">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Recette</label>
    <textarea name="add_description" class="form-control" rows="5" placeholder="Recette..."></textarea>
  </div>
	<div class="form-group">
    <label for="exampleFormControlTextarea1">Ingrédients</label>
    <textarea name="add_ingredients" class="form-control" rows="5" placeholder="Ingrédients..."></textarea>
  </div>
	<div class="dropdown">
		Sélectionner une catégorie :</br>
			<div class="form-check">
			<?php foreach($showCategories as $element)
			{
				echo '
				<label class="form-check-label">
				<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="'.$element->getIdCategorie().'">
				'.$element->getIntituleCategorie().'
				</label></br>
				';
			}?>
		</div>
	</div>
   <div class="form-group">
  Pour ajouter une image, créez d'abord la recette puis modifiez la.
  </div>
  <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
</div>
</div>
</br>
