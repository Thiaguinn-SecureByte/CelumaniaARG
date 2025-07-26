<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  // Eliminar imagen asociada
  $stmtImg = $pdo->prepare("SELECT imagen FROM productos WHERE id = ?");
  $stmtImg->execute([$id]);
  $producto = $stmtImg->fetch();

  if ($producto && $producto["imagen"]) {
    $ruta = "../uploads/" . $producto["imagen"];
    if (file_exists($ruta)) {
      unlink($ruta);
    }
  }

  // Eliminar producto
  $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: listar.php");
exit;
