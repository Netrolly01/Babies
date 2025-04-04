<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🎀 Registrar Personaje Barbie 💖</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('https://www.giffywalls.in/cdn/shop/collections/117_13_B641.jpg?v=1737716866');
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
  <script>
    function validarFormulario() {
      let fotoInput = document.getElementById('foto');
      let fotoURL = fotoInput.value.trim();
      let urlPattern = /^(https?:\/\/.*\.(?:png|jpg|jpeg|gif|webp|svg))$/i;

      if (fotoURL === "") {
        // Asignar imagen por defecto si está vacío
        fotoInput.value = "https://via.placeholder.com/100";
      } else if (!urlPattern.test(fotoURL)) {
        alert("⚠️ Por favor, introduce una URL válida para la imagen.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <div class="container">
    <h2>🎀 Registrar Personaje en el Mundo Barbie 💖</h2>
    <form action="Guardar_person.php" method="post" onsubmit="return validarFormulario()">
      <div class="form-group">
        <label for="identificacion">🆔 Identificación:</label>
        <input type="text" name="identificacion" id="identificacion" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="nombre">👩 Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="apellido">🌸 Apellido:</label>
        <input type="text" name="apellido" id="apellido" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="fecha_nacimiento">🎂 Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="foto">📸 URL de la Foto del Personaje:</label>
        <input type="url" name="foto" id="foto_url" class="form-control" placeholder="https://example.com/imagen.jpg">
      </div>
      <div class="form-group">
        <label for="rol">🌟 Profesión o Rol en el Mundo Barbie:</label>
        <input type="text" name="rol" id="rol" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">💖 Registrar</button>
    </form>
  </div>
</body>
</html>
