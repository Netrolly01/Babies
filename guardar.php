<?php
require("libreria/motor.php");

// Crear una nueva instancia de personaje
$personaje = new Personajes ();
$personaje->id = $_POST["id"];
$personaje->nombre = $_POST["nombre"];
$personaje->apellido = $_POST["apellido"];
$personaje->fecha_nacimiento = $_POST["fecha_nacimiento"];
$personaje->foto = $_POST["foto"];

// Recorrer las habilidades enviadas por el formulario y agregarlas al personaje
foreach ($_POST["habilidades"]["nombre"] as $i => $nombre) {
    $habilidad = new Habilidades();
    $habilidad->nombre = $nombre;
    $habilidad->tipo = $_POST["habilidades"]["tipo"][$i];
    $habilidad->nivel = $_POST["habilidades"]["nivel"][$i];
    $habilidad->salario_mensual = $_POST["habilidades"]["salario_mensual"][$i];

    $personaje->habilidades[] = $habilidad;
}

// Guardar los datos del personaje
guardar_datos($personaje->id, $personaje);


// Aplicar la plantilla
plantilla::aplicar();
?>

<h1> 📀Datos guardados </h1>

<div class="d-derecha">
    <a href="index.php" class="boton">Volver</a>
</div>


