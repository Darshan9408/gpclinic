<?php

require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}


if (isset($_POST["submit"])) {


    $Name = $_POST["Name"];
    $RegistrationDateTime = $_POST["RegistrationDateTime"];
    $RegistrationNumber = $_POST["RegistrationNumber"];
    $Age = $_POST["Age"];
    $Address = $_POST["Address"];
    $MobileNumber = $_POST["MobileNumber"];
    $Gender = $_POST["gender"];

    $query = "INSERT INTO patients (`Name`, `RegistrationDateTime`, `MasterRegistrationNumber`, `Age`, `Gender`, `Address`, `MobileNumber`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = [$Name, $RegistrationDateTime, $RegistrationNumber, $Age, $Gender, $Address, $MobileNumber];
    $add = execute($query, $params);

    // print_r($params);

    header('Location: ' . urlOf('admin/patients/'));
    exit();
}

$masterregistrationnumber = selectOne('SELECT MAX(`MasterRegistrationNumber`) as masternumber FROM `patients`');
$masternumber = $masterregistrationnumber['masternumber'] + 1;

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
    <label align="right" style="font-weight: bolder;font-size:large;"><a href="<?= urlOf('admin/patients/')?>" style="" ><i class="bi bi-caret-left-fill"></i>Back</a></label>

        <div class="bg-light rounded h-100 p-4 mx-6">
            <u>
                <h3 class="mb-4">New Patient</h3>
            </u>
            <form action="" method="post">
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Name</label>
                        <input type="text" name="Name" autocomplete="off" class="form-control mb-2" autofocus>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Registration Date Time</label>
                        <?php

                        date_default_timezone_set('Asia/Kolkata');
                        $Format = 'Y-m-d';

                        //This is a past day setting
                        $PD = 1;
                        $PM = 1;
                        $PY = 1;

                        //This is a future day setting
                        $FD = 1;
                        $FM = 1;
                        $FY = 1;


                        $PDT = date($Format, strtotime(" -$PD days -$PM month -$PY years "));
                        $CDT = date($Format);
                        $PDT = date($Format, strtotime(" +$FD days +$FM month +$FY years "));

                        ?>
                        <!-- <input type="date" name="RegistrationDateTime" min="<?= $PDT ?>" value="<?= $CDT ?>" max="<?= $FDT ?>" class="form-control" id="RegistrastionDateTime" required> -->

                        <input type="date" name="RegistrationDateTime" value="<?= $CDT ?>" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Registration Number</label>
                        <input type="text" name="RegistrationNumber"  class="form-control mb-2" readonly value="<?= $masternumber ?>">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Age</label>
                        <input type="text" name="Age" autocomplete="off" class="form-control mb-2">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Address</label>
                        <input type="text" name="Address" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Mobile Number</label>
                        <input type="text" name="MobileNumber" autocomplete="off" class="form-control mb-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2 mt-2">
                        <label class="mx-3">Gender : </label>

                        <input class="form-check-input mx-2" type="radio" name="gender" value="male" required>
                        <label class="form-check-label mx-1" for="gridRadios1">
                            Male
                        </label>
                        <input class="form-check-input mx-2" type="radio" name="gender" value="female">
                        <label class="form-check-label mx-1" for="gridRadios1">
                            Female
                        </label>
                    </div>
                    <div class="col-6 mb-2 w-80 ">
                        <button type="submit" class="btn btn-primary" name="submit">Add Patient</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php
require(pathOf('admin/includes/footer1.php'));
require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>