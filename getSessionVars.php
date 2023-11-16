<?php
session_start();
/*print_r($_SESSION);*/
if (isset($_SESSION['user']))
{
    $sessInfo=[];
    $sessInfo['user'] = $_SESSION['user'];
    // Другие из сесии которые могут быть переданы
    //$sessInfo[''] = $_SESSION[''];
	echo json_encode($sessInfo); 
}else{
    echo "Информация недоступна";
}
?>