<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/stylet.css">
<title></title>
    </head>


<body>

<?php
require_once('config.php');
session_start();
if($_SESSION['logged_in'] != 1 ){
    
  header('Location: index.html');
}

  if ( time() - $_SESSION['time_created'] > 60*30){
      
      session_unset();
        
       if (isset($_COOKIE[session_name()])) {
           setcookie(session_name(), '', time(), '/');
       }

        session_destroy();
       header('Location: index.html');
    }

$id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM history where userID = ?");
 if ($stmt->execute(array($id)))
    
    
 {

    

    
echo "<table>";
    
echo "<tr> <th>Date</th> <th>Action</th> </tr>";
    while ($row = $stmt->fetch()){
        echo "<tr>" . "<td>" . $row["Date"] . "</td>" . "<td>".$row["Action"] ."</td>"."</tr>";
    }


echo "</table>";
    
 }
    
    
?>
</body>
</html>