<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

$bmipatinets = select("SELECT * FROM bmi ");

?>



<div class="container mx-2">
    <div class="row mt-5 mx-4">
        <div class="bg-light rounded h-100 p-4 mx-6">
            <u><a href="<?= urlOf('admin/BMI/bmi.php') ?>">
                    <h3 class="mb-4">New BMI</h3>
                </a></u>
            <table class="table table-light table-bordered">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <!-- <th scope="col">No</th> -->
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Master Registration Number</th> -->
                        <!-- <th scope="col">Date-Time</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile Number</th> -->
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col" class="text-center">View BMI</th> 

                        <!-- <th scope="col" colspan="2" class="text-center">Action</th> -->
                    </tr>
                </thead>
                <?php
                foreach ($bmipatinets as $p) {
                    $patientid = $p['PatientId'];
                    $rows = select("SELECT * FROM patients WHERE Id = ?  ", [$patientid]);
                    // $count = count($rows);
                    // print_r($count);
                    // for ($i = $count; $i >= 1; $i--) {
                    foreach($rows as $r){
                 ?>


                        <tbody>
                            <tr style="text-align: center;">
                                <!-- <td><?= $i;
                                    $i--; ?></td> -->
                                <td><?= $r['Name'] ?></td>
                                <td><?= $r['Age'] ?></td>
                                <td><?= $r['Gender'] ?></td>
                                <td><?= $r['Address'] ?></td>
                                <td><?= $r['MobileNumber'] ?></td>
                                <td>
                                    <a href="<?= urlOf('admin/BMI/index.php') ?>?Id=<?= $r['Id'] ?>"> <button class="btn btn-primary" name="Delete">BMI</button></a>
                                </td>
                                <!-- <td>
                                    <a href="<?= urlOf('admin/patients/update.php') ?>?Id=<?= $r['Id'] ?>"><button class="btn btn-primary" name="Update">Update</button></a>
                                </td> -->
                                <!-- <td>
                                    <a href="<?= urlOf('admin/patients/delete.php') ?>?Id=<?= $r['Id'] ?>"> <button class="btn btn-primary" name="Delete">Delete</button></a>
                                </td> -->
                            </tr>
                        </tbody>
                <?php 
                }}  ?>
            </table>
        </div>
    </div>

    <?php
    require(pathOf('admin/includes/footer1.php'));
    require(pathOf('admin/includes/script.php'));
    require(pathOf('admin/includes/footer2.php'));
    ?>
</div>