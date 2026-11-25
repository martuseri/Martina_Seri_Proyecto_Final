<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['rol'] == 'admin') {
    header("Location: panel_admin.php");
    exit;
}

require 'conexion.php';

$stmt = $pdo->prepare("SELECT nombre, apellido, dni, email, rol, fecha_creacion FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$usuario = $stmt->fetch();

if (!$usuario) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi cuenta - TodoModa</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body class="perfil-body">
    <div class="perfil-box">
        <h1>TODOMODA</h1>
        <h2>Mi Perfil</h2>
        <a href="todomoda.php" class="perfil-volver">← Volver a TodoModa</a>

        <div class="perfil-dato"><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></div>
        <div class="perfil-dato"><strong>Apellido:</strong> <?php echo htmlspecialchars($usuario['apellido']); ?></div>
        <div class="perfil-dato"><strong>DNI:</strong> <?php echo htmlspecialchars($usuario['dni']); ?></div>
        <div class="perfil-dato"><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['email']); ?></div>
        <div class="perfil-dato"><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['rol']); ?></div>

        <a href="logout.php" class="perfil-btn">Cerrar sesión</a>
    </div>
</body>
</html>