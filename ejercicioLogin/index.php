<?php
session_start();
date_default_timezone_set("Europe/Madrid");
const USER = "admin";
const PASS = "1234";
$mensaje = "";
$sesionIniciada = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    


    if(!empty($username) && !empty($password)){
$username = $_POST["username"];
$password = $_POST["password"];

if ($username === USER && $password === PASS){
    $_SESSION["username"] = USER;
    $_SESSION["ultAcceso"] = date("H:i:s");
    if(isset($_POST["recordar"])){
        
       setcookie("usuario_recordado", USER, time() + (86400 * 7));
    }else{
        setcookie("usuario_recordado", "", time() - 3600);
    }
    $sesionIniciada = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}else{
    $mensaje= "<p style = 'color:red'> Fallo en el inicio de sesión</p>";
}
}
}

if (isset($_GET['accion']) && $_GET['accion'] === 'salir') {
    $sesionIniciada = false;    
    session_destroy();   
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
</head>
<body>
    <?php if (!isset($_SESSION['username'])): ?>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <!-- El atributo action apunta al archivo o script que procesará los datos (ej. login.php) -->
        <!-- El atributo method="POST" envía los datos de forma oculta en el cuerpo de la petición HTTP -->
        <form action="index.php" method="POST">
            <div>
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" required>
            </div>

            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <input name="recordar" type="checkbox">Recordar Usuario </input>
            <button type="submit">Entrar</button>
        </form>
        <?php 
        echo $mensaje;
        ?>
            <?php endif;?>

        

    </div>
    <?php if(isset($_SESSION["username"])): ?>
        <p>Bienvenid@ <?php echo $_SESSION["username"];?></p>
        <p>Último acceso <?php echo $_SESSION["ultAcceso"];?>
        <?php if (isset($_COOKIE["usuario_recordado"])): ?>
    <p>COOKIE: <?php echo $_COOKIE["usuario_recordado"]; ?></p>
<?php else: ?>
    <p>COOKIE: No hay cookie guardada</p>
<?php endif; ?>

        <a href="?accion=salir">Cerrar Sesión</a>
    <?php endif;?>

</body>
</html>