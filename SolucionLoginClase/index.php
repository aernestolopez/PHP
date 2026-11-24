<?php
session_start();

$usuario_valido = "admin";
$password_valida = "1234";
$error = "";

// 1. PROCESAR EL LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {  // if (isset($_POST['entrar']))
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === $usuario_valido && $pass === $password_valida) {
        // Guardamos datos en la sesión
        $_SESSION['usuario_conectado'] = $user;
        $_SESSION['hora_acceso'] = date("H:i:s");

        // Guardamos o borramos la cookie según el checkbox
        if (isset($_POST['recordar'])) {
            // setcookie admite hasta 7 parámetros aunque sólo es obligatorio 1 y normalmente se suelen usar hasta 3:
            // 1. Nombre con el que se identificará la cookie en el array $_COOKIE
            // 2. Valor que se le asigna. Cuando se omite o se deja vacío, PHP interpreta que vas a eliminarla
            // 3. Fecha de caducidad en segundos. Si se deja vacío, caduca al cerrar el navegador
            // 4. Ruta donde estará disponible la cookie. Si pones / estará disponible en toda la web y si lo omites sólo funciona en la carpeta actual
            // 5. Dominio donde es válida la cookie
            // 6. Seguridad. Si pones true, la cookie sólo se enviará si la web usa conexión cifrada (https)
            // 7. Si pones true impides que la cookie pueda leerse desde JavaScript

            setcookie("usuario_recordado", $user, time() + (86400 * 7));
        } else {
            // Sino marcó la casilla de verificación, la cookie se elimina poniendo un tiempo pasado
            setcookie("usuario_recordado", "", time() - 3600);
        }
        // Se ejecuta una redirección hacia la misma página, es decir, hacia repaso_sesiones.php
        // Sirve para evitar tener que cambiar el código, si, por ejemplo, cambiamos el nombre del archivo
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

// 2. CERRAR SESIÓN
// Se recoge por el método GET porque la información se ha enviado a través de un enlace html con la etiqueta <a>

//Código que habría que poner en caso de añadir un botón de Cerrar sesión en el formulario en lugar de un enlace como se ha puesto 

/* if (isset($_POST['cerrar_sesion'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
*/

if (isset($_GET['accion']) && $_GET['accion'] === 'salir') {
    $_SESSION = [];
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit; // Para evitar que se siga la ejecución del programaa
}

// 3. LEER COOKIE SI EXISTE
$usuario_en_cookie = $_COOKIE['usuario_recordado'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesiones y Cookies</title>
</head>
<body>

<!-- Mientras exista una sesion activa -->
<?php if (isset($_SESSION['usuario_conectado'])): ?>

    <h2>Panel Privado</h2>
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_conectado']); ?></p>
    <p>Hora de acceso: <?php echo $_SESSION['hora_acceso']; ?></p>

    <!-- AQUÍ SÍ SE MUESTRA LA COOKIE TRAS LA RECARGA -->
    <p>
        <?php
        if (isset($_COOKIE['usuario_recordado'])) {
            echo "El valor de la Cookie es: " . htmlspecialchars($_COOKIE['usuario_recordado']);
        } else {
            echo "No hay ninguna cookie guardada (no marcaste recordar).";
        }
        ?>
    </p>

    <a href="?accion=salir">Cerrar sesión</a>
    <!--<a href="repaso_sesiones.php?accion=salir">Cerrar sesión</a> -->

    <!--<a href="logout.php">Cerrar sesión</a> 
        Podiamos crear un archivo externo llamado logout.php y en él poner lo siguiente:
        <?php
    //    session_start();
        $_SESSION = [];
     //   session_destroy();
     //   header("Location: repaso_sesiones.php"); // Vuelve al archivo principal
     //   exit;
        ?>
    -->


<?php else: ?>

    <h2>Iniciar Sesión</h2>
    <p><?php echo $error; ?></p>

    <form method="POST" autocomplete="off">
        Usuario: <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario_en_cookie); ?>" autocomplete="off" required><br><br>
        Contraseña: <input type="password" name="password" autocomplete="new-password" required><br><br>
        <input type="checkbox" name="recordar" <?php if ($usuario_en_cookie) echo "checked"; ?>> Recordar mi usuario<br><br>
        <button type="submit">Entrar</button>
        <!-- input type = "submit" name = "entrar"> -->
    </form>

<?php endif; ?>

</body>
</html>
