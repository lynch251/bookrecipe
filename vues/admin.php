<!-- VUE : Affichage dans un tableau -->
<div class="card text-center">
  <div class="card-body">
   <h2>Administration</h2>
  </div>
</div></br>
<div class="col-lg-6 offset-lg-3">
  <div class="dropdown text-center">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Utilisateurs
    <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <?php
      if (isset($getAllUser)) {
        foreach($getAllUser as $element)
        {
          echo '
          <li><a href="index.php?page=admin&user='.$element->getId().'">Utilisateur : '.$element->getEmail().'</a></li>';
        }
      }?>
    </ul>
  </div>
    <?php
    if (isset($modifyOneUser))
    {
            if ($modifyOneUser->getIsCheck() != 1)
            {
                echo '<a href="index.php?page=admin">< Retour</a></br><i><u>'.$modifyOneUser->getEmail().'</u></i>';
                echo '
                <form action="index.php?page=validerUtilisateur&user='.$modifyOneUser->getId().'" method="post">
                  <p>Valider le compte utilisateur :</p>
                  <div>
                    <input type="radio" id="contactChoice1"
                     name="check" value="1">
                    <label for="contactChoice1">Confirmer l\'inscription</label>
                    <input type="radio" id="contactChoice2"
                     name="check" value="0">
                    <label for="contactChoice2">Refuser l\'inscription</label>
                  </div>
                  <div>
                    <button type="submit">Envoyer</button>
                  </div>
                </form>
                ';
              }
              else
              {
                echo '<a href="index.php?page=admin">< Retour</a></br>'.$modifyOneUser->getEmail().' a un compte enregistré et valide.';
              }
            }
    ?>
</div>
