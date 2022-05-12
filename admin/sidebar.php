<div class="sidebar-container">
    <div class="logo-container">
        logo
    </div>

    <div class="nav-container">
        <ul>
            <?php
            if ($_SESSION["role"] == 'main admin') {
            ?>
                <li class="list">
                    <!-- -->
                    <a href="admin-dashboard.php " class="link">
                        <i class="fa fa-solid fa-chalkboard"></i> dashboard </a>
                </li>

                <li class="list">
                    <!--  -->
                    <a href="admin-pendingAdmin.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Pending Admins</a>
                </li>

                <li class="list">
                    <a href="admin-users.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Users</a>
                </li>
            <?php
            }
            ?>

            <?php
            if ($_SESSION["role"] == 'Admin1') {
            ?>

                <li class="list">
                    <a href="admin-documents.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Pending Documents</a>
                </li>

            <?php
            }
            ?>

            <?php
            if ($_SESSION["role"] == 'Admin2') {
            ?>
                <li class="list">
                    <a href="admin-podcast.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Upload Podcasts</a>
                </li>

                <li class="list">
                    <a href="admin-audiobook.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Upload Audiobooks</a>
                </li>
            <?php
            }
            ?>


            <li class="list">
                <a href="admin-audit-trail.php" class="link">
                    <i class="fa fa-solid fa-users"></i>Audit trail</a>
            </li>

            <li class="list">
                <!---->
                <a href="../functions/admin-logout-function.php" class="link">
                    <i class="bi bi-box-arrow-right"></i>logout</a>
            </li>

        </ul>
    </div>
</div>