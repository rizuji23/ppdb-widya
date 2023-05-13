<?php

require '../system/controller.php';

if (empty($_SESSION['username'])) {
  header("location: ../login.php");
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | PPDB SMK BAKTI NUSANTARA 666</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->

    <?php

    include 'include/sidebar_core.php';

    ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php if ($_SESSION['level'] == 3) {
        include 'include/navbar.php';
      } else if ($_SESSION['level'] == 2) {
        include 'include/navbar_petugas.php';
      } else if ($_SESSION['level'] == 1) {
        include 'include/navbar_admin.php';
      } ?>

      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <?php if ($_SESSION['level'] == 3) {
          include 'siswa/index.php';
        } else if ($_SESSION['level'] == 2) {
          include 'include/navbar_petugas.php';
        } else if ($_SESSION['level'] == 1) {
          include 'include/navbar_admin.php';
        } ?>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>