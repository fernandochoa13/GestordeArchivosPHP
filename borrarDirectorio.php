<?php

if(isset($_GET['dir'])) {//Método para borrar directorio

    $directorioBorrar = $_GET['dir'];

    $nombreDirectorio = "archivos/" . $directorioBorrar;
    
        $archivos = scandir($nombreDirectorio); //obtenemos todos los nombres de los ficheros
        foreach ($archivos as $archivo) {
            if ('.' !== $archivo && '..' !== $archivo) {
                $ficheros = "archivos\\" . $directorioBorrar . '\\' . $archivo;
                var_dump($archivo);

                if (is_file($ficheros)){

                    unlink($ficheros); //elimino el fichero
                }


            }
        }
    rmdir($nombreDirectorio);
         $message = "Se borro el fichero exitosamente";
        header('Location: index.php?msg='.$message);

        


    }

    






?>