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

<h1 style="text-align:center; margin-top:50px">Lista de empleados</h1>
<div class="col-md-8" style="width:30%; text-align:center; margin: 0 auto; margin-top:50px">

    <?php if(isset($_SESSION['message'])) {?>

    <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
    <?= $_SESSION['message']?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php session_unset(); } ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM usuario WHERE idusuariotipo<>3";
            $result_empleados = mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($result_empleados)) { ?>
                <tr>
                    <td><?php echo $row['idusuario']?></td>
                    <td><?php echo $row['nombre']?></td>
                    <td><?php echo $row['apellido_p']?></td>

                    <?php $idusuariotipo=$row['idusuariotipo']?>
                    <?php $query_usuariotipo = "SELECT tipo FROM usuariotipo WHERE idusuariotipo=$idusuariotipo";
                    $result_usuariotipo = mysqli_query($conn, $query_usuariotipo);?>
                    <td>
                    <?php while ($row1 = $result_usuariotipo->fetch_assoc()) {
                        echo $row1['tipo'];
                    }?>
                    </td>
                    
                    <td><?php echo $row['correo']?></td>
                    <td><?php echo $row['telefono']?></td>
                    <td>
                        <a href="controller/edit_usuario.php?id=<?php echo $row['idusuario']?>">
                            Editar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php")?>   