<?php

require("../init/init.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $PatientId = $_POST['PatientId'];
    $DateTime = $_POST['DateTime'];
    $OutdoorPatientDepartmentNumber = $_POST['OutdoorPatientDepartmentNumber'];
    $Complaint = $_POST['Complaint'];
    $Remarks = $_POST['Remarks'];
    $TotalChargedAmount = $_POST['TotalChargedAmount'];
    $DiscountAmount = $_POST['DiscountAmount'];

    $query = "INSERT INTO consultations(`DateTime`,`OutdoorPatientDepartmentNumber`, `Complaint`, `Remarks`, `TotalChargedAmount`,`DiscountAmount`,`PatientId`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = [$DateTime, $OutdoorPatientDepartmentNumber, $Complaint, $Remarks, $TotalChargedAmount, $DiscountAmount, $PatientId];


    execute($query, $params);
    $ConsultationId = lastInsertId();

    $Tempreture = $_POST['Tempreture'];
    $Pulse = $_POST['Pulse'];
    $BloodPressure = $_POST['BloodPressure'];
    $RespiratoryRate = $_POST['RespiratoryRate'];
    $RandomBloodSugar = $_POST['RandomBloodSugar'];
    $Height = $_POST['Height'];
    $Weight = $_POST['Weight'];

    $query = "INSERT INTO `parameters` (`Tempreture`, `Pulse`, `BloodPressure`, `RespiratoryRate`, `RandomBloodSugar`, `Height`, `Weight`, `ConsultationId`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$Tempreture, $Pulse, $BloodPressure, $RespiratoryRate, $RandomBloodSugar, $Height, $Weight, $ConsultationId];
    execute($query, $params);



    // updating multiple: delete and re-insert
    // execute("DELETE FROM `consultationservices` WHERE `ConsultationId` = 1");



    $ConsultationServices = $_POST['Services'];

    foreach ($ConsultationServices as $ConsultationService) {
        $ServiceId = $ConsultationService["ServiceId"];
        $AmountCharged = $ConsultationService["AmountCharged"];

        $query = "INSERT INTO `consultationservices` (`AmountCharged`,`ConsultationId`, `ServiceId`) VALUES (?, ?, ?)";
        $params = [$AmountCharged, $ConsultationId, $ServiceId];

        execute($query, $params);
    }

    $ExtraNotes = $_POST['ExtraNotes'];
    $TotalPrice = $_POST['TotalPrice'];

    $query = "INSERT INTO `prescriptions` (`PrescribedOnDateTime`, `ExtraNotes`, `TotalPrice`, `ConsultationId`) VALUES (?, ?, ?, ?)";
    $params = [$DateTime, $ExtraNotes, $TotalPrice, $ConsultationId];
    execute($query, $params);

    $PrescriptionId = lastInsertId();
    $PrescriptionMedicines = $_POST['PrescribedMedicines'];

    foreach ($PrescriptionMedicines as $PrescriptionMedicine) {

        $Quantity = $PrescriptionMedicine['Quantity'];
        $PricePerPiece = $PrescriptionMedicine['PricePerPiece'];
        $MorningDose = isset($PrescriptionMedicine['MorningDose']) ? $MorningDose = 1 : $MorningDose = 0;
        $AfternoonDose = isset($PrescriptionMedicine['AfternoonDose']) ? $AfternoonDose = 1 : $AfternoonDose = 0;
        $EveningDose = isset($PrescriptionMedicine['EveningDose']) ? $EveningDose = 1 : $EveningDose = 0;
        $NightDose = isset($PrescriptionMedicine['NightDose']) ? $NightDose = 1 : $NightDose = 0;
        $BeforeOrAfterFood = $PrescriptionMedicine['BeforeOrAfterFood'];
        $MedicineId = $PrescriptionMedicine['MedicineId'];

        $query = "INSERT INTO `PrescriptionMedicines` (Quantity, PricePerPiece, MorningDose, AfternoonDose, EveningDose, NightDose, BeforeOrAfterFood, PrescriptionId, MedicineId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $Quantity,
            $PricePerPiece,
            $MorningDose,
            $AfternoonDose,
            $EveningDose,
            $NightDose,
            $BeforeOrAfterFood,
            $PrescriptionId,
            $MedicineId,
        ];

        execute($query, $params);
    }

    exit();
}

$OutdoorPatientDepartmentNumber = selectOne('SELECT MAX(`OutdoorPatientDepartmentNumber`) as OutdoorPatient FROM `consultations`');
$OutdoorPatient = $OutdoorPatientDepartmentNumber['OutdoorPatient'] + 1;

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));


?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
        <form action="" method="post">
            <div class="bg-light rounded h-100 p-4 mx-6">
                <div class="row">
                    <div class="col-4 mb-2">
                        <u>
                            <h3 class="mb-4">Consultations</h3>
                        </u>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <?php $rows = select("SELECT * FROM patients"); ?>
                        <label class="mb-2">Patients Name</label>
                        <select id="PatientId">
                            <option>Select Patient Name</option>
                            <?php foreach ($rows as $r) { ?>
                                <option value="<?= $r['Id'] ?>"><?= $r['Name'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Date Time</label>
                        <?php
                        $Format = 'Y-m-d';
                        $CDT = date($Format);
                        ?>
                        <input type="Date" id="DateTime" value="<?= $CDT ?>" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Outdoor Patient Department Number</label>
                        <input type="text" id="OutdoorPatientDepartmentNumber" readonly value="<?= $OutdoorPatient ?>" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Total Charged Amount</label>
                        <input type="text" id="TotalChargedAmount" autocomplete="off" class="form-control mb-2" onfocusout="displayTotal();">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Discount Amount</label>
                        <input type="text" id="DiscountAmount" autocomplete="off" class="form-control mb-2" onfocusout="displayTotal();">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Complaint</label>
                        <input type="text" id="Complaint" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Remarks</label>
                        <input type="text" id="Remarks" autocomplete="off" class="form-control mb-2">
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
                        <input type="text" id="Tempreture" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Pulse</label>
                        <input type="text" id="Pulse" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Blood Pressure</label>
                        <input type="text" id="BloodPressure" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Respiratory Rate</label>
                        <input type="text" id="RespiratoryRate" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Random Blood Sugar</label>
                        <input type="text" id="RandomBloodSugar" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Height</label>
                        <input type="text" id="Height" autocomplete="off" class="form-control mb-2">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Weight</label>
                        <input type="text" id="Weight" autocomplete="off" class="form-control mb-2">
                    </div>
                </div>
                <div class="col-4 mb-2 mt-5">
                    <u>
                        <h3 class="mb-4">Services</h3>
                    </u>
                </div>
                <div class="row">

                    <div class="col-6 mb-2">
                        <label class="mb-2">Service Name :</label>
                        <form>
                            <select id="ServicesId">
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
                            <button type="button" id="Add Services" onclick="addServicesData()"> Add</button>
                        </form>

                        <table class="table table-light table-bordered ">
                            <thead class="table-primary">
                                <tr>
                                    <div class="row">
                                        <div class="col-6">
                                            <th scope="col">Name</th>

                                        </div>
                                        <div class="col-6">
                                            <th scope="col">Amount Charged</th>
                                        </div>
                                        <div class="col-6">
                                            <th scope="col">Remove</th>
                                        </div>
                                    </div>

                                </tr>
                            </thead>
                            <tbody id="ServicesData"></tbody>
                        </table>
                    </div>
                </div>

                <div class="col-4 mb-2  mt-5">
                    <u>
                        <h3 class="mb-4">Prescription</h3>
                    </u>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Extra Notes</label>
                        <input type="text" id="ExtraNotes" autocomplete="off" class="form-control mb-2">
                    </div>

                    <div class="col-6 mb-2">
                        <label class="mb-2">Total Price</label>
                        <input type="text" id="TotalPrice" class="form-control mb-2" disabled>
                    </div>
                </div>

                <form class="mb-2 mt-5">
                    <select id="medId" autofocus>
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
                    &nbsp; <button type="button" id="Add" onclick="getData()"> Add</button>
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
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="medData">

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6 mb-2 w-80 ">
                        <button type="submit" class="btn btn-primary" id="submit" onclick="submitData()">submit</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    var medicinesTotal = 0;

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
                <td><input class="PricePerPiece" id="PricePerPiece" name="PricePerPiece" type="textbox" value="${response[i].PricePerPiece}" style="border:none; backgroundcolor:transparernt"></input></td>
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
                <td><input class="Quantity" type="number" value="1" style="border:none; backgroundcolor:transparernt"></td>
                <td><input type="button" onclick="deleteMedicine(this)" value="❌" style="border: 0;background-color: transparent;"></td>
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
                <td><input type="button" onclick="deleteService(this)" value="❌" style="border: 0;background-color: transparent;"></td>
            
            </tr>
            `
                data += html;
            }
            document.getElementById("ServicesData").innerHTML += data;
        })
    }

    function deleteService(service) {
        $(service).parents("tr").remove();
    }

    function deleteMedicine(medicines) {
        $(medicines).parents("tr").remove();
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

        $.post('./add.php', data);
        alert('Consultation Inserted !');
        location.reload();
        console.log(data);
    }
</script>
<?php
require(pathOf('admin/includes/footer1.php'));
require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>