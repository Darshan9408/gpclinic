<?php

require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}

if (isset($_POST["submit"])) {

    $Id = $_REQUEST["Id"];
    $Name = $_POST["Name"];
    $DefaultAmount = $_POST["DefaultAmount"];

    $query = " UPDATE `services` SET `Name`= ? , `DefaultAmount` = ? WHERE `Id` = ?";
    $params = [$Name, $DefaultAmount, $Id];
    $add = execute($query, $params);
    header('Location: ' . urlOf('admin/Parameters/'));

    exit();
}

$Id = $_REQUEST['Id'];
$Services = selectOne("SELECT * FROM `services` WHERE `Id` = ?", [$Id]);

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));


?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
    <label align="right" style="font-weight: bolder;font-size:large;"><a href="<?= urlOf('admin/Parameters/')?>" style="" ><i class="bi bi-caret-left-fill"></i>Back</a></label>

        <div class="col-6">
            <div class="bg-light rounded h-100 p-4 mx-6">
                <div class="col-12">
                    <u>
                        <h4 class="mb-4">New Service</h4>
                    </u>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <label class="mb-2">Name</label>
                                <input type="text" name="Name" class="form-control mb-2" autocomplete="off" value="<?= $Services['Name'] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label class="mb-2">Default Amount</label>
                                <input type="text" name="DefaultAmount" class="form-control mb-2" autocomplete="off" value="<?= $Services['DefaultAmount'] ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" name="submit">Update Parameter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    require(pathOf('admin/includes/footer1.php'));
    require(pathOf('admin/includes/script.php'));
    require(pathOf('admin/includes/footer2.php'));
    ?>