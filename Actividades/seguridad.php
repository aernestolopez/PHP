<?php
if(isset($_POST['nombre'])){
    //Elimina todos los nulos y todas las etiquetas PHP y HTML
    $nombre1=strip_tags($_POST['nombre']);
    //Convierte caracteres especiales en entidades HTML
    $nombre02=htmlspecialchars($_POST['nombre']);
    echo "Nombre saneado con strip_tags: ";
    echo $nombre1;
    echo "<br/>";
    echo "Nombre saneado con htmlspecialchars: ";
    echo $nombre02; 
}else{
    echo "No has introducido tu nombre";
}