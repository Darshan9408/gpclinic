<div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="index.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">GP Clinic</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <!-- <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div> -->
            </div>
            <div class="navbar-nav w-100">
                <a href="<?= urlOf('admin/index.php') ?>" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Consultations </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./ConsultationsDisplay.php" class="dropdown-item"><i class="fa fa-chart-bar me-2"></i>Consultations</a>
                            <a href="./ConsultationServicesDisplay.php" class="dropdown-item"><i class="fa fa-chart-bar me-2"></i>Consultations Services</a>
                        </div>
                    </div> -->
                <!-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a> -->
                <a href="<?= urlOf('admin/patients/') ?>" class="nav-item nav-link"><i class="fa fa-male me-2"></i>Patients</a>
                <a href="<?= urlOf('admin/consultations/') ?>" class="nav-item nav-link"><i class="fa fa-briefcase me-2"></i>Consultations</a>
                <!-- <a href="./ConsultationsDisplay.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>consultations</a> -->
                <a href="<?= urlOf('admin/medicines/') ?>" class="nav-item nav-link"><i class="fa fa-plus-square me-2"></i>Medicines</a>
                <a href="<?= urlOf('admin/Parameters/') ?>" class="nav-item nav-link"><i class="fa fa-handshake me-2"></i>Parameters </a>
                <a href="<?= urlOf('admin/BMI/viewpatients.php') ?>" class="nav-item nav-link"><i class="fa fa-handshake me-2"></i>BMI </a>
                <a href="<?= urlOf('admin/changepassword.php/') ?>" class="nav-item nav-link"><i class="bi bi-shield-lock-fill"></i>
                    New Password </a>

                <a href="<?= urlOf('admin/logout.php') ?>" class="nav-item nav-link"><i class="bi bi-power"></i>Logout </a>

                <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->