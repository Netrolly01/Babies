<?php
$profesiones = [];
if(is_dir('data')){
    foreach(scandir('data') as $file){
        if(strpos($file, 'profession_') === 0){
            $data = file_get_contents('data/' . $file);
            $profesion = unserialize($data);
            $profesion['filename'] = $file;
            $profesiones[] = $profesion;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>💖 Listado de Profesiones - Mundo Barbie 💼</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Listado de Profesiones</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
        <th>🆔 ID del Personaje</th>
          <th>👑 Profesión</th>
          <th>🌟 Categoría</th>
          <th>📊 Nivel</th>
          <th>💰 Salario ($USD)</th>
          <th>⚙️ Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($profesiones as $p): ?>
          <tr>
            <td><?php echo $p['id_personaje']; ?></td>
            <td><?php echo $p['nombre_profesion']; ?></td>
            <td><?php echo $p['categoria']; ?></td>
            <td><?php echo $p['nivel']; ?></td>
            <td><?php echo $p['salario']; ?></td>
            <td>
              <a href="edit_profes.php?file=<?php echo urlencode($p['filename']); ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="Borrar_profes.php?file=<?php echo urlencode($p['filename']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta profesión?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">🏡 Volver al Inicio</a>
  </div>
</body>
</html>


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
      color: black;
      border-radius: 10px;
      overflow: hidden;
    }
    .table th {
      background: hotpink;
      color: white;
      font-size: 1.2rem;
      text-transform: uppercase;
    }
    .btn-warning {
      background: #ffb6c1;
      border-color: #ff69b4;
      color: white;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-warning:hover {
      background: #ff69b4;
      transform: scale(1.1);
    }
    .btn-danger {
      background: #ff1493;
      border-color: #c71585;
      color: white;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-danger:hover {
      background: #c71585;
      transform: scale(1.1);
    }
    .btn-secondary {
      background: #ff69b4;
      border-color: #ff1493;
      font-size: 1.2rem;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-secondary:hover {
      background: #ff1493;
      transform: scale(1.1);
    }
  </style>