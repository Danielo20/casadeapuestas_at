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
?>

<?php if(isset($correo)) : ?>
    <h1 style="text-align:center; margin-top:50px">Bienvenido, <?php echo $userinfo["nombre"]; ?></h1>
    <?php $linkbaner="https://scontent-lim1-1.xx.fbcdn.net/v/t39.30808-6/315407074_3501928940093386_8604887088662308298_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeGkExaUTfmqpf7t2DOhmYczQNbGDmyZpgRA1sYObJmmBOADhV1qrkL7V0Yw6TCzAw9adKpYCtAEltJqSYe_2ujL&_nc_ohc=fjOnP5DDW7wAX8Whsm9&_nc_ht=scontent-lim1-1.xx&oh=00_AfD_Tz5cMpJIlWPjLun1R7o5xi1Rf7pl6en1WCaekJfEfg&oe=63928F3D"?>
    <img src="<?php echo $linkbaner; ?>" alt="ApuestaTotal baner" style="display:block; margin-left:auto; margin-right:auto; width:80%; margin-top:50px">
<?php elseif(!isset($correo)) : ?>
    <?php header("Location: login.php")?>
<?php endif; ?>

<?php include("includes/footer.php")?>   