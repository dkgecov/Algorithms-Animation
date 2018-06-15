<?php
require_once('classes.php');
        session_unset();
       if (isset($_COOKIE[session_name()])) {
           setcookie(session_name(), '', time(), '/');
       }
        session_destroy();


if( isset($_POST['username'], $_POST['password'], $_POST['repeat_password'], $_POST['email'] ) ) {
    if($_POST['password'] != $_POST['repeat_password']){
    echo "Password don't match !";
    return;
    }
	$user = new User($_POST['username'], $_POST['password'],$_POST['email'], $conn, "users");
   /* echo $user->getUserId()."/".$user->getUsername()."/".$user->getEmail();*/
   if( ! ( $user->emailExist() || $user->userNameExist() ) ){
            $query = "INSERT INTO "."users "."(username, password, email) VALUES(:user, :password, :email)";
       
			$stmt = $user->getConnection()->prepare($query);
            $stmt->bindParam(':user', $user->getUsername());
            $stmt->bindParam(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
            $stmt->bindParam(':email', $user->getEmail());
			$stmt->execute();
            if($query) header('Location: index.html');
            else echo "Нещо се обърка";
    } 
    else {
		echo "Грешка: ".$user->getError();
    }
}
else echo "Грешни данни !";


    
?>