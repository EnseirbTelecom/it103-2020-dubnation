<?php 
	include("functions.php");
    session_start();
?>



<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/myprofile.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

  <!--banner-->
  <div class="banner">
    <div class="row align-items-center">

    <!--website_name-->
    <div class="col" id='Topright'>BIENVENUE SUR TON DEBSTER: <?php echo $_SESSION["pseudo"] ?></div>
    <!--end_website_name-->

    <!--logo-->
    <div class="col" id='Topmiddle'>
      <img src="img/Screenshot from 2020-04-09 13-15-47.png" class="imag_small" alt="Logo" />
    </div>
    <!--end_logo-->

    <!--connexion_inscription-->
    <div class="col">
      <button type="button" class="btn btn-dark" id="liens"><a href='deconnect.php'>Déconnexion</a></button>
      <button type="button" class="btn btn-dark" id="liens"><a href='carnet_amis.php'>Gestion d'amis</a></button>
      <div class="dropdown">
        <div class="btn-group">
          <button type="button" class="btn btn-secondary" id="lien2" >Gestion du compte</button>
          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Gestion du compte</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="menu">
            <a class="dropdown-item" href="transaction_ami.php">Transaction simple</a>
            <a class="dropdown-item" href="transaction_groupe.php">Transaction vers un Groupe</a>
            <a class="dropdown-item" href="historique.php">Historique des comptes</a>
          </div>
        </div>
      </div>
    </div>
    <!--end connexion_inscription-->

   </div>
  </div>
  <!--end_banner-->
</body>
</html>