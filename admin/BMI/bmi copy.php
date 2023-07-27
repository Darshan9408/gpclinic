<?php

require("../init/init.php");

if (isset($_POST["submit"])) {

    $PatientId = $_POST['PatientId'];
    $Weight = $_POST['Weight'];
    $array = ['Weight'];
    $Weightarr = implode(" ", $array);
    $WeightSelect = $_POST['WeightSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Weightarr, $Weight, $WeightSelect, $PatientId];
    execute($query, $params);
    
    $Bmi = $_POST['Bmi'];
    $array = ['Bmi'];
    $Bmiarr = implode(" ", $array);
    $BmiSelect = $_POST['BmiSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Bmiarr, $Bmi, $BmiSelect, $PatientId];
    execute($query, $params);
    
    $Fat = $_POST['Fat'];
    $array = ['Fat'];
    $Fatarr = implode(" ", $array);
    $FatSelect = $_POST['FatSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Fatarr, $Fat, $FatSelect, $PatientId];
    execute($query, $params);
    
    $Muscle = $_POST['Muscle'];
    $array = ['Muscle'];
    $Musclearr = implode(" ", $array);
    $MuscleSelect = $_POST['MuscleSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Musclearr, $Muscle, $MuscleSelect, $PatientId];
    execute($query, $params);
    
    $Water = $_POST['Water'];
    $array = ['Water'];
    $Waterarr = implode(" ", $array);
    $WaterSelect = $_POST['WaterSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Waterarr, $Water, $WaterSelect, $PatientId];
    execute($query, $params);
    
    $Visceralfat = $_POST['Visceralfat'];
    $array = ['Visceral Fat'];
    $Visceralfatarr = implode(" ", $array);
    $VisceralfatSelect = $_POST['VisceralfatSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Visceralfatarr, $Visceralfat, $VisceralfatSelect, $PatientId];
    execute($query, $params);
    
    $Bonemass = $_POST['Bonemass'];
    $array = ['Bone Mass'];
    $Bonemassarr = implode(" ", $array);
    $BonemassSelect = $_POST['BonemassSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Bonemassarr, $Bonemass, $BonemassSelect, $PatientId];
    execute($query, $params);
    
    $Metabolism = $_POST['Metabolism'];
    $array = ['Metabolism'];
    $Metabolismarr = implode(" ", $array);
    $MetabolismSelect = $_POST['MetabolismSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Metabolismarr, $Metabolism, $MetabolismSelect, $PatientId];
    execute($query, $params);
    
    $Protein = $_POST['Protein'];
    $array = ['Protein'];
    $Proteinarr = implode(" ", $array);
    $ProteinSelect = $_POST['ProteinSelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Proteinarr, $Protein, $ProteinSelect, $PatientId];
    execute($query, $params);
    
    $Obesity = $_POST['Obesity'];
    $array = ['Obesity'];
    $Obesityarr = implode(" ", $array);
    $ObesitySelect = $_POST['ObesitySelect'];
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`, `MeasureUnit`,  `PatientId`) VALUES(?, ?, ?, ?)";
    $params = [$Obesityarr, $Obesity, $ObesitySelect, $PatientId];
    execute($query, $params);
    
    $Bodysge = $_POST['Bodysge'];
    $array = ['Body Age'];
    $Bodysgearr = implode(" ", $array);
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`,  `PatientId`) VALUES(?, ?, ?)";
    $params = [$Bodysgearr, $Bodysge, $PatientId];
    execute($query, $params);

    $Lbm = $_POST['Lbm'];
    $array = ['Lbm'];
    $Lbmarr = implode(" ", $array);
    $query = "INSERT INTO `Bmi` (`Name`, `Unit`,  `PatientId`) VALUES(?, ?, ?)";
    $params = [$Lbmarr, $Lbm, $PatientId];
    execute($query, $params);

    header('Location: ' . urlOf('admin/BMI/bmi.php'));
    
    exit();
}


require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
        <div class="bg-light rounded h-100 p-4 mx-6">
            <u>
                <h3 class="mb-4">BMI</h3>
            </u>
            <div class="row mx-5">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="col-6 mb-5">
                                <?php $rows = select("SELECT * FROM `patients` where `IsDeleted` = '0'"); ?>
                                <label>Patients Name : </label>
                                <select Name="PatientId" autofocus>
                                    <option>Select Patient Name</option>
                                    <?php foreach ($rows as $r) { ?>
                                        <option value="<?= $r['Id'] ?>"><?= $r['Name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="row mb-2">
                                <label class="col-3  col-form-label">Weight</label>
                                <div class="col-4  mb-2">
                                    <input type="text" name="Weight" autocomplete="off" class="form-control mb-2">
                                </div>
                                <label class="col-1 col-form-label">Kg</label>
                                <div class="col-2 mb-2">
                                    <select name="WeightSelect">
                                        <option>Obset</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Excellent</option>
                                        <option>Severe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">BMI</label>
                                    <div class="col-4 mb-2">
                                        <input type="text" name="Bmi" autocomplete="off" style="width: 145px;" class="form-control mb-2" autofocus>
                                    </div>
                                    <!-- <label class="col-2 col-form-label"></label> -->
                                    <div class="col-3 mb-2" style="margin-left: 54px;">
                                        <select name="BmiSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Fat</label>
                                    <div class="col-4 mb-2">
                                        <input type="text" name="Fat" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;">%</label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="FatSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Muscle</label>
                                    <div class="col-4 mb-2">
                                        <input type="text" name="Muscle" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;">Kg</label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="MuscleSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Water</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Water" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;">%</label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="WaterSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3 col-form-label">Visceral Fat</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Visceralfat" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;"></label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="VisceralfatSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Bone Mass</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Bonemass" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;">Kg</label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="BonemassSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Metabolism</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Metabolism" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;"></label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="MetabolismSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Protein</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Protein" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;">%</label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="ProteinSelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Obesity</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Obesity" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;">%</label>
                                    <div class="col-1 mb-2" style="margin-left: 1px;">
                                        <select name="ObesitySelect">
                                            <option>Obset</option>
                                            <option>Low</option>
                                            <option>High</option>
                                            <option>Excellent</option>
                                            <option>Severe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">Body Age</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Bodysge" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mb-2">
                                    <label class="col-3  col-form-label">LBM</label>
                                    <div class="col-4  mb-2">
                                        <input type="text" name="Lbm" style="width: 145px;" autocomplete="off" class="form-control mb-2" autofocus>
                                    </div>
                                    <label class="col-1 col-form-label" style="margin-left:15px;"></label>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <button type="submit" class="btn btn-primary" name="submit">submit</button>
                            </div>
                        </div>
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
</div>