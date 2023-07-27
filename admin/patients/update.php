<?php

require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
if (isset($_POST["submit"])) {

    $Id = $_REQUEST["Id"];
    $Name = $_POST["Name"];
    $RegistrationDateTime = $_POST["RegistrationDateTime"];
    $Age = $_POST["Age"];
    $Address = $_POST["Address"];
    $MobileNumber = $_POST["MobileNumber"];
    $Gender = $_POST["gender"];
    
        $query ="UPDATE `patients` SET `Name`= ? , `RegistrationDateTime` = ? , `Age` = ?, `Gender` = ?, `Address` =?, `MobileNumber`=? WHERE `Id` = ?";
        $params = [$Name, $RegistrationDateTime, $Age, $Gender,$Address, $MobileNumber,$Id];

        $updated = execute($query, $params);

        header('Location: ' . urlOf('admin/patients/'));    
        exit();
    }

    $Id = $_REQUEST['Id'];
    $Patient = selectOne("SELECT * FROM `patients` WHERE `Id` = ?", [$Id]);
    

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));


?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
        <label align="right" style="font-weight: bolder;font-size:large;"><a href="<?= urlOf('admin/patients/')?>" style="" ><i class="bi bi-caret-left-fill"></i>Back</a></label>
        <div class="bg-light rounded h-100 p-4 mx-6">

            <u><h3 class="mb-4">New Patient</h3></u>
            <form action="" method="post">
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Name</label>
                        <input type="text" name="Name" class="form-control mb-2" autocomplete="off" value="<?= $Patient['Name'] ?>">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Registrastion DateTime</label>
                        <input type="date" name ="RegistrationDateTime" class="form-control" autocomplete="off" id="RegistrationDateTime" value="<?= $Patient['RegistrationDateTime'] ?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Registration Number</label>
                        <input type="text" name=" RegistrationNumber" class="form-control mb-2" value="<?= $Patient['MasterRegistrationNumber'] ?>" disabled>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Age</label>
                        <input type="text" name="Age" class="form-control mb-2" autocomplete="off" value="<?= $Patient['Age'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Address</label>
                        <input type="text"name="Address" class="form-control mb-2" autocomplete="off" value="<?= $Patient['Address'] ?>">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Mobile  Number</label>
                        <input type="text" name="MobileNumber" class="form-control mb-2" autocomplete="off" value="<?= $Patient['MobileNumber'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2 mt-2">
                        <label class="mx-3">Gender : </label>

                        <input class="form-check-input mx-2"  type="radio" name="gender" value="male" 
                            <?php
                                
                                if($Patient["Gender"] == "male")
                                {
                                    echo "checked";
                                }
                                
                            ?>
                        >
                        <label class="form-check-label mx-1"  for="gridRadios1" >
                            Male
                        </label>
                        <input class="form-check-input mx-2"  type="radio" name="gender" value="female" 
                        <?php
                             
                                if($Patient["Gender"] == "female")
                                {
                                    echo "checked";
                                }
                                
                            ?>>
                        <label class="form-check-label mx-1" for="gridRadios1" >
                            Female
                        </label>
                    </div>
                    <div class="col-6 mb-2 w-80 ">
                        <button type="submit" class="btn btn-primary" name="submit">Update Patient</button>
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
    