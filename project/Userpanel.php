<?php
include("./MysqlConnection.php");

session_start();
?>
<html>

<head>
    <title>Gate Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="mycss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <div class="header" style="margin: 40px">
       
        <?php
         if($_GET['user_id']=="")
         {
            header("Location: UserLogin.php");

         }
        if (isset($_SESSION['status'])) {
            echo "<h1 class='text-center text-success' >" . $_SESSION['status'] . "</h1>";
            unset($_SESSION['status']);
        }
        ?>
    </div>
    <br></br>
</head>
<style>
    #logout{
    width: 100%;
    background-color: red;
    padding: 8px;
    border: none;
    font-size: 16px;
    font-weight: 500;
    color: white;
    margin: 15px 0;
    transition: background-color 0.4s;
}
</style>

<body>

    <div class="login-form">
        <h2>User PANEL</h2>
        <form method="POST" action="./panel/code.php">
            <?php
            $user_id = $_GET['user_id'];
            ?>
            <input type="hidden" name="userid" value="<?php echo $user_id ?>">
            <?php
            $query = "SELECT * FROM gate_log where USER_ID='$user_id' AND EXIT_TIME is NULL LIMIT 1";
            $query_run = mysqli_query($connection, $query);
            if (mysqli_num_rows($query_run) > 0) {
               ?>
               <button type="submit" name="GateExit">Exit the Gate</button>
               <?php
            } else {
                ?>
                <button type="submit" name="GateLogin">Log in to the Gate</button>
                <?php
            }
            ?>
            <button type="submit" name="ProfileLogin">Go to profile</button>
            <div class="extra">
            <a href="index.php">Log Out</a>
             </div>

        </form>
    </div>




</body>