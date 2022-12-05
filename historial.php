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

if($idusuariotipo==3)
{
    header("Location: index.php");
}
?>

<h1 style="text-align:center; margin-top:50px">Lista de interacciones</h1>
<div class="col-md-8" style="width:70%; text-align:center; margin: 0 auto; margin-top:50px">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Elemento</th>
                <th>ID Interactuador</th>
                <th>Tipo de interacción</th>
                <th>Motivo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php 

            if($idusuariotipo==1)
            {
                $select_interaccion = "SELECT * FROM interaccion";
                $result_interaccion = mysqli_query($conn, $select_interaccion);
                $interaccioninfo = mysqli_fetch_array($result_interaccion);
                $idinteraccion = $interaccioninfo['idinteraccion'];
            }
            elseif($idusuariotipo==2)
            {
                $select_interaccion = "SELECT * FROM interaccion WHERE idinteractuador='$idusuario'";
                $result_interaccion = mysqli_query($conn, $select_interaccion);
                $interaccioninfo = mysqli_fetch_array($result_interaccion);
                $idinteraccion = $interaccioninfo['idinteraccion'];
            }
            
            while($row = mysqli_fetch_array($result_interaccion)) { ?>
                <tr>
                    <td><?php echo $row['idinteraccion']?></td>
                    <td><?php echo $row['idelemento']?></td>
                   
                    <?php $idusuariointeractuador=$row['idinteractuador']?>
                    <?php $query_usuariointeractuador = "SELECT nombre, apellido_p FROM usuario WHERE idusuario='$idusuariointeractuador'";
                    $result_usuariointeractuador = mysqli_query($conn, $query_usuariointeractuador);
                    $usuariointeractuadorinfo = mysqli_fetch_array($result_usuariointeractuador);
                    $nombreusuariointeractuador = $usuariointeractuadorinfo['nombre'];
                    $apellidousuariointeractuador = $usuariointeractuadorinfo['apellido_p'];
                    ?>
                    <td>
                        <?php echo $nombreusuariointeractuador.' '.$apellidousuariointeractuador?>
                    </td>

                    <td><?php echo $row['tipo']?></td>
                    <td><?php echo $row['motivo']?></td>
                    <td><?php echo $row['fecha']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php")?>   