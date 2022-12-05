<?php

include("../database/bd_connection.php");
session_start();

$correo = $_POST['correo'];
$password = $_POST['password'];

$query = "SELECT COUNT(*) as conteo FROM usuario WHERE correo='$correo' AND password='$password'";
$result = mysqli_query($conn, $query);
$array = mysqli_fetch_array($result);

if(isset($_POST['user_login']))
{
    if($array['conteo']>0)
    {
        $_SESSION['correo'] = $correo;
        $_SESSION['password'] = $password;
        header("Location: ../index.php");
    }
    else
    {
        echo "Información erronea, intente nuevamente";
    }
}
elseif(isset($_POST['user_register']))
{
    header("Location: ../register.php");
}


?>