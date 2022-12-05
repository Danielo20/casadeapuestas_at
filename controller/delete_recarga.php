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

if($idusuariotipo==3)
{
    header("Location: ../index.php");
}

if(isset($_GET['id']))
{
    $idrecarga = $_GET['id'];
    $query = "SELECT * FROM recarga WHERE idrecarga = $idrecarga";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_array($result);
    $monto = $row['monto'];
    $mediobancario = $row['mediobancario'];
    $medioatencion = $row['medioatencion'];
    $idbilletera = $row['idbilletera'];
    $idpromotor = $row['idpromotor'];
    $fechacreacion = $row['created_at'];
    $estado = $row['estado'];
    
}

if(isset($_POST['delete_recarga']))
{
    $idrecarga = $_GET['id'];
    $estado = $row['estado'];

    $motivo = htmlspecialchars($_POST['motivo']);
    $update_recarga = "UPDATE recarga SET estado = 3 WHERE idrecarga = '$idrecarga'";
    mysqli_query($conn, $update_recarga);
    
    $query_interaccion = "INSERT INTO interaccion(idelemento, idinteractuador, tipo, motivo) VALUES('$idrecarga','$idusuario','Eliminacion de recarga','$motivo')";
    mysqli_query($conn, $query_interaccion);

    
    $_SESSION['message'] = 'Borrado satisfactorio';
    $_SESSION['message_type'] = 'success';
    header('Location: ../list_recargas.php');
}

?>


<?php include("../includes/header.php") ?>


<div class="card card-body" style="width:20%; text-align:center; margin: 0 auto; margin-top:50px">
    <form action="delete_recarga.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
            <input type="number" name="monto" class="form-control" value="<?php echo $monto; ?>" disabled>
        </div>

        <div class="form-group" style="margin-top:10px">
            <input type="text" name="mediobancario" class="form-control" value="<?php echo $mediobancario; ?>" disabled>
        </div>  

        <div class="form-group" style="margin-top:10px">
            <input type="text" name="medioatencion" class="form-control" value="<?php echo $medioatencion; ?>" disabled>
        </div>


        <?php 
            $query_usuariobilletera = "SELECT nombre, apellido_p FROM usuario WHERE idbilletera='$idbilletera'";
            $result_usuariobilletera = mysqli_query($conn, $query_usuariobilletera);
            $usuariobilleterainfo = mysqli_fetch_array($result_usuariobilletera);
            $nombreusuariobilletera = $usuariobilleterainfo['nombre'];
            $apellidousuariobilletera = $usuariobilleterainfo['apellido_p'];
        ?>
        <div class="form-group" style="margin-top:10px">
            <input type="text" name="billetera" class="form-control" value="<?php echo $idbilletera.' - '.$nombreusuariobilletera.' '.$apellidousuariobilletera; ?>" disabled>
        </div>


        <?php 
            $query_usuariopromotor = "SELECT nombre, apellido_p FROM usuario WHERE idusuario='$idpromotor'";
            $result_usuariopromotor = mysqli_query($conn, $query_usuariopromotor);
            $usuariopromotorinfo = mysqli_fetch_array($result_usuariopromotor);
            $nombreusuariopromotor = $usuariopromotorinfo['nombre'];
            $apellidousuariopromotor = $usuariopromotorinfo['apellido_p'];
        ?>
        <div class="form-group" style="margin-top:10px">
            <input type="text" name="promotor" class="form-control" value="<?php echo $nombreusuariopromotor.' '.$apellidousuariopromotor; ?>" disabled>
        </div>

        <div class="form-group" style="margin-top:10px">
            <input type="text" name="fechacreacion" class="form-control" value="<?php echo $fechacreacion; ?>" disabled>
        </div>

        <textarea class="form-control" name="motivo" style="margin-top:20px" rows="3" placeholder="Ingrese el motivo de esta eliminación..."></textarea>

        <input type="submit" style="margin-top:25px" class="btn btn-success btn-block" name="delete_recarga" value="Eliminar">
        <input type="button" style="margin-top:25px" class="btn btn-danger btn-block" value="Cancelar" onclick="history.back()">
    </form>
</div>

<?php include("../includes/footer.php")?>   