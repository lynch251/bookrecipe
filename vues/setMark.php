<!-- VUE : Affichage dans un tableau -->
<div class="card text-center">
  <div class="card-body">
   <h2>Noter les recettes</h2>
  </div>
</div></br>
<div class="col-lg-6 offset-lg-3">
  <div class="dropdown text-center">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Sélectionner une recette
    <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <?php
      if (isset($setMarkSuccess)) {
        foreach($setMarkSuccess as $element)
        {
          echo '
          <li><a href="index.php?page=noter&recette='.$element->getId().'" title="'.$element->getId().'">'.$element->getTitle().'</a></li>';
        }
      }?>
    </ul>
  </div>
    <?php
    if (isset($_GET['recette']) && !empty($_GET['recette']))
    {
      echo '<i><u>'.$nom->getTitle().'</u></i>';
      echo '
      <form action="index.php?page=enregistrerNote&recette='.$recette.'" method="post">
        <p>Veuillez choisir une note :</p>
        <div>
          <input type="radio" id="contactChoice1"
           name="note" value="1">
          <label for="contactChoice1">1 </label>

          <input type="radio" id="contactChoice2"
           name="note" value="2">
          <label for="contactChoice2">2 </label>

          <input type="radio" id="contactChoice3"
           name="note" value="3">
          <label for="contactChoice3">3 </label>

          <input type="radio" id="contactChoice3"
           name="note" value="4">
          <label for="contactChoice3">4 </label>

          <input type="radio" id="contactChoice3"
           name="note" value="5">
          <label for="contactChoice3">5 </label>
        </div>
        <div>
          <button type="submit">Envoyer</button>
        </div>
      </form>
      ';
    }?>
</div>
