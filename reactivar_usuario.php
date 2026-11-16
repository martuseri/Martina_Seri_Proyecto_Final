<?php
session_start();
require 'conexion.php';
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];
$stmt = $pdo->prepare("UPDATE usuarios SET activo=1 WHERE id=?");
$stmt->execute([$id]);
header("Location: panel_admin.php");
exit;
?>