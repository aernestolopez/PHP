<?php
// Quita espacios de los extremos y etiquetas HTML
function limpiarTexto(string $texto): string
{
    return strip_tags(trim($texto));
}

// Los 3 partidos de ejemplo con los que arranca la clasificación
function partidosIniciales(): array
{
    return [
        ['local' => 'FC Barcelona',       'golesLocal' => 3, 'visitante' => 'Real Madrid',   'golesVisitante' => 1],
        ['local' => 'Atlético de Madrid', 'golesLocal' => 2, 'visitante' => 'Real Betis Balompié', 'golesVisitante' => 2],
        ['local' => 'Sevilla FC',         'golesLocal' => 0, 'visitante' => 'Valencia FC',   'golesVisitante' => 1],
    ];
}

// Valida un partido. Si algo falla lanza una Exception con el mensaje de error.
// Si todo está bien no devuelve nada.
function validarPartido(array $equipos, array $partidos, string $local, string $golesLocal, string $visitante, string $golesVisitante): void
{
    // 1. Campos en blanco
    if ($local === '' || $visitante === '' || $golesLocal === '' || $golesVisitante === '') {
        throw new Exception("No puedes dejar ningún campo en blanco.");
    }

    // 2. Equipos que existen en la lista (array_search devuelve false si no lo encuentra)
    if (array_search($local, $equipos) === false || array_search($visitante, $equipos) === false) {
        throw new Exception("Alguno de los equipos no existe en la liga.");
    }

    // 3. Equipos iguales
    if ($local === $visitante) {
        throw new Exception("Un equipo no puede jugar contra sí mismo.");
    }

    // 4. Goles negativos
    if ((int) $golesLocal < 0 || (int) $golesVisitante < 0) {
        throw new Exception("Los goles no pueden ser negativos.");
    }

    // 5. Goles enteros: solo dígitos (rechaza letras y decimales)
    if (!ctype_digit($golesLocal) || !ctype_digit($golesVisitante)) {
        throw new Exception("Los goles tienen que ser números enteros, sin letras ni decimales.");
    }

    // 6. Límite de goles
    if ((int) $golesLocal > 20 || (int) $golesVisitante > 20) {
        throw new Exception("El máximo es de 20 goles por equipo.");
    }

    // 7. Partido ya jugado (mismo local y mismo visitante)
    foreach ($partidos as $partido) {
        if ($partido['local'] === $local && $partido['visitante'] === $visitante) {
            throw new Exception("Ese partido ya se ha jugado: $local contra $visitante.");
        }
    }
}

// Calcula la tabla: puntos y goles a favor de cada equipo, ordenada
function calcularClasificacion(array $equipos, array $partidos): array
{
    $tabla = [];
    foreach ($equipos as $equipo) {
        $tabla[$equipo] = ['equipo' => $equipo, 'puntos' => 0, 'golesFavor' => 0];
    }

    foreach ($partidos as $partido) {
        $tabla[$partido['local']]['golesFavor'] += $partido['golesLocal'];
        $tabla[$partido['visitante']]['golesFavor'] += $partido['golesVisitante'];

        if ($partido['golesLocal'] > $partido['golesVisitante']) {
            $tabla[$partido['local']]['puntos'] += 3;
        } elseif ($partido['golesLocal'] < $partido['golesVisitante']) {
            $tabla[$partido['visitante']]['puntos'] += 3;
        } else {
            $tabla[$partido['local']]['puntos'] += 1;
            $tabla[$partido['visitante']]['puntos'] += 1;
        }
    }

    // Quitamos las claves con el nombre y ordenamos: puntos y, si empatan, goles a favor
    $tabla = array_values($tabla);
    usort($tabla, function ($a, $b) {
        if ($a['puntos'] !== $b['puntos']) {
            return $b['puntos'] <=> $a['puntos'];
        }
        return $b['golesFavor'] <=> $a['golesFavor'];
    });

    return $tabla;
}
