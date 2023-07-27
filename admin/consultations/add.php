<?php

require("../init/init.php");

if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
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
        $MorningDose = $PrescriptionMedicine['MorningDose'];
        $AfternoonDose = $PrescriptionMedicine['AfternoonDose'];
        $EveningDose = $PrescriptionMedicine['EveningDose'];
        $NightDose = $PrescriptionMedicine['NightDose'];
        $BeforeOrAfterFood = $PrescriptionMedicine['BeforeOrAfterFood'];
        $MedicineId = $PrescriptionMedicine['MedicineId'];
        $Days = $PrescriptionMedicine['Days'];

        $query = "INSERT INTO `PrescriptionMedicines` (Quantity, PricePerPiece, MorningDose, AfternoonDose, EveningDose, NightDose, BeforeOrAfterFood, PrescriptionId, MedicineId, Days) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
            $Days,
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

<div class="container mx-5" style="color:black;">
    <div class="row mt-5 mx-4">
    <label align="right" style="font-weight: bolder;font-size:large;"><a href="<?= urlOf('admin/consultations/')?>" style="" ><i class="bi bi-caret-left-fill"></i>Back</a></label>

        <form action="" method="post" onsubmit="return false">
            <div class="bg-light rounded h-100 p-4 mx-6">
                <div class="row">
                    <div>
                        <u>
                            <h3 class="mb-4">Consultations</h3>
                        </u>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?php $rows = select("SELECT * FROM patients where `IsDeleted` = '0'"); ?>
                        <label>Patients Name : </label>
                        <select id="PatientId" class="form-select" autofocus style="width: 15rem;display: unset;">
                            <option>Select Patient Name</option>
                            <?php foreach ($rows as $r) { ?>
                                <option value="<?= $r['Id'] ?>"><?= $r['Name'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-6 row mb-2">
                        <lable class="col-3 col-form-label">Date Time :</lable>
                        <?php
                        // $date = date('d-m-y h:i:s');
                        ?>
                        <div class="col-sm-9 mb-2">
                            <input type="date" id="DateTime" name="DateTime" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Outdoor Patient Department Number</label>
                        <input type="text" id="OutdoorPatientDepartmentNumber" class="form-control mb-2" readonly value="<?= $OutdoorPatient ?>">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Complaint</label>
                        <input type="text" id="Complaint" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Remarks</label>
                        <input type="text" id="Remarks" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <!-- <label class="mb-2">Discount Amount</label> -->
                        <input type="hidden" id="DiscountAmount" class="form-control mb-2" autocomplete="off" value="1"  required>
                    </div>
                    <div class="col-6 mb-2">
                        <!-- <label class="mb-2">Total Charged Amount</label> -->
                        <input type="hidden" id="TotalChargedAmount" class="form-control mb-2" autocomplete="off" value="1"  required>
                    </div>
                    <div class="col-6 mb-2">
                        <!-- <label class="mb-2">Total Price</label> -->
                        <input type="hidden" id="TotalPrice" class="form-control mb-2" value="1" readonly>
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
                        <input type="text" id="Tempreture" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Pulse</label>
                        <input type="text" id="Pulse" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Blood Pressure</label>
                        <input type="text" id="BloodPressure" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Respiratory Rate</label>
                        <input type="text" id="RespiratoryRate" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Random Blood Sugar</label>
                        <input type="text" id="RandomBloodSugar" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Height</label>
                        <input type="text" id="Height" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Weight</label>
                        <input type="text" id="Weight" class="form-control mb-2" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Extra Notes</label>
                        <input type="textarea" id="ExtraNotes" class="form-control mb-2" autocomplete="off" required>
                    </div>

                </div>
                <!-- </div> -->
                <div class="col-4 mb-2 mt-5">
                    <u>
                        <h3 class="mb-4">Services</h3>
                    </u>
                </div>
                <div class="row">

                    <div class="col-6 mb-2">
                        <form>
                            <div class="mb-2">
                                <select id="ServicesId" class="form-select" autofocus style="width: 15rem;display: unset;">
                                    <option> Select Service Name </option>

                                    <?php
                                    $rows = select("SELECT * FROM services where `IsDeleted` = '0'");

                                    foreach ($rows as $r) { ?>
                                        <?php
                                        ?>
                                        <option value=" <?= $r['Id']; ?>">
                                            <?= $r['Name']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                                <button type="button" id="Add Services" class="btn btn-sm" style=" margin-left: 5px; background-color: #82CAFF;color:black;font-weight: bold;" onclick="addServicesData()"> Add Service</button>
                            </div>
                        </form>

                        <table class="table table-light table-bordered mt-2">
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


                <form>
                    <div class="mb-3">
                        <select id="medId" class="form-select" autofocus style="width: 15rem;display: unset;">
                            <option> Select medicines </option>

                            <?php
                            $medicines = select("SELECT * FROM medicines where `IsDeleted` = '0'");

                            foreach ($medicines as $r) { ?>

                                <option value="<?= $r['Id']; ?>">
                                    <?= $r['Name']; ?>
                                </option>
                            <?php }

                            ?>
                        </select>
                        &nbsp; <button type="button" class="btn btn-sm" style="background-color: #82CAFF;color:black;font-weight: bold;" id="Add" onclick="getData()"> Add Medicine</button>
                    </div>
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

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6 mb-2 w-80 ">
                        <button type="submit" id="submit" class="btn btn-primary" onclick="submitData()">Add Consultation</button>
                        <!-- <button type="submit" onclick="showChecked()">checkbox</button> -->
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
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
                <td><input class="PricePerPiece" type="textbox" value="${response[i].PricePerPiece}" style="border:none; backgroundcolor:transparernt;width:80px"></input></td>
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
                <td><input class="Quantity" type="number" value="1" style="border:none; backgroundcolor:transparernt;width:40px"></td>
                <td><input class="Days" type="number" style="border:none; backgroundcolor:transparernt;width:40px"></td>
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
            let MorningDose = $('.MorningDose').is(':checked') ? 1 : 0;
            let AfternoonDose = $('.AfternoonDose').is(':checked') ? 1 : 0;
            let EveningDose = $('.EveningDose').is(':checked') ? 1 : 0;
            let NightDose = $('.NightDose').is(':checked') ? 1 : 0;
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

    // function displayTotal() {
    //     var totalChargedAmount = $('#TotalChargedAmount').val();
    //     var discountAmount = $('#DiscountAmount').val();

    //     $('#TotalPrice').val(totalChargedAmount - discountAmount);
    // }

    function deleteService(service) {
        $(service).parents("tr").remove();
    }

    function deleteMedicine(medicines) {
        $(medicines).parents("tr").remove();
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
        // location.reload();
        // console.log(data);
        window.location.replace('./index.php');
    }
</script>
<?php
require(pathOf('admin/includes/footer1.php'));
require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>