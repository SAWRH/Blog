<?php 

if(isset($_POST["caption"])&&isset($_POST["content"])){

    $caption = $_POST["caption"];
	$content = $_POST["content"];

    

    //echo $content;

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
    $sql="INSERT into articles (caption, content, date, authorID) values ('$caption', '$content', now(), 1)";

    


}



?>