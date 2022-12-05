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

if(isset($_GET['id']))
{
    $idusuario = $_GET['id'];
    $query = "SELECT * FROM usuario WHERE idusuario = $idusuario";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $apellido_p = $row['apellido_p'];
        $apellido_m = $row['apellido_m'];
        $correo = $row['correo'];
        $telefono = $row['telefono'];
    }
}

if(isset($_POST['edit_usuario']))
{
    $idusuario = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellidoP'];
    $apellido_m = $_POST['apellidoM'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $query = "UPDATE usuario SET nombre = '$nombre', apellido_p = '$apellido_p', apellido_m = '$apellido_m', correo = '$correo', telefono = '$telefono' WHERE idusuario = '$idusuario'";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Edición satisfactoria';
    $_SESSION['message_type'] = 'success';
    header('Location: ../list_empleados.php');
}

?>


<?php include("../includes/header.php") ?>

<div class="card card-body" style="width: 20%; margin: 0 auto; text-align:center; margin-top: 50px;">
    <form action="edit_usuario.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group" style="margin-top: 10px">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $nombre; ?>">
        </div>
        <div class="form-group" style="margin-top: 10px">
            <input type="text" name="apellidoP" class="form-control" placeholder="Apellido paterno" value="<?php echo $apellido_p; ?>">
        </div>
        <div class="form-group" style="margin-top: 10px">
            <input type="text" name="apellidoM" class="form-control" placeholder="Apellido materno" value="<?php echo $apellido_m; ?>">
        </div>
        <div class="form-group" style="margin-top: 10px">
            <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
        </div>
        <div class="form-group" style="margin-top: 10px">
            <input type="number" name="telefono" class="form-control" placeholder="Teléfono" value="<?php echo $telefono; ?>">
        </div>
        <input type="submit" class="btn btn-success btn-block" style="margin-top: 15px" name="edit_usuario" value="Editar">
        <input type="button" class="btn btn-danger btn-block" style="margin-top: 15px" value="Cancelar" onclick="history.back()">
    </form>
</div>

<?php include("../includes/footer.php")?>   