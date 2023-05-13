<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.php" class="text-nowrap logo-img">
                <img src="../assets/logo.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <?php

            if ($_SESSION['level'] == 3) {
                include 'include/sidebar.php';
            } else if ($_SESSION['level'] == 2) {
                include 'include/sidebar_petugas.php';
            } else if ($_SESSION['level'] == 1) {
                include 'include/sidebar_admin.php';
            }

            ?>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>