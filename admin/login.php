<?php

require("./init/init.php");

if (isset($_SESSION['LoggedInUserId']))
{
    header('Location: ' . urlOf('admin/'));
    exit();
}

if (isset($_POST['username']))
{
    header('Content-Type: application/json');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $row = selectOne("SELECT Id FROM `users` WHERE `Username` = ? AND `Password` = ?", [$username, $password]);

    if (!$row)
        echo json_encode(["status" => false, "message" => "Wrong username or password"]);
    else
    {
        $_SESSION['LoggedInUserId'] = $row['Id'];
        echo json_encode(["status" => true, "message" => "Logged in!"]);
    }

    exit();
}
require(pathOf('admin/includes/header.php'));
// require(pathOf('admin/includes/nav.php'));
// require(pathOf('admin/includes/sidebar.php'));
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 col-md-3"></div>
        <div class="col-6 col-md-6">
            <div class="card card-primary " style="width: 450px; margin: 170px 170px 170px 170px;">
                <div class="card-header " style="background-color: cornflowerblue;">
                    <h3 class="card-title" sty>#G.P.Clinic</h3>
                </div>
                <form onsubmit="return login()">
                    <div class="card-body">
                        <?php $row = select("SELECT * FROM `users`");
                            foreach($row as $r){
                        ?>
                        <!-- print_r($row); -->
                        
                        <div class="form-group" style="color: black;">
                            <label for="username" class="mb-2 mx-2">Username :</label>
                            <input type="text" name="username" id="username" value="<?=$r['Username'] ?>" class="form-control mb-3" placeholder="Enter Username"  required readonly>
                        </div>
                        <?php }?>
                        <div class="form-group" style="color:black">
                            <label for="password" class="mx-2 mb-2">Password :</label>
                            <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Enter Password" autofocus required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button id="btn-submit" type="submit" class="btn btn-primary btn-login" id="btn-save-details">
                            <span id="btn-submit-text">Submit</span>
                            <span id="btn-submit-text-saved" style="display: none">Logged in!</span>
                            <div id="btn-submit-spinner" class="spinner-border spinner-border-sm" role="status" style="display: none">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <div id="message">

            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!-- </section> -->
<script src="<?= urlOf('admin/js/auth.js') ?>"></script>
<?php
// require(pathOf('admin/includes/footer1.php'));

require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>