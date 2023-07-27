<?php

require("../init/init.php");
if ($_SESSION['LoggedInUserId'] == null) {
    header('Location: ' . urlOf('admin/login.php'));
}
// require(pathOf('admin/includes/header.php'));
// require(pathOf('admin/includes/nav.php'));
// require(pathOf('admin/includes/sidebar.php'));

$Id = $_REQUEST['Id'];
// echo $Id;

$Patients = selectOne("SELECT * FROM `patients` WHERE `Id` = ?", [$Id]);
// print_r($Patients);

// print_r($Bmis)

$Bmiid = selectOne('SELECT MAX(`Id`) as bmiid FROM `bmi` where `PatientId`= ' . $Id . '');
$BmiPatient = selectOne('SELECT * from bmi where `PatientId` = ' . $Id . ' AND `Id`  = '.$Bmiid['bmiid'].'');
// print_r($BmiPatient['']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GP Clinic</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class=" invoice">
        <div class=" row invoice_header">
            <div class=" col-3 logo">
                <img src="Image/Logo.png" alt="" style="height: 105px; width:120px;padding-left: 10px;">
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4 ">
                        <div class="oval ">
                            <p class="mt-3" style=" margin: 14px;font-family: cursive;font-weight: bold; font-size: 20px;color: black;">
                                G.P.CLINIC<br>
                            </p>
                        </div>
                    </div>

                    <div class="col-8 mt-3">

                        <div class="name mt-1" style="color: black;" align="right">Dr. Malay K. Acharya<br>(M.B.B.S)</div>
                    </div>
                </div>
                <div class="row">

                    <p style="font-size: 15px;font-family: 'Cambria';color: black;"> <img src="Image/map.png" alt="" class="mx-2" style="height: 18px; width:20px;">3rd Floor, Shreeji Square , Valkeshwari, Jamnagar</p>

                    <p style="font-size: 15px;font-family: 'Cambria';color: black;"> <img src="Image/call.png" alt="" class="mx-2" style="height: 18px; width:20px;">0288 - 2990105</p>
                </div>
            </div>
        </div>
        <hr style="border: 2px solid black;">

        <!-- <div class=""> -->
        <div class="row">
            <div class="col-12">
                <p style="margin-bottom: 0;color: black;">Patient Name : <?= $Patients['Name'] ?></p>

                <b>
                    <hr style="border: 2px solid black;">
                </b>
            </div>
        </div>
        <!-- <div class="row">
                    <div class="col-3">
                        Weight
                    </div>
                    <div class="col-3">
                        Units
                    </div>
                    <div class="col-3">
                        Weight
                    </div>
                </div> -->
        <?php
        // $Bmis = select("SELECT * FROM `Bmi` WHERE `PatientId` = ? ", [$Id]);

        // foreach ($BmiPatient as $Bmi) {
            // print_r($Bmi);
            $B=$BmiPatient['Id'];
            $BmiUnits = select("SELECT * FROM `Bmiunit` WHERE `BmiId` = ?", [$B]);

            // foreach ($Bmis as $Bmi){
                // print_r($BmiUnits[0]['Id']);
            // foreach ($BmiUnits[0] as $BmiUnits[0]) {
        ?>

                <div class="row">
                    <div class="col-4">
                        Weight
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Weight'] . " kg" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Weight'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Bmi
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Bmi'] ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Bmi'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Fat
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Fat'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Fat'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Body Fat Weight
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['BodyFatWeight'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['BodyFatWeight'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Skeletal Muscle
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['SkeletalMuscle'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['SkeletalMuscle'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Skeletal Muscle Weight
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['SkeletalMuscleWeight'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['SkeletalMuscleWeight'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Muscle
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Muscle'] . " kg" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Muscle'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Muscle Weight
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['MuscleWeight'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['MuscleWeight'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Water
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Water'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Water'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Water Content
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['WaterContent'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['WaterContent'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        VisceralFat
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['VisceralFat'] ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['VisceralFat'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        BoneMass
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['BoneMass'] . " kg" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['BoneMass'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Metabolism
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Metabolism'] ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Metabolism'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Protein
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Protein'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Protein'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Obesity
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['Obesity'] . " %" ?>
                    </div>
                    <div class="col-3">
                        <?= $BmiUnits[0]['Obesity'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Body Age
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['BodyAge'] ?>
                    </div>
                    <!-- <div class="col-3">
                            <?= $BmiUnits[0]['BodyAge'] ?>
                        </div> -->
                </div>
                <div class="row mt-1">
                    <div class="col-4">
                        Lbm
                    </div>
                    <div class="col-2">
                        <?= $BmiPatient['LBM'] ?>
                    </div>
                    <!-- <div class="col-3">
                            <?= $BmiUnits[0]['LBM'] ?>
                        </div> -->
                </div>
        

        <?php
        // require(pathOf('admin/includes/footer1.php'));
        require(pathOf('admin/includes/script.php'));
        // require(pathOf('admin/includes/footer2.php'));
        ?>

    </div>
    <!-- </div>  -->
</body>

</html>