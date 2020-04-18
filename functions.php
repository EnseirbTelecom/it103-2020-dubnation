<?php
function con(){
  $con = mysqli_connect('localhost', 'zac', 'password', 'debster');
  mysqli_set_charset($con, "utf8");
  return $con;
}

//Fct qui ajoute un utilisateur après inscription
function addUser($first_name, $last_name, $email, $password, $birthday, $pseudo) {
  $con = con();
  $stmt = mysqli_prepare($con, "INSERT INTO user (first_name, last_name, email, password, birthday, pseudo) VALUES (?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'ssss', $first_name, $last_name, $email, $password, $birthday, $pseudo);
  mysqli_stmt_execute($stmt);
  $id_final = mysqli_insert_id($con);
  mysqli_close($con);
  return $id_final;
}

//Fct qui check si l'email est déjà utilisée
function checkSignMail($email){
  $con = con();
  $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE email = ?");
  mysqli_stmt_bind_param($stmt, 's', $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $UsedAlready=0;
  if(mysqli_num_rows($result)>0){
      $UsedAlready=1;
  }
  mysqli_free_result($result);
  mysqli_close($con);
  return $UsedAlready;
}


//Fct qui check si le pseudo est déjà utilisé
function checkSignPseudo($pseudo){
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE pseudo = ?");
    mysqli_stmt_bind_param($stmt, 's', $pseudo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $UsedAlready=0;
    if(mysqli_num_rows($result)>0){
        $UsedAlready=1;
    }
    mysqli_free_result($result);
    mysqli_close($con);
    return $UsedAlready;
}

