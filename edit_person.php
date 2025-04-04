<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = 'data/' . $file;
    if(file_exists($filepath)){
        $data = file_get_contents($filepath);
        $personaje = unserialize($data);
    } else {
        die("Archivo no encontrado.");
    }
} else {
    die("No se especificó archivo.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>✨ Editar Personaje Barbie ✨</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #ffebf0;
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    .container {
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      margin-top: 50px;
      text-align: center;
      box-shadow: 0 0 10px rgba(255, 105, 180, 0.7);
    }
    h2 {
      color: #ff1493;
      text-shadow: 2px 2px 5px hotpink;
    }
    .btn-primary {
      background: #ff69b4;
      border-color: #ff1493;
    }
    .btn-primary:hover {
      background: #ff1493;
    }
    .btn-secondary {
      background: #ffb6c1;
      border-color: #ff69b4;
    }
    .btn-secondary:hover {
      background: #ff69b4;
    }
    img {
      border-radius: 10px;
      border: 2px solid hotpink;
      margin-bottom: 10px;
      max-width: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>✨ Editar Personaje Barbie ✨</h2>
    <form action="update_personaje.php" method="post">
      <input type="hidden" name="original_file" value="<?php echo htmlspecialchars($file); ?>">

      <div class="form-group">
        <label for="identificacion">🆔 Identificación:</label>
        <input type="text" name="identificacion" id="identificacion" class="form-control" value="<?php echo htmlspecialchars($personaje['identificacion']); ?>" required readonly>
      </div>
      
      <div class="form-group">
        <label for="nombre">👩 Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($personaje['nombre']); ?>" required>
      </div>

      <div class="form-group">
        <label for="apellido">🌸 Apellido:</label>
        <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo htmlspecialchars($personaje['apellido']); ?>" required>
      </div>

      <div class="form-group">
        <label for="fecha_nacimiento">🎂 Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo htmlspecialchars($personaje['fecha_nacimiento']); ?>" required>
      </div>

      <div class="form-group">
        <label for="rol">💖 Profesión o Rol en el Mundo Barbie:</label>
        <input type="text" name="rol" id="rol" class="form-control" value="<?php echo htmlspecialchars($personaje['rol']); ?>" required>
      </div>

      <div class="form-group">
        <label>📸 Foto Actual:</label><br>
        <?php if(isset($personaje['foto'])): ?>
          <img src="<?php echo htmlspecialchars($personaje['foto']); ?>" alt="Foto del personaje"><br>
        <?php endif; ?>

        <label for="foto">🔗 Cambiar Foto (Ingrese URL):</label>
        <input type="url" name="foto" id="foto" class="form-control" placeholder="https://ejemplo.com/imagen.jpg">
      </div>

      <button type="submit" class="btn btn-primary">💾 Actualizar</button>
    </form>
    
    <a href="list_personajes.php" class="btn btn-secondary mt-3">🏡 Volver al listado</a>
  </div>
</body>
</html>
