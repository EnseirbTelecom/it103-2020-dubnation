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
		<script src="jquery.min.js" type="text/javascript"></script>
		<script src="bootstrap.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


		<title>Inscription </title>

    </head>
    <body>
		<div class="container">
		<div class="row centered-form">
		<div class="col-xs col-sm col-md col-sm-offset col-md-offset">
			<div class="panel panel-default">
				<div class="panel-heading">
						<h2 class="panel-title">Inscris-toi sur Debster !</h2>
						</div>
						<div class="panel-body">
						<form role="form" method="post" class="needs-validation" novalidate>
                            <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="firstname"> Prénom </label>
                                        <input type="text" id="firstname" class="form-control input-sm" placeholder="First name" required>
                                        <div class="valid-feedback">
                                            Passez à l'étape suivante
                                        </div>
                                        <div class="invalid-feedback">
                                            Veuillez rentrer votre prénom
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="lastname"> Nom </label>
                                        <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Last name" required>
                                        <div class="valid-feedback">
                                            <input class="form-control is-valid" required>
                                                Passez à létape suivante
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
                                            <input type="text" id="email" class="form-control input-sm" placeholder="Email" required>
                                            <div class="invalid-feedback">
                                                Veuillez rentrer votre email s'il vous plait
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
                                    <div class="valid-feedback">
                                            Sympa !
                                    </div>
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
                                    <input type="password_check" class="form-control" id="password_check" placeholder="PMot de passe">
                                </div>
                            </div> 
                            <input type="submit" value="Inscris-toi" class="btn btn-outline-success">
                            
						</form>
						</div>
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
							echo "Mot de passe non confirmé";
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
    </body>

</html>