<?php
	include("functions.php");
  include("login.php");
    session_start();
?>

<?php
if (empty($_POST["pseudo"]) || empty($_POST["password"])){
    echo "champs pas remplis";
	}

		elseif (isset($_POST["pseudo"]) && isset($_POST["password"])) {
				 $pseudo=$_POST["pseudo"];
				 $password=$_POST["password"];
				 echo $pseudo;
				 echo $password;
				 checkPassword($pseudo,$password);
		}



?>
