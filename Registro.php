<?php
// Incluye el archivo motor.php que contiene funciones y clases necesarias
require("libreria/motor.php");

// Aplica la plantilla definida en la clase Plantilla
Plantilla::aplicar();

// Crea una nueva instancia de la clase Personaje
$personaje = new Personajes ();

// Verifica si se ha pasado un código por la URL
if (isset($_GET["codigo"])) {
    // Carga los datos del personaje con el código proporcionado
    $personaje = cargar_datos($_GET["codigo"]);

    // Si no se encuentra el personaje, muestra un mensaje de error y termina la ejecución
    if (!$personaje) {
        echo "<h1> ⚠️Lo sentimos</h1>";
        echo "<p>El participante no existe</p>";
        exit;
    }
}
?>

<!-- Título y mensaje de instrucciones con temática Barbie -->
<h1>Crea el perfil de Barbie 🌟</h1>
<p>¡Bienvenida al registro de Barbie! 💖 Ingresa los datos necesarios👑</p>

<!-- Enlace para volver al inicio -->
<div class="d-derecha">
    <a href="index.php" class="boton">Inicio 🏡</a>
</div>

<!-- Formulario para guardar los datos del personaje -->
<form method="post" action="Guardar.php">
<?php
    // Genera los campos de entrada para los datos del personaje con temática Barbie
    echo the_input("id", "🌸 ID", $personaje->id, ["required" => "required", "style" => "border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;"]);
    echo the_input("nombre", "💖 Nombre Completo", $personaje->nombre, ["required" => "required", "style" => "border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;"]);
    echo the_input("apellido", "💅 Apellido", $personaje->apellido, ["required" => "required", "style" => "border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;"]);
    echo the_input("fecha_nacimiento", "🎂 Fecha de Nacimiento", $personaje->fecha_nacimiento, ["type" => "date", "style" => "border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;"]);
    echo the_input("foto", "📸 Foto de Perfil", $personaje->foto, ["type" => "url", "style" => "border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;"]);
?>
    <hr>
    <h3>💎 Habilidades Únicas 💖</h3>

<!-- Tabla para las habilidades del personaje -->
<table>
    <thead>
        <tr>
            <th>💫 Nombre</th>
            <th>🌟 Tipo</th>
            <th>⭐ Nivel</th>
            <th>💰 Salario</th>
            <td><button type="button" onclick="AgregarHabilidad()">➕ Agregar Habilidad</button></td>
        </tr>
    </thead>
    <tbody id="tdhabilidades">
        <?php
        // Genera las filas de la tabla con las habilidades del personaje
        foreach ($personaje->habilidades as $habilidad) {
            echo "<tr>";
            echo "<td><input type='text' name='habilidades[nombre][]' value='{$habilidad->nombre}' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>";
            echo "<td><input type='text' name='habilidades[tipo][]' value='{$habilidad->tipo}' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>";
            echo "<td><input type='text' name='habilidades[nivel][]' value='{$habilidad->nivel}' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>";
            echo "<td><input type='number' name='habilidades[salario_mensual][]' value='{$habilidad->salario_mensual}' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>";
            echo "<td><button type='button' onclick='QuitarFila(this)'>❌ Eliminar</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Botón para enviar el formulario -->
<div style="margin: 20px;">
    <input type="submit" class="boton" value="Guardar ✨" style="background-color: #FF66B2; color: white;">
</div>
</form>

<script>
function AgregarHabilidad() {
    var table = document.getElementById("tdhabilidades");
    var row = table.insertRow();
    row.innerHTML = `
        <td><input type='text' name='habilidades[nombre][]' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>
        <td><input type='text' name='habilidades[tipo][]' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>
        <td><input type='text' name='habilidades[nivel][]' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>
        <td><input type='number' name='habilidades[salario_mensual][]' style='border: 2px solid #FF66B2; background-color: #FEE6F1; color: #FF66B2;'></td>
        <td><button type='button' onclick='QuitarFila(this)'>❌ Eliminar</button></td>
    `;
}

function QuitarFila(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>
