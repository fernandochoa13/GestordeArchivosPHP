<?php
$directorioNombre = $_GET['dir']; //Nombre del directorio obtenido de la url
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio <?php echo $directorioNombre ?></title>
    <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="css/Imagenes/LIBRETA.png">
</head>
<body>
    <div class="row">
        <nav class="Banner col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
           <h3>Bloc de Notas</h3>
        </nav>
    </div>
  <div class="buscadorNotas container-fluid"><!--Buscador de archivos-->
    <form class="d-flex" role="search" method="post">
        <input type="text" name="barraBusqueda" placeholder="Buscar archivo" class="form-control"> 
        <input type="submit" name="botonBuscar" class="btn btn-outline-success"> 
        <input type="submit" name="botonRefrescar" value="Refrescar" class="btn btn-outline-success">
    </form>
   </div>
    <h1 class="tituloDirectorio"> <?php echo $directorioNombre  ?> </h1>
  
    
</body>
</html>
<?php
//Lo que muestra al buscar
$carpeta = "archivos/".$directorioNombre;
if(isset($_POST['botonBuscar']) && !empty($_POST['barraBusqueda'])) {

    $busqueda = $_POST['barraBusqueda'];
    if($archivario = opendir($carpeta)) {
        while (false !== ($file = readdir($archivario) )) {
            if ($file != "." && $file != ".." && $file == $busqueda) { 
                ?>
                <div class="card container-fluid" style="width: 18rem;">
                <img src="css/Imagenes/Nota.jpg" class="card-img-top" alt="Imagen_Nota">
                <div class="card-body">
               <h4><b><?php echo $file ?></b></h4>
               <a target='_blank' class="btn btn-outline-success" href="directorioVista.php?dir=<?php echo $file ?>">Ver</a>
               <a target='_blank' class="btn btn-outline-danger" href="borrarDirectorio.php?dir=<?php echo $file ?>">Borrar</a> </div> </div>
               <?php
            }
    }
    closedir($archivario);
    }
    //Navegaci??n por defecto
} else if(isset($_POST['botonRefrescar'])) {   
//Al refrescar
if($archivario = opendir($carpeta)) {
        while (false !== ($archivo = readdir($archivario) )) {
            if ($archivo != "." && $archivo != "..") {   
                ?>
                <div class="card container-fluid" style="width: 18rem;">
                <img src="css/Imagenes/Nota.jpg" class="card-img-top" alt="Imagen_Nota">
                <div class="card-body">
               <h4><b><?php echo $archivo ?></b></h4>
              <?php $rutaArchivo = "archivos/".$directorioNombre."/".$archivo ?>
               <a target='_blank' class="btn btn-outline-success" href="archivoVista.php?archivo=<?php echo $rutaArchivo ?>">Ver</a>
               <a target='_blank' class="btn btn-outline-danger" href="borrarArchivo.php?archivo=<?php echo $rutaArchivo ?>">Borrar</a> </div> </div>
               <?php 
            }
    }
    closedir($archivario);
    }
} else {//Reci??n entrando a la web
    if($archivario = opendir($carpeta)) {
        while (false !== ($archivo = readdir($archivario) )) {
            if ($archivo != "." && $archivo != "..") {   
                ?>
                <div class="card container-fluid" style="width: 18rem;">
                <img src="css/Imagenes/Nota.jpg" class="card-img-top" alt="Imagen_Nota">
                <div class="card-body">
               <h4><b><?php echo $archivo ?></b></h4>
              <?php $rutaArchivo = "archivos/".$directorioNombre."/".$archivo ?>
               <a target='_blank' class="btn btn-outline-success" href="archivoVista.php?archivo=<?php echo $rutaArchivo ?>">Ver</a>
               <a target='_blank' class="btn btn-outline-danger" href="borrarArchivo.php?archivo=<?php echo $rutaArchivo ?>">Borrar</a> </div> </div>
               <?php 
            }
    }
    closedir($archivario);
    }
}
if(isset($_POST['btn'])) {//Al crear un archivo nuevo
    if(isset($_POST['nombreArchivonuevo']) && !empty($_POST['nombreArchivonuevo'])) {

        $file = $_POST['nombreArchivonuevo'] . ".txt";
        $directorio = $_GET['dir'];

            if(file_exists('archivos/'.$directorio."/".$file)) {
                $mensaje = "Ese archivo ya existe";
                echo("<script>location.href = '/index.php?msg=$mensaje';</script>");
            } else {
                $fp = fopen('archivos/'.$directorio."/".$file, 'w+');
            if(!empty($_POST['textarea'])) {
                $contenidotextField = $_POST['textarea'] . "";
                fwrite($fp, $contenidotextField);
            }
            echo("<script>location.href = '/directorioVista.php?dir=$directorio';</script>");
            $message = "Se creo el archivo exitosamente";
            echo "<script>alert('$message');</script>"; 
            }
        
    }
} 
//Form para crear archivo
?>

<div class="formNotas container-fluid">
<h1 class="tituloNota">A??adir nueva Nota</h1> <br>
 <form action="" method="post">
 <label>Titulo del archivo:</label>  <br><br>
 <input class="form-control" id="tituloArchivo" type="text" name="nombreArchivonuevo" required placeholder="Ingrese el t??tulo"> <br> <br> 
 <label>Contenido del archivo:</label> <br> <br>
 <textarea  class="form-control" name="textarea" rows="10" cols="50" placeholder="Ingrese el contenido"> </textarea> <br> <br>
 <input type="submit" name="btn" value="Guardar" class="btn btn-outline-success"> <br> <br>
 </form>
</div>

