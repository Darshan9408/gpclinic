<?php

require("../init/init.php");
if ($_SESSION['LoggedInUserId'] == null) {
    header('Location: ' . urlOf('admin/login.php'));
}
if (isset($_POST["submit"])) {

    $PatientId = $_POST['PatientId'];

    $Weight = $_POST['Weight'];
    $WeightSelect = $_POST['WeightSelect'];
    $Bmi = $_POST['Bmi'];
    $BmiSelect = $_POST['BmiSelect'];
    $Fat = $_POST['Fat'];
    $FatSelect = $_POST['FatSelect'];
    $BodyFatWeight = $_POST['BodyFatWeight'];
    $BodyFatWeightSelect = $_POST['BodyFatWeightSelect'];
    $SkeletalMuscle = $_POST['SkeletalMuscle'];
    $SkeletalMuscleSelect = $_POST['SkeletalMuscleSelect'];
    $SkeletalMuscleWeight = $_POST['SkeletalMuscleWeight'];
    $SkeletalMuscleWeightSelect = $_POST['SkeletalMuscleWeightSelect'];
    $Muscle = $_POST['Muscle'];
    $MuscleSelect = $_POST['MuscleSelect'];
    $MuscleWeight = $_POST['MuscleWeight'];
    $MuscleWeightSelect = $_POST['MuscleWeightSelect'];
    $Water = $_POST['Water'];
    $WaterSelect = $_POST['WaterSelect'];
    $WaterContent = $_POST['WaterContent'];
    $WaterContentSelect = $_POST['WaterContentSelect'];
    $Visceralfat = $_POST['VisceralFat'];
    $VisceralfatSelect = $_POST['VisceralFatSelect'];
    $Bonemass = $_POST['BoneMass'];
    $BonemassSelect = $_POST['BoneMassSelect'];
    $Metabolism = $_POST['Metabolism'];
    $MetabolismSelect = $_POST['MetabolismSelect'];
    $Protein = $_POST['Protein'];
    $ProteinSelect = $_POST['ProteinSelect'];
    $Obesity = $_POST['Obesity'];
    $ObesitySelect = $_POST['ObesitySelect'];
    $BodyAge = $_POST['BodyAge'];
    $LBM = $_POST['LBM'];
    $OutdoorPatientDepartmentNumber = $_POST['OutdoorPatientDepartmentNumber'];



    $query = "INSERT INTO `bmi` ( `Weight`, `Bmi`, `Fat`, `BodyFatWeight`, `SkeletalMuscle`, `SkeletalMuscleWeight`, `Muscle`, `MuscleWeight`, `Water`, `WaterContent`, `VisceralFat`, `BoneMass`, `Metabolism`, `Protein`, `Obesity`, `BodyAge`, `LBM`,`OutdoorPatientDepartmentNumber`, `PatientId`) VALUES (?, ?, ?,?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $params = [$Weight, $Bmi, $Fat, $BodyFatWeight, $SkeletalMuscle, $SkeletalMuscleWeight, $Muscle, $MuscleWeight, $Water, $WaterContent, $Visceralfat, $Bonemass, $Metabolism, $Protein, $Obesity, $BodyAge, $LBM, $OutdoorPatientDepartmentNumber, $PatientId];
    // print_r($params);
    execute($query, $params);

    $BmiId = lastInsertId();

    $query = "INSERT INTO `bmiunit` ( `Weight`, `Bmi`, `Fat`, `BodyFatWeight`, `SkeletalMuscle`, `SkeletalMuscleWeight`, `Muscle`, `MuscleWeight`, `Water`, `WaterContent`, `VisceralFat`, `BoneMass`, `Metabolism`, `Protein`, `Obesity`, `BmiId`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$WeightSelect, $BmiSelect, $FatSelect, $BodyFatWeightSelect, $SkeletalMuscleSelect, $SkeletalMuscleWeightSelect, $MuscleSelect, $MuscleWeightSelect, $WaterSelect, $WaterContentSelect, $VisceralfatSelect, $BonemassSelect, $MetabolismSelect, $ProteinSelect, $ObesitySelect, $BmiId];
    // print_r($params);
    execute($query, $params);



    header('Location: ' . urlOf('admin/BMI/viewpatients.php'));

    exit();
}


require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>

<div class="container mx-5">
    <div class="row mt-5 mx-4" style="color: black;">
        <label align="right" style="font-weight: bolder;font-size:large;"><a href="<?= urlOf('admin/BMI/viewpatients.php') ?>" style=""><i class="bi bi-caret-left-fill"></i>Back</a></label>

        <div class="bg-light rounded h-100 p-4 mx-6">
            <u>
                <h3>BMI</h3>
            </u>
            <form action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <?php $rows = select("SELECT * FROM `patients` where `IsDeleted` = '0'"); ?>
                        <label>Patients Name : </label>
                        <select Name="PatientId" class="form-select" autofocus style="width: 15rem;display: unset;">
                            <option>Select Patient Name</option>
                            <?php foreach ($rows as $r) { ?>
                                <option value="<?= $r['Id'] ?>"><?= $r['Name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Weight
                            </div>
                            <div class="col-3">
                                <input type="text" name="Weight" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">KG</div>
                            <div class="col-4">
                                <select name="WeightSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Bmi
                            </div>
                            <div class="col-3">
                                <input type="text" name="Bmi" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1"></div>

                            <div class="col-4">
                                <select name="BmiSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Fat
                            </div>
                            <div class="col-3">
                                <input type="text" name="Fat" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">
                                %
                            </div>
                            <div class="col-4">
                                <Select name="FatSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                BodyFat Weight
                            </div>
                            <div class="col-3">
                                <input type="text" name="BodyFatWeight" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">KG</div>
                            <div class="col-4">
                                <select name="BodyFatWeightSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Skeletal Muscle
                            </div>
                            <div class="col-3">
                                <input type="text" name="SkeletalMuscle" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">%</div>

                            <div class="col-4">
                                <select name="SkeletalMuscleSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Skeletal Muscle Weight
                            </div>
                            <div class="col-3">
                                <input type="text" name="SkeletalMuscleWeight" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">KG</div>

                            <div class="col-4">
                                <select name="SkeletalMuscleWeightSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Muscle
                            </div>
                            <div class="col-3">
                                <input type="text" name="Muscle" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">%</div>

                            <div class="col-4">
                                <select name="MuscleSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Muscle Weight
                            </div>
                            <div class="col-3">
                                <input type="text" name="MuscleWeight" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">KG</div>

                            <div class="col-4">
                                <select name="MuscleWeightSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Water
                            </div>
                            <div class="col-3">
                                <input type="text" name="Water" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">%</div>

                            <div class="col-4">
                                <select name="WaterSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Water Content
                            </div>
                            <div class="col-3">
                                <input type="text" name="WaterContent" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1"></div>

                            <div class="col-4">
                                <select name="WaterContentSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Visceral Fat
                            </div>
                            <div class="col-3">
                                <input type="text" name="VisceralFat" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1"></div>

                            <div class="col-4">
                                <select name="VisceralFatSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Bone Mass
                            </div>
                            <div class="col-3">
                                <input type="text" name="BoneMass" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">KG</div>

                            <div class="col-4">
                                <select name="BoneMassSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Metabolism
                            </div>
                            <div class="col-3">
                                <input type="text" name="Metabolism" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1"></div>
                            <div class="col-4">
                                <select name="MetabolismSelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Protein
                            </div>
                            <div class="col-3">
                                <input type="text" name="Protein" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">%</div>

                            <div class="col-4">
                                <select name="ProteinSelect" class="form-select" style="width: 8rem;display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Obesity
                            </div>
                            <div class="col-3">
                                <input type="text" name="Obesity" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">%</div>

                            <div class="col-4">
                                <select name="ObesitySelect" class="form-select" style="display: unset;">
                                    <option>Obese</option>
                                    <option>Low</option>
                                    <option>High</option>
                                    <option>Excellent</option>
                                    <option>Severe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                Body Age
                            </div>
                            <div class="col-3">
                                <input type="text" name="BodyAge" autocomplete="off" class="form-control">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                LBM
                            </div>
                            <div class="col-3">
                                <input type="text" name="LBM" autocomplete="off" class="form-control">

                            </div>
                            <div class="col-1">KG</div>

                        </div>
                    </div>
                    <div class="col-6">
                        <?php
                        $OutdoorPatientDepartmentNumbers = selectOne('SELECT MAX(`OutdoorPatientDepartmentNumber`) as OutdoorPatient FROM `bmi`');
                        $OutdoorPatient = $OutdoorPatientDepartmentNumbers['OutdoorPatient'] + 1;
                        ?>
                        <div class="row">

                            <div class="col-3">
                                OPD Number
                                
                            </div>
                            <div class="col-3">
                                <input type="text" name="OutdoorPatientDepartmentNumber" autocomplete="off" class="form-control" readonly value="<?= $OutdoorPatient ?>">
                                
                            </div>
                            <div class="col-3">

                                <button type="submit" class="btn btn-primary" name="submit">Add BMI</button>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>

    <?php
    require(pathOf('admin/includes/footer1.php'));
    require(pathOf('admin/includes/script.php'));
    require(pathOf('admin/includes/footer2.php'));
    ?>
</div>