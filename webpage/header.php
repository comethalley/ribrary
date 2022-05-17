<header>
    <div class="container">
        <div class="list">
            <button class="links">Settings</button>
            <button class="links"><a href="ticket.php">Help & Support</button>

            <?php
            if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

            ?>
                <button class="links"><a href="../functions/logout-function.php">Log out</a></button>
            <?php
            } else {
            ?>
                <button class="links"><a href="Login-and-SignUp-page.html">Log In</a></button>
            <?php } ?>
        </div>

        <button class="click">...</button>

        <?php
        if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

        ?>
            <!-- NOtif button -->
            <div id="notification"><i class="bi bi-bell-fill"></i> <span class="notif-count"><?php

                                                                                                $notifCount = $user->getUnreadNotif($_SESSION["id"]);

                                                                                                if ($notifCount) {
                                                                                                    echo count($notifCount);
                                                                                                }
                                                                                                ?></span>
                <div class="notif-container hidden">

                    <?php

                    $data = $user->getNotification($_SESSION["id"]);
                    foreach ($data as $row) {
                    ?>
                        <div class="notif-message">
                            <p class="notif-date"><i><?php echo $row['date_and_time']; ?></i></p>
                            <?php
                            if ($row['status'] == 'pending') {
                            ?>
                                <p class="notif-details"> We are verifying your uploaded document <?php echo $row['doc_name'] ?> please wait for a moment.</p>
                            <?php
                            } else if ($row['status'] == 'accepted') {
                            ?>
                                <p class="notif-details"> Your uploaded document <?php echo $row['doc_name'] ?> has been accepted.</p>
                            <?php
                            } else if ($row['status'] == 'declined') {
                            ?>

                                <p class="notif-details"> Your uploaded document <?php echo $row['doc_name'] ?> has been declined. </br> <span class="view-message"> View message
                                        <input type="hidden" id="decline-message" value="<?php echo $row['message'] ?>"></span></p>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Notif content -->
            <a href="UserProf.php" id="account-name">
                <p>Hi, <?php echo $_SESSION['first-name'] ?> <?php echo $_SESSION['last-name'] ?></p>
            </a>

            <img src="<?php echo $_SESSION["profile"] ?>" alt="" class="user-image">
        <?php
        }
        ?>
    </div>

    <script>
        let click = document.querySelector('.click');
        let list = document.querySelector('.list');
        click.addEventListener("click", () => {
            list.classList.toggle('newlist');
        });
    </script>
</header>