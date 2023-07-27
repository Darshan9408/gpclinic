<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
global $total;
global $m;
global $t;
$ConsultationId = $_REQUEST['Id'];

$consultations = select("SELECT * FROM `consultations` WHERE `Id` = ?", [$ConsultationId]);
// print_r($consultations); 

$Patients = select("SELECT patients.Name, patients.Age, patients.MasterRegistrationNumber , patients.Gender  FROM consultations INNER JOIN patients ON consultations.PatientId = patients.Id WHERE consultations.Id = ?", [$ConsultationId]);
$parameters = select("SELECT * FROM `parameters` WHERE `consultationId` = ?", [$ConsultationId]);

$prescriptions = select("SELECT * FROM `prescriptions` WHERE `ConsultationId` = ?", [$ConsultationId]);
$oldmedicines = select('SELECT *, medicines.Name, prescriptions.ConsultationId, prescriptionmedicines.Quantity as givenQuantity, prescriptionmedicines.PricePerPiece as givenPricePerPiece , prescriptionmedicines.MorningDose as givenMorningDose, prescriptionmedicines.AfternoonDose as givenAfternoonDose, prescriptionmedicines.EveningDose as givenEveningDose, prescriptionmedicines.NightDose as givenNightDose, prescriptionmedicines.BeforeOrAfterFood as givenBeforeOrAfterFood  FROM prescriptionmedicines INNER JOIN medicines ON prescriptionmedicines.MedicineId = medicines.Id INNER JOIN prescriptions ON prescriptionmedicines.PrescriptionId = prescriptions.Id WHERE prescriptions.ConsultationId = ?', [$ConsultationId]);
$consultationservices = select("SELECT * FROM `consultationservices` WHERE `ConsultationId` = ?", [$ConsultationId]);

// print_r($consultationservices);
// foreach ($consultationservices as $c) {
//     // print_r($c);
//     $Id = $c['ServiceId'];
//     $services = selectone("SELECT * FROM `services` WHERE `Id` = ?", [$Id]);
// }

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
    <style>
    @print {
	@page :footer {
		display: none
	}

	@page :header {
		display: none
	}
}</style>
</head>

<body>
    <?php
    foreach ($consultations as $consultation) {
        foreach ($prescriptions as $prescription) {
            foreach ($Patients as $Patient) { ?>

                <div class=" invoice">
                    <div class=" row invoice_header">
                        <div class="row">
                            <div class="col-12 text-center ">
                                <p style="font-family: cursive;font-weight: bold; font-size: 20px;color: black;">G.P.CLINIC<br></p>
                                <p style="font-size: 15px;font-family: 'Cambria';color: black;"> <img src="Image/map.png" alt="" class="mx-2" style="height: 18px; width:20px;">3rd Floor, Shreeji Square , Valkeshwari, Jamnagar-361008</p>
                                <p style="font-size: 15px;font-family: 'Cambria';color: black;"> <img src="Image/call.png" alt="" class="mx-2" style="height: 18px; width:20px;">0288 - 2990105 &nbsp;/&nbsp; REG No.: G-50435 </p>
                                <p style="font-size: 15px;font-family: 'Cambria';color: black;" class="mb-1"> OPD BILL </p>
                            </div>
                        </div>
                    </div>
                    <hr style="height: 4px;">
                    <div class="row" style="font-size: 13.5px;">
                        <div class="col-6 mt-2 name">
                            OPD No &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" name="RegistrationDateTime" value="<?= $consultation['OutdoorPatientDepartmentNumber'] ?>" style="border: 0;font-weight:bold ;"><br>
                            Bill Date &nbsp;&nbsp;&nbsp;: &nbsp;<input type="date" name="RegistrationDateTime" value="<?= $consultation['DateTime'] ?>" style="border: 0;"><br>
                            Doctor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; DR.MALAY.ACHARYA<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(General Physician)
                        </div>


                        <div class="col-6 mt-2 name">
                            MR No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" name="RegistrationDateTime" value="<?= $Patient['MasterRegistrationNumber'] ?>" style="border: 0;font-weight:bold ;"><br>
                            Patient's Name &nbsp;: &nbsp;<?= $Patient['Name'] ?><br>
                            Age / Gender &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <input type="text" name="RegistrationDateTime" value="<?= $Patient['Age'] . " - " . $Patient['Gender'] ?>" style="border: 0;font-weight:bold ;"><br>

                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered mt-2 " style="color: black;font-size: small;margin-bottom: 0;">
                            <thead>
                                <tr class="table-primary" style="font-size:13px;height: 5px;">
                                    <th scope="col" class="text-center">Service Particulars </th>
                                    <th scope="col" class="text-center">Count</th>
                                    <th scope="col" class="text-center">Amount ₹</th>
                                </tr>
                            </thead>
                            <tbody>
<!-- 
                                <tr class="text-center">
                                    <td>Charges</td>
                                    <td>1</td>
                                    <td><label class="c" c="<?= $prescription['TotalPrice'] ?>" style="font-weight: bold;"><?= $prescription['TotalPrice'] ?></label></td>

                                </tr> -->
                                <?php if (count($consultationservices) > 0) { ?>
                                    <tr class="text-center">
                                        <td><?php foreach ($consultationservices as $c) {
                                                $Id = $c['ServiceId'];
                                                $services = select("SELECT * FROM `services` WHERE `Id` = ?", [$Id]);

                                                foreach ($services as $s) {
                                                    echo $s['Name'];
                                                    echo " / &nbsp; ";
                                                    // echo $s['DefaultAmount'];
                                                }
                                            }
                                            ?> </td>
                                        <td>1</td>


                                        <td style="font-weight: bold;">
                                            <?php foreach ($consultationservices as $s) {

                                                $p = $s['AmountCharged'];
                                                $total += $p;
                                                // }
                                            } ?> <label class="s" s=<?= $total ?>><?php echo $total; ?> </label>
                                        </td>


                                    </tr>
                                <?php } ?>
                                <?php if (count($oldmedicines) > 0) { ?>

                                    <tr class="text-center">
                                        <td>Medicine</td>
                                        <td>1</td>
                                        <td style="font-weight: bold;"> <?php $t = 0;
                                                                        foreach ($oldmedicines as $old) {
                                                                            $t = $old['givenQuantity'] * $old['givenPricePerPiece'] + $t;
                                                                            // $t += $t;
                                                                        } ?><label class="m" m=<?= $t ?>>
                                                <?php echo $t; ?></label></td>

                                    </tr>
                                <?php } ?>


                        </table>
                    </div>
                    <div class="row mt-1" align="right" style="color: black;">
                        <p style="font-size: small;">Spl Discount : &nbsp;<input type="text" class="dis" style="border: 1;width: 120px;font-size: 15px;background-color: transparent;" autofocus require> </p>

                        <?php
                        $total = 0;
                        foreach ($oldmedicines as $old) {
                            $m = $old['givenQuantity'] * $old['givenPricePerPiece'];
                            $m += $m;
                        }
                        foreach ($consultationservices as $c) {
                            $Id = $c['ServiceId'];
                            $services = select("SELECT * FROM `services` WHERE `Id` = ?", [$Id]);

                            foreach ($services as $s) {
                                // print_r($s);
                                $p = $s['DefaultAmount'];
                                $total += $p;
                            }
                        }

                        $finaltotal =  $total + $consultation['TotalChargedAmount'] + $m;

                        ?>
                        <p class="mt-2" style="font-size: small;">Total Amount : &nbsp;&nbsp;<input type="text" disabled value=" " class="t" style="border: 1;width: 120px;font-size: 15px;background-color:transparent"></p>
                    </div>
                    <div class="row " style="color: black;margin-top: 35px;">
                        <div class="col-6" style="font-size: 15px;"></div>
                        <div class="col-6" align="right" style="font-size: 15px;">Sign</div>
                    </div>
                    <hr style="height: 3px; position: absolute;font-weight: bold;bottom: 0;left: 0;width: 730px;margin-left: 30px;margin-bottom:45px ;">
                    <div class="row">
                        <div class="col-6 " style="font-size: 10px;margin-top: 8px;color: black;">
                            For Appointment , Call<br>Get Well Soon. Wishing You Years of Good Health.
                        </div>
                    </div>
                </div>
    <?php }
        }
    }
    ?>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> -->
    <script src="<?= urlOf('admin/js/min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            alert('Enter Spl Discount !!!!!');
        });

        $(document).on('change', '.dis', function() {
            var services = $('.s').attr('s');
            var medicines = $('.m').attr('m');
            // var charge = $('.c').attr('c');
            var dis = $('.dis').val();

            if(services == undefined)
            {
                services = 0
            }
            
            if(medicines == undefined)
            {
                medicines = 0
            }
            
            // if(charge == undefined)
            // {
            //     charge = 0
            // }
            // alert(services)
            $('.t').val(add(services, medicines,  dis))
        });

        function add(services, medicines, dis) {
            sum = Number(services) + Number(medicines) - Number(dis);
            // sum =Number(charge);
            return sum;
        }
    </script>
</body>

</html>