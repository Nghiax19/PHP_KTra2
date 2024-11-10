<?php

$user=$_POST["user"];
$pass=$_POST["pass"];

if($user=="chan" && $pass=="0903")
{
    session_start();
    $_SESSION["user"] =$user;
    header("Location:admin.php");
    exit();
}
else
{
    echo("Loi dang nhap");
}
?>