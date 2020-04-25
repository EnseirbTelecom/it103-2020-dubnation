<?php
    include("functions.php");
    session_start();
?>    

<?php

$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "ca marche po";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';


//var_dump($_POST);
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_check"]) && isset($_POST["birth"]) ){
    
    
    if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["password_check"]) || empty($_POST["birth"]) ){
		echo 'Tous les champs ne sont pas remplis ';
    }
    $condition=0;
        if (empty($_POST["username"])){
            echo 'Remplissez le champ Pseudo ';
        }
        else {
            checkSignPseudo($_POST["username"],$link);
            $condition+=1;
            echo $condition;
        }    

    	if (empty($_POST["email"])){
            echo 'Remplissez le champ Email';
        }
        else {
            checkSignMail($_POST["email"],$link);
            $condition+=1;
            echo $condition;
            }
		
    	if ($_POST["password"]!=$_POST["password_check"]){
             echo 'Merci de bien confirmer votre mot de passe ';
        }
        else{
            $condition+=1;
            echo 'Mot de passe validé';
            echo $condition;
        }

        if ($condition==3)
        {
            echo 'cest un debut';
			$user_id=addUser($_POST["firstname"],$_POST["lastname"],$_POST["email"],crypt($_POST["password"]),$_POST["birth"],$_POST["username"],$link);
			// $_SESSION["userid"]=$user_id;
			// $_SESSION["first_name"]=$_POST["firstname"];
			// $_SESSION["last_name"]=$_POST["lastname"];
			// $_SESSION["email"]=$_POST["email"];
			// $_SESSION["birthday"]=$_POST["birth"];
			// $_SESSION["pseudo"]=$_POST["username"];
			// $_SESSION["password"]=$_POST["password"];
		}

	//}
}

?>