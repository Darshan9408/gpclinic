<?php
require("../init/init.php");
if($_SESSION['LoggedInUserId'] == null){
    header('Location: ' . urlOf('admin/login.php'));

}
require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));

$rows = select("SELECT * FROM services  WHERE `IsDeleted` = '0' ORDER BY Id DESC");
$r = count($rows);

?>

<div class="container mx-5">
    <div class="row mt-5 mx-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4 mx-6">
                <u><a href="<?= urlOf('admin/Parameters/add.php') ?>">
                        <h3 class="mb-4">New Parameters</h3>
                    </a></u>
                <div class="col-8 "  >

                    
                    <table class="table table-light table-bordered">
                        <thead class="table-primary" style="text-align: center;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Default Amount</th>
                                <th scope="col" colspan="2"class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php for($i=$r ; $i >= 1 ; $i--){foreach ($rows as $r) { ?>
                            <tbody>
                                <tr><td class="mx-4"><?= $i; $i--; ?></td>
                                    <td class="mx-4"><?= $r['Name'] ?></td>
                                    <td class="mx-4"><?= $r['DefaultAmount'] ?></td>
                                    <td class="text-center ">
                                        <a href="<?= urlOf('admin/Parameters/update.php') ?>?Id=<?=$r['Id']?>"><button class="btn btn-primary" name="Update">Update</button></a>
                                    </td>
                                        <td class="text-center ">
                                       
                                        <a href="<?= urlOf('admin/Parameters/delete.php') ?>?Id=<?=$r['Id']?>"><button class="btn btn-primary" name="Delete">Delete</button></a>
                                    </td>
                                    <!-- <td class="text-center>
                    </td> -->
                                </tr>
                            </tbody>
                        <?php }} ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    require(pathOf('admin/includes/footer1.php'));
    require(pathOf('admin/includes/script.php'));
    require(pathOf('admin/includes/footer2.php'));
    ?>

</div>