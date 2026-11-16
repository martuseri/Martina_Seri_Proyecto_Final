<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$mensaje = "";

// Traer usuario
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: panel_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombre=?, apellido=?, dni=?, email=?, password=?, rol=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([$nombre, $apellido, $dni, $email, $password, $rol, $id]);
    } else {
        // Si no puso contraseña, no la cambia
        $sql = "UPDATE usuarios SET nombre=?, apellido=?, dni=?, email=?, rol=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([$nombre, $apellido, $dni, $email, $rol, $id]);
    }

    if ($ok) {
        header("Location: panel_admin.php");
        exit;
    } else {
        $mensaje = "Error al actualizar.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="perfil-body">
    <div class="perfil-box">
        <h1>TodoModa</h1>

        <h3>Editar: <?php echo htmlspecialchars($usuario['nombre']); ?></h3>

        <?php if ($mensaje != ""): ?>
            <p style="color:red;"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <form method="POST" action="editar_usuario.php?id=<?php echo $usuario['id']; ?>">

            <div class="perfil-dato">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" style="border:none; background:transparent; width:70%; outline:none;">
            </div>
            <div class="perfil-dato">
                <strong>Apellido:</strong>
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" style="border:none; background:transparent; width:70%; outline:none;">
            </div>
            <div class="perfil-dato">
                <strong>DNI:</strong>
                <input type="text" name="dni" value="<?php echo htmlspecialchars($usuario['dni']); ?>" style="border:none; background:transparent; width:70%; outline:none;">
            </div>
            <div class="perfil-dato">
                <strong>Correo:</strong>
                <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" style="border:none; background:transparent; width:70%; outline:none;">
            </div>
            <div class="perfil-dato">
                <strong>Nueva contraseña:</strong>
                <input type="password" name="password" placeholder="Dejar vacío para no cambiar" style="border:none; background:transparent; width:55%; outline:none;">
            </div>
            <div class="perfil-dato">
                <strong>Rol:</strong>
                <select name="rol" style="border:none; background:transparent; outline:none;">
                    <option value="usuario" <?php if($usuario['rol']=='usuario') echo 'selected'; ?>>usuario</option>
                    <option value="admin" <?php if($usuario['rol']=='admin') echo 'selected'; ?>>admin</option>
                </select>
            </div>

            <button type="submit" class="perfil-btn" style="width:100%; border:none; cursor:pointer;">Guardar cambios</button>
            <a href="panel_admin.php" class="perfil-btn perfil-btn-secundario">Volver sin guardar</a>
        </form>
    </div>
</body>
</html>