<?php
session_start();
require 'conexion.php';


if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id == $_SESSION['id']) {
        header("Location: panel_admin.php?error=autoeliminacion");
        exit;
    }
   
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: panel_admin.php");
exit;
?>