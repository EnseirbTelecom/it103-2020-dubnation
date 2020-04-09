<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	 <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../it103/signup_css.css">


<form method="post" action="login.php">
<title> Connexion </title>
<p>
    Votre pseudo :<br />
    <input id='pseudo' type="text" name="pseudo"/><br />

    votre mot de passe :<br />
    <input id='password' type="password" name="password"/><br />

    <input type="submit" value="Connexion"/><input type="button" onclick="deconnect()" value="Deconnexion"/>

</p>


</form>

<?php
if (isset($_POST['pseudo']) AND isset($_POST['password']))
{
    if ($_POST['pseudo'] != NULL AND $_POST['password'] != NULL)
    {

        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
				$id=1;
			}
	}
if (empty($_POST["pseudo"]) || empty($_POST["password"])){
		echo "champs pas remplis";
	}
echo $id;
?>
<script>
function deconnect(){
	if ($id==1){
		$id=0;
	}
}
</script>


</head></html>
