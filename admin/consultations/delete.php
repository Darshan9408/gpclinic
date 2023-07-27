<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}

$Id = $_REQUEST['Id'];
$medicines = selectOne("SELECT * FROM `consultations` WHERE `Id` = ?", [$Id]);

$query = ("UPDATE `consultations` SET `IsDeleted` = '1' WHERE `ID` = ?");
$params = [$Id];
$add = execute($query, $params);

execute("DELETE FROM `consultationservices` WHERE `ConsultationId` = ?",[$Id]);
execute("DELETE FROM `parameters` WHERE `ConsultationId` = ?",[$Id]);
execute("DELETE FROM `prescriptions` WHERE `ConsultationId` = ?",[$Id]);

header('Location: ' . urlOf('admin/consultations/'));


?>