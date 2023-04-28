<html>
<head>
<title>Gate Management System</title>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<link rel="stylesheet" type="text/css" href="mycss.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>

<div class="login-form">
    <h2>Welcome To Gate Management System</h2>
    <form method="POST">
        
        <button type="submit" name="admin">Admin</button>
        <button type="submit" name="user">User</button>


    </form>
</div>
<?php
  if(isset($_POST['admin']))
  {
    
        
        header("location:./AdminLogin.php");
  }
    else if(isset($_POST['user']))
    {
        header("location:./UserLogin.php");
    }
  
?>

</body>