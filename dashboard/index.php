<?php


    //connection to database
    require_once '../connection/dbconnect.php';
if(!isset($_SESSION['usersform'])){
        header('Location: ../index.php');
      }

    
    $usersform = '';

    if(isset($_SESSION['usersform'])){
        $usersform = $_SESSION['usersform'];
    }
    // else{
    //     header('Location: ../index.php');
    // }

    // if(isset($_SESSION['usersform'])){
    //     header('Location: ../index.php');
    //   }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/mycustom-style.css">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion my-sidebar" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>

            <div class="sb-sidenav-menu-heading text-center mt-4">
                <img src="img/profile-avatar.jpg" class="img-fluid rounded-circle mb-3" width="130" height="130">
                <p class="small mb-1">Logged in as:</p>
                <p><?php echo $usersform['fullname'] ?></p>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img class="img-profile rounded-circle" src="img/profile-avatar.jpg">
                            </a>
                        </li>
                        <li class="nav-item my-auto logout">

                            <?php if(isset($_SESSION['usersform'])) : ?>
                                <a href="../index.php" class="my-auto">Logout <i class="fas fa-sign-out-alt"></i></a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
               

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white p-4">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy 2015 Kwame Nkrumah University of Science & Technology.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>