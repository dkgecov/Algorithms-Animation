<?php
session_start();
require_once('classes.php');
if(isset($_POST['username'], $_POST['password'])) {
	
	// $conn го взехме от файла config.php който е включен в classes.php
	$user = new User($_POST['username'], $_POST['password'],"", $conn, "users");
	$user->validate();

   if( $_SESSION['user_id'] == $user->getUserId() )
        {
           echo "You are already logged in!";
        }
    
	else if($user->isValid()){
        
        $_SESSION['logged_in'] = 1;
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['user'] = $user->getUsername();
        $_SESSION['time_created'] = time();
        
		echo "Вписахте се успешно!";//
        echo $user->getUserId();//
        header('Location: homepage.html');}  
	 else {
		echo "Грешка: ".$user->getError();
	}
}
?>
