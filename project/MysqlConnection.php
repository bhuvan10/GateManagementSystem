<?php
$connection=mysqli_connect("localhost","root","123456","gate_management");
if(!$connection)
{
    echo "connection not established";

    die("could not connect".mysqli_connect_error());
}
else{
    //echo 'connection esatblished';
}
?>