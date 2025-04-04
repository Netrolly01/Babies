<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🎀 Mundo Barbie - Gestión 💖</title>
  <!-- Bootstrap para estilos -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('https://www.pixelstalk.net/wp-content/uploads/images6/Barbie-Desktop-Wallpaper.jpg'); 
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: white;
    }
    .container {
      background: rgba(255, 182, 193, 0.85); /* Fondo rosado translúcido */
      padding: 20px;
      border-radius: 15px;
      margin-top: 50px;
      text-align: center;
      box-shadow: 0 0 10px rgba(255, 105, 180, 0.7);
    }
    h1 {
      font-size: 2.5rem;
      font-weight: bold;
      text-shadow: 2px 2px 5px hotpink;
    }
    .eslogan {
      font-size: 1.4rem;
      color: hotpink;
      font-weight: bold;
      margin-top: 10px;
      text-shadow: 1px 1px 3px white;
    }
    .nav-pills .nav-link {
      color: white;
      background-color: hotpink;
      margin: 5px;
      border-radius: 10px;
      font-size: 1.1rem;
      font-weight: bold;
      transition: 0.3s;
    }
    .nav-pills .nav-link:hover {
      background-color: deeppink;
      transform: scale(1.1);
    }
    .footer {
      margin-top: 50px;
      font-size: 1rem;
      color: white;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🎀 Sistema de Gestión del Mundo Barbie 💖</h1>
    <div class="eslogan">¡Tú puedes ser lo que quieras! 💖</div> 
    <nav class="mt-4">
      <ul class="nav nav-pills flex-column flex-sm-row">
        <li class="nav-item"><a class="nav-link" href="register_person.php">👗 Registrar Personaje</a></li>
        <li class="nav-item"><a class="nav-link" href="register_profes.php">💼 Registrar Profesión</a></li>
        <li class="nav-item"><a class="nav-link" href="list_person.php">👩‍🎤 Listar Personajes</a></li>
        <li class="nav-item"><a class="nav-link" href="list_profes.php">🌟 Listar Profesiones</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard.php">📊 Dashboard</a></li>
      </ul>
    </nav>
  </div>
</body>
</html>
