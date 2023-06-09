<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <?php $level = get_level($_SESSION['level']) ?>
                <h4>Dashboard <?= $level ?></h4>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <?php

                    if ($_SESSION['level'] == 3) {
                    ?>
                        <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $file = get_file($_SESSION['id_siswa']);
                            ?>
                            <img src="./media/<?= $file['foto_pas'] ?>" alt="" width="35" height="35" class="rounded-circle"> &nbsp;
                            <?php
                            $user = get_user($_SESSION['username'], $_SESSION['level']);
                            echo $user['nama'];
                            ?>
                        </a>
                    <?php } else { ?>
                        <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">

                            <img src="assets/images/user.jpg" alt="" width="35" height="35" class="rounded-circle"> &nbsp;
                            <?php
                            $user = get_user($_SESSION['username'], $_SESSION['level']);
                            echo $user['nama'];
                            ?>
                        </a>
                    <?php } ?>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">


                            <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>