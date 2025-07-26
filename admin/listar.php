<?php
session_start();
require_once("../config/db.php");

// Verificamos si el admin está logueado
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

// Consultamos los productos de la base de datos
$stmt = $pdo->query("SELECT * FROM productos ORDER BY creado_en DESC");
$productos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de productos - Celumanía</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f4f4f4;
      padding: 2rem;
    }

    h2 {
      color: #00ACC1;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #e0f7fa;
    }

    img {
      width: 60px;
      height: auto;
      border-radius: 4px;
    }

    .eliminar {
      color: white;
      background: crimson;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
    }

    .eliminar:hover {
      background: darkred;
    }
  </style>
</head>
<body>

  <h2>Productos cargados</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Stock</th>
        <th>Precio</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($productos as $producto): ?>
        <tr>
          <td><?= $producto["id"] ?></td>
          <td>
            <?php if ($producto["imagen"]): ?>
              <img src="../uploads/<?= htmlspecialchars($producto["imagen"]) ?>" alt="Imagen">
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($producto["nombre"]) ?></td>
          <td><?= htmlspecialchars($producto["categoria"]) ?></td>
          <td><?= $producto["stock"] ?></td>
          <td>$<?= number_format($producto["precio"], 2) ?></td>
          <td>
            <a class="eliminar" href="eliminar.php?id=<?= $producto["id"] ?>" onclick="return confirm('¿Estás seguro de que querés eliminar este producto?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>
</html>
