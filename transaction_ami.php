<?php
        //Connexion à la base de donnée
        $server = 'localhost';
        $username = 'admin';
        $password = 'it103';
        $database = 'Dubnation';

        $conn = new mysqli($server, $username, $password, $database);

        if($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error . ".\r\n");
    }
    echo "Connection successful!\r\n";

?>

<?php

include("function.php");

if (isset($_POST['Message_Explicatif']) && isset($_POST['Utilisateur_Source']) && isset($_POST['ami']) && isset($_POST['Montant'])){

  //ON RECOLTE LES INFORMATIONS
  $utilisateur_source = $_POST['Utilisateur_Source'];
  $ami = $_POST['ami'];
  $montant = $_POST['Montant'];
  $date = $_POST['date'];
  $status = $_POST['status'];
  $message_explicatif = $_POST['Message_Expliicatif'];

  // ON VERIFIE SI L'UTILISATEUR EXISTE
  $sql_1  = "SELECT COUNT(*) AS nbr_1 FROM user WHERE userid = '".$utilisateur_source."'";
  $res_1  = mysql_query($sql_1);
  $alors_1  = mysql_fetch_assoc($res_1);

    // UNE BOUCLE POUR INFORMER L'UTLISATEUR
    if(isset($utilisateur_source)){
      if($alors_1['nbr_1'] == 0){
        echo "Cet utilisateur n'est pas enregistré !";
        include ami.php;
      }


  // ON VERIFIE SI LE PSEUDO EST DANS LA TABLE
  $sql_2  = "SELECT COUNT(*) AS nbr_2 FROM user WHERE pseudo = '".$ami."'";
  $res_2  = mysql_query($sql_2);
  $alors_2  = mysql_fetch_assoc($res_2);

    // UNE BOUCLE POUR INFORMER L'UTLISATEUR
    if(isset($ami)){
      if($alors_2['nbr_2'] == 0){
        echo "Ce pseudo est invalide !";
        include ami.php;
      }

  //VERIFIER SI LE SOLDE DE L'UTILISATEUR EST SUFFISANT
  $pr = "SELECT sum as solde FROM Transaction_Ami WHERE id='".$userid."'";
  $ver = mysql_query($pr);
  $ver_table = mysql_fetch_assoc($ver);

   //UNE BOUCLE POUR INFORMER L'UTILISATEUR
   if(isset($userid)){
     if($ver_table['solde'] < $montant){
       echo "Solde insuffisant pour cette opération";
       include ami.php;
     }
   }

   //SELECTIONNER LES ID DES UTILISATEURS SOURCE ET CIBLE
    $ID_SOURCE = mysqli_query($conn, "SELECT `userid` FROM `user` WHERE userid=`$utilisateur_source`");
    $ID_CIBLE = mysqli_query($conn, "SELECT `userid` FROM `user` WHERE pseudo=`$ami`");


   //MODIFIER LA BASE DE DONNEES
   $conn->query("INSERT INTO Transaction_Ami ('id_user_dept',`id_user_waiting`,'status','date','contexte','sum') VALUES ('$ID_SOURCE','$ID_CIBLE','$status','$date','$message_explicatif','$montant')");
   echo "Paiment effectué";

   //METTRE A JOUR LE SOLDE DES UTILSATEURS SOURCE ET CIBLE
   $conn->query("UPDATE `` SET Montant='$MoneyLeft' WHERE UserName = $UtilisateurSource );
}

else{
include 'ami.php' ;
echo 'Saisir les données' ;

}
