<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $original_file = $_POST['original_file'];
    $filepath = 'data/' . $original_file;

    if(!file_exists($filepath)){
        die("⚠️ Archivo no encontrado.");
    }
    
    $personaje = unserialize(file_get_contents($filepath));

    // Actualizar datos
    $personaje['nombre'] = trim(htmlspecialchars($_POST['nombre']));
    $personaje['apellido'] = trim(htmlspecialchars($_POST['apellido']));
    $personaje['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
    $personaje['rol'] = trim(htmlspecialchars($_POST['rol']));

    // Procesar nueva foto como URL
    if(!empty($_POST['foto'])){
        $fotoURL = trim($_POST['foto']);
        if(filter_var($fotoURL, FILTER_VALIDATE_URL)){
            $personaje['foto'] = $fotoURL;
        } else {
            die("⚠️ La URL de la foto no es válida.");
        }
    }

    // Guardar datos actualizados
    $data = serialize($personaje);
    if(file_put_contents($filepath, $data)){
        echo "✅ Personaje actualizado exitosamente. <br>";
        echo "<a href='list_personajes.php'>⬅️ Volver al listado</a>";
    } else {
        echo "❌ Error al actualizar el personaje.";
    }
} else {
    echo "❌ Método no permitido.";
}
?>
