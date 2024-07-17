<?php
include 'conexion.php';  // Incluye el archivo de conexión

// Ejemplo de consulta
$sql = "SELECT * FROM tabla_ejemplo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Muestra los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "Campo1: " . $row["campo1"]. " - Campo2: " . $row["campo2"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Cierra la conexión
$conn->close();
?>
