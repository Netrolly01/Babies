<?php
require_once("libreria/motor.php"); // Asegura que se incluye solo una vez

if (isset($_GET['codigo'])) {
    $id = $_GET['codigo'];

    if (eliminar_registro($id)) {
        echo "<script>alert('Registro eliminado correctamente.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: No se pudo eliminar el registro.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Error: Código no válido.'); window.history.back();</script>";
}
?>
