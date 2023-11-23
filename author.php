<?php
session_start();
//print_r($_POST);// DEBUG
//echo "POST:".print_r($_POST);
if (isset($_POST["login"]) && isset($_POST["password"])) {   
    
	$login = $_POST["login"];
	$password = $_POST["password"];
	//echo "DEBUG получили лигин и пароль $login $password";
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
    $sql = "SELECT * FROM users WHERE email = '$login' AND password='$password'";
	//echo "DEBUG Установили соединение с БД sql = $sql";
    if ($result = $conn->query($sql))
	{
		if ($result->num_rows>0)
		{
			$row=$result->fetch_assoc();
		//	echo "DEBUG Пользователь авторизован";
			$_SESSION['user'] = 
			[
				
				'name' => $row['name'],
				'email' => $row['email']
				
				
			];
		//	require_once("getSessionVars.php");
			echo 'done';
		}else
		{
		//	echo "DEBUG Пользователь не авторизован";
			echo '';
		}
		

	}
	//echo "DEBUG Скрипт завершен";
}




?>