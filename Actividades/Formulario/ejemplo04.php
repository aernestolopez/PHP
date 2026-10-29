<?php
    if(isset($_GET["enviar"])) {
        $mensajeFinal;
        if(isset($_GET["idioma"])){
            $idioma = $_GET['idioma'];
            if($idioma == "es"){
                $bienvenida ="Tu nombre completo es ";
                $interesesMens="tus intereses son: ";
            }else{
                $bienvenida="Your name is ";
                $interesesMens="your interests are: ";
            }
            if(isset($_GET["nombre"], $_GET["apellidos"])){
            $nombre = $_GET['nombre'];
            $apellido = $_GET['apellidos'];
        
            $mensajeFinal=$bienvenida. $nombre . " ". $apellido;
        }

        if(isset($_GET["interes"])){
            $interesesArr= $_GET['interes'];
            foreach ($interesesArr as $value){
                $value = $value . " ";
                $mensajeFinal = $mensajeFinal . " ". $interesesMens . $value;
            }

        }

        if(isset($_GET["interes1"])){
            $interesesArr1= $_GET['interes1'];
            foreach ($interesesArr1 as $value){
                $value = $value . " ";
                $interesesMens1 = "Tus otros intereses son: " . $value;
                $mensajeFinal = $mensajeFinal . " " . $interesesMens1;
            }

        }
        
        echo $mensajeFinal;
        }else{
            echo "Selecciona idioma";
        }
        
    }

//generar usuario
?>