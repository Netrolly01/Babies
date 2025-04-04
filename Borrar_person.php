<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = 'data/' . $file;

    if(file_exists($filepath)){
        // Leer datos del personaje
        $personaje = unserialize(file_get_contents($filepath));

        // Si la foto es una URL válida, no intentamos eliminarla como archivo
        if(isset($personaje['foto']) && filter_var($personaje['foto'], FILTER_VALIDATE_URL)){
            // Solo eliminamos la referencia, no hay archivo local que borrar
            $personaje['foto'] = null;
        }

        // Eliminar archivo del personaje
        unlink($filepath);

        // Eliminar profesiones asociadas a este personaje
        foreach(scandir('data') as $f){
            if(strpos($f, 'profession_' . $personaje['identificacion'] . '_') === 0){
                unlink('data/' . $f);
            }
        }

        echo "🎀 Personaje y profesiones asociadas eliminados exitosamente. <br>";
        echo "<a href='list_personajes.php'>⬅️ Volver al listado</a>";
    } else {
        echo "⚠️ Archivo no encontrado.";
    }
} else {
    echo "⚠️ No se especificó archivo.";
}
?>
