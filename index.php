<?php $msg = "";//Mensaje volviendo de otra página ?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas | Fernando Ochoa</title>
    <link rel="stylesheet" href="css/style.css">
    <head>
</head>
</head>
<body>
  <div class="row">
        <nav class="Banner col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
           <h3>Bloc de Notas</h3>
        </nav>
    </div>

    <div class="buscadorNotas  container-fluid"> <!--Buscador de Directorios-->
           <form class="d-flex" role="search" method="post">
           <input type="text" name="barraBusqueda" placeholder="Buscar directorio" class="form-control" type="search"> 
           <input type="submit" name="botonBuscar" class="btn btn-outline-success"> <br> 
           <input type="submit" name="botonRefrescar" class="btn btn-outline-success" value="Refrescar"><br> 
           </form>
    </div>

    <div class="formNotas container-fluid"><!--Añadir nota nueva-->
          <h1 class="tituloNota">Añadir nueva Nota</h1> <br>
           <form action="" method="post">
           <label>Título del archivo:</label>  <br><br>
           <input class="form-control" id="tituloArchivo" type="text" name="nombreArchivonuevo" required placeholder="Ingrese el título"> <br> <br> 
           <label>Contenido del archivo:</label> <br> <br>
           <textarea  class="form-control" name="textarea" rows="10" cols="50" placeholder="Ingrese el contenido"> </textarea> <br> <br>
           <label>Seleccionar el directorio:</label> <br> <br>
           <input type="text" class="form-control" name="directorioArchivonuevo" required placeholder="Ingrese el nombre del directorio" id="nombreDirectorio"> <br> <br> <br>
           <input type="submit" name="btn" value="Enviar" class="btn btn-outline-success"> <br> <br>
           </form>
    </div>

    <h1 class="tituloDirectorio"> Lista de Directorios:  </h1> 

</body>
</html>

<?php

//Crear archivo en un directorio
if(isset($_POST['btn'])) {
    if(isset($_POST['nombreArchivonuevo']) && !empty($_POST['nombreArchivonuevo'] && !empty($_POST['directorioArchivonuevo'])) ) {

        $file = $_POST['nombreArchivonuevo'] . ".txt";
        $directorio = $_POST['directorioArchivonuevo'];
        if(is_dir('archivos/'.$directorio)) { //Si el directorio ya existe

            if(file_exists('archivos/'.$directorio."/".$file)) { //Si ya existe
                $mensaje = "Ese archivo ya existe";
                header("Location:index.php?msg=".$mensaje);
            } else {
                $fp = fopen('archivos/'.$directorio."/".$file, 'w+');
            if(!empty($_POST['textarea'])) { //Si no está vacío el text area
                $contenidotextField = $_POST['textarea'] . "";
                fwrite($fp, $contenidotextField);
            }
            $mensaje = "Se creó el archivo";
            fclose($fp);
            header("Location:index.php?msg=".$mensaje);
    
            }
        } else {//Si el directorio no existe
            mkdir("archivos/".$directorio, 0700); //Método para crear el directorio en caso de no existir
            $fp = fopen('archivos/'.$directorio."/".$file, 'w');
            if(!empty($_POST['textarea'])) {
                $contenidotextField = $_POST['textarea'];
                fwrite($fp, $contenidotextField);
            }
            $mensaje = "Se creó el archivo";
            fclose($fp);
            header("Location:index.php?msg=".$mensaje);
        }
       
        

        
        
    }
    
 
} 


//Buscador de directorios
$carpeta = "archivos/";//Donde buscar
if(isset($_POST['botonBuscar']) && !empty($_POST['barraBusqueda'])) {
    $msg = "";
    $busqueda = $_POST['barraBusqueda'];
    if($archivario = opendir($carpeta)) {
        while (false !== ($file = readdir($archivario) )) {
            if ($file != "." && $file != ".." && $file == $busqueda) { 
                ?>
                <div class="card container-fluid"" style="width: 18rem;">
                <img src="css/Imagenes/Carpeta.jpg" class="card-img-top" alt="Imagen_Carpeta">
                <div class="card-body">
               <h4><b><?php echo $file ?></b></h4>
               <a target='_blank'  class="btn btn-outline-success" href="directorioVista.php?dir=<?php echo $file ?>">Ver</a>
               <a target='_blank' class="btn btn-outline-danger" href="borrarDirectorio.php?dir=<?php echo $file ?>">Borrar</a> </div> </div>
            <?php
            }
    }
    closedir($archivario);
    }  

} else { 

//Navegador de directorios
$msg = ""; ?> <?php
    if($archivario = opendir($carpeta)) {
        while (false !== ($file = readdir($archivario) )) {
            if ($file != "." && $file != "..") { 
                ?>
                <div class="card container-fluid"" style="width: 18rem;">
                <img src="css/Imagenes/Carpeta.jpg" class="card-img-top" alt="Imagen_Carpeta">
                <div class="card-body">
               <h4><b><?php echo $file ?></b></h4>
               <a target='_blank' class="btn btn-outline-success" href="directorioVista.php?dir=<?php echo $file ?>">Ver</a>
               <a target='_blank' class="btn btn-outline-danger" href="borrarDirectorio.php?dir=<?php echo $file ?>">Borrar</a> </div> </div>
               <?php
            }
    }
    closedir($archivario);
    }   
}


 //Mensaje despues de una acción
 

 if(isset($_GET['msg'])) { 
    $message = $_GET['msg'];
   echo "<script>alert('$message');</script>"; 
    }





?> 