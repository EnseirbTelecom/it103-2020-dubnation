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

if (isset($_POST['ami']) && isset($_POST['Montant'])){

  //ON RECOLTE LES INFORMATIONS
  $userid = $_GET['userid'];
  $ami = $_POST['ami'];
  $Montant = $_POST['Montant'];
  $date = $_POST['date'];
  $status = $_POST['status'];
  $contexte = $_POST['contexte'];

  // ON VERIFIE SI LE PSEUDO EST DANS LA TABLE
  $sql  = "SELECT COUNT(*) AS nbr FROM user WHERE pseudo = '".$ami."'";
  $res  = mysql_query($sql);
  $alors  = mysql_fetch_assoc($res);

    // UNE BOUCLE POUR INFORMER L'UTLISATEUR
    if(isset($ami)){
      if($alors['nbr'] == 0){
        echo "Ce pseudo est invalide !";
      }

  //VERIFIER SI LE SOLDE DE L'UTILISATEUR EST SUFFISANT
  $pr = "SELECT sum as solde FROM Transaction_Ami WHERE id='".$userid."'";
  $ver = mysql_query($pr);
  $ver_table = mysql_fetch_assoc($ver);

   //UNE BOUCLE POUR INFORMER L'UTILISATEUR
   if(isset($userid)){
     if($ver_table['solde'] < $montant){
       echo "Solde insuffisant pour cette opération";
     }
     else{
       $solde = $ver_table['solde'] - $montant;
     }
   }

   //MODIFIER LA BASE DE DONNEES
   $conn->query("INSERT INTO Transaction_Ami ('id','id_user_dept','status','date','contexte','sum') VALUES ('$userid','$Montant','$status','$contexte','$solde')");
   echo "Paiment effectué";


}
