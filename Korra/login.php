<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Credenciales de administrador
    $adminUsername = 'korra';
    $adminPassword = 'theavatar123';

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['is_admin'] = true; // Marca al usuario como administrador
        echo "Bienvenido, administrador!";
        header("Location: clae.php"); // Redirige a la página de administración
        
        exit();
    } else {
        $_SESSION['is_admin'] = false; // Usuario no es administrador
        echo "Acceso denegado.";
        header("Location: index.html?error=1"); // Devuelve al inicio con error
        
        exit();
    }
}
?>
