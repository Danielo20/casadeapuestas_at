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

<h1 style="text-align:center; margin-top:50px">Lista de recargas</h1>
<div class="col-md-8" style="width:70%; text-align:center; margin: 0 auto; margin-top:50px">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Medio bancario</th>
                <th>Medio de atención</th>
                <th>ID Billetera</th>
                <th>Promotor</th>
                <th>Fecha creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 

            if($idusuariotipo==1)
            {
                $select_recarga = "SELECT * FROM recarga WHERE estado<>3";
                $result_recarga = mysqli_query($conn, $select_recarga);
                $recargainfo = mysqli_fetch_array($result_recarga);
                $idrecarga = $recargainfo['idrecarga'];
            }
            elseif($idusuariotipo==2)
            {
                $select_recarga = "SELECT * FROM recarga WHERE idpromotor='$idusuario' AND estado<>3 ORDER BY estado";
                $result_recarga = mysqli_query($conn, $select_recarga);
                $recargainfo = mysqli_fetch_array($result_recarga);
                $idrecarga = $recargainfo['idrecarga'];
            }
            
            while($row = mysqli_fetch_array($result_recarga)) { ?>
                <tr>
                    <td><?php echo $row['idrecarga']?></td>
                    <td>S/.<?php echo $row['monto']?></td>
                    <td><?php echo $row['mediobancario']?></td>
                    <td><?php echo $row['medioatencion']?></td>

                    <?php $idbilletera=$row['idbilletera']?>

                    <?php $query_usuariobilletera = "SELECT nombre, apellido_p FROM usuario WHERE idbilletera='$idbilletera'";
                    $result_usuariobilletera = mysqli_query($conn, $query_usuariobilletera);
                    $usuariobilleterainfo = mysqli_fetch_array($result_usuariobilletera);
                    $nombreusuariobilletera = $usuariobilleterainfo['nombre'];
                    $apellidousuariobilletera = $usuariobilleterainfo['apellido_p'];
                    ?>

                    <td>
                        <?php echo $idbilletera.' - '.$nombreusuariobilletera.' '.$apellidousuariobilletera?>
                    </td>
                    
                    <?php $idusuariopromotor=$row['idpromotor']?>
                    <?php $query_usuariopromotor = "SELECT nombre, apellido_p FROM usuario WHERE idusuario='$idusuariopromotor'";
                    $result_usuariopromotor = mysqli_query($conn, $query_usuariopromotor);
                    $usuariopromotorinfo = mysqli_fetch_array($result_usuariopromotor);
                    $nombreusuariopromotor = $usuariopromotorinfo['nombre'];
                    $apellidousuariopromotor = $usuariopromotorinfo['apellido_p'];
                    ?>
                    <td>
                        <?php echo $nombreusuariopromotor.' '.$apellidousuariopromotor?>
                    </td>

                    <td><?php echo $row['created_at']?></td>

                    <td>                      
                        <?php if($recargainfo['estado'] <> 3) : ?>
                        <a href="controller/edit_recarga.php?id=<?php echo $row['idrecarga']?>">
                            Editar
                        </a>
                        <a href="controller/delete_recarga.php?id=<?php echo $row['idrecarga']?>">
                            Borrar
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php")?>   