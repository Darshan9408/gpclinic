<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
$ConsultationId = $_REQUEST['Id'];

$consultations = select("SELECT * FROM `consultations` WHERE `Id` = ?", [$ConsultationId]);
$Patients = select("SELECT patients.Name, patients.Age, patients.MasterRegistrationNumber FROM consultations INNER JOIN patients ON consultations.PatientId = patients.Id WHERE consultations.Id = ?", [$ConsultationId]);
$parameters = select("SELECT * FROM `parameters` WHERE `consultationId` = ?", [$ConsultationId]);

$prescriptions = select("SELECT * FROM `prescriptions` WHERE `ConsultationId` = ?", [$ConsultationId]);
// print_r($prescriptions);
// $prescriptionmedicines = select("SELECT * FROM `prescriptionmedicines` WHERE `PrescriptionId` = ?", $prescription['Id']);
// $medicines = select("SELECT * FROM `medicines` WHERE `PrescriptionId` = ?", $prescriptionmedicines['MedicineId']);

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
        <hr style="height: 4px;">
        <div class="row" style="color:black;">
            <?php foreach ($Patients as $Patient) {
            } ?>
            <?php foreach ($consultations as $consultation) {
            } ?>

            <div class="col-9 mt-1">
                Patient Name :  <?= $Patient['Name'] ?>

            </div>
            
        </div>
        <div class="col-4 mt-2" align="right" >
                <?php $value = $consultation['DateTime']  ?>
                <input type="date" name="RegistrationDateTime" value="<?= $value ?>" class="form-control">
            </div>
        <hr>
        <?php foreach ($prescriptions as $prescription) {
            foreach ($parameters as $parameter) { ?>
                <div class="row">
                    <div class="col-6">
                        Age : &nbsp;<?= $Patient['Age'] ?> <br>
                        <?php if ($parameter['Pulse'] > 0) {
                            echo 'Pulse :' . $parameter['Pulse'] . '<br>';
                        }
                        if ($parameter['RandomBloodSugar'] > 0) {
                            echo 'RandomBloodSugar :' . $parameter['RandomBloodSugar'] . '<br>';
                        }
                        if ($parameter['Height'] > 0) {
                            echo 'Height :' . $parameter['Height'] . '<br>';
                        }
                        if ($prescription['ExtraNotes'] > 0) {
                            echo 'ExtraNotes :' . $prescription['ExtraNotes'];
                        }
                        ?>
                    </div>
                    <div class="col-6">
                        <?php if ($parameter['Tempreture'] > 0) {
                            echo 'Tempreture :' . $parameter['Tempreture'] . '<br>';
                        }


                        if ($parameter['BloodPressure'] > 0) {
                            echo 'BloodPressure :' . $parameter['BloodPressure'] . '<br>';
                        }
                        if ($parameter['RespiratoryRate'] > 0) {
                            echo 'RespiratoryRate :' . $parameter['RespiratoryRate'] . '<br>';
                        }
                        if ($parameter['Weight'] > 0) {
                            echo 'Weight :' . $parameter['Weight'] . '<br>';
                        }
                        ?>
                    </div>
                </div>
        <?php }
        } ?>
        </tbody>
        </table>
        <table class="table table-bordered mt-2 " style="color: black;">
            <thead>
                <tr class="table-primary" style="font-size:13px;">
                    <th scope="col" class="text-center">Medicine </th>
                    <th scope="colspan-2" class="text-center">Dose / Before Or After Food</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($prescriptions as $prescription) {
                    $prescriptionmedicines = select("SELECT * FROM `prescriptionmedicines` WHERE `PrescriptionId` = ?", [$prescription['Id']]);
                    foreach ($prescriptionmedicines as $prescriptionmedicine) {
                        $medicines = select("SELECT * FROM `medicines` WHERE `Id` = ?", [$prescriptionmedicine['MedicineId']]);
                        foreach ($medicines as $medicine) {
                ?>
                            <tr style="font-size:13px;">
                                <td><?= $medicine['Name'] ?></td>
                                <td>
                                    <?php if ($prescriptionmedicine['MorningDose'] == 1) {
                                        echo " Morning ";echo"/";
                                    }
                                    if ($prescriptionmedicine['AfternoonDose'] == 1) {
                                        echo " AfterNoon   ";
                                        echo"/";
                                    }
                                    if ($prescriptionmedicine['EveningDose'] == 1) {
                                        echo " Evening  ";
                                        echo"/";
                                    }
                                    if ($prescriptionmedicine['NightDose'] == 1) {
                                        echo " Night  ";
                                        echo"/";
                                    }  
                                    echo "-- " . $prescriptionmedicine['Days'] . " Days";
                                    ?>
                                    <?= "( " . $prescriptionmedicine['BeforeOrAfterFood'] . " Food )"  ?>

                                    
                                </td>
                            </tr>
                <?php }
                    }
                } ?>
            </tbody>
        </table>

        <div class="name mx-3" style="color: black;margin-top:12rem;" align="right">
            <hr style="height: 2px;width:40px;margin: 0;">Sign.
        </div>

        <div class="row justify-content-center" id="bottom">
            <hr style="height: 2px;"> ફરી આવો ત્યારે દવાનો કાગળ સાથે લાવવો.
        </div>
    </div>
</body>

</html>