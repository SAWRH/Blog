<?php 
session_start();


if(isset($_GET["name"]) && $_GET["email"] && $_GET["password"])
{
    $name = $_GET["name"];
    $email = $_GET["email"];
	$password = $_GET["password"];
    
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
		echo true;
	}
    else
    {
        echo false;
    }
    
	
	
    
}


?>