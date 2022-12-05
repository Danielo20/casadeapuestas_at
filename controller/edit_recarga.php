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
    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_array($result);
        $monto = $row['monto'];
        $mediobancario = $row['mediobancario'];
        $idbilletera = $row['idbilletera'];
        $estado = $row['estado'];   
    }

    $query_billetera = "SELECT * FROM billetera WHERE idbilletera='$idbilletera'";
    $result_billetera = mysqli_query($conn, $query_billetera);
    $billetera_info = mysqli_fetch_array($result_billetera);
}

if(isset($_POST['edit_recarga']))
{
    $idrecarga = $_GET['id'];
    $monto = $_POST['monto'];
    $mediobancario = htmlspecialchars($_POST['mediobancario']);

    if(isset($_POST['mediobancario']))
    {
        if($_POST['mediobancario']==1)
        {
            $mediobancario = "Banco de Crédito del Perú (BCP)";
        }
        elseif($_POST['mediobancario']==2)
        {
            $mediobancario = "Interbank";
        }
        elseif($_POST['mediobancario']==3)
        {
            $mediobancario = "Scotiabank";
        }
        elseif($_POST['mediobancario']==4)
        {
            $mediobancario = "BBVA";
        }
    }

    $estado = $row['estado'];

    if($estado==1)
    {
        $update_recarga = "UPDATE recarga SET monto = '$monto', mediobancario = '$mediobancario', estado = 2 WHERE idrecarga = '$idrecarga'";
        mysqli_query($conn, $update_recarga);
        
        if($billetera_info['monto']>0)
        {
            $update_billetera = "UPDATE billetera SET monto = monto + '$monto' WHERE idbilletera='$idbilletera'";
            mysqli_query($conn, $update_billetera);
        }
        elseif($billetera_info['monto']==0 || is_null($row['monto']))
        {
            $update_billetera = "UPDATE billetera SET monto = '$monto' WHERE idbilletera='$idbilletera'";
            mysqli_query($conn, $update_billetera);
        }   
    }
    elseif($estado==2)
    {
        $motivo = htmlspecialchars($_POST['motivo']);
        $update_recarga = "UPDATE recarga SET monto = '$monto', mediobancario = '$mediobancario', estado = 2 WHERE idrecarga = '$idrecarga'";
        mysqli_query($conn, $update_recarga);

        if($billetera_info['monto']>0)
        {
            $montoantiguo = $row['monto'];
            $montonuevo = $_POST['monto'];
            $update_billetera = "UPDATE billetera SET monto = monto - '$montoantiguo' + '$montonuevo' WHERE idbilletera='$idbilletera'";
            mysqli_query($conn, $update_billetera);
        }
        elseif($billetera_info['monto']==0 || is_null($row['monto']))
        {
            $update_billetera = "UPDATE billetera SET monto = '$monto' WHERE idbilletera='$idbilletera'";
            mysqli_query($conn, $update_billetera);
        }

        $query_interaccion = "INSERT INTO interaccion(idelemento, idinteractuador, tipo,motivo) VALUES('$idrecarga','$idusuario','Edicion de recarga','$motivo')";
        mysqli_query($conn, $query_interaccion);
    }

    
    $_SESSION['message'] = 'Edición satisfactoria';
    $_SESSION['message_type'] = 'success';
    header('Location: ../list_recargas.php');
}

?>


<?php include("../includes/header.php") ?>


<div class="card card-body" style="width:20%; text-align:center; margin: 0 auto; margin-top:50px">
    <form action="edit_recarga.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
            <input type="number" style="margin-top:10px" min="20.00" max="3000.00" name="monto" class="form-control" placeholder="Monto" value="<?php echo $monto; ?>"
            onKeyUp="if(this.value>3000.00){this.value='3000.00';}else if(this.value<0.00){this.value='20.00';}">
        </div>
        <div class="form-group" style="margin-top:10px">
            <select class="form-select" name="mediobancario">
                <?php if(isset($row['mediobancario'])) : ?>
                    <option selected><?php echo $mediobancario; ?></option>
                <?php endif; ?>
                <?php if(!isset($row['mediobancario'])) : ?>
                    <option selected>Elige medio bancario</option>                  
                <?php endif; ?>
                <option value="1">Banco de Crédito del Perú (BCP)</option>
                <option value="2">Interbank</option>
                <option value="3">Scotiabank</option>
                <option value="4">BBVA</option>
            </select>
        </div>
        <?php if($row['estado'] == 2) : ?>
            <textarea class="form-control" name="motivo" style="margin-top:20px" rows="3" placeholder="Ingrese el motivo de esta edición..."></textarea>
        <?php endif; ?>

        <input type="submit" style="margin-top:25px" class="btn btn-success btn-block" name="edit_recarga" value="Realizar cambios">
        <input type="button" style="margin-top:25px" class="btn btn-danger btn-block" value="Cancelar" onclick="history.back()">
    </form>
</div>

<?php include("../includes/footer.php")?>   