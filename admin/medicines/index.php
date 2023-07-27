<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

$rows = select("SELECT * FROM medicines WHERE `IsDeleted` = '0' ORDER BY Id DESC");

$r = count($rows);
?>

<div class="container mx-2">
    <div class="row mt-5 mx-4">
        
        <div class="bg-light rounded h-100 p-4 mx-6">
            <u><a href="<?= urlOf('admin/medicines/add.php') ?>"><h3 class="mb-4">New Medicines</h3></a></u>
            <table class="table table-light table-bordered">
            <thead class="table-primary" style="text-align: center;">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price Per Piece</th>
                    <th scope="col">Morning Dose</th>
                    <th scope="col">Afternoon Dose</th>
                    <th scope="col">Evening Dose</th>
                    <th scope="col">Night Dose</th>
                    <th scope="col">Before Or After Food</th>
                    <th scope="col">Extra Notes</th>
                    <th scope="col" colspan="2" class="text-center">Action</th>
                </tr>
            </thead>

            <?php for($i=$r ; $i >= 1 ; $i--) {foreach ($rows as $r) { ?>
            <tbody>
                <tr>
                    <td><?= $i; $i--; ?></td>
                    <td><?=$r['Name']?></td>
                    <td><?=$r['Company']?></td>
                    <td><?=$r['Type']?></td>
                    <td><?=$r['PricePerPiece']?></td>
                    <td><?php if($r['MorningDose'] == 1){?><i class="bi bi-check-square-fill" style="color: blue;"></i><?php }else{?><i class="bi bi-x-square-fill" style="color: red;"></i><?php }?></td>
                    <td><?php if($r['AfternoonDose'] == 1){?><i class="bi bi-check-square-fill" style="color: blue;"></i><?php }else{?><i class="bi bi-x-square-fill" style="color: red;"></i><?php }?></td>    
                    <td><?php if($r['EveningDose'] == 1){?><i class="bi bi-check-square-fill" style="color: blue;"></i><?php }else{?><i class="bi bi-x-square-fill" style="color: red;"></i><?php }?></td>    
                    <td><?php if($r['NightDose'] == 1){?><i class="bi bi-check-square-fill" style="color: blue;"></i><?php }else{?><i class="bi bi-x-square-fill" style="color: red;"></i><?php }?></td>    
                    <td><?=$r['BeforeOrAfterFood']?></td>    
                    <td><?=$r['ExtraNotes']?></td>  
                    <td >
                        <a href="<?= urlOf('admin/medicines/update.php') ?>?Id=<?=$r['Id']?>"><button class="btn btn-primary" name="Update">Update</button></a>
                    </td>
                    <td>
                        <a href="<?= urlOf('admin/medicines/delete.php') ?>?Id=<?=$r['Id']?>"><button class="btn btn-primary" name="Delete">Delete</button></a>
                    </td>
                </tr>
            </tbody>
        <?php } }?>
        </table>
        </div>
    </div>
    
    <?php
require(pathOf('admin/includes/footer1.php'));
require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>

</div>
