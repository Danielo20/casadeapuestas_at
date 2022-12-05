<?php include("database/bd_connection.php")?>

<?php include("includes/header.php")?>

<h1 style="text-align:center; margin-top:50px">Iniciar sesión</h1>
<div class="card card-body" style="width: 20%; margin: 0 auto; text-align:center; margin-top: 50px;">
<form action="controller/user_login.php" method="POST">
    <div class="form-group">
        <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" autofocus>
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
    </div>

    <input type="submit" class="btn btn-success btn-block" style="margin-top: 15px" name="user_login" value="Iniciar sesión"><br>
    <h6 style="margin-top:25px">¿No tienes una cuenta? </h6>
    <input type="submit" class="btn btn-warning btn-block" style="margin-top: 15px" name="user_register" value="Regístrate">
</form>
</div>


<?php include("includes/footer.php")?>   