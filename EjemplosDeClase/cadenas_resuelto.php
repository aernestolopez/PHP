<?php
function validarPassword(string $password): bool {
    // Mínimo 8 caracteres, al menos una mayúscula, una minúscula, un número y un carácter especial
    $tieneLongitud = strlen($password) >= 8;
    $tieneMayuscula = preg_match('/[A-Z]/', $password);
    $tieneMinuscula = preg_match('/[a-z]/', $password);
    $tieneNumero = preg_match('/[0-9]/', $password);
    $tieneEspecial = preg_match('/[\W_]/', $password); 
    // \W detecta no-alfanuméricos y el guión bajo

    if($tieneLongitud && $tieneMayuscula && $tieneMinuscula && $tieneNumero && $tieneEspecial)
    return true;
    else return false;
      
    /*return $tieneLongitud && $tieneMayuscula && $tieneMinuscula && $tieneNumero && $tieneEspecial;*/
}

// Ejemplo de uso:
var_dump(validarPassword("Asd15qs_")); // true
var_dump(validarPassword("abc123_x")); // false



function contarVocales(string $cadena): int {
    // Convertimos todo a minúsculas para simplificar la búsqueda
    $cadena = strtolower($cadena);
    // preg_match_all busca todas las coincidencias y devuelve el conteo total
    return preg_match_all('/[aeiouáéíóú]/', $cadena);
}

$conteo = contarVocales("Esto es una frase de prueba ");
echo "<br>Total de vocales ", $conteo;

// Cadena original
$cadena = "El abecedario completo es algo largo y detallarlo exhaustivamente es costoso";

// Reemplazamos las letras 'a' (minúsculas) por '*'
// Si quisieras cambiar también las mayúsculas, usarías str_ireplace()
$cadenaModificada = str_replace('a', '*', $cadena);

echo "<h3>Cadena modificada:</h3>";
echo "<br> $cadenaModificada";
?>