<?php
session_start();
include('MysqlConnection.php');
?>
<html>

<head>
    <title>Gate Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="mycss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    
        <div class="login-form">
            <h2>Vehicle LOGIN PANEL</h2>
            <form method="POST" action="./panel/code.php">
                <select class="custom-select" id="inputGroupSelect01" name="platenumber">
                    <option value="none">none</option>

                    <?php
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        $query = "SELECT * FROM owner WHERE USER_ID='$user_id'";
                        $query_run = mysqli_query($connection, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                                ?>
                                <option value=<?php echo $row['PLATE_NUMBER'] ?>><?php echo $row['PLATE_NUMBER'] ?></option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <input type="text" hidden=true value=<?php echo $_GET['user_id'] ?> name="userid">
                <button type="submit" name="SigninVehicle" class="btn btn-info">Sign In</button>

            </form>
        </div>
        <?php

    
    ?>



</body>