<?php
require("./init/init.php");

if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
$Id = $_REQUEST['Id'];

$Patients = selectOne("SELECT * FROM `patients` WHERE `Id` = ?", [$Id]);

$consultations = select("SELECT * FROM `consultations` WHERE `IsDeleted` = '0' && `PatientId` = ? ORDER BY DateTime DESC", [$Patients['Id']]);
require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));
?>
<div class="container mx-5">
    <div class="row mt-5 mx-4">
        <div class="bg-light rounded h-100 p-4 mx-6">
            <p style="margin-bottom: 0;color: black;">Patient Name : <?= $Patients['Name'] ?></p>
            <?php foreach ($consultations as $consultation) {
                // print_r($consultation);
            ?>
                <div class="border border-1 border-dark" style="margin-top: 5px;">
                    ==========================================================================
                    <div class="row">
                        <div class="col-3">

                            <p style="margin-bottom: 0;=    ">DateTime : <?= $consultation['DateTime'] ?></p>
                        </div>
                        <div class="col-3">
                            <p style="margin-bottom: 0;">OPD No : <?= $consultation['OutdoorPatientDepartmentNumber'] ?></p>
                        </div>
                    </div>
                    -----------------------------------------------------------------------------------------------------------------------

                    <?php $parameters = select("SELECT * FROM `parameters` WHERE `ConsultationId` = ? ", [$consultation['Id']]);
                    // print_r($parameters);
                    ?>
                    <div style="font-size: 15px;color: gray;">
                        <?php
                        foreach ($parameters as $parameter) {
                        ?>
                            *Parameters : <br>
                            <div class="row" style="margin-left: 4px;">
                                <div class="col-2">
                                    Tempreture: <?= $parameter['Tempreture'] ?>
                                </div>

                                <div class="col-3">
                                    Pulse: <?= $parameter['Pulse'] ?>
                                </div>

                                <div class="col-2">
                                    BloodPressure: <?= $parameter['BloodPressure'] ?>
                                </div>

                            </div>
                            <div class="row" style="margin-left: 4px;">

                                <div class="col-2">
                                    RespiratoryRate: <?= $parameter['RespiratoryRate'] ?>
                                </div>

                                <div class="col-3">
                                    RandomBloodSugar: <?= $parameter['RandomBloodSugar'] ?>
                                </div>

                                <div class="col-2">
                                    Height: <?= $parameter['Height'] ?>
                                </div>

                            </div>
                            <div class="row" style="margin-left: 4px;">

                                <div class="col-2">
                                    Weight: <?= $parameter['Weight'] ?>
                                </div>

                                <div class="col-3">
                                    RandomBloodSugar: <?= $parameter['RandomBloodSugar'] ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    -----------------------------------------------------------------------------------------------------------------------

                    <?php $consultationservices = select("SELECT * FROM `consultationservices` WHERE `IsDeleted` = '0'&& `ConsultationId` = ? ", [$consultation['Id']]);
                    $prescriptions = select("SELECT * FROM `prescriptions` WHERE `ConsultationId` = ? ", [$consultation['Id']]);
                    // print_r($prescriptions);
                    ?>
                    <div class="row">
                        <p style="margin-bottom: 0;">* Services :
                            <?php foreach ($consultationservices as $cs) {
                                $services = select("SELECT * FROM `services` WHERE `IsDeleted` = '0' && `Id` = ? ", [$cs['ServiceId']]);

                                foreach ($services as $s) {

                            ?>

                                    <?= $s['Name'] . " / " ?>
                            <?php }
                            } ?></p>
                    </div>
                    -----------------------------------------------------------------------------------------------------------------------

                    <div class="row">
                        <p style="margin-bottom: 0;">* Medicines :<br>
                            <?php foreach ($prescriptions as $prescription) {
                                $prescriptionmedicines = select("SELECT * FROM `prescriptionmedicines` WHERE `PrescriptionId` = ? ", [$prescription['Id']]);
                                // print_r($prescriptionmedicines);
                                foreach ($prescriptionmedicines as $pms) {
                                    $medicines = select("SELECT * FROM `medicines` WHERE `Id` = ? ", [$pms['MedicineId']]);
                                    //  print_r($medicines);
                                    foreach ($medicines as $m) {
                            ?>
                        <div style="margin-left: 8px;">
                        <?php echo $m['Name'] . " = ";
                                    }
                                    echo $pms['BeforeOrAfterFood'] . " Food --" ?>
                    <?php if ($pms['MorningDose'] == 1) {
                                        echo "/ Morning ";
                                    }
                                    if ($pms['AfternoonDose'] == 1) {
                                        echo "/ AfterNoon   ";
                                    }
                                    if ($pms['EveningDose'] == 1) {
                                        echo "/ Evening  ";
                                    }
                                    if ($pms['NightDose'] == 1) {
                                        echo "/ Night  ";
                                    }
                                    echo "-- " . $pms['Days'] . " : Days <br>";
                                } ?>
                        </div>
                    </div>
                    </div>
            <?php }
                        } ?></p>
                

        </div>
        <?php
        require(pathOf('admin/includes/footer1.php'));
        require(pathOf('admin/includes/script.php'));
        require(pathOf('admin/includes/footer2.php'));
        ?>
    </div>