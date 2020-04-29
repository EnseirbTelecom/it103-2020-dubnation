<?php
    session_start();
    include("functions.php");
?>    

<?php

$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "Probleme de connexion";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';

$pseudo_1 = $_SESSION["pseudo"];
//echo $pseudo_1;
$Requete = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$pseudo_1\";");
$result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

//echo $result[0]["userid"];
$_SESSION["userid"] = $result[0]["userid"];
//echo $_SESSION["userid"];
$user_con = $result[0]["userid"];
//echo $_SESSION["userid"];


                            ///////////////

// Toutes les relations d'amis en lien avec le user connecté
$Requete_1 = mysqli_query($link,"SELECT * FROM Reach_my_friend WHERE id_username_1 = \"$user_con\" OR id_username_2 = \"$user_con\";");
$result_1 = mysqli_fetch_all($Requete_1, MYSQLI_ASSOC);
//var_dump($result_1);

                            /////////////

if ($_SESSION["pseudo"]){
    $user_check[]=$_SESSION["pseudo"];
    //var_dump($user_check);
}

$condition=0;
if (isset($_POST["friends_deleted"])){
    if (empty($_POST["friends_deleted"])){
        echo "Veuillez rentrer le pseudo de l'ami que vous voulez ajouter";
    }
    // if ($_POST["friends_name"]=$_SESSION["pseudo"]){
    //     echo "Vous ne pouvez pas vous ajouter";
    // }

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
            //var_dump($result_3);
            $user_check[]=$result_3[0]["pseudo"];                 
        }
    }
    //var_dump($user_check);
    if (!(in_array($_POST["friends_deleted"],$user_check))) {
        echo "Vous ne pouvez pas supprimer une personne qui n'est pas votre ami";
    }
    else {
        $condition+=1;
        $friend_added=$_POST["friends_deleted"];
        $Requete_finale = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friend_added\";");
        $result_final = mysqli_fetch_all($Requete_finale, MYSQLI_ASSOC);
        echo $result_final[0]["userid"];
        echo $_SESSION["userid"];
        if ($condition == 1 ){
            delete_friendship($_SESSION["userid"],$result_final[0]["userid"],$link);
        }
    }
}

?>