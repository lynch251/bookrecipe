<!-- CONTROLEUR -->
<?php
session_start();
try {
		include("vues/header.php");
		if (isset($_GET['page']))
		{
			switch(htmlspecialchars($_GET['page']))
			{
				case "welcome":
				{
					include("vues/welcome.php");
				}
				break;
				case "create_recipe":
				{
					if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user']))
					{
							// Afficher le vue et la liste des catégories de recettes
							include('PDO/classe_categorie.php');
							include('PDO/categoriePDO.php');
							if (!isset($_POST['add_title']) || !isset($_POST['add_description']))
							{
								$showCategorie = new CategoriePDO;
								$showCategories = $showCategorie->getAll();
								include("vues/create_recipe.php");
							}
							if (isset($_POST['add_title']) && isset($_POST['add_description']) && isset($_POST['optionsRadios']) && isset($_POST['add_ingredients']) && !empty($_POST['optionsRadios']) && !empty($_POST['add_title']) && !empty($_POST['add_description']))
							{
								$title = htmlspecialchars($_POST['add_title']);
								$description = htmlspecialchars($_POST['add_description']);
								$description = nl2br($description);
								$date_creation_recipe = date("Y-m-d H:i:s");
								$id_user = htmlspecialchars($_SESSION['id_user']);
								$idCategorie = htmlspecialchars($_POST['optionsRadios']);
								$ingredients = htmlspecialchars($_POST['add_ingredients']);
								include("PDO/classe_recette.php");
								include("PDO/recettePDO.php");
								$create_recipe = new RecettePDO();
								// Utiliser la méthode setAll
								$create_recipe->setAll($title, $description, $date_creation_recipe, $id_user, $idCategorie, $ingredients);
								if ($create_recipe == false)
								{
									echo '<script>window.location.href="index.php?page=create_recipe&success=2"</script>';
								}
								else if ($create_recipe == true)
								{
									echo '<script>window.location.href="index.php?page=create_recipe&success=12"</script>';
								}
							}
						}
						else
						{
							echo '<script>window.location.href="index.php?page=connexion"</script>';
						}
				}
				break;
				case "read_recipe":
				{
					// Affichage des bouttons catégories
					include('PDO/classe_categorie.php');
					include('PDO/categoriePDO.php');
					$show_categories = new CategoriePDO();
					$categories = $show_categories->getAll();
					if ($categories == false)
					{
						echo '<script>window.location.href="index.php?page=welcome&success=10"</script>';
					}
					if (isset($_GET['id_categorie']))
					{
						// Affichage des recettes de la catégorie sélectionnée
						$id_categorie = htmlspecialchars($_GET['id_categorie']);
						include("PDO/classe_recette.php");
						include("PDO/recettePDO.php");
						$show_recipes = new RecettePDO();
						$recettes = $show_recipes->getAll($id_categorie);
					}
					else if (!isset($_GET['id_categorie']))
					{
						// Lecture par défaut des appéritifs si rien n'est sélectionné
						include("PDO/classe_recette.php");
						include("PDO/recettePDO.php");
						$show_recipes = new RecettePDO();
						//var_dump($show_recipes);
						$recettes = $show_recipes->getAll(4);
					}
					include('vues/read_recipe.php');
				}
				break;
				case "connexion":
				{
					include('vues/connexion.php');
				}
				break;
				case "inscription":
				{
					include('vues/inscription.php');
				}
				break;
				case "traitement_inscription":
				{
					if (isset($_POST['inscription_email']) && isset($_POST['inscription_pwd']) && isset($_POST['inscription_pwd1']) && !empty($_POST['inscription_pwd1']) && !empty($_POST['inscription_email']) && !empty($_POST['inscription_pwd']))
					{
						include('PDO/userPDO.php');
						$email = htmlspecialchars($_POST['inscription_email']);
						$pwd = htmlspecialchars($_POST['inscription_pwd']);
						$inscription = new userPDO();
						$existingUser = $inscription->getOne($email);
						if ($existingUser == false)
						{
							if ($_POST['inscription_pwd'] == $_POST['inscription_pwd1'])
							{
								// Hacher le mdp et enregistrer l'utilisateur dans la BDD
								$setUser = new userPDO();
								$setUserSuccess = $setUser->setUser($email, $pwd);
								if ($setUserSuccess == true)
								{
									echo '<script>window.location.href="index.php?page=inscription&success=3"</script>';
								}
								else
								{
									echo '<script>window.location.href="index.php?page=inscription&success=2"</script>';
								}
							}
							else if ($_POST['inscription_pwd'] != $_POST['inscription_pwd1'])
							{
								echo '<script>window.location.href="index.php?page=inscription&success=6"</script>';
							}
						}
						else if ($existingUser == true)
						{
							echo '<script>window.location.href="index.php?page=inscription&success=5"</script>';
						}
					}
					else
					{
						echo '<script>window.location.href="index.php?page=inscription&success=2"</script>';
					}
				}
				break;
				case "traitement_connexion":
				{
					if (isset($_POST['connexion_email']) && isset($_POST['connexion_pwd']) && !empty($_POST['connexion_email']) && !empty($_POST['connexion_pwd']))
					{
						// Vérifier que l'adresse a le bon format
						if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['connexion_email']))
						{
							// Vérifier que l'utilisateur existe dans la BDD
							include('PDO/userPDO.php');
							$connexion = new userPDO();
							$user = $connexion->login($_POST['connexion_email'], $_POST['connexion_pwd']);
							if ($user)
							{
								// L'utilisateur existe
								// Comparaison du mot de passe
								$isPasswordCorrect = password_verify($_POST['connexion_pwd'], $user['pwd']);
								if ($isPasswordCorrect)
								{
									// Le mot de passe correspond
									if ($user['is_check'] != NULL)
									{
										// L'utilisateur a un compte validé
										// Démarrer la session utilisateur
										$_SESSION['id_user'] = $user['id_user'];
										$_SESSION['email'] = $user['email'];
										if ($user['is_admin'] ==1) {
											$_SESSION['admin'] = $user['is_admin'];
										}
										echo '<script>window.location.href="index.php?page=read_recipe&success=1"</script>';
										//header('location:index.php?page=read_recipe&success=1');
									}
									else { echo '<script>window.location.href="index.php?page=connexion&success=13"</script>';}
								}
								else
								{
									// Le mot de passe ne correspond pas
									echo '<script>window.location.href="index.php?page=connexion&success=2"</script>';
								}
							}
						}
					}
					else
					{
						echo '<script>window.location.href="index.php?page=connexion&success=2"</script>';
					}
				}
				break;
				case "logout":
        {
            include('PDO/userPDO.php');
            $logout = new userPDO();
            echo 'DÃ©connexion en cours...';
            $logout->logout();
            echo '<meta http-equiv="refresh" content="2;URL=index.php?page=welcome">';
        }
        break;
        case "modifyRecipe":
        {
            if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user']))
            {

                include('PDO/classe_recette.php');
                include('PDO/recettePDO.php');
                if (!isset($_POST['modify_title']) || !isset($_POST['modify_ingredients']) || !isset($_POST['modify_description']) || !isset($_FILES['picture']['name']))
                {
                    $id_user = htmlspecialchars($_SESSION['id_user']);
                    $id_recipe = htmlspecialchars($_GET['id_recipe']);
                    $show_recipe = new RecettePDO();
                    $recipe = $show_recipe->getOne($id_recipe);
                    include('vues/modifyRecipe.php');
                }
                if (isset($_POST['modify_title']) && isset($_POST['modify_ingredients']) && isset($_POST['modify_description']) && isset($_FILES['picture']['name']))
                {
                    // Modifier si un des champs est saisi / sont saisis
                    if (!empty($_POST['modify_title']))
                    {
                        $id_user = htmlspecialchars($_SESSION['id_user']);
                        $id_recipe = htmlspecialchars($_GET['id_recipe']);
                        $modify_title = htmlspecialchars($_POST['modify_title']);
                        $modify_recipe = new RecettePDO();
                        $modifyOneSuccess = $modify_recipe->modifyOneTitle($id_recipe, $modify_title, $id_user);
                        if ($modifyOneSuccess)
                        {
                            echo '<div class="alert alert-success text-center" role="alert">
                      Modification effectuÃ©e ! </div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';

                            // echo '<script>window.location.href=""</script>';
                        }
                        else {
                            echo '<div class="alert alert-danger text-center" role="alert">
                      Erreur lors de la modification.</div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                        }
                    }
                    if (!empty($_POST['modify_ingredients']))
                    {
												$id_user = htmlspecialchars($_SESSION['id_user']);
												$id_recipe = htmlspecialchars($_GET['id_recipe']);
												$modify_ingredients = htmlspecialchars($_POST['modify_ingredients']);
                        $modify_recipe = new RecettePDO();
                        $modifyOneSuccess = $modify_recipe->modifyOneIngredients($id_recipe, $modify_ingredients, $id_user);
                        if ($modifyOneSuccess)
                        {
                            echo '<div class="alert alert-success text-center" role="alert">
                      Modification effectuÃ©e !
                      </div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                        }
                        else {
                            echo '<div class="alert alert-danger text-center" role="alert">
                      Erreur lors de la modification.</div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                        }
                    }
                    if (!empty($_POST['modify_description']))
                    {
												$id_user = htmlspecialchars($_SESSION['id_user']);
												$id_recipe = htmlspecialchars($_GET['id_recipe']);
												$modify_title = htmlspecialchars($_POST['modify_title']);
                        $modify_description = htmlspecialchars($_POST['modify_description']);
                        $modify_ingredients = htmlspecialchars($_POST['modify_ingredients']);
                        $modify_recipe = new RecettePDO();
                        $modifyOneSuccess = $modify_recipe->modifyOneDescription($id_recipe, $modify_description, $id_user);
                        if ($modifyOneSuccess)
                        {
                            echo '<div class="alert alert-success text-center" role="alert">
                      Modification effectuÃ©e !
                      </div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                        }
                        else {
                            echo '<div class="alert alert-danger text-center" role="alert">
                      Erreur lors de la modification.</div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                        }
                    }
                    if (!empty($_FILES['picture']['name']))
                    {
                            // Modification avec l'image
                            if ($_FILES['picture']['size'] > 3000000)
                            {
                                // Image trop lourde (> 3Mo)
                                echo '<meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&success=9&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                            }
                            else
                            {
                                    // Tester si l'extension est la bonne
                                    $infosfichier = pathinfo($_FILES['picture']['name']);
                                    $extension_upload = $infosfichier['extension'];
                                    $extensions_autorisees = array('jpg','jpeg');
                                    if (in_array($extension_upload, $extensions_autorisees))
                                    {
                                        // Redimensionner l'image
                                        $id_recipe = htmlspecialchars($_GET['id_recipe']);
                                        $id_user = $_SESSION['id_user'];
                                        $file_dest = 'public/images/'.$id_recipe.'.jpg';
                                        $source = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                        $destination = imagecreatetruecolor(600, 450);
                                        $largeur_source = imagesx($source);
                                        $hauteur_source = imagesy($source);
                                        $largeur_destination = imagesx($destination);
                                        $hauteur_destination = imagesy($destination);
                                        // CrÃ©ation miniature
                                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                                        $image = imagejpeg($destination, $file_dest);
                                        // Copier dÃ©finitivement l'image sur le serveur
                                        $resultat = move_uploaded_file($image, $file_dest);
                                        // Envoi en BDD
                                        $modify_title = htmlspecialchars($_POST['modify_title']);
                                        $modify_description = htmlspecialchars($_POST['modify_description']);
                                        $modify_ingredients = htmlspecialchars($_POST['modify_ingredients']);
																				$id_user = htmlspecialchars($_SESSION['id_user']);
								                        $id_recipe = htmlspecialchars($_GET['id_recipe']);
                                        $modify_recipe = new RecettePDO();
                                        $modifyOneSuccess = $modify_recipe->modifyOnePicture($id_recipe, $id_user);
                                        if ($modifyOneSuccess) {
                                            echo '<div class="alert alert-success text-center" role="alert">
                                      Modification effectuÃ©e !
                                      </div>
                                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                                        }
                                        else {
                                            echo '<div class="alert alert-danger text-center" role="alert">
                                      Erreur lors de la modification.</div>
                                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">';
                                        }
                                    }
                            }
                        }
                        else if (empty($_POST['modify_title']) && empty($_POST['modify_ingredients']) && empty($_POST['modify_description']) && empty($_FILES['picture']['name'])){
                            echo '<div class="alert alert-danger text-center" role="alert">
                      Il faut modifier au moins un champ</div>
                            <meta http-equiv="refresh" content="2;URL=index.php?page=modifyRecipe&id_recipe='.htmlspecialchars($_GET['id_recipe']).'">
                            ';
                        }
                }
            }
        }
        break;
				case "deleteRecipe":
				{
					include('PDO/classe_recette.php');
					include('PDO/recettePDO.php');
					$delete_recipe = new RecettePDO();
					$delete_recipe->deleteRecipe(htmlspecialchars($_GET['recipe']));
					echo '<script>window.location.href="index.php?page=read_recipe"</script>';
				}
				break;
				case "register":
				{
					include('register.php');
					include('PDO/classe_user.php');
				}
				break;
				case "noter":
				{
					if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user']))
					{
						if (!isset($_GET['recette']))
						{
							require_once('PDO/classe_recette.php');
							require_once('PDO/recettePDO.php');
							$setMark = new RecettePDO();
							$setMarkSuccess = $setMark->getAllRecipe();
							if ($setMarkSuccess == true)
							{
								include('vues/setMark.php');
							}
						}
						else if (isset($_GET['recette']))
						{
							// Chargement de la recette sélectionnée pour la noter
							require_once('PDO/classe_recette.php');
							require_once('PDO/recettePDO.php');
							$nomRecette = new RecettePDO();
							$recette = htmlspecialchars($_GET['recette']);
							$nom = $nomRecette->getOne($recette);
							if ($nom == true) {
								include('vues/setMark.php');
							}
						}
						else
						{
							echo '<script>window.location.href="index.php?page=noter&success=2"</script>';
						}
					}
					else
					{
						echo '<script>window.location.href="index.php?page=connexion"</script>';
					}
				}
				break;
				case "enregistrerNote":
				{
					if (isset($_GET['note']) && !empty($_GET['note']) && isset($_GET['recette']) && !empty($_GET['recette']))
					{
						// Enregistrer la note dans la BDD
						$recette = htmlspecialchars(htmlspecialchars($_GET['recette']));
						$mark = htmlspecialchars(htmlspecialchars($_GET['note']));
						require_once('PDO/classe_recette.php');
						require_once('PDO/recettePDO.php');
						$setMark = new RecettePDO();
						$setMarkSuccess = $setMark->setMark($recette, $mark);
						if ($setMarkSuccess == true)
						{
							echo '<script>window.location.href="index.php?page=read_recipe&success=8"</script>';
						}
						else if ($setMarkSuccess == false)
						{
							echo '<script>window.location.href="index.php?page=read_recipe&success=2"</script>';
						}
					}
					else
					{
						echo '<script>window.location.href="index.php?page=read_recipe&success=2"</script>';
					}
				}
				break;
				case "admin":
				{
					if (isset($_SESSION['admin']) && $_SESSION['admin'] != NULL)
					{
						// Admin connecté
						include('PDO/classe_user.php');
						include('PDO/userPDO.php');
						// Afficher les utilisateurs
						if (!isset($_GET['user']) || empty($_GET['user']))
						{
							$allUser = new userPDO();
							$getAllUser = $allUser->getAll();
							if ($getAllUser)
							{
								include('vues/admin.php');
							}
						}
						// Obtenir les données de l'utilisateur sélectionné
						if (isset($_GET['user']))
						{
							$oneUser = new userPDO();
							$modifyOneUser = $oneUser->getUser(htmlspecialchars($_GET['user']));
							if ($modifyOneUser)
							{
								$is_check = $oneUser->getUserCheck(htmlspecialchars($_GET['user']));
							  $modifyOneUser->setIsCheck($is_check);

								include('vues/admin.php');
							}
						}
					}
					else
					{
						echo '<script>window.location.href="index.php?page=connexion"</script>';
					}
				}
				break;
				case "validerUtilisateur":
				{
					if (isset($_SESSION['admin']) && $_SESSION['admin'] != NULL)
					{
						// Admin connecté
						include('PDO/classe_user.php');
						include('PDO/userPDO.php');
						if (isset($_GET['user']) && isset($_POST['check']))
						{
							if ($_POST['check'] == 0)
							{
								$adminUser = new userPDO();
								$deleteOneUser = $adminUser->delete(htmlspecialchars($_GET['user']));
								if ($deleteOneUser)
								{
									echo '<script>window.location.href="index.php?page=admin&success=14"</script>';
								}
							}
							else if ($_POST['check'] == 1)
							{
								$adminUser = new userPDO();
								$updateOneUser = $adminUser->updateAdminOne(htmlspecialchars($_GET['user']), $_POST['check']);
								if ($updateOneUser)
								{
									echo '<script>window.location.href="index.php?page=admin&success=14"</script>';
								}
			 				}

						}
					}
				}
				break;
			}
		}
		else
		{
			include("vues/welcome.php");
		}
		include('vues/footer.php');
	}
	catch(Exception $e) {
		echo '
		<div class="alert alert-danger text-center" role="alert">
		Erreur : '.$e->getMessage();'
		</div>';
	}
