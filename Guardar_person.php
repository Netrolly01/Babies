<?php
// Verifica o crea las carpetas necesarias
if (!is_dir('data')) {
    mkdir('data', 0777, true);
}

if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $identificacion    = trim($_POST['identificacion']);
    $nombre            = trim($_POST['nombre']);
    $apellido          = trim($_POST['apellido']);
    $fecha_nacimiento  = $_POST['fecha_nacimiento'];
    $rol               = trim($_POST['rol']);
    $fotoNuevoNombre   = null;
    
    // Validar URL de la foto
    if (isset($_POST['foto_url']) && !empty($_POST['foto_url'])) {
        $fotoUrl = trim($_POST['foto_url']);
        
        // Verificar si la URL es válida
        if (filter_var($fotoUrl, FILTER_VALIDATE_URL)) {
            $fotoExt = pathinfo(parse_url($fotoUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
            $fotoNuevoNombre = $identificacion . '_' . time() . '.' . $fotoExt;
            $destino = 'uploads/' . $fotoNuevoNombre;

            // Descargar la imagen con cURL en lugar de file_get_contents()
            $ch = curl_init($fotoUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $fotoData = curl_exec($ch);
            curl_close($ch);

            if ($fotoData === false || !file_put_contents($destino, $fotoData)) {
                die("⚠️ Error al descargar la imagen desde la URL.");
            }
        } else {
            die("⚠️ La URL proporcionada no es válida.");
        }
    } elseif (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Procesar foto subida
        $fotoTmp  = $_FILES['foto']['tmp_name'];
        $fotoName = basename($_FILES['foto']['name']);
        $fotoExt  = pathinfo($fotoName, PATHINFO_EXTENSION);
        $fotoNuevoNombre = $identificacion . '_' . time() . '.' . $fotoExt;
        $destino  = 'uploads/' . $fotoNuevoNombre;

        if (!move_uploaded_file($fotoTmp, $destino)) {
            die("⚠️ Error al subir la foto.");
        }
    } else {
        // Si no hay imagen subida ni URL, asignar una imagen por defecto
        $fotoNuevoNombre = "default.jpg";
    }

    // Crear array de datos del personaje
    $personaje = [
        'identificacion'   => $identificacion,
        'nombre'           => $nombre,
        'apellido'         => $apellido,
        'fecha_nacimiento' => $fecha_nacimiento,
        'foto'             => $fotoNuevoNombre,
        'rol'              => $rol
    ];

    // Serializar y guardar en un archivo .txt en lugar de .dart
    $data     = serialize($personaje);
    $filename = 'data/character_' . $identificacion . '.txt';
    
    if (file_put_contents($filename, $data)) {
        echo "🎉 Personaje registrado exitosamente. <a href='index.php'>Volver al inicio</a>";
    } else {
        echo "⚠️ Error al guardar los datos del personaje.";
    }
} else {
    echo "⚠️ Método no permitido.";
}
?>

