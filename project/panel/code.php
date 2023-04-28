<?php
session_start();
include('..\MysqlConnection.php');
if (isset($_POST['addUser'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_query = "INSERT INTO user (FIRST_NAME,LAST_NAME,username,password) VALUES ('$firstname','$lastname','$username','$password')";
    $user_query_run = mysqli_query($connection, $user_query);

    if ($user_query_run) {
        $_SESSION['status'] = 'User Added Successfully';
        header("Location: register.php");
    } else {
        $_SESSION['status'] = 'User Registration Failed';
        header("Location: register.php");
    }
}
if (isset($_POST['updateUser'])) {
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_query = "UPDATE  user SET   FIRST_NAME='$firstname',LAST_NAME='$lastname',username='$username',password='$password' WHERE USER_ID='$user_id'";
    $user_query_run = mysqli_query($connection, $user_query);

    if ($user_query_run) {
        $_SESSION['status'] = 'User Updated Successfully';
        header("Location: updateUser.php?user_id=$user_id");
    } else {
        $_SESSION['status'] = 'User Not Updated';
        header("Location: updateUser.php?user_id=$user_id");
    }
}
if (isset($_POST['addVehicle'])) {
    $user_id = $_POST['user_id'];
    $platenumber = $_POST['platenumber'];
    $color = $_POST['color'];
    $type = $_POST['type'];
    $user_query = "INSERT INTO vehicle VALUES ('$platenumber','$color','$type');";
    $user_query_run = mysqli_query($connection, $user_query);

    if ($user_query_run) {
        $user_query = "INSERT INTO owner VALUES ('$user_id','$platenumber');";
        $user_query_run = mysqli_query($connection, $user_query);
        if ($user_query_run) {

            $_SESSION['status'] = 'Vehicle Registered';
            header("Location: updateUser.php?user_id=$user_id");
        } else {
            $_SESSION['status'] = 'Vehicle not Registered';
            header("Location: updateUser.php?user_id=$user_id");
        }
    } else {
        $_SESSION['status'] = 'Vehicle not Registered';
        header("Location: updateUser.php?user_id=$user_id");
    }
}
if (isset($_POST['GateLogin'])) {
    $user_id = $_POST['userid'];
    header("Location: ../VehicleLogin.php?user_id=$user_id");
}
if (isset($_POST['GateExit'])) {
    $user_id = $_POST['userid'];
    $query = "UPDATE gate_log SET Exit_time=CURRENT_TIMESTAMP WHERE USER_ID='$user_id' AND Exit_time is NULL";
    $user_query_run = mysqli_query($connection, $query);
    if ($user_query_run) {

        $_SESSION['status'] = 'Gate Exit Successful';
        header("Location: ../Userpanel.php?user_id=$user_id");

    } else {
        $_SESSION['status'] = 'Gate Exit Unsuccessful';
        header("Location: ../Userpanel.php?user_id=$user_id");
    }
}
if (isset($_POST['ProfileLogin'])) {
    $user_id = $_POST['userid'];
    header("Location: ./updateUser.php?user_id=$user_id");
}
if (isset($_POST['UserLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_query = "SELECT * from user where username='$username' AND password='$password' LIMIT 1";
    $user_query_run = mysqli_query($connection, $user_query);
    if (mysqli_num_rows($user_query_run) > 0) {
        foreach ($user_query_run as $row) {
            $_SESSION['status'] = 'Signed in Successfully';
            $user_id = $row['USER_ID'];
            header("Location: ../Userpanel.php?user_id=$user_id");
        }
    } else {
        $_SESSION['status'] = 'Incorrect Password or Username';
        header("Location: ../UserLogin.php");
    }
}
if (isset($_POST['SigninVehicle'])) {
    $platenumber = $_POST['platenumber'];
    $user_id = $_POST['userid'];
    $user_query = "INSERT into gate_log (USER_ID,PLATE_NUMBER) VALUES ('$user_id','$platenumber')";
    $user_query_run = mysqli_query($connection, $user_query);
    if ($user_query_run) {
        $_SESSION['status'] = 'Gate Login successful';
        header("Location: ../Userpanel.php?user_id=$user_id");
    } else {
        $_SESSION['status'] = 'Gate Login Unsuccessfull';
        header("Location: ../UserLogin.php");
    }
}
if (isset($_POST['ChangePassword'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $password = $_POST['password'];
    $user_query = "update user set password='$password' where username='$username' AND FIRST_NAME='$firstname' LIMIT 1 ";
    $user_query_run = mysqli_query($connection, $user_query);
    if ($user_query_run) {
        $_SESSION['status'] = 'Password changed Successfully';
        header("Location: ../UserLogin.php");
    } else {
        $_SESSION['status'] = 'Password Change Unsuccessfull';
        header("Location: ../UserLogin.php");
    }
}
if (isset($_POST['DeleteUserbtn'])) {
    $user_id = $_POST['delete_id'];
    $query = "DELETE FROM user WHERE USER_ID='$user_id'";
    $user_query_run = mysqli_query($connection, $query);
    if ($user_query_run) {
        $_SESSION['status'] = 'User Deleted Successfully';
        header("Location: registeredusers.php");
    } else {
        $_SESSION['status'] = 'User Deletion Failed';
        header("Location: registeredusers.php");
    }
}
?>