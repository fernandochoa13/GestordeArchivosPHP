<?php

if(isset($_GET['archivo'])) {//Método para borrar archivo
    $archivo_a_borrar = $_GET['archivo'];
    unlink($archivo_a_borrar);
    $message = "Se borro el archivo exitosamente";
    header("Location:index.php?msg=".$message);
}




?>