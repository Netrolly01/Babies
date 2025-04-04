<?php
$personajes = [];
if (is_dir('data')) {
    foreach (scandir('data') as $file) {
        if (strpos($file, 'character_') === 0) {
            $data = file_get_contents('data/' . $file);
            $personaje = unserialize($data);
            $personaje['filename'] = $file; // Para identificar en edición/eliminación
            $personajes[] = $personaje;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🎀 Listado de Personajes Barbie 💖</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('https://static1.ara.cat/clip/3ecc8db6-d2b6-47ca-87b2-97c418949912_16-9-aspect-ratio_default_0.jpg'); 
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: white;
    }
    .container {
      background: rgba(255, 182, 193, 0.9); /* Fondo rosado translúcido */
      padding: 20px;
      border-radius: 15px;
      margin-top: 50px;
      text-align: center;
      box-shadow: 0 0 10px rgba(255, 105, 180, 0.7);
    }
    h2 {
      font-size: 2rem;
      font-weight: bold;
      text-shadow: 2px 2px 5px hotpink;
    }
    .table {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 0px 10px rgba(255, 20, 147, 0.5);
    }
    .table th {
      background: hotpink;
      color: white;
      font-size: 1.1rem;
    }
    .table td {
      color: black;
      font-size: 1rem;
    }
    .btn-warning {
      background: #ff69b4;
      border-color: #ff1493;
      color: white;
    }
    .btn-warning:hover {
      background: #ff1493;
    }
    .btn-danger {
      background: #d63384;
      border-color: #c2185b;
    }
    .btn-danger:hover {
      background: #c2185b;
    }
    .btn-secondary {
      background: #ffb6c1;
      border-color: #ff69b4;
      color: white;
    }
    .btn-secondary:hover {
      background: #ff69b4;
    }
    img {
      border-radius: 50%;
      border: 2px solid hotpink;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>🎀 Listado de Personajes del Mundo Barbie 💖</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>🆔 Identificación</th>
          <th>👩 Nombre</th>
          <th>🌸 Apellido</th>
          <th>🎂 Fecha de Nacimiento</th>
          <th>🌟 Rol</th>
          <th>📸 Foto</th>
          <th>⚙️ Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($personajes as $p): ?>
          <tr>
            <td><?php echo $p['identificacion']; ?></td>
            <td><?php echo $p['nombre']; ?></td>
            <td><?php echo $p['apellido']; ?></td>
            <td><?php echo $p['fecha_nacimiento']; ?></td>
            <td><?php echo $p['rol']; ?></td>
            <td>
              <?php 
                // Verificar si la foto es una URL o un archivo
                if (filter_var($p['foto'], FILTER_VALIDATE_URL)) {
                    // Es una URL válida, mostrar la foto directamente
                    echo "<img src='" . $p['foto'] . "' alt='Foto' width='50'>";
                } elseif (isset($p['foto'])) {
                    // Es un archivo, mostrarlo desde la carpeta de uploads
                    echo "<img src='uploads/" . $p['foto'] . "' alt='Foto' width='50'>";
                } else {
                    // Si no hay foto
                    echo "Sin Foto ✖️";
                }
              ?>
            </td>
            <td>
              <a href="edit_person.php?file=<?php echo urlencode($p['filename']); ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
              <a href="Borrar_person.php?file=<?php echo urlencode($p['filename']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este personaje?')">🗑️ Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">🏡 Volver al inicio</a>
  </div>
</body>
</html>
