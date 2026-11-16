<?php
session_start();
require 'conexion.php';

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, apellido, dni, email, password, rol, activo) VALUES (?, ?, ?, ?, ?, 'usuario', 1)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nombre, $apellido, $dni, $email, $password])) {
        header("Location: todomoda.php");
        exit;
    } else {
        $mensaje = "Error al registrarse. Puede que ese email ya exista.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta - TodoModa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

    <div class="login-box">
        <h1>TodoModa</h1>
        <h2>Crear cuenta</h2>

        <?php if ($mensaje) echo "<p class='error'>$mensaje</p>"; ?>

        <form method="POST">
            <div class="campo">
                <input type="text" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="campo">
                <input type="text" name="apellido" placeholder="Apellido" required>
            </div>
            <div class="campo">
                <input type="text" name="dni" placeholder="DNI" required>
            </div>
            <div class="campo">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="campo">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn">Registrarse</button>
            <a href="index.php" class="link">¿Ya tenés cuenta? Iniciar sesión</a>
        </form>
    </div>

</body>
</html>