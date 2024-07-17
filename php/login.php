<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Iniciar sesión
session_start();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['username'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if (empty($usuario) || empty($contrasena)) {
        echo "empty_fields";
        exit;
    }

    // Para depuración: imprimir los datos recibidos
    //echo "Usuario: $usuario, Contraseña: $contrasena"; // Esta línea puede ser útil para depurar

    // Consulta SQL para verificar el usuario y contraseña
    $sql = "SELECT * FROM usuario WHERE n_usuario = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "prepare_failed";
        exit;
    }
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si se encuentra el usuario, verificar la contraseña
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Para depuración: imprimir la contraseña hashada
        //echo "Hashed Password: $hashed_password"; // Esta línea puede ser útil para depurar

        // Verificar la contraseña hash
        if (password_verify($contrasena, $hashed_password)) {
            // Contraseña válida, iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $usuario;
            echo "success";
        } else {
            // Contraseña incorrecta
            echo "invalid_password";
        }
    } else {
        // Usuario no encontrado
        echo "user_not_found";
    }

    // Cerrar la statement y la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>
