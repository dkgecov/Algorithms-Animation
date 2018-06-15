<?php
require_once('config.php');

class User {
	private $username;
	private $password;
    private $email;
	private $hashed;  // хеширана парола
	private $isValid; // показва дали е валиден User-a. Валиден е когато няма непозволени символи и съществува потреб. със съответното име и парола.
	private $conn; // обект държащ нашата връзка
	private $lastError;
	private $table; //таблица с потребители (акаунти)
    private $userId;
	
	function __construct ($username, $password, $email, &$conn, $table) {
		$this->conn = $conn;
		$this->username = $username;
		$this->password = $password;
        $this->email = $email;
		$this->hashed = password_hash($password, PASSWORD_DEFAULT);
		$this->isValid = false;
		$this->lastError = "";
		$this->table = $table;
        
	}
	
	//Валидира потребителя и записва валидността му в $isValid
	function validate() {
		if(preg_match("/[a-zA-Z0-9]+/", $this->password)){
			$query = "SELECT password FROM ".$this->table." WHERE username = :user";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':user', $this->username);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if($result){ //ако $result != null тоест имаме намерен потребител
				if(password_verify($this->password, $result['password'])){
					$this->isValid = true;
				} else {
					$this->lastError = "Невалидни име или парола!";
				}
			} else {
				$this->lastError = "Невалидни име или парола!";// няма такъв user
			}
		} else {
			$this->lastError = "Въведени са грешни данни във формата!";//невалидни символи 
			exit;
		}
	}
    
    
     function emailExist(){
        $query = "SELECT email FROM ".$this->table." WHERE email = :email";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':email', $this->email);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if($result){ $this->lastError = "Този email вече съществува!"; return  true; }
            else return false;
    }
    
    function userNameExist(){
        $query = "SELECT username FROM ".$this->table." WHERE username = :user";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':user', $this->username);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if($result){ $this->lastError = "Потребител с това име вече съществува!"; return true; }
            else return false;
 
    }
    
    
        function getUserId($user){
        $query = "SELECT id FROM ".$this->table." WHERE username = :user";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':user', $this->username);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$result){return -1; }
            else return $result['id'];
 
    }
    
	
	//показва дали потребителя е валиден - дали съществува потребител с това име и парола
	function isValid(){
		return $this->isValid;
	}
	
	//Допълнителни гетери
	
	function getUsername(){
		return $this->username;
	}
    
    function getEmail(){
        return $this->email;
    }
     function getPassword(){
        return $this->password;
    }
    
	
	function getHashedPassword(){
		return $this->hashed;
	}
	
	function getError() {
		return $this->lastError;
        /*return $this->userId;*/
        
	}
  
    function getConnection(){
        return $this->conn;
    }
    
       function setError($msg){
         $this->lastError = $msg;
    }
};

?>
