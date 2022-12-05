<?php 

include("../database/bd_connection.php");

if(!isset($_SESSION))
{
    session_start();
}
$correo = $_SESSION['correo'];
$password = $_SESSION['password'];

$query = "SELECT * FROM usuario WHERE correo='$correo' AND password='$password'";
$result_usuario = mysqli_query($conn, $query);
$userinfo = mysqli_fetch_array($result_usuario);
$idusuario = $userinfo['idusuario'];
$idusuariotipo = $userinfo['idusuariotipo'];

if($idusuariotipo==3 || $idusuariotipo==2)
{
    header("Location: ../index.php");
}

if(isset($_POST['save_promotor']))
{
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $query = "INSERT INTO usuario(nombre, apellido_p, apellido_m, password, correo, telefono, idusuariotipo, idbilletero) 
    VALUES('$nombre', '$apellidoP', '$apellidoM', '$password', '$correo', '$telefono', 2, NULL)";
    $result = mysqli_query($conn, $query);
    if(!$result)
    {
        die("Query failed");
    }

    $_SESSION['message'] = 'Promotor guardado exitosamente';
    $_SESSION['message_type'] = 'success';

    header("Location: ../index.php");
}

?>