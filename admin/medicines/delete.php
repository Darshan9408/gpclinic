<?php
require("../init/init.php");

if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
$Id = $_REQUEST['Id'];
$medicines = selectOne("SELECT * FROM `medicines` WHERE `Id` = ?", [$Id]);

// $query = "DELETE FROM `medicines` WHERE `Id` = ?";
$query = ("UPDATE `medicines` SET `IsDeleted` = '1' WHERE `ID` = ?");

$params = [$Id];

$add = execute($query, $params);

header('Location: ' . urlOf('admin/medicines/'));


?>