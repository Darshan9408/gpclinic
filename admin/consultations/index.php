<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

?>

<div class="container mx-2">
    <div class="row mt-5 mx-4">
        <div class="bg-light rounded h-100 p-4 mx-6">
            <u><a href="<?= urlOf('admin/consultations/add.php') ?>">
                    <h3 class="mb-4">New Consultations</h3>
                </a></u>
            <table class="table table-light table-bordered">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">OPD Number</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col"> TotalCharged Amount</th>
                        <th scope="col">Discount Amount</th>
                        <th scope="col" colspan="4" class="text-center">Action</th>
                    </tr>
                </thead>
                <?php

                $consultations = select("SELECT * FROM consultations WHERE `IsDeleted` = '0' ORDER BY OutdoorPatientDepartmentNumber DESC");
                $r = count($consultations);
                for ($i = $r; $i > 1; $i++) {
                    foreach ($consultations as $consultation) { ?>
                        <tbody>
                            <tr>
                                <?php
                                $Id = $consultation['PatientId'];
                                $Patient = selectOne("SELECT * FROM `patients` WHERE `Id` = ?", [$Id]);
                                ?>
                                <td><?= $i; $i--; ?></td>
                                <td><?= $Patient['Name'] ?></td>
                                <td><?= $consultation['OutdoorPatientDepartmentNumber'] ?></td>
                                <td><?= $consultation['DateTime'] ?></td>
                                <td><?= $consultation['TotalChargedAmount'] ?></td>
                                <td><?= $consultation['DiscountAmount'] ?></td>

                                <td>
                                    <a href="<?= urlOf('admin/consultations/update.php') ?>?Id=<?= $consultation['Id'] ?>"><button class="btn btn-primary" name="Update">Update</button></a>
                                </td>
                                <td>
                                    <a href="<?= urlOf('admin/consultations/delete.php') ?>?Id=<?= $consultation['Id'] ?>"><button class="btn btn-primary" name="Delete">Delete</button></a>
                                </td>
                                <td>
                                    <a href="<?= urlOf('admin/Prescription/prescription.php') ?>?Id=<?= $consultation['Id'] ?>"><button class="btn btn-primary" name="print">Print</button></a>
                                </td>
                                <td>
                                    <a href="<?= urlOf('admin/Bill/bill.php') ?>?Id=<?= $consultation['Id'] ?>"><button class="btn btn-primary" name="bill">Bill</button></a>
                                </td>
                            </tr>
                        </tbody>
                <?php }
                } ?>

            </table>
        </div>
    </div>

    <?php
    require(pathOf('admin/includes/footer1.php'));
    require(pathOf('admin/includes/script.php'));
    require(pathOf('admin/includes/footer2.php'));
    ?>

</div>