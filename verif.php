<?php
	
  include("login.php");
    session_start();
?>

<?php
$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "ca marche po";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully';

if (empty($_POST["pseudo"]) || empty($_POST["password"])){
    echo "champs pas remplis";
	}

		elseif (isset($_POST["pseudo"]) && isset($_POST["password"])) {
				 $pseudo=$_POST["pseudo"];
				 $password=$_POST["password"];
				 //echo $pseudo;
				 //echo $password;
				 checkPassword($pseudo,$password,$link);
		}



?>
