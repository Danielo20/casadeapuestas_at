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

if(isset($_POST['save_recarga_w']))
{
    $select_billetera = "SELECT idbilletera FROM billetera WHERE idusuario='$idusuario'";
    $result_billetera = mysqli_query($conn, $select_billetera);
    $billeterainfo = mysqli_fetch_array($result_billetera);
    $idbilletera = $billeterainfo['idbilletera'];
    
    $select_promotor_random = "SELECT * FROM usuario WHERE idusuariotipo=2 ORDER BY RAND() LIMIT 1";
    $result_promotor = mysqli_query($conn, $select_promotor_random);
    $promotorinfo = mysqli_fetch_array($result_promotor);
    $idusuariopromotor = $promotorinfo['idusuario'];
    $numeropromotor = $promotorinfo['telefono'];


    $query = "INSERT INTO recarga(medioatencion, idbilletera, idpromotor, estado) VALUES('WhatsApp','$idbilletera','$idusuariopromotor', 1)"; 
    $result = mysqli_query($conn, $query);
    if(!$result)
    {
        die("Query failed");
    }
   
    header("Location: https://wa.me/+51$numeropromotor?text=Hola%20quisiera%20una%20recarga%20por%20favor");
}

elseif(isset($_POST['save_recarga_t']))
{
    $select_billetera = "SELECT idbilletera FROM billetera WHERE idusuario='$idusuario'";
    $result_billetera = mysqli_query($conn, $select_billetera);
    $billeterainfo = mysqli_fetch_array($result_billetera);
    $idbilletera = $billeterainfo['idbilletera'];
    
    $select_promotor_random = "SELECT * FROM usuario WHERE idusuariotipo=2 ORDER BY RAND() LIMIT 1";
    $result_promotor = mysqli_query($conn, $select_promotor_random);
    $promotorinfo = mysqli_fetch_array($result_promotor);
    $idusuariopromotor = $promotorinfo['idusuario'];
    $numeropromotor = $promotorinfo['telefono'];


    $query = "INSERT INTO recarga(medioatencion, idbilletera, idpromotor, estado) VALUES('Telegram','$idbilletera','$idusuariopromotor', 1)"; 
    $result = mysqli_query($conn, $query);
    if(!$result)
    {
        die("Query failed");
    }
   
    header("Location: https://t.me/+51$numeropromotor");
}

?>