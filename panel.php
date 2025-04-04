<?php

require('libreria/motor.php');
plantilla::aplicar();

if (!function_exists('lista_Dregistro')) {
    function lista_Dregistro() {
        $registros = [];
        $archivos = scandir("datos");
        foreach ($archivos as $archivo) {
            if (!is_file("datos/{$archivo}")) {
                continue;
            }
            $datos = cargar_datos(str_replace(".dat", "", $archivo));
            $registros[] = $datos;
        }
        return $registros;
    }
}


$datos = lista_Dregistro();

$totalHabilidades = 0;
$totalEdad = 0;
$totalParticipantes = count($datos);
$totalPoder = 0;
$totalHabilidadesConPers = 0;
$habilidadMasPoderosa = "Desconocida";
$habilidadMenosPoderosa = "Desconocida";
$nivelMax = PHP_INT_MIN;
$nivelMin = PHP_INT_MAX;
$profesionesRegistradas = [];
$totalSalarios = 0;
$salariosConValor = 0;
$profesionMasAlta = (object)["nombre" => "No disponible", "salario_mensual" => 0];
$profesionMasBaja = (object)["nombre" => "No disponible", "salario_mensual" => PHP_INT_MAX];
$personaConProfesionMasAlta = null;
$habilidadProfesionMasAlta = "Desconocida";
$salarioProfesionMasAlta = 0;

foreach ($datos as $personaje) {
    $totalEdad += (int)$personaje->edad();
    if (!empty($personaje->habilidades)) {
        $totalHabilidades += count($personaje->habilidades);
        foreach ($personaje->habilidades as $habilidad) {
            if (isset($habilidad->nivel)) {
                $nivel = (int)$habilidad->nivel;
                $totalPoder += $nivel;
                $totalHabilidadesConPers++;
                if ($nivel > $nivelMax) {
                    $nivelMax = $nivel;
                    $habilidadMasPoderosa = $habilidad->nombre;
                }
                if ($nivel < $nivelMin) {
                    $nivelMin = $nivel;
                    $habilidadMenosPoderosa = $habilidad->nombre;
                }
            }
        }
    }

    if (isset($personaje->profesion)) {
        $profesion = $personaje->profesion->nombre;
        $profesionesRegistradas[$profesion] = true;
        if (isset($personaje->profesion->salario_mensual)) {
            $salario = (float)$personaje->profesion->salario_mensual;
            $totalSalarios += $salario;
            $salariosConValor++;
            if ($salario > $salarioProfesionMasAlta) {
                $profesionMasAlta = $personaje->profesion;
                $personaConProfesionMasAlta = $personaje;
                $salarioProfesionMasAlta = $salario;
                $habilidadProfesionMasAlta = !empty($personaje->habilidades) ? $personaje->habilidades[0]->nombre : "Sin habilidad";
            }
            if ($salario < $profesionMasBaja->salario_mensual) {
                $profesionMasBaja = $personaje->profesion;
            }
        }
    }
}

$habilidadesPorPersonaje = $totalParticipantes > 0 ? round($totalHabilidades / $totalParticipantes, 2) : 0;
$edadPromedio = $totalParticipantes > 0 ? round($totalEdad / $totalParticipantes, 2) : 0;
$poderPromedio = $totalHabilidadesConPers > 0 ? round($totalPoder / $totalHabilidadesConPers, 2) : 0;
$salarioPromedio = $salariosConValor > 0 ? round($totalSalarios / $salariosConValor, 2) : 0;
?>

<h1>Estadísticas de Profesiones</h1>
<table>
    <tr>
        <td><h1><?= $totalParticipantes ?></h1>Personajes</td>
        <td><h1><?= $totalHabilidades ?></h1>Profesiones</td>
        <td><h1><?= $habilidadesPorPersonaje ?></h1>P x Personaje</td>
        <td><h1><?= $edadPromedio ?></h1>Edad Promedio</td>
        <td><h1><?= $poderPromedio ?></h1>Poder Promedio</td>
        <td><h1><?= $habilidadMasPoderosa ?></h1>Experiencia más común</td>
        <td><h1><?= $habilidadMenosPoderosa ?></h1>Experiencia menos común</td>
        <td><h1><?= $salarioPromedio ?></h1>Salario Promedio</td>
        <td><h1><?= $profesionMasAlta->nombre ?></h1>Profesión Más Alta</td>
        <td><h1><?= $habilidadProfesionMasAlta ?></h1>Habilidad Asociada</td>
        <td><h1><?= $salarioProfesionMasAlta ?></h1>Salario Más Alto</td>
        <td><h1><?= $profesionMasBaja->nombre ?></h1>Profesión Más Baja</td>
    </tr>
</table>
