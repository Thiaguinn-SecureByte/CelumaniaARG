<?php
session_start();
require_once("../config/db.php");

// Verificamos si el usuario está logueado
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración - Celumanía</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 3rem auto;
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #00ACC1;
    }

    .acciones {
      margin-top: 2rem;
    }

    .acciones a {
      display: inline-block;
      margin: 0.5rem;
      padding: 0.8rem 1.5rem;
      background-color: #00ACC1;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .acciones a:hover {
      background-color: #008b9b;
    }

    .logout {
      float: right;
      margin-top: -2rem;
    }

    .logout a {
      color: #999;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .logout a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logout">
      <a href="../logout.php">Cerrar sesión</a>
    </div>

    <h2>¡Hola, <?php echo htmlspecialchars($_SESSION["admin"]); ?>!</h2>
    <p>Bienvenido al panel de administración de Celumanía.</p>

    <div class="acciones">
      <a href="agregar.php">➕ Agregar producto</a>
      <a href="listar.php">📦 Ver productos</a>
    </div>
  </div>
</body>
</html>
