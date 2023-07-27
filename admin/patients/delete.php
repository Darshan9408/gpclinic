<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
$Id = $_REQUEST['Id'];
$query = ("UPDATE `patients` SET `IsDeleted` = '1' WHERE `ID` = ?");
$params = [$Id];
$Delete = execute($query, $params);

header('Location: ' . urlOf('admin/patients/'));

exit();

?>