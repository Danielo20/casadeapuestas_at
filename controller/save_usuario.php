<?php 

include("../database/bd_connection.php");

if(isset($_POST['save_cliente']))
{
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $query = "INSERT INTO usuario(nombre, apellido_p, apellido_m, password, correo, telefono, idusuariotipo) 
    VALUES('$nombre', '$apellidoP', '$apellidoM', '$password', '$correo', '$telefono', 3)";
    $result = mysqli_query($conn, $query);
    if(!$result)
    {
        die("Query failed");
    }

    $select_usuario = "SELECT idusuario FROM usuario WHERE correo='$correo' AND password='$password'";
    $result_usuario = mysqli_query($conn, $select_usuario);
    $userinfo = mysqli_fetch_array($result_usuario);
    $idusuario = $userinfo['idusuario'];

    $insert_billetera = "INSERT INTO billetera(monto, idusuario) VALUES(0.00, '$idusuario')";
    $result2 = mysqli_query($conn, $insert_billetera);

    $select_billetera = "SELECT idbilletera FROM billetera WHERE idusuario='$idusuario'";
    $result_billetera = mysqli_query($conn, $select_billetera);
    $billeterainfo = mysqli_fetch_array($result_billetera);
    $idbilletera = $billeterainfo['idbilletera'];


    $update_usuario = "UPDATE usuario SET idbilletera = '$idbilletera' WHERE idusuario='$idusuario'";
    $result3 = mysqli_query($conn, $update_usuario);

    $_SESSION['message'] = 'Cuenta creada exitosamente';
    $_SESSION['message_type'] = 'success';

    header("Location: ../login.php");
}

?>