<html>
<head>
<title>Gate Management System</title>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<link rel="stylesheet" type="text/css" href="mycss.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>

<div class="login-form">
    <h2>Admin LOGIN PANEL</h2>
    <form method="POST">
        <div class="input-field">
            <i class="bi bi-person-circle"></i>
            <input type="text" placeholder="Username" name="Adminname">
        </div>
        <div class="input-field">
            <i class="bi bi-shield-lock"></i>
            <input type="password" placeholder="Password" name="AdminPassword">
        </div>
        
        <button type="submit" name="Signin">Sign In</button>

        
    </form>
</div>
<?php
  if(isset($_POST['Signin']))
  {
    if($_POST['Adminname']=="admin"&&$_POST['AdminPassword']=="123")
    {
        session_start();
        $_SESSION['AdminLoginId']=$_POST['Adminname'];
        header("location:AdminPanel.php");
    }
    else
    {
        echo" <script>alert('incorrect password');</script>";
    }
  }
?>

</body>