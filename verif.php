<?php
	include("function.php");
  include("login.php");
    session_start();
?>

<?php
if (empty($_POST["pseudo"]) || empty($_POST["password"])){
    echo "champs pas remplis";
    }


?>
