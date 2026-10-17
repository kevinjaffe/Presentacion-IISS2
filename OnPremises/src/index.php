<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de contacto</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card">
    <h1>Registro de contacto</h1>

    <?php if (isset($_GET['ok'])): ?>
      <p class="msg ok">Registro guardado correctamente. ID: <?php echo htmlspecialchars($_GET['id']); ?></p>
    <?php elseif (isset($_GET['error'])): ?>
      <p class="msg error">Ocurrió un error al guardar. Intenta de nuevo.</p>
    <?php endif; ?>

    <form action="submit.php" method="post">
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required maxlength="100" placeholder="Tu nombre">

      <label for="correo">Correo</label>
      <input type="email" id="correo" name="correo" required maxlength="100" placeholder="tucorreo@ejemplo.com">

      <button type="submit">Enviar</button>
    </form>
  </main>
</body>
</html>
