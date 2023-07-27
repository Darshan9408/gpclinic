<?php

require("./init/init.php");
require(pathOf('admin/includes/auth.php'));

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));
?>
<div class="container mx-2">
    <div class="row mt-4 mx-4">
        <div class="bg-light rounded h-100 p-4 mx-6 " align="center">
            <img src="<?= urlOf('admin/bill/Image/dr.png') ?>" alt="" >
        </div>
    </div>


    <?php
    require(pathOf('admin/includes/footer1.php'));
    require(pathOf('admin/includes/script.php'));
    require(pathOf('admin/includes/footer2.php'));
    ?>
</div>