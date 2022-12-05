<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apuesta Total</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" href="https://estafaopiniones.com/wp-content/uploads/2021/11/apuestatotal.jpg">
  </head>
<body>

<?php
if(!isset($_SESSION))
{
    session_start();
}
error_reporting(E_ERROR | E_PARSE);

$correo = $_SESSION['correo'];
$password = $_SESSION['password'];

$query = "SELECT * FROM usuario WHERE correo='$correo' AND password='$password'";
$result_usuario = mysqli_query($conn, $query);
$userinfo = mysqli_fetch_array($result_usuario);
?>

<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="https://images.prismic.io/sgbg/954b9375-0c41-453a-ad15-ff752fd6b88c_Apuestatotal-logo.png" alt="ApuestaTotal" width="150" height="40" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <?php if(isset($correo)) : ?>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

          <?php if($userinfo['idusuariotipo'] == 1) : ?>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="list_empleados.php">Empleados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="register_promotor.php">Registrar promotor</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="list_recargas.php">Recargas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="partidos.php">Partidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="historial.php">Historial</a>
          </li>
          <?php endif; ?>

          <?php if($userinfo['idusuariotipo'] == 2) : ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="list_recargas.php">Recargas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="partidos.php">Partidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="historial.php">Historial</a>
          </li>
          <?php endif; ?>

          <?php if($userinfo['idusuariotipo'] == 3) : ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="partidos.php">Partidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="mibilletera.php">Mi billetera</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="recarga_aqui.php">Recarga aquí</a>
          </li>
          <?php endif; ?>

          <li>
            <a class="nav-link text-white" href="controller/user_logout.php">Cerrar sesión</a>
          </li>

        </ul>
      </div>
    <?php endif; ?>
  </div>
</nav>