<?php

require("./init/init.php");
require(pathOf('admin/includes/auth.php'));

if (isset($_POST['oldPassword'])) {
    header('Content-Type: application/json');

    $userId = $_SESSION['LoggedInUserId'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    $row = selectOne("SELECT `Password` FROM `users` WHERE `Id` = ? AND `Password` = ?", [$userId, $oldPassword]);

    if (!$row)
        echo json_encode(["status" => false, "message" => "Old password is wrong!"]);
    else {
        execute("UPDATE `users` SET `Password` = ? WHERE `Id` = ?", [$newPassword, $userId]);

        echo json_encode(["status" => true, "message" => "Password updated successfully."]);
        // header('Location: ' . urlOf('admin/'));

    }

    exit();
}

require(pathOf('admin/includes/header.php'));
require(pathOf('admin/includes/nav.php'));
require(pathOf('admin/includes/sidebar.php'));
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-3 col-md-3"></div>
        <div class="col-6 col-md-6">
            <div class="card card-primary " style="width: 450px; margin: 130px 100px 100px 100px;">
                <!-- <div class="card card-primary"> -->
                <div class="card-header" style="background-color: cornflowerblue;">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <form onsubmit="return changePassword()">
                    <div class="card-body">
                        <div class="form-group">
                            <!-- <label for="password" class="mb-2 mx-2">Old Password :</label> -->
                            <input type="password" name="old-password" id="old-password" class="form-control mb-4" placeholder=" Enter Old Password" autofocus required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="password" class="mb-2 mx-2">New Password :</label> -->
                            <input type="password" name="new-password" id="new-password" class="form-control mb-4" placeholder=" Enter New Password" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="password" class="mb-2 mx-2">Confirm New Password :</label> -->
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control mb-4" placeholder=" Enter Confirm New Password" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button id="btn-submit" type="submit" class="btn btn-primary">
                            <span id="btn-submit-text">Save</span>
                            <span id="btn-submit-text-saved" style="display: none">Saved!</span>
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
</section>
<script src="<?= urlOf('admin/js/auth.js') ?>"></script>
<?php
require(pathOf('admin/includes/footer1.php'));

require(pathOf('admin/includes/script.php'));
require(pathOf('admin/includes/footer2.php'));
?>
</div>