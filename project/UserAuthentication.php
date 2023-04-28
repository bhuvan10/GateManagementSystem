<?php
session_start();
?>
<html>

<head>
    <title>Gate Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="mycss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <?php
    if (isset($_SESSION['status'])) {
        echo "<h1 class='text-center text-success' >" . $_SESSION['status'] . "</h1>";
        unset($_SESSION['status']);
    } else {
        ?>
        <div class="login-form">
            <h2>Change Password</h2>
            <form method="POST" action="./panel/code.php">
                <div class="input-field">
                    <i class="bi bi-person-circle"></i>
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="input-field">
                    <i class="bi bi-person-circle"></i>
                    <input type="text" placeholder="First name" name="firstname">
                </div>
                <div class="input-field">
                    <i class="bi bi-shield-lock"></i>
                    <input type="password" placeholder="New Password" name="password">
                </div>

                <button type="submit" name="ChangePassword">change Password</button>
                
            </form>
        </div>
        <?php

    }
    ?>



</body>