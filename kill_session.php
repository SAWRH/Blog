<?php       
require_once "session.php";
unset($_SESSION['user']);
if(!isset($_SESSION['user']))
{
    echo true;
}
else
{
    echo false;
}
?>