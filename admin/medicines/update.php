<?php

require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
if (isset($_POST["submit"])) {

    $Id = $_REQUEST['Id'];
    $Name = $_POST['Name'];
    $Company = $_POST['Company'];
    $Type = $_POST['Type'];
    $PricePerPiece = $_POST['PricePerPiece'];
    if(isset($_POST['MorningDose']) == "1"){$MorningDose = 1;}else{$MorningDose = 0;}
    if(isset($_POST['AfternoonDose']) == "1"){$AfternoonDose = 1;}else{$AfternoonDose = 0;}
    if(isset($_POST['EveningDose']) == "1"){$EveningDose = 1;}else{$EveningDose = 0;}
    if(isset($_POST['NightDose']) == "1"){$NightDose = 1;}else{$NightDose = 0;}
    $BeforeOrAfterFood = $_POST['BeforeOrAfterFood'];
    $ExtraNotes = $_POST['ExtraNotes'];

    $query = "UPDATE medicines SET `Name` = ? , `Company` = ? , `Type` = ? , `PricePerPiece` = ?, `MorningDose` = ?, `AfternoonDose` = ?, `EveningDose` = ?, `NightDose` = ?, `BeforeOrAfterFood` = ?, `ExtraNotes` = ? WHERE Id = ?";
    $params = [$Name, $Company, $Type, $PricePerPiece, $MorningDose, $AfternoonDose, $EveningDose, $NightDose, $BeforeOrAfterFood, $ExtraNotes, $Id];
    $add = execute($query, $params);

    header('Location: ' . urlOf('admin/medicines/'));

    exit();
}

$Id = $_REQUEST['Id'];
$medicines = selectOne("SELECT * FROM `medicines` WHERE `Id` = ?", [$Id]);

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));


?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
    <label align="right" style="font-weight: bolder;font-size:large;"><a href="<?= urlOf('admin/medicines/')?>" style="" ><i class="bi bi-caret-left-fill"></i>Back</a></label>

        <div class="bg-light rounded h-100 p-4 mx-6">
            <u>
                <h3 class="mb-4">medicines</h3>
            </u>
            <form action="" method="post">
                <div class="row mt-3">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Name :</label>
                        <input type="text" name="Name" class="form-control mb-2" autocomplete="off" value="<?= $medicines['Name'] ?>">
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Company :</label>
                        <input type="text" name="Company" class="form-control" autocomplete="off" value="<?= $medicines['Company'] ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Type :</label>
                        <select name="Type" class="form-select"  style="width: 15rem;display: unset;" value="<?= $medicines['Type'] ?>">
                            <option value="Tablet" 
                            <?php 
                                if($medicines['Type'] == 'Tablet')
                                {
                                    echo "Selected";
                                }
                            ?>>Tablet</option>
                            <option value="Capsule"
                            <?php 
                                if($medicines['Type'] == 'Capsule')
                                {
                                    echo "Selected";
                                }
                            ?>>Capsule</option>
                            <option value="Syrup"
                            <?php 
                                if($medicines['Type'] == 'Syrup')
                                {
                                    echo "Selected";
                                }
                            ?>>Syrup</option>
                            <option value="Lotion"
                            <?php 
                                if($medicines['Type'] == 'Lotion')
                                {
                                    echo "Selected";
                                }
                            ?>>Lotion</option>
                            <option value="Injection"
                            <?php 
                                if($medicines['Type'] == 'Injection')
                                {
                                    echo "Selected";
                                }
                            ?>>Injection</option>
                            <option value="Extra"
                            <?php 
                                if($medicines['Type'] == 'Extra')
                                {
                                    echo "Selected";
                                }
                            ?>>Extra</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mb-2">Before Or After Food : </label>
                        <select name="BeforeOrAfterFood" class="form-select"  style="width: 15rem;display: unset;">
                            <option
                            <?php 
                                if($medicines['BeforeOrAfterFood'] == 'Before')
                                {
                                    echo "Selected";
                                }
                            ?>>Before</option>
                            <option
                            <?php 
                                if($medicines['BeforeOrAfterFood'] == 'After')
                                {
                                    echo "Selected";
                                }
                            ?>>After</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3    ">
                    <div class="col-6 mb-2">
                        <label class="mb-2">Price Per Piece :</label>
                        <input type="text" name="PricePerPiece" class="form-control mb-2"  autocomplete="off" value="<?= $medicines['PricePerPiece'] ?>">
                    </div>

                    <div class="col-6 mb-2">
                        <label class="mb-2">Extra Notes :</label>
                        <input type="text" name="ExtraNotes" class="form-control mb-2" autocomplete="off"  value="<?= $medicines['ExtraNotes'] ?>">
                    </div>
                </div>
                <div class="row mt-3">
                <div class="col-6 mb-2 mt-">
                        <label class="mx-3"><b>Dose : </b></label>

                        <input class="form-check-input mx-2" type="checkbox" name="MorningDose"
                        <?php 
                            if($medicines['MorningDose'] == 1){
                                
                                echo "checked";
                            }else
                            

                        ?>
                        >
                        <label class="form-check-label mx-1" for="gridRadios1">
                            Morning
                        </label>
                        <input class="form-check-input mx-2" type="checkbox" name="AfternoonDose" <?php 
                            if($medicines['AfternoonDose'] == 1){
                                
                                echo "checked";
                            }

                        ?>>
                        <label class="form-check-label mx-1" for="gridRadios1">
                            Afternoon
                        </label>
                        <input class="form-check-input mx-2" type="checkbox" name="EveningDose" <?php 
                            if($medicines['EveningDose'] == 1){
                                
                                echo "checked";
                            }

                        ?>>
                        <label class="form-check-label mx-1" for="gridRadios1">
                            Evening
                        </label>
                        <input class="form-check-input mx-2" type="checkbox" name="NightDose"<?php 
                            if($medicines['NightDose'] == 1){
                                
                                echo "checked";
                            }
                        ?>>
                        <label class="form-check-label mx-1" for="gridRadios1">
                            Night
                        </label>
                    </div>
                    <div class="col-6 mb-2 w-80 ">
                        <button type="submit" class="btn btn-primary" name="submit">Update Medicine</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php
require(pathOf('admin/includes/footer1.php'));
require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>