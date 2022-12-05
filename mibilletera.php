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
$idbilletera = $userinfo['idbilletera'];
?>

<?php if(!empty($userinfo['idbilletera'])) : ?>
    <?php 
        $query = "SELECT * FROM billetera WHERE idbilletera='$idbilletera'";
        $result_billetera = mysqli_query($conn, $query);
        $billetera_info = mysqli_fetch_array($result_billetera);
    ?>
    <div class="card card-body" style="width: 20%; margin: 0 auto; text-align:center; margin-top: 50px;">
    <h1 style="text-align:center; margin-top:50px">Tu billetera</h1>
    <h4 style="text-align:center; margin-top:50px">Saldo actual: S/. <?php echo $billetera_info['monto']?> </h4>
    <input type="submit" class="btn btn-success btn-block" style="margin-top: 15px" onclick="location.href='recarga_aqui.php';" value="Recargar saldo">
    </div>
<?php endif; ?>


<?php if(!isset($correo)){
    header("Location: login.php");
 } 
 ?>

<?php include("includes/footer.php")?>   