<!-- VUE : Affichage dans un tableau -->
</br><div class="text-center">
  <?php
  foreach($categories as $element)
  {
  ?>
    <button class="btn btn-primary" type="submit"><a class="text-white" style="font-size:12px; font-weight:normal;" href="index.php?page=read_recipe&id_categorie=<?= $element->getIdCategorie()?>"/><?= $element->getIntituleCategorie()?></a></button>
  <?php
  }
  ?>
</div>
</br>
<div class="col-lg-8 offset-lg-2">
  <?php
  if (isset($recettes))
  {
      foreach($recettes as $element)
      {?>
        <table class="table">
          <tbody>
            <tr>
              <td style="width:25%;"><p class="mb-3 medium"></br></br></br><?= $element->getIngredients();?></p></td>
              <td style="width:75%;">
                <h1 class="section-heading mb-3">
                  <span class="section-heading-upper"><?=$element->getTitle();?></span></br>
                </h1>
                <p class="mb-5 medium"><b>Ajoutée le : <?= $element->getDateCreationRecipe();?></b></p>
                <p class="mb-3"><img src="<?= $element->getPictureRecipe();?>"></p>
                <p class="mb-5" style="font-size:12px;"><?= $element->getDescription();?>
                <form action="index.php?page=enregistrerNote&recette='.$recette.'" method="post">
                  <div class="rating"><b>Note : <?= round($element->getMarkRecipe(),1, PHP_ROUND_HALF_UP);?>/5</b>
                  <a href="index.php?page=enregistrerNote&recette=<?= $element->getId();?>&note=1" title="Donner 1 étoile">☆</a>
                  <a href="index.php?page=enregistrerNote&recette=<?= $element->getId();?>&note=2" title="Donner 2 étoiles">☆</a>
                  <a href="index.php?page=enregistrerNote&recette=<?= $element->getId();?>&note=3" title="Donner 3 étoiles">☆</a>
                  <a href="index.php?page=enregistrerNote&recette=<?= $element->getId();?>&note=4" title="Donner 4 étoiles">☆</a>
                  <a href="index.php?page=enregistrerNote&recette=<?= $element->getId();?>&note=5" title="Donner 5 étoiles">☆</a>
                  </div>



                  </form>




                </p>
            <div class="intro-button mx-auto">
              <!--  bouton de suppression -->
              <?php if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user']) && $_SESSION['id_user'] == $element->getIdUser())
              {?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?= $element->getId();?>">
                  Supprimer
                </button>
                <!-- Modal -->
                <div class="modal" id="modal<?= $element->getId();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Etes-vous sûr de vouloir supprimer cette recette ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary"><a class="text-white" href="index.php?page=deleteRecipe&recipe=<?= $element->getId()?>"/>Supprimer</a></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- bouton de modification -->
                <a href="index.php?page=modifyRecipe&id_recipe=<?= $element->getId()?>"/>Modifier</a>
                <?php
              }?>
            </div>
          </td>
          </tr>
        </tbody>
      </table>
          <?php
      }
  }
      ?>
</div>
