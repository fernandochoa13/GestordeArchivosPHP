<?php

if(isset($_GET['dir'])) {//Método para borrar directorio

    $directorioBorrar = $_GET['dir'];

    $nombreDirectorio = "archivos/" . $directorioBorrar;
    
        $archivos = scandir($nombreDirectorio); //obtenemos todos los nombres de los ficheros
        foreach ($archivos as $archivo) {
            if ('.' !== $archivo && '..' !== $archivo) {
                $ficheros = "archivos/" . $directorioBorrar . '/' . $archivo;

                if (is_file($ficheros)){

                    unlink($ficheros); //elimino el fichero
                }


            }
        }
    rmdir($nombreDirectorio);
         $message = "Se borró el fichero exitosamente";
        echo("<script>location.href = '/index.php?msg=$message';</script>");

        


    }

    






?>
