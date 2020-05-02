<?php 
	include("functions.php");
    session_start();
?>
<?php

$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "Probleme de connexion";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';

$pseudo_1 = $_SESSION["pseudo"];
$Requete = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$pseudo_1\";");
$result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

$_SESSION["userid"] = $result[0]["userid"];
$user_con = $result[0]["userid"];

$Requete_1 = mysqli_query($link,"SELECT * FROM Reach_my_friend WHERE id_username_1 = \"$user_con\" OR id_username_2 = \"$user_con\";");
$result_1 = mysqli_fetch_all($Requete_1, MYSQLI_ASSOC);

if ($_SESSION["pseudo"]){
    $user_check[]=$_SESSION["pseudo"];
}

for ($i=0; $i<sizeof($result_1) ; $i++) { 
    if ($result_1[$i]["id_username_1"] == $_SESSION["userid"]) {
        $friend = $result_1[$i]["id_username_2"];
        $Requete_2 = mysqli_query($link,"SELECT first_name, last_name, pseudo FROM user WHERE userid = \"$friend\";");
        $result_2 = mysqli_fetch_all($Requete_2, MYSQLI_ASSOC);
        $user_check[]=$result_2[0]["pseudo"]; 
        
    }
    if ($result_1[$i]["id_username_2"] == $_SESSION["userid"]) {
        $friend_bis = $result_1[$i]["id_username_1"];
        $Requete_3 = mysqli_query($link,"SELECT userid, first_name, last_name, pseudo FROM user WHERE userid = \"$friend_bis\";");
        $result_3 = mysqli_fetch_all($Requete_3, MYSQLI_ASSOC);
        $user_check[]=$result_3[0]["pseudo"];                 
    }
}

if (!(in_array($_POST["friends_transaction"],$user_check))) {
    echo "Le peudo rentré n'est pas votre ami";
}







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










</body>
</html>