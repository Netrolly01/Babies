<?php
// Inicializar arrays
$personajes   = [];
$profesiones  = [];

// Leer archivos de la carpeta data
if(is_dir('data')){
    $files = scandir('data');
    foreach($files as $file){
        if(strpos($file, 'character_') === 0){
            $data = file_get_contents('data/' . $file);
            $p = unserialize($data);
            $personajes[] = $p;
        } elseif(strpos($file, 'profession_') === 0){
            $data = file_get_contents('data/' . $file);
            $prof = unserialize($data);
            $profesiones[] = $prof;
        }
    }
}

// Total de personajes y profesiones
$totalPersonajes = count($personajes);
$totalProfesiones= count($profesiones);

// Promedio de profesiones por personaje
$promedioProfesionesPorPersonaje = $totalPersonajes > 0 ? $totalProfesiones / $totalPersonajes : 0;

// Edad promedio de personajes
$sumaEdades = 0;
foreach($personajes as $p){
    $fechaNacimiento = $p['fecha_nacimiento'];
    $edad = floor((time() - strtotime($fechaNacimiento)) / (365.25*24*60*60));
    $sumaEdades += $edad;
}
$edadPromedio = $totalPersonajes > 0 ? $sumaEdades / $totalPersonajes : 0;

// Distribución de profesiones por categoría
$categorias = [];
foreach($profesiones as $prof){
    $cat = $prof['categoria'];
    if(!isset($categorias[$cat])){
        $categorias[$cat] = 0;
    }
    $categorias[$cat]++;
}

// Nivel de experiencia más común
$niveles = [];
foreach($profesiones as $prof){
    $nivel = $prof['nivel'];
    if(!isset($niveles[$nivel])){
        $niveles[$nivel] = 0;
    }
    $niveles[$nivel]++;
}
$nivelMasComun = '';
if(!empty($niveles)){
    arsort($niveles);
    $nivelMasComun = key($niveles);
}

// Profesión con mayor y menor salario
$mayorSalario   = null;
$menorSalario   = null;
$profesionMayor = null;
$profesionMenor = null;
$sumaSalarios   = 0;
foreach($profesiones as $prof){
    $salario = $prof['salario'];
    $sumaSalarios += $salario;
    if($mayorSalario === null || $salario > $mayorSalario){
        $mayorSalario = $salario;
        $profesionMayor = $prof;
    }
    if($menorSalario === null || $salario < $menorSalario){
        $menorSalario = $salario;
        $profesionMenor = $prof;
    }
}
$salarioPromedio = $totalProfesiones > 0 ? $sumaSalarios / $totalProfesiones : 0;

// Personaje con el salario total más alto (sumando los salarios de todas sus profesiones)
$salariosPersonajes = [];
foreach($profesiones as $prof){
    $id = $prof['id_personaje'];
    if(!isset($salariosPersonajes[$id])){
        $salariosPersonajes[$id] = 0;
    }
    $salariosPersonajes[$id] += $prof['salario'];
}
$maxSalarioPersonaje = null;
$idMaxSalario = null;
foreach($salariosPersonajes as $id => $totalSalario){
    if($maxSalarioPersonaje === null || $totalSalario > $maxSalarioPersonaje){
        $maxSalarioPersonaje = $totalSalario;
        $idMaxSalario = $id;
    }
}
// Obtener el nombre del personaje con mayor salario
$nombreMaxSalario = '';
if($idMaxSalario !== null){
    foreach($personajes as $p){
        if($p['identificacion'] == $idMaxSalario){
            $nombreMaxSalario = $p['nombre'] . ' ' . $p['apellido'];
            break;
        }
    }
}

// Preparar datos para Chart.js: Suma de salarios por categoría
$salariosPorCategoria = [];
foreach($profesiones as $prof){
    $cat = $prof['categoria'];
    if(!isset($salariosPorCategoria[$cat])){
        $salariosPorCategoria[$cat] = 0;
    }
    $salariosPorCategoria[$cat] += $prof['salario'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Estadísticas Mundo Barbie 🌸</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <h2 class="mt-5 text-center">Dashboard - Estadísticas del Mundo Barbie 💖✨</h2>
    <ul class="list-group mt-4">
      <li class="list-group-item">Total de Personajes Registrados: <span>👤 <?php echo $totalPersonajes; ?></span></li>
      <li class="list-group-item">Total de Profesiones Registradas: <span>💼 <?php echo $totalProfesiones; ?></span></li>
      <li class="list-group-item">Promedio de Profesiones por Personaje: <span>📊 <?php echo number_format($promedioProfesionesPorPersonaje, 2); ?></span></li>
      <li class="list-group-item">Edad Promedio de los Personajes: <span>🎂 <?php echo number_format($edadPromedio, 2); ?> años</span></li>
      <li class="list-group-item">Nivel de Experiencia más Común: <span>🏆 <?php echo $nivelMasComun; ?></span></li>
      <li class="list-group-item">Profesión con Mayor Salario: <span>💸 <?php echo $profesionMayor ? $profesionMayor['nombre_profesion'] . " ($" . $mayorSalario . ")" : "N/A"; ?></span></li>
      <li class="list-group-item">Profesión con Menor Salario: <span>💰 <?php echo $profesionMenor ? $profesionMenor['nombre_profesion'] . " ($" . $menorSalario . ")" : "N/A"; ?></span></li>
      <li class="list-group-item">Salario Promedio en el Mundo Barbie: <span>💖 $<?php echo number_format($salarioPromedio, 2); ?></span></li>
      <li class="list-group-item">Personaje con el Salario Total más Alto: <span>💎 <?php echo $nombreMaxSalario ? $nombreMaxSalario . " ($" . $maxSalarioPersonaje . ")" : "N/A"; ?></span></li>
    </ul>
    
    <h3 class="mt-5 text-center">Distribución de Salarios por Categoría 🎨</h3>
    <canvas id="salaryChart" width="400" height="200"></canvas>
    
    <script>
      const ctx = document.getElementById('salaryChart').getContext('2d');
      const salaryChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: <?php echo json_encode(array_keys($salariosPorCategoria)); ?>,
              datasets: [{
                  data: <?php echo json_encode(array_values($salariosPorCategoria)); ?>,
                  backgroundColor: [
                      '#ff80ab', '#f48fb1', '#f06292', '#ec407a', '#e91e63', '#d81b60'
                  ]
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                      labels: { font: { size: 16, weight: 'bold' }, color: '#d81b60' }
                  },
                  title: {
                      display: true,
                      text: 'Salarios por Categoría 💼',
                      font: { size: 20 },
                      color: '#e91e63'
                  }
              }
          }
      });
    </script>
    <a href="index.php" class="btn btn-secondary mt-3">Volver al inicio 🌸</a>
  </div>
</body>
</html>

<style>
    body {
      background-image: url('https://wallpapercave.com/wp/wp2775551.jpg'); 
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: white;
    }
    .container {
      max-width: 900px;
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
      margin-top: 30px;
    }
    h2, h3{
      text-align: center;
      color: #ff69b4;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      text-shadow: 2px 2px #ffb6c1;
    }
    .list-group-item {
      background-color: #fce4ec;
      color: #c2185b;
      border: 1px solid #f8bbd0;
      font-size: 16px;
    }
    .btn-barbie {
      background-color: #ff4081;
      color: white;
      font-weight: bold;
      border-radius: 50px;
      text-align: center;
    }
    .btn-barbie:hover {
      background-color: #f50057;
      color: white;
    }
    canvas {
      background-color: white;
      border-radius: 10px;
      padding: 10px;
    }
    .list-group-item span {
      font-weight: bold;
      color: #e91e63;
    }
  </style>
