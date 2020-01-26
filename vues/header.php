
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <title>Livre des recettes</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light active text-dark" style="color:rgba(0, 0, 0, 1);">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse h6" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item" style="background-color:#42bcf4;height:100%;padding:0;margin:0;position:absolute;left:0;top:0;">
        <a class="nav-link" href="http://chupin-pierre.fr"><b> < Revenir</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=welcome">Accueil</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?page=create_recipe">Créer une recette</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?page=read_recipe">Les recettes</a>
      </li>

      <?php
      if (!isset($_SESSION['id_user']))
      {
        echo '
        </ul>
        <ul class="navbar-nav  mt-2 mt-lg-0">
        <li class="nav-item pull-right">
          <a class="nav-link" href="index.php?page=connexion"><span class="fa fa-lock"></span></a>
        </li>
        <li class="nav-item pull-right">
        <a class="nav-link" href="index.php?page=inscription">Inscription</a>
      </li>
      </ul>
        ';
      }
      else
      {
        echo '
        </ul>
        <ul class="navbar-nav  mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
          </li>
        </ul>
        ';
        if (isset($_SESSION['admin']) && $_SESSION['admin'] != NULL) {
          echo '
          </ul>
          <ul class="navbar-nav  mt-2 mt-lg-0">
            <li class="nav-item pull-right">
              <a class="nav-link" href="index.php?page=admin">Administration</a>
            </li>
          </ul>';
        }
      }?>
    </ul>
  </div>
</nav>
<?php

if (isset($_GET['success']) || isset($success))
{
  if (isset($_GET['success']) && !empty($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']);
  }
  switch($success)
  {
    case "14":
      echo '<div class="alert alert-success text-center" role="alert">
      Action enregistrée.   
      </div>';
    break;
    case "13":
      echo '<div class="alert alert-danger text-center" role="alert">
      Votre compte n\'a pas été validé par l\'administrateur.
      </div>';
    break;
    case "12":
    {
      echo '
      <div class="alert alert-success text-center" role="alert">
      Ajout effectué !
      </div>
      ';
    }
    break;
    case "11":
    {
      echo '
      <div class="alert alert-success text-center" role="alert">
      Modification effectuée !
      </div>
      ';
    }
    break;
    case "10":
    {
      echo '
      <div class="alert alert-danger text-center" role="alert">
      Erreur de chargement de la page demandée !
      </div>
      ';
    }
    break;
    case "9":
    {
      echo '
      <div class="alert alert-danger text-center" role="alert">
      L\'image dépasse 3 Mo ou le fichier n\'a pas la bonne extension (.jpg ou .jpeg).
      </div>
      ';
    }
    break;
    case "8":
    {
      echo '<p><script type="text/javascript">alert(\'La note a bien été ajoutée !\')</script></p>';
    }
    break;
    case "7":
    {
      echo '<p><script type="text/javascript">alert(\'La recette a bien été ajoutée !\')</script></p>';
    }
    break;
    case "6":
    {
      echo '
      <div class="alert alert-danger text-center" role="alert">
      Saisissez des mots de passe identiques !
      </div>
      ';
    }
    break;
    case "5":
    {
      echo '
      <div class="alert alert-danger text-center" role="alert">
      L\'utilisateur existe déjà dans la base de données !
      </div>
      ';
    }
    break;
    case "3":
    {
      echo '
      <div class="alert alert-success text-center" role="alert">
      Inscription effectuée ! L\'administrateur va valider votre inscription prochainement.
      </div>
      ';
    }
    break;
    case "2":
      echo '
      <div class="alert alert-danger text-center" role="alert">
      Erreur : saisie incorrecte !
      </div>
      ';
    break;
    case "1":
      echo '
      <div class="alert alert-success text-center" role="alert">
      Vous êtes connecté !
      </div>
      ';
    break;
  }
}?>
