<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, apellido, dni, email, password, rol, activo) VALUES (?, ?, ?, ?, ?, ?, 1)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nombre, $apellido, $dni, $email, $password, $rol])) {
        header("Location: panel_admin.php");
        exit;
    } else {
        $mensaje = "Error al crear usuario.";
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
        <h1>TODOMODA</h1>
        <h2>Crear cuenta</h2>

        <a href="panel_admin.php" class="link" style="margin-bottom:20px;">← Volver al panel</a>

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
            <div class="campo">
                <select name="rol" required>
                    <option value="usuario">Usuario</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn">Crear cuenta</button>
        </form>
    </div>

</body>
</html>