<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM usuarios WHERE activo = 1 ORDER BY id ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->query("SELECT * FROM usuarios WHERE activo = 0 ORDER BY id ASC");
$archivados = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador - TodoModa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">TODOMODA</div>
    <div class="iconos">
        Hola, Admin
        <a href="logout.php" class="cerrar">Cerrar sesión</a>
    </div>
</header>

<div class="container admin-panel">
    <div class="admin-top">
        <div>
            <h1>Panel Administrador</h1>
            <p>Gestioná los usuarios de la tienda</p>
        </div>
        <a href="crear_usuario.php" class="btn-admin">+ Crear nuevo usuario</a>
    </div>

    <h2>Usuarios</h2>

    <div class="tabla-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($u['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($u['dni']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><span class="badge-rol"><?php echo $u['rol']; ?></span></td>
                    <td>
                        <?php if ($u['activo'] == 1): ?>
                            <span class="badge-activo">Activo</span>
                        <?php else: ?>
                            <span class="badge-archivado">Archivado</span>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                    <a href="editar_usuario.php?id=<?php echo $u['id']; ?>" class="btn-accion btn-editar">Editar</a>
                    <?php if($u['activo'] == 1): ?>
                    <a href="archivar_usuario.php?id=<?php echo $u['id']; ?>" class="btn-accion btn-archivar">Archivar</a>
                    <?php else: ?>
                    <a href="reactivar_usuario.php?id=<?php echo $u['id']; ?>" class="btn-accion btn-reactivar">Reactivar</a>
                    <?php endif; ?>
                    <a href="eliminar_usuario.php?id=<?php echo $u['id']; ?>" class="btn-accion btn-eliminar" onclick="return confirm('¿Estás seguro de que querés eliminar este usuario permanentemente?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Usuarios archivados</h2>
    <div class="tabla-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($archivados as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td>
                        <a href="reactivar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn-accion btn-reactivar">Reactivar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>