<?php

if (!isset($_SESSION['LoggedInUserId']))
{
    header('Location: ' . urlOf('admin/login.php'));
    exit();
}
// if($_SESSION['LoggedInUserId'] == null){
//     header('Location: ' . urlOf('admin/login.php'));
    
// }
?>