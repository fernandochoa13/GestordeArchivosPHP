<?php

if(isset($_GET['archivo'])) {

    $rutaArchivo = $_GET['archivo']; //Obtiene la ruta del archivo
    $nombreArchivo = explode("/",$rutaArchivo); //Divide la ruta en un array de strings
    $longitudNombreArchivo = strlen($nombreArchivo[2]);//Encuentra la longitud del nombre del archivo
    $nombreArchivoReal = substr($nombreArchivo[2], 0, $longitudNombreArchivo-4);//Elimina la extension .txt   
    $fr = fopen($rutaArchivo, "r+");//Abrir el archivo
    $lectura = fread($fr, filesize($rutaArchivo));
} else {
    $message = "El archivo al que usted intenta acceder no existe";
    header("Location:index.php?=msg".$message);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivo <?php echo $nombreArchivoReal ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="row">
        <nav class="Banner col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
           <h3>Bloc de Notas</h3>
        </nav>
    </div> 
    <div class="formNotas container-fluid">
     <h1 class="tituloNota">Archivo</h1> <br>
     <form action="" method="post"> 
      <label> Nombre del archivo: </label>  <br>
      <label><?php echo $nombreArchivoReal ?></label> <br>
      <label> Contenido del archivo </label> <br> <br>
      <textarea class="form-control" rows="10" cols="50" name='textarea'><?php echo $lectura?></textarea> <br> <br>
      <input type="submit" name="botonGuardarCambios" value="Guardar Cambios"  class="btn btn-outline-success">
      <input type="submit" name="botonInicio" value="Volver al Inicio"  class="btn btn-outline-success"> <br> <br>
    </form>
</body>
</html>

<?php  
if(isset($_POST['botonGuardarCambios'])) {//Guardar cambios del archivo
        $fr = fopen($rutaArchivo,'r+');
        if(!empty($_POST['textarea'])) {
            $contenidotextField = $_POST['textarea'];
            fwrite($fr, $contenidotextField);
        }
        $mensaje = "Se hizo el cambio en el archivo";
        fclose($fr);
            header("Location:index.php?msg=".$mensaje);

}

if(isset($_POST['botonInicio'])) {//Regresar al inicio
    $message = $_GET['msg'];
    header("Location:index.php");
}


?>