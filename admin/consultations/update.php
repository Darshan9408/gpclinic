<?php

require("../init/init.php");
if ($_SESSION['LoggedInUserId'] == null) {
    header('Location: ' . urlOf('admin/login.php'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Id = $_REQUEST['Id'];
    $DateTime = $_POST['DateTime'];
    $OutdoorPatientDepartmentNumber = $_POST['OutdoorPatientDepartmentNumber'];
    $Complaint = $_POST['Complaint'];
    $Remarks = $_POST['Remarks'];
    $TotalChargedAmount = $_POST['TotalChargedAmount'];
    $DiscountAmount = $_POST['DiscountAmount'];
    $PatientId = $_POST['PatientId'];

    $query = "UPDATE consultations SET `DateTime` = ?, `OutdoorPatientDepartmentNumber` = ?, `Complaint` = ?, `Remarks` = ? , `TotalChargedAmount` = ? ,`DiscountAmount` = ?,`PatientId` =? Where Id = ? ";
    $params = [$DateTime, $OutdoorPatientDepartmentNumber, $Complaint, $Remarks, $TotalChargedAmount, $DiscountAmount, $PatientId, $Id];
    $add = execute($query, $params);

    $Tempreture = $_POST['Tempreture'];
    $Pulse = $_POST['Pulse'];
    $BloodPressure = $_POST['BloodPressure'];
    $RespiratoryRate = $_POST['RespiratoryRate'];
    $RandomBloodSugar = $_POST['RandomBloodSugar'];
    $Height = $_POST['Height'];
    $Weight = $_POST['Weight'];

    execute("DELETE FROM `parameters` WHERE `ConsultationId` = ?", [$Id]);
    $query = "INSERT INTO `parameters` (`Tempreture`, `Pulse`, `BloodPressure`, `RespiratoryRate`, `RandomBloodSugar`, `Height`, `Weight`, `ConsultationId`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$Tempreture, $Pulse, $BloodPressure, $RespiratoryRate, $RandomBloodSugar, $Height, $Weight, $Id];
    execute($query, $params);

    execute("DELETE FROM `consultationservices` WHERE `ConsultationId` = ?", [$Id]);
    $ConsultationServices = $_POST['Services'];

    foreach ($ConsultationServices as $ConsultationService) {
        $ServiceId = $ConsultationService["ServiceId"];
        $AmountCharged = $ConsultationService["AmountCharged"];

        $query = "INSERT INTO `consultationservices` (`AmountCharged`,`ConsultationId`, `ServiceId`) VALUES (?, ?, ?)";
        $params = [$AmountCharged, $Id, $ServiceId];

        execute($query, $params);
    }

    $ExtraNotes = $_POST['ExtraNotes'];
    $TotalPrice = $_POST['TotalPrice'];

    execute("DELETE FROM `prescriptions` WHERE `ConsultationId` = ?", [$Id]);
    $query = "INSERT INTO `prescriptions` (`PrescribedOnDateTime`, `ExtraNotes`, `TotalPrice`, `ConsultationId`) VALUES (?, ?, ?, ?)";
    $params = [$DateTime, $ExtraNotes, $TotalPrice, $Id];
    execute($query, $params);

    $PrescriptionId = lastInsertId();
    $PrescriptionMedicines = $_POST['PrescribedMedicines'];

    execute("DELETE FROM `prescriptionmedicines` WHERE `PrescriptionId` = ?", [$PrescriptionId]);
    foreach ($PrescriptionMedicines as $PrescriptionMedicine) {

        $Quantity = $PrescriptionMedicine['Quantity'];
        $PricePerPiece = $PrescriptionMedicine['PricePerPiece'];
        $MorningDose = $PrescriptionMedicine['MorningDose'];
        $AfternoonDose = $PrescriptionMedicine['AfternoonDose'];
        $EveningDose = $PrescriptionMedicine['EveningDose'];
        $NightDose = $PrescriptionMedicine['NightDose'];
        $BeforeOrAfterFood = $PrescriptionMedicine['BeforeOrAfterFood'];
        $MedicineId = $PrescriptionMedicine['MedicineId'];
        $Days = $PrescriptionMedicine['Days'];
        $query = "INSERT INTO `PrescriptionMedicines` (Quantity, PricePerPiece, MorningDose, AfternoonDose, EveningDose, NightDose, BeforeOrAfterFood, PrescriptionId, MedicineId,Days) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $params = [
            $Quantity,
            $PricePerPiece,
            $MorningDose === "true" ? 1 : 0,
            $AfternoonDose === "true" ? 1 : 0,
            $EveningDose === "true" ? 1 : 0,
            $NightDose === "true" ? 1 : 0,
            $BeforeOrAfterFood,
            $PrescriptionId,
            $MedicineId,
            $Days,
        ];

        execute($query, $params);
    }
    header('Location: ' . urlOf('admin/Consultations/'));

    exit();
}


$Id = $_REQUEST['Id'];
$total = 0;
$Consultation = selectOne("SELECT * FROM `consultations` WHERE `Id` = ?", [$Id]);

$parameter = selectOne("SELECT * FROM `parameters` WHERE `ConsultationId` = ?", [$Id]);

$prescription = selectOne("SELECT * FROM `prescriptions` WHERE `ConsultationId` = ?", [$Id]);

$prescriptionId = $prescription['Id'];
$prescriptionmedicines = select("SELECT * FROM `prescriptionmedicines` WHERE  `PrescriptionId` = ?", [$prescriptionId]);

$oldservices = select('SELECT *,services.Name FROM consultationservices INNER JOIN services ON consultationservices.ServiceId = services.Id WHERE consultationservices.ConsultationId = ?', [$Id]);
$oldmedicines = select('SELECT *,medicines.Name, prescriptions.ConsultationId, prescriptionmedicines.MorningDose as givenMorningDose, prescriptionmedicines.AfternoonDose as givenAfternoonDose, prescriptionmedicines.EveningDose as givenEveningDose, prescriptionmedicines.NightDose as givenNightDose, prescriptionmedicines.BeforeOrAfterFood as givenBeforeOrAfterFood  FROM prescriptionmedicines INNER JOIN medicines ON prescriptionmedicines.MedicineId = medicines.Id INNER JOIN prescriptions ON prescriptionmedicines.PrescriptionId = prescriptions.Id WHERE prescriptions.ConsultationId = ?', [$Id]);


$prescription = selectOne("SELECT * FROM `prescriptions` WHERE `ConsultationId` = ?", [$Id]);

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));


?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
        <form action="" method="post" onsubmit="return false;">
            <div class="bg-light rounded h-100 p-4 mx-6">
                <div class="row">
                    <div class="col-4 mb-2">
                        <u>
                            <h3 class="mb-4">Consultations</h3>
                        </u>
                    </div>

                    <div class="row">

                        <?php $selected = selectOne("SELECT * FROM patients Where `Id` = ? ", [$Consultation['PatientId']]); ?>

                        <div class="col-6 mb-2">
                            <?php $rows = select("SELECT * FROM patients"); ?>

                            <label class="mb-2">Patients Name</label>
                            <select id="PatientId" class="form-select" autofocus style="width: 15rem;display: unset;">
                                <option>Select Patient Name</option>
                                <?php foreach ($rows as $r) { ?>

                                    <option value="<?= $r['Id'] ?>" <?php
                                                                    if ($selected['Name'] == $r['Name']) {
                                                                        echo "Selected";
                                                                    }
                                                                    ?>> <?= $r['Name'] ?> </option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-6 row mb-2">
                            <label class="col-3 col-form-label">Date Time</label>
                            <div class="col-sm-9 mb-2">
                                <input type="datetime" id="DateTime" value="<?= $Consultation['DateTime'] ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label class="mb-2">Outdoor Patient DepartmentNumber</label>
                            <input type="text" id="OutdoorPatientDepartmentNumber" class="form-control mb-2" value="<?= $Consultation['OutdoorPatientDepartmentNumber'] ?>" readonly>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="mb-2">Complaint</label>
                            <input type="text" id="Complaint" class="form-control mb-2" value="<?= $Consultation['Complaint'] ?>" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6 mb-2">
                        <label class="mb-2">Remarks</label>
                        <input type="text" id="Remarks" class="form-control mb-2" value="<?= $Consultation['Remarks'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <!-- <label class="mb-2">TotalChargedAmount</label> -->
                        <input type="hidden" id="TotalChargedAmount" class="form-control mb-2" value="<?= $Consultation['TotalChargedAmount'] ?>" onfocusout="displayTotal();" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <!-- <label class="mb-2">Discount Amount</label> -->
                        <input type="hidden" id="DiscountAmount" class="form-control mb-2" value="<?= $Consultation['DiscountAmount'] ?>" onfocusout="displayTotal();" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <!-- <label class="mb-2">Total Price</label> -->
                        <input type="hidden" id="TotalPrice" class="form-control mb-2" value="<?= $prescription['TotalPrice'] ?>" readonly>
                    </div>
                </div>
                <div class="col-4 mb-2  mt-5">
                    <u>
                        <h3 class="mb-4">Parameters</h3>
                    </u>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Tempreture</label>
                        <input type="text" id="Tempreture" class="form-control mb-2" autocomplete="off" value="<?= $parameter['Tempreture'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Pulse</label>
                        <input type="text" id="Pulse" class="form-control mb-2" autocomplete="off" value="<?= $parameter['Pulse'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Blood Pressure</label>
                        <input type="text" id="BloodPressure" class="form-control mb-2" autocomplete="off" value="<?= $parameter['BloodPressure'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Respiratory Rate</label>
                        <input type="text" id="RespiratoryRate" class="form-control mb-2" autocomplete="off" value="<?= $parameter['RespiratoryRate'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Random Blood Sugar</label>
                        <input type="text" id="RandomBloodSugar" class="form-control mb-2" autocomplete="off" value="<?= $parameter['RandomBloodSugar'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Height</label>
                        <input type="text" id="Height" class="form-control mb-2" autocomplete="off" value="<?= $parameter['Height'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Weight</label>
                        <input type="text" id="Weight" class="form-control mb-2" autocomplete="off" value="<?= $parameter['Weight'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Extra Notes</label>
                        <input type="text" id="ExtraNotes" class="form-control mb-2" autocomplete="off" value="<?= $prescription['ExtraNotes'] ?>" autocomplete="off">
                    </div>
                </div>

                <div class="col-4 mb-2 mt-5">
                    <u>
                        <h3 class="mb-4">Services</h3>
                    </u>
                </div>
                <div class="row">

                    <div class="col-6 mb-3">
                        <label class="mb-2">Service Name :</label>
                        <form>
                            <select id="ServicesId" class="form-select" autofocus style="width: 15rem;display: unset;">
                                <option> Select Service Name </option>

                                <?php
                                $rows = select("SELECT * FROM services");

                                foreach ($rows as $r) { ?>
                                    <?php
                                    ?>
                                    <option value=" <?= $r['Id']; ?>">
                                        <?= $r['Name']; ?>
                                    </option>

                                <?php } ?>
                            </select>
                            <button type="button" id="Add Services" class="btn btn-sm" style=" margin-left: 5px; background-color: #82CAFF;color:black;font-weight: bold;" onclick="addServicesData()"> Add Services</button>
                        </form>

                        <table class="table table-light table-bordered mt-2 ">
                            <thead class="table-primary">
                                <tr>
                                    <div class="row">
                                        <div class="col-6">
                                            <th scope="col">Name</th>

                                        </div>
                                        <div class="col-6">
                                            <th scope="col">Amount Charged</th>
                                            <th scope="col">Remove</th>
                                        </div>
                                    </div>
                                </tr>
                            </thead>
                            <tbody id="ServicesData">
                                <?php foreach ($oldservices as $oldservice) { ?>
                                    <tr class="ConsultationService">
                                        <input class="Id" type="hidden" value="<?= $oldservice['ServiceId'] ?>" />
                                        <td><input type="textbox" class="Name" value="<?= $oldservice['Name'] ?>" name="ServiceName" style="border:none; backgroundcolor:transparernt" /></td>
                                        <td><input type="textbox" class="AmountCharged" value="<?= $oldservice['AmountCharged'] ?>" name="ServiceName" style="border:none; backgroundcolor:transparernt" /></td>
                                        <td><input type="button" onclick="deleteService(this)" value="❌" style="border: 0;background-color: transparent;"></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-4 mb-2  mt-5">
                    <u>
                        <h3 class="mb-4">Prescription</h3>
                    </u>
                </div>
                <!-- <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Extra Notes</label>
                        <input type="text" id="ExtraNotes" class="form-control mb-2" autocomplete="off" value="<?= $prescription['ExtraNotes'] ?>" autocomplete="off">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Total Price</label>
                        <input type="text" id="TotalPrice" class="form-control mb-2" value="<?= $prescription['TotalPrice'] ?>" readonly>
                    </div>
                </div> -->
                <form class="mb-2 mt-5">
                    <select id="medId" class="form-select" autofocus style="width: 15rem;display: unset;">
                        <option> Select medicines </option>

                        <?php
                        $medicines = select("SELECT * FROM medicines");

                        foreach ($medicines as $r) { ?>

                            <option value="<?= $r['Id']; ?>">
                                <?= $r['Name']; ?>
                            </option>
                        <?php }

                        ?>
                    </select>
                    &nbsp; <button type="button" id="Add" class="btn btn-sm" style=" margin-left: 5px; background-color: #82CAFF;color:black;font-weight: bold;" onclick="getData()"> Add Medicine</button>
                </form>

                <table class="table table-light table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">PricePerPiece</th>
                            <th scope="col">MorningDose</th>
                            <th scope="col">Afternoon Dose</th>
                            <th scope="col">Evening Dose</th>
                            <th scope="col">Night Dose</th>
                            <th scope="col">Before Or After Food</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">How Days</th>

                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="medData">
                        <?php foreach ($oldmedicines as $oldmedicine) {
                            $total += $oldmedicine['PricePerPiece'];
                        ?>
                            <tr class="PrescriptionMedicine">
                                <input class="Id" type="hidden" value="<?= $oldmedicine['MedicineId'] ?>" />
                                <td><input class="Name" type="textbox" value="<?= $oldmedicine['Name'] ?>" style="border:none; backgroundcolor:transparernt"></input></td>
                                <td><input class="PricePerPiece" type="textbox" value="<?= $oldmedicine['PricePerPiece'] ?>" style="border:none; backgroundcolor:transparernt;width:80px"></input></td>
                                <td><input class="form-check-input mx-2 MorningDose" type="checkbox" name="MorningDose" <?= $oldmedicine['givenMorningDose'] == 1 ? "checked" : "" ?>></td>
                                <td><input class="form-check-input mx-2 AfternoonDose" type="checkbox" name="AfternoonDose" <?= $oldmedicine['givenAfternoonDose'] == 1 ? "checked" : "" ?>></td>
                                <td><input class="form-check-input mx-2 EveningDose" type="checkbox" name="EveningDose" <?= $oldmedicine['givenEveningDose'] == 1 ? "checked" : "" ?>></td>
                                <td><input class="form-check-input mx-2 NightDose" type="checkbox" name="NightDose" <?= $oldmedicine['givenNightDose'] == 1 ? "checked" : "" ?>></td>

                                <td>
                                    <select class="BeforeOrAfterFood">
                                        <option <?php
                                                if ($oldmedicine['givenBeforeOrAfterFood'] == 'Before') {
                                                    echo "Selected";
                                                }
                                                ?>>Before</option>
                                        <option <?php
                                                if ($oldmedicine['givenBeforeOrAfterFood'] == 'After') {
                                                    echo "Selected";
                                                }
                                                ?>>After</option>
                                    </select>
                                </td>
                                <td><input type="text" class="Quantity" value="<?= $oldmedicine['Quantity'] ?>" style="text-align: center;"></td>
                                <td><input class="Days" type="number" style="border:none; background-color:transparernt;width:40px" value="<?= $oldmedicine['Days'] ?>"></td>

                                <td><input type="button" onclick="deleteMedicine(this)" value="❌" style="border: 0;background-color: transparent;" </td>
                            </tr>
                        <?php } ?>
                        <!-- <tr>
                            <td colspan="7">Total</td>
                            <td><input type="text" disabled value="<?= $total ?>" style="border: 0;"></td>
                        </tr> -->
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6 mb-2 w-80 ">
                        <button type="submit" class="btn btn-primary" name="submit" onclick="submitData()">submit</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    function deleteService(service) {
        $(service).parents("tr").remove();
    }

    function deleteMedicine(medicines) {
        $(medicines).parents("tr").remove();
    }

    function getData() {
        let id = $("#medId option:selected").val()
        $.post('../api/displayData.php', {
            id: id
        }, function(response) {
            let data = '';
            for (let i = 0; i < response.length; i++) {
                let html = `
            <tr class="PrescriptionMedicine">
                <input class="Id" type="hidden" value="${response[i].Id}" />
                <td><input class="Name" type="textbox" value="${response[i].Name}" style="border:none; backgroundcolor:transparernt"></input></td>
                <td><input class="PricePerPiece" type="textbox" value="${response[i].PricePerPiece}" style="border:none; backgroundcolor:transparernt"></input></td>
                <td><input class="MorningDose" type="checkbox" ${response[i].MorningDose == 1 ? 'checked' : ''}></td>
                <td><input class="AfternoonDose" type="checkbox" ${response[i].AfternoonDose == 1 ? 'checked' : ''}></td>
                <td><input class="EveningDose" type="checkbox" ${response[i].EveningDose == 1 ? 'checked' : ''}></td>
                <td><input class="NightDose" type="checkbox" ${response[i].NightDose == 1 ? 'checked' : ''}></td>
                <td>
                    <select class="BeforeOrAfterFood">
                        <option value="Before" ${response[i].BeforeOrAfterFood == 'Before' ? 'selected' : ''}>Before</option>
                        <option value="After" ${response[i].BeforeOrAfterFood == 'After' ? 'selected' : ''}>After</option>
                    </select>
                </td>
                <td><input class="Quantity" type="number" value="${response[i].Quantity}" style="border:none; backgroundcolor:transparernt"></td>
                <td><input class="Days" type="number" value="${response[i].Days}"style="border:none; backgroundcolor:transparernt;width:40px"></td>

            </tr>
         `
                data += html;
            }
            document.getElementById("medData").innerHTML += data;
        })

    }

    function addServicesData() {
        let id = $("#ServicesId option:selected").val()
        console.log(id)
        let serviceData = {};
        $.post('../api/displayServiceData.php', {
            id: id
        }, function(response) {
            let data = '';
            for (let i = 0; i < response.length; i++) {
                let html = `
            <tr class="ConsultationService">
                <input class="Id" type="hidden" value="${response[i].Id}" />
                <td><input type="textbox" class="Name" value="${response[i].Name}" name="ServiceName" style="border:none; backgroundcolor:transparernt"></input></td>
                <td><input type="textbox" class="AmountCharged" value="${response[i].DefaultAmount}" name="AmountCharged" style="border:none; backgroundcolor:transparernt"></input></td>
            </tr>
            `
                data += html;
            }
            document.getElementById("ServicesData").innerHTML += data;
            // console.log(serviceData);
        })
    }

    function getServicesData() {
        let ConsultationServices = [];
        let ConsultationServiceRows = document.getElementsByClassName('ConsultationService');
        if (ConsultationServiceRows == null)
            return;

        for (let i = 0; i < ConsultationServiceRows.length; i++) {
            let row = ConsultationServiceRows[i];

            let Id = row.querySelector('.Id').value;
            let Name = row.querySelector('.Name').value;
            let AmountCharged = row.querySelector('.AmountCharged').value;

            let ConsultationService = {
                ServiceId: Id,
                Name: Name,
                AmountCharged: AmountCharged,
            }

            ConsultationServices.push(ConsultationService);
        }

        return ConsultationServices;
        console.log(ConsultationServices);
    }

    function getPrescriptionMedicinesData() {
        let prescribedMedicines = [];
        let prescriptionMedicineRows = document.getElementsByClassName('PrescriptionMedicine');
        if (prescriptionMedicineRows == null)
            return;

        for (let i = 0; i < prescriptionMedicineRows.length; i++) {
            let row = prescriptionMedicineRows[i];

            let Id = row.querySelector('.Id').value;
            let Name = row.querySelector('.Name').value;
            let PricePerPiece = row.querySelector('.PricePerPiece').value;
            let MorningDose = row.querySelector('.MorningDose').checked;
            let AfternoonDose = row.querySelector('.AfternoonDose').checked;
            let EveningDose = row.querySelector('.EveningDose').checked;
            let NightDose = row.querySelector('.NightDose').checked;
            let BeforeOrAfterFood = row.querySelector('.BeforeOrAfterFood').value;
            let Quantity = row.querySelector('.Quantity').value;
            let Days = row.querySelector('.Days').value;
            let prescriptionMedicine = {
                MedicineId: Id,
                Name: Name,
                PricePerPiece: PricePerPiece,
                MorningDose: MorningDose,
                AfternoonDose: AfternoonDose,
                EveningDose: EveningDose,
                NightDose: NightDose,
                BeforeOrAfterFood: BeforeOrAfterFood,
                Quantity: Quantity,
                Days: Days,
            }

            prescribedMedicines.push(prescriptionMedicine);
        }

        return prescribedMedicines;
    }

    function displayTotal() {
        var totalChargedAmount = $('#TotalChargedAmount').val();
        var discountAmount = $('#DiscountAmount').val();

        $('#TotalPrice').val(totalChargedAmount - discountAmount);
    }

    function submitData() {

        let services = getServicesData();
        let prescribedMedicines = getPrescriptionMedicinesData();

        let data = {
            Id: <?= $Id ?>,
            PatientId: $('#PatientId').val(),
            DateTime: $('#DateTime').val(),
            OutdoorPatientDepartmentNumber: $('#OutdoorPatientDepartmentNumber').val(),
            Complaint: $('#Complaint').val(),
            Remarks: $('#Remarks').val(),
            TotalChargedAmount: $('#TotalChargedAmount').val(),
            DiscountAmount: $('#DiscountAmount').val(),
            Tempreture: $('#Tempreture').val(),
            Pulse: $('#Pulse').val(),
            BloodPressure: $('#BloodPressure').val(),
            RespiratoryRate: $('#RespiratoryRate').val(),
            RandomBloodSugar: $('#RandomBloodSugar').val(),
            Height: $('#Height').val(),
            Weight: $('#Weight').val(),
            ExtraNotes: $('#ExtraNotes').val(),
            TotalPrice: $('#TotalPrice').val(),
            Services: services,
            PrescribedMedicines: prescribedMedicines
        }

        $.post('./update.php', data);
        window.location.replace('./index.php');

        // console.log(data);
    }
</script>
<?php
require(pathOf('admin/includes/footer1.php'));
require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>