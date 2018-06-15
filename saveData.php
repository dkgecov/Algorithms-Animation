<?php

require_once('config.php');
session_start();


$data = json_decode(stripslashes($_POST['data']), true);
$id =  $_SESSION['user_id'];
date_default_timezone_set('Europe/Sofia');// to do international
$date = date('Y/m/d/h:i:s');
$action = $data['action'];


   $query = "INSERT INTO "."history "."(userID, Date, Action) VALUES(:id, :date, :action)";
       
			$stmt=$conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':action', $action);
			$stmt->execute(); 
//var_dump(json_decode($_POST['data'], true))
// echo json_encode($data);
?>