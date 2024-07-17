<?php
$servername = "localhost";  // El servidor de la base de datos (puede ser localhost si está en tu máquina)
$username = "root";         // Nombre de usuario de MySQL por defecto en XAMPP es 'root'
$password = "";             // Contraseña de MySQL por defecto en XAMPP es ''
$dbname = "proyecto dental"; // Nombre de la base de datos que quieres utilizar

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
