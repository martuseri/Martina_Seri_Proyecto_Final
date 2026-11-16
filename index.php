<?php
session_start();
require "conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND fecha_archivado IS NULL");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario["password"])) {
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];

        if ($usuario["rol"] == "admin") {
            header("Location: panel_admin.php");
        } else {
            header("Location: todomoda.php");
        }
        exit;
    } else {
        $error = "Email o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TodoModa - Iniciar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

    <main class="form-box login-box">
        <h1>TodoModa</h1>
        <h2>Iniciar sesión</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="campo">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="campo">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn">Iniciar sesión</button>
        </form>

        <a class="link" href="registro.php">¿No tenés cuenta? Crear cuenta</a>
    </main>

</body>