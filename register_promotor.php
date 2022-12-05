<?php include("database/bd_connection.php")?>

<?php include("includes/header.php")?>


<?php
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
    header("Location: index.php");
}
?>


<h1 style="text-align:center; margin-top:50px">Registrar promotor</h1>
<div class="card card-body" style="width: 20%; margin: 0 auto; text-align:center; margin-top: 50px;">
<form action="controller/save_promotor.php" method="POST">
    <div class="form-group">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus>
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="text" name="apellidoP" class="form-control" placeholder="Apellido paterno">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="text" name="apellidoM" class="form-control" placeholder="Apellido materno">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="email" name="correo" class="form-control" placeholder="Correo electrónico">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="number" name="telefono" class="form-control" placeholder="Número de teléfono">
    </div>

    <input type="submit" class="btn btn-success btn-block" style="margin-top: 15px" name="save_promotor" value="Registro">
    <input type="button" class="btn btn-danger btn-block" style="margin-top: 15px" value="Cancelar" onclick="history.back()">
</form>
</div>


<?php include("includes/footer.php")?>   