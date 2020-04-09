<?php

if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_check"]) && isset($_POST["birthday"]) ){

	if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["password_check"]) || empty($_POST["birthday"]) ){
		$_POST["incription_error"]=0;
    }
    

    else
    {
		$currentdate=new DateTime("now");
		$birthdate= new DateTime($_POST["birthday"]);
        $user = new UserController();
        
        if ($user->checkUsedPseudo($_POST["username"])!=0){
			$_POST["error_inscription"]=1;
        }
        
		elseif ($user->checkUsedMail($_POST["email"])!=0){
			$_POST["error_inscription"]=2;
        }
        
		elseif($birthdate>$currentdate ){
			$_POST["error_inscription"]=3;
        }
        
		elseif ($_POST["password"]!=$_POST["password_check"]){
			$_POST["error_inscription"]=4;
        }
        
        else
        {
			$user_id=$user->addUser($_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["username"],$_POST["password"],$_POST["birthday"]);
			$_SESSION["user_id"]=$user_id;
			$_SESSION["first_name"]=$_POST["firstname"];
			$_SESSION["last_name"]=$_POST["lastname"];
			$_SESSION["email"]=$_POST["email"];
			$_SESSION["birth_date"]=$_POST["birthday"];
			$_SESSION["pseudo"]=$_POST["username"];
			redirect('');
		}

	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../it103/signup_css.css">
		 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


		<title>Inscription </title>

    </head>
    <body>
		<div class="container">
		<div class="row centered-form">
		<div class="col-xs col-sm col-md col-sm-offset col-md-offset">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<h2 class="panel-title">Inscris-toi sur Debster !</h2>
				</div>
					<div class="panel-body" id="debut">
					<form role="form" method="post" class="needs-validation" novalidate>
                        <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="firstname"> Prénom </label>
                                    <input type="text" id="firstname" class="form-control input-sm" placeholder="First name" required>
                                    <div class="valid-feedback">
                                        Complétez l'ensemble des champs
                                    </div>
                                    <div class="invalid-feedback">
                                        Veuillez rentrer votre prénom
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="lastname"> Nom </label>
                                    <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Last name" required>
                                    <div class="valid-feedback">
                                        Complétez l'ensemble des champs
                                    </div>
                                    <div class="invalid-feedback">
                                        Veuillez rentrer votre nom
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email">@</span>
                                        </div>
                                        <input type="email" id="email" class="form-control input-sm" placeholder="Email" required>
                                        <div class="invalid-feedback">
                                            Veuillez rentrer votre email 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="birthday"> Date de Naissance </label>
                                <input class="form-control input-sm" type="date" name="birthday" onfocus="display_dateHelp()" onfocusout="hide_dateHelp()" placeholder="Date de Naissance" required>
								<div class="invalid-feedback">
									Veuillez rentrer votre date de naissance
								</div>
								<div id="dateHelp" class="form-text text-muted HelpForm"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username"> Pseudo </label>
                                <input type="username" class="form-control" id="username" placeholder="Pseudo">
                                    <div class="invalid-feedback">
										Ce pseudo est déjà utilisé
									</div>
                            </div>
                        </div>    
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label"> Mot de Passe </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="Mot de passe">
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label for="password_check" class="col-sm-2 col-form-label"> Mot de passe à confirmer </label>
                                <div class="col-sm-10">
                                    <input type="password_check" class="form-control" id="password_check" placeholder="Mot de passe">
                                </div>
                                <div class="invalid-feedback">
									Erreur dans la confirmation du mot de passe
								</div>
                            </div> 
                            <input class="btn btn-primary" type="submit" value="S'inscrire" id="submit">                            
						</form>
						</div>
					</div>
				</div>

		<?php
				if (isset($_POST["incription_error"])){
                     switch ($_POST["error_inscription"])
                     {
						case 0:
							echo "Vous n'avez pas rempli l'ensemble des champs";
							break;
						case 1:
							echo "Ce pseudo est déjà utilisé";
							break;
						case 2:
							echo "Cette adresse mail est déjà utilisée";
							break;
						case 3:
							echo "Date de naissance invalide";
							break;
						case 4:
							echo "Mot de passe mal confirmé";
							break;
						default:
							echo "Une erreur est apparue pendant votre inscription, veuillez réessayer";
							break;
					}
					echo "</div>";
			}
            ?>
            

			</div>
        </div>
        
        <script>
			function display_dateHelp() {
				document.getElementById("dateHelp").style.visibility = "visible";
			}
			function hide_dateHelp() {
				document.getElementById("dateHelp").style.visibility = "hidden";
			}
//source pour le script: https://www.pierre-giraud.com/bootstrap-apprendre-cours/formulaire/

			(function() {
				'use strict';
				window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					let forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
					let validation = Array.prototype.filter.call(forms, function(form) {
						form.addEventListener('submit', function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add('was-validated');
						}, false);
					});
				}, false);
			})();
		</script>
    </body>

</html>