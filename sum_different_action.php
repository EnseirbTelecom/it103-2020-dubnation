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
//echo $pseudo_1;
$Requete = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$pseudo_1\";");
$result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

//echo $result[0]["userid"];
$_SESSION["userid"] = $result[0]["userid"];
//echo $_SESSION["userid"];
$user_con = $result[0]["userid"];
//echo $_SESSION["userid"];

                            ///////
// Toutes les relations d'amis en lien avec le user connecté
$Requete_1 = mysqli_query($link,"SELECT * FROM Reach_my_friend WHERE id_username_1 = \"$user_con\" OR id_username_2 = \"$user_con\";");
$result_1 = mysqli_fetch_all($Requete_1, MYSQLI_ASSOC);
//var_dump($result_1);
                            /////////////

if ($_SESSION["pseudo"]){
    $user_check[]=$_SESSION["pseudo"];
    //var_dump($user_check);
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
      //var_dump($result_3);
      $user_check[]=$result_3[0]["pseudo"];                 
  }
}
$length=sizeof($user_check)-1;
// echo $length;
// echo $_POST["montant"][1];


$friend_to_transaction = $_SESSION["utilisateur_cible"][0];
//echo $friend_to_transaction;
$Requete_4 = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friend_to_transaction\";");
$result_4 = mysqli_fetch_all($Requete_4, MYSQLI_ASSOC);
//var_dump($result_4);
//echo $result_4[0]["userid"];
$id_friends[]=$result_4[0]["userid"];
//var_dump($id_friends);

for ($i=1; $i <$length ; $i++) {
    $friend_group = $_SESSION["utilisateur_cible"][$i];
    $Requete_5 = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friend_group\";");
    $result_5 = mysqli_fetch_all($Requete_5, MYSQLI_ASSOC);
    $id_friends[]=$result_5[0]["userid"];
    //echo $id_friends[$i];
}

//var_dump($id_friends);


for ($i=0; $i <$length ; $i++) { 
    if ($_POST["montant"][$i]<0){
        echo "Les montants doivent être strictement positifs";
        exit();
    }
    else {
        echo $id_friends[$i]; echo $_POST["montant"][$i];
        addtransactiongroup($_SESSION["userid"], $id_friends[$i], $_SESSION["Statut"], $_SESSION["date_de_création"], $_SESSION["Message_Explicatif"], $_SESSION["date_de_fermeture"],$_SESSION["Message_de_fermeture"],$_POST["montant"][$i],$link);        
    }    
}