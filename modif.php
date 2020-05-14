<?php
$ttl = 3600; // Une heure, en secondes
session_set_cookie_params($ttl);
ini_set('session.gc_maxlifetime', $ttl);
include ("functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	 <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../it103/rest_files.css">



  <form method="post" action="modif2.php">
  <title> Modifier une transaction </title>
  <h1> Modifier une transaction </h1>
  <p>
      Numéro de la transaction :<br />
      <input id='idtrans' type="number" name="idtrans"/><br />

      Message Explicatif :<br />
      <input id='mess_explicatif' type="text" name="mess_explicatif" /><br />

      Montant : <br />
      <input id='newmontant' type ="number" name="newmontant" /><br/>

      <input type="submit" id="submit" value="Modifier"/>


  </p>





  </form>





  </head></html>
