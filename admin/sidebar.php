<div class="sidebar-container">
    <div class="logo-container text-light h6">
        <img src="../webpage/img/ribrary-logo-white.png" alt="logo" class="admin-logo">
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
                        <i class="fa fa-solid fa-user"></i>Pending Admins</a>
                </li>

                <li class="list">
                    <a href="admin-users.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Users</a>
                </li>
            <?php
            }
            ?>

            <?php
            if ($_SESSION["role"] == 'Admin1' || $_SESSION["role"] == 'main admin') {
            ?>

                <li class="list">
                    <a href="admin-documents.php" class="link">
                        <i class="fa fa-solid fa-file"></i>Pending Documents</a>
                </li>

                <li class="list">
                    <a href="admin-pendingPodcasts.php" class="link">
                        <i class="fa fa-solid fa-podcast"></i>Pending Podcasts</a>
                </li>

                <li class="list">
                    <a href="admin-pendingAudiobooks.php" class="link">
                        <i class="fa fa-solid fa-file-audio"></i>Pending Audiobooks</a>
                </li>

                <li class="list">
                    <a href="admin-pendingEbooks.php" class="link">
                        <i class="fa fa-solid fa-book"></i>Pending Ebooks</a>
                </li>

            <?php
            }
            ?>

            <?php
            if ($_SESSION["role"] == 'main admin') {
            ?>

                <li class="list">
                    <a href="admin-acceptedDocuments.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Documents</a>
                </li>

                <li class="list">
                    <a href="admin-acceptedPodcasts.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Podcasts</a>
                </li>

                <li class="list">
                    <a href="admin-acceptedAudiobooks.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Audiobooks</a>
                </li>

                <li class="list">
                    <a href="admin-acceptedEbooks.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Ebooks</a>
                </li>

                <li class="list">
                    <a href="admin-tickets.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Tickets</a>
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

                <li class="list">
                    <a href="admin-ebooks.php" class="link">
                        <i class="fa fa-solid fa-users"></i>Upload Ebooks</a>
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
                <a href="../functions/admin-logout-function.php" class="link logout">
                    <i class="fa fa-solid fa-arrow-right-from-bracket"></i>logout</a>
            </li>

        </ul>
    </div>
</div>