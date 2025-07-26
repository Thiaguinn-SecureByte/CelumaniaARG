<?php
session_start();
require_once("../config/db.php");

// Verificar si el admin está logueado
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $precio = $_POST["precio"];
  $categoria = $_POST["categoria"];
  $stock = $_POST["stock"];

  // Manejo de imagen
  if ($_FILES["imagen"]["error"] === 0) {
    $nombreImagen = uniqid() . "_" . $_FILES["imagen"]["name"];
    $rutaImagen = "../uploads/" . $nombreImagen;
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen);
  } else {
    $nombreImagen = null;
  }

  // Guardar en la base de datos
  $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria, stock, imagen) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->execute([$nombre, $descripcion, $precio, $categoria, $stock, $nombreImagen]);

  $mensaje = "Producto agregado correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Producto - Celumanía</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 50px;
    }

    form {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 600px;
    }

    h2 {
      color: #00ACC1;
    }

    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 0.7rem 1.5rem;
      background: #00ACC1;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background: #008B9B;
    }

    .mensaje {
      margin-top: 1rem;
      background: #dff0d8;
      color: #3c763d;
      padding: 10px;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<form method="POST" enctype="multipart/form-data">
  <h2>Agregar Producto</h2>

  <label>Nombre</label>
  <input type="text" name="nombre" required>

  <label>Descripción</label>
  <textarea name="descripcion" required></textarea>

  <label>Precio</label>
  <input type="number" name="precio" step="0.01" required>

  <label>Categoría</label>
  <select name="categoria" required>
    <option value="Celulares">Celulares</option>
    <option value="Accesorios">Accesorios</option>
    <option value="Extras">Extras</option>
  </select>

  <label>Stock</label>
  <input type="number" name="stock" required>

  <label>Imagen del producto</label>
  <input type="file" name="imagen" accept="image/*" required>

  <button type="submit">Cargar producto</button>

  <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
</form>

</body>
</html>
