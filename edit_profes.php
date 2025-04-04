<?php
if(isset($_GET['file'])){
    $file = $_GET['file'];
    $filepath = 'data/' . $file;
    if(file_exists($filepath)){
        $data = file_get_contents($filepath);
        $profesion = unserialize($data);
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
  <title>Editar Profesión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2 class="mt-5">Editar Profesión</h2>
    <form action="update_profesion.php" method="post">
      <input type="hidden" name="original_file" value="<?php echo htmlspecialchars($file); ?>">
      <div class="form-group">
        <label for="id_personaje">ID del Personaje:</label>
        <input type="text" name="id_personaje" id="id_personaje" class="form-control" value="<?php echo htmlspecialchars($profesion['id_personaje']); ?>" required readonly>
      </div>
      <div class="form-group">
        <label for="nombre_profesion">Nombre de la Profesión:</label>
        <input type="text" name="nombre_profesion" id="nombre_profesion" class="form-control" value="<?php echo htmlspecialchars($profesion['nombre_profesion']); ?>" required>
      </div>
      <div class="form-group">
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" class="form-control" value="<?php echo htmlspecialchars($profesion['categoria']); ?>" required>
      </div>
      <div class="form-group">
        <label for="nivel">Nivel de Experiencia:</label>
        <select name="nivel" id="nivel" class="form-control" required>
          <option value="Principiante" <?php if($profesion['nivel']=='Principiante') echo 'selected'; ?>>Principiante</option>
          <option value="Intermedio" <?php if($profesion['nivel']=='Intermedio') echo 'selected'; ?>>Intermedio</option>
          <option value="Avanzado" <?php if($profesion['nivel']=='Avanzado') echo 'selected'; ?>>Avanzado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="salario">Salario Mensual Estimado ($USD):</label>
        <input type="number" name="salario" id="salario" class="form-control" value="<?php echo htmlspecialchars($profesion['salario']); ?>" required step="0.01">
      </div>
      <button type="submit" class="btn btn-primary">Actualizar Profesión</button>
    </form>
    <a href="list_profesiones.php" class="btn btn-secondary mt-3">Volver al listado</a>
  </div>
</body>
</html>
