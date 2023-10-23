<?php

if (!isset($_POST["usuario"]) || !isset($_POST["clave"])) {
    exit("Faltan datos");
}
$correo = $_POST["usuario"];
$palabraSecreta = $_POST["clave"];
include_once "funciones.php";
$valor = hacerLogin($correo, $palabraSecreta);
if ($valor == 0) {
    # Correo o contraseña incorrectos
    header("Location: login.php?mensaje=Usuario o contraseña incorrectos. Se ha registrado el intento fallido");
} else if ($valor == 2) {
    header("Location: login.php?mensaje=Límite de intentos alcanzado. Contactar a administrador para reiniciar");
} else {
    #Todo bien. Iniciar sesión y redireccionar a la página
    iniciarSesionDeUsuario();
    header("Location: index.php");
}