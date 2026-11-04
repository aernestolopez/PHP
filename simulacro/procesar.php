<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["tipoUsuario"])){
        $usuario = $_POST["tipoUsuario"];
    echo $usuario;
    }
}
    ?>