<?php 
require_once("session.php");


if(isset($_POST["name"]) && $_POST["email"] && $_POST["password"])
{
    $name = $_POST["name"];
    $email = $_POST["email"];
	$password = $_POST["password"];
    
    define('DBSERVER', 'localhost'); // Database server
    define('DBUSERNAME', 'root'); // Database username
    define('DBPASSWORD', 'root'); // Database password
    define('DBNAME', 'blog'); // Database name
    
    /* connect to MySQL database */
    $conn = new mysqli(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME); // Создает соединение
	$conn->set_charset("utf8mb4");// Устанавливает кодировку
	
    
    // Check db connection
    if($conn->connect_error){
		die("Ошибка: " . $conn->connect_error); // Если все плохо - умираем
	}
    $sql="INSERT into users (name, email, password) values ('$name', '$email', '$password')";

	
    if ($result = $conn->query($sql))
	{
        $_SESSION['user'] = 
		[
			
			'name' => $name,
            'email' => $email
            
			
		];
         
        //require_once("getSessionVars.php");
        echo 'done';
	}
    else
    {
        echo '';
    }
    
	
	
    
}


?>