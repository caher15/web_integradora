<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://api.fontshare.com/v2/css?f[]=gambarino@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login.css">
  <title>Formulario</title>
</head>
<body>
<form action="verificacion.php" method="post">
  <section class="form-register">
    <h4>Peaky Blinder's</h4>
    <?php
        # si hay un mensaje, mostrarlo
        if (isset($_GET["mensaje"])) { ?>
            <div class="alert alert-info">
                <?php echo $_GET["mensaje"] ?>
            </div>
        <?php } ?>
    <input class="controls"  type="text" name="usuario" required >
    <input class="controls"  type="password" name="clave" required >
    <input class="botons" type="submit" value="Iniciar Sesión">
    <a class="botonR" href="./index.php">Regresar</a>
  </section>
</form>
  

            
        
</body>
</html>