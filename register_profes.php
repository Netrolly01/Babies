<?php
// Cargar personajes desde los archivos guardados en 'data'
$personajes = [];
$dataDir = 'data/';

if (is_dir($dataDir)) {
    $files = scandir($dataDir);
    foreach ($files as $file) {
        if (strpos($file, 'character_') === 0 && strpos($file, '.txt') !== false) {
            $data = file_get_contents($dataDir . $file);
            $personaje = unserialize($data);
            if ($personaje) {
                $personajes[] = $personaje;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🎀 Registrar Profesión - Mundo Barbie 💖</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('https://th-thumbnailer.cdn-si-edu.com/cjFZNXiiTKKxWwe9FPXIp-mbwTQ=/fit-in/1600x0/filters:focal(687x480:688x481)/https://tf-cmsv2-smithsonianmag-media.s3.amazonaws.com/filer_public/be/11/be11d496-6bda-4232-a35a-2a29f078fbc9/barbie.jpg'); 
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: white;
    }
    .container {
      background: rgba(255, 182, 193, 0.9);
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
    .form-group label {
      font-weight: bold;
      color: hotpink;
      font-size: 1.2rem;
    }
    .form-control {
      border: 2px solid hotpink;
      border-radius: 10px;
    }
    .btn-primary {
      background: #ff69b4;
      border-color: #ff1493;
      font-size: 1.2rem;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background: #ff1493;
      transform: scale(1.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>👑 Registrar Profesión para un Personaje Barbie 💼</h2>
    <form action="Guardar_profes.php" method="post">
      <div class="form-group">
        <label for="id_personaje">💖 Seleccione el Personaje:</label>
        <select name="id_personaje" id="id_personaje" class="form-control" required>
          <option value="">-- Seleccione --</option>
          <?php if (!empty($personajes)): ?>
            <?php foreach($personajes as $p): ?>
              <option value="<?php echo htmlspecialchars($p['identificacion']); ?>">
                <?php echo htmlspecialchars($p['nombre']) . " " . htmlspecialchars($p['apellido']) . " (ID: " . htmlspecialchars($p['identificacion']) . ")"; ?>
              </option>
            <?php endforeach; ?>
          <?php else: ?>
            <option disabled>No hay personajes disponibles</option>
          <?php endif; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="nombre_profesion">✨ Nombre de la Profesión:</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="categoria">🌈 Categoría:</label>
        <input type="text" name="categoria" id="categoria" class="form-control" required placeholder="Ej: Ciencia, Arte, Deporte, etc.">
      </div>
      <div class="form-group">
        <label for="nivel">📊 Nivel de Experiencia:</label>
        <select name="nivel" id="nivel" class="form-control" required>
          <option value="">-- Seleccione --</option>
          <option value="Principiante">🌟 Principiante</option>
          <option value="Intermedio">💎 Intermedio</option>
          <option value="Avanzado">👑 Avanzado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="salario">💰 Salario Mensual Estimado ($USD):</label>
        <input type="number" name="salario" id="salario" class="form-control" required step="0.01">
      </div>
      <button type="submit" class="btn btn-primary">💼 Registrar Profesión</button>
    </form>
  </div>
</body>
</html>
