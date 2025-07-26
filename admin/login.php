<?php
session_start();
require_once("../config/db.php");

// Si ya está logueado, redirigir
if (isset($_SESSION["admin"])) {
  header("Location: dashboard.php");
  exit;
}

$error = "";

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $usuario = $_POST["usuario"] ?? "";
  $password = $_POST["password"] ?? "";

  // Consulta al admin
  $stmt = $pdo->prepare("SELECT * FROM admin WHERE usuario = ?");
  $stmt->execute([$usuario]);
  $admin = $stmt->fetch();

  // Verificación segura con password_verify()
  if ($admin && password_verify($password, $admin["password"])) {
    $_SESSION["admin"] = $admin["usuario"];
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Usuario o contraseña incorrectos.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - Celumanía</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      display: relative;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }

    h2 {
      text-align: center;
      color: #00ACC1;
    }

    input[type="text"],
    input[type="password"] {
      padding: 10px;
      width: 92.5%;
      margin-top: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      margin-top: 15px;
      width: 100%;
      background-color: #00ACC1;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0097A7;
    }

    .error {
      color: crimson;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Panel Celumanía</h2>
    <form method="POST">
      <input type="text" name="usuario" placeholder="Usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Ingresar</button>

      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
