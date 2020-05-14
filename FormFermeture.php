<?php
  include("functions.php");
  //include("historique_2.php");
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	 <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../it103/rest_files.css">


<form method="post" action="fermeture.php">
<title> Transactions que vous voulez fermer par remboursement </title>
<h1> Fermer des transactions </h1>
<p>
    Transaction n° :<br />
    <input id='1' type="number" name="Tr1"/><br />

    Transaction n° :<br />
    <input id='2' type="number" name="Tr2"/><br />

    Transaction n° :<br />
    <input id='3' type="number" name="Tr3"/><br />

    Transaction n° :<br />
    <input id='4' type="number" name="Tr4"/><br />

    Transaction n° :<br />
    <input id='5' type="number" name="Tr5"/><br />

    Message de fermeture :<br />
    <input id='mf' type="text" name="MessFerm"/><br />

    <input type="submit" name="remboursement" value="Fermer ces transactions par remboursement" id="submit"/><input type="submit" name ="annulation" value="Fermer ces transactions par annulation" id="submit">
    
  

</p>

</form>
<form method="link" action="myprofile.php"> <input type="submit" value="Retour à l'accueil" id="submit"> </form>


</head></html>
