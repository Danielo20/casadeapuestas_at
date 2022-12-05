<?php include("database/bd_connection.php")?>

<?php include("includes/header.php")?>


<?php if(isset($_SESSION['message'])) {?>

<div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
<?= $_SESSION['message']?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php session_unset(); } ?>


<h1 style="text-align:center; margin-top:50px">Registrarse</h1>
<h5 style="text-align:center; margin-top:50px">Para validar tu información necesitamos que llenes el siguiente formulario</h5>
<div class="card card-body" style="width: 20%; margin: 0 auto; text-align:center; margin-top: 50px;">
<form action="controller/save_usuario.php" method="POST">
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
        <input type="email" name="correo" class="form-control" placeholder="Correo electrónico">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input type="number" name="telefono" class="form-control" placeholder="Número de teléfono">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input id="password" type="password" name="password" class="form-control" onkeyup='check();' placeholder="Contraseña">
    </div>

    <div class="form-group" style="margin-top: 10px">
        <input id="confirm_password" type="password" name="confirm_password" class="form-control" onkeyup='check();' placeholder="Repetir contraseña">
        <span id='mensaje'></span>
    </div>

    <input type="submit" class="btn btn-success btn-block" style="margin-top: 15px" name="save_cliente" value="Registrarse">
    <input type="button" class="btn btn-danger btn-block" style="margin-top: 15px" value="Cancelar" onclick="history.back()">
</form>
</div>

<script>
    var check = function() 
    {
        if (document.getElementById('password').value == document.getElementById('confirm_password').value) 
        {
            document.getElementById('mensaje').style.color = 'green';
            document.getElementById('mensaje').innerHTML = 'Las contraseñas coinciden';
        } 
        else 
        {
            document.getElementById('mensaje').style.color = 'red';
            document.getElementById('mensaje').innerHTML = 'Las contraseñas no coinciden';
        }
    }
</script>

<?php include("includes/footer.php")?>   