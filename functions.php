<?php
function con(){
  echo "test";
  $con =  mysqli_connect('localhost', 'admin', 'it103','Dubnation');
  echo $con;
  if ($con){
    echo " connexion au site";
  }
  mysqli_set_charset($con, "utf8");
  return $con;
}

//Fct qui ajoute un utilisateur après inscription
function addUser($first_name, $last_name, $email, $password, $birthday, $pseudo,$link) {
  $stmt = mysqli_prepare($link, "INSERT INTO user (first_name, last_name, email, password, birthday, pseudo) VALUES (?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'ssssss', $first_name, $last_name, $email, $password, $birthday, $pseudo);
  mysqli_stmt_execute($stmt);
  printf("%d ligne insérée.\n", mysqli_stmt_affected_rows($stmt));
  printf("Erreur : %s.\n", mysqli_stmt_error($stmt));
  $id_final = mysqli_insert_id($con);
  mysqli_close($con);
  return $id_final;
}


//Fct qui check si l'email est déjà utilisée
function checkSignMail($email,$link){
  $Requete = mysqli_query($link,"SELECT * FROM user WHERE email = \"$email\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
    echo "Email Validé";
  }
  else{
    echo "Email déjà utilisé, veuillez-le changer";
    exit();
  }
    
}




//Fct qui check si le pseudo est déjà utilisé
function checkSignPseudo($pseudo,$link){
  $Requete = mysqli_query($link,"SELECT * FROM user WHERE pseudo = \"$pseudo\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
    echo "Pseudo Validé";
  }
  else{
    echo "Pseudo déjà utilisé, veuillez-le changer";
    exit();
  }
    
}



//fct qui verifie la correspondance pseudo-mot de Passe
function checkPassword($pseudo,$password,$link){
  $Requete = mysqli_query($link,"SELECT * FROM user WHERE pseudo = \"$pseudo\";");
  // echo "SELECT * FROM user WHERE pseudo = \"$pseudo\";";
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  // var_dump($result);
  // while ($row = mysqli_fetch_row($Requete)) {
  //       printf ("%s (%s)\n", $row[0], $row[1]);
  //   }

  if (!$result) {
	   echo "L'utilisateur est incorrect.";
} else {
	 $hash = $result[0]["password"];
   // echo $hash;
   //echo $password;

	if ($password == $hash) {
		echo "Connexion réussie";
	} else {
    echo "Le mot de passe est incorrect.";
    exit();
	}

}
}
