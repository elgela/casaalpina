<?php
include_once 'db.php';

function listarReservasAnuales() {
    $anio = date('Y');

    $meses = [
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    ];

    for ($mes = 1; $mes <= 12; $mes++) {
        $diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $primerDiaSemana = date('N', strtotime("$anio-$mes-01"));

        echo "<h2>Mes: " . ucfirst($meses[$mes]) . "</h2>";
        echo "<table border='1' style='border-collapse:collapse; text-align:left;' class='tabla-reservas'>";
        echo "<tr style='text-align:center;'>
                <th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th><th>Dom</th>
              </tr><tr>";

        // Espacios en blanco antes del primer día
        for ($i = 1; $i < $primerDiaSemana; $i++) {
            echo "<td></td>";
        }

        // Generar días
        for ($d = 1; $d <= $diasMes; $d++) {
            $fecha = "$anio-" . str_pad($mes, 2, '0', STR_PAD_LEFT) . "-" . str_pad($d, 2, '0', STR_PAD_LEFT);

            $pdo = conexion();
            $stmt = $pdo->prepare("SELECT r.id_reserva, p.nombre, p.apellido, p.dni, c.id_cabania,
                                          r.adultos, r.ninios, r.bebes, r.llegada,
                                          r.salida, r.noches, r.notas, r.valor
                                   FROM reservas r
                                   JOIN personas p ON r.id_persona = p.id_persona
                                   JOIN cabanias c ON r.id_cabania = c.id_cabania
                                   WHERE r.llegada <= :fecha
                                     AND r.salida >= :fecha");
            $stmt->execute(['fecha' => $fecha]);
            $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<td><strong>$d</strong>";
            // Ordenar por id_cabania
            usort($reservas, function ($a, $b) {
                return $a['id_cabania'] <=> $b['id_cabania'];
            });

            $cabanias = [
                1 => 'Del Pinar',
                2 => 'Del Solar',
                3 => 'Del Puente',
                4 => 'Casagrande'
            ];

            foreach ($cabanias as $idCabania => $nombreCabania) {
                // Buscar si hay reserva para esta cabaña
                $reservaCabana = null;
                foreach ($reservas as $res) {
                    if ($res['id_cabania'] == $idCabania) {
                        $reservaCabana = $res;
                        break;
                    }
                }

                if ($reservaCabana) {
                    // Mostrar reserva
                    echo "<div class='reserva'
                            data-id-cabania='{$nombreCabania}'
                            data-nombre='{$reservaCabana['nombre']}'
                            data-apellido='{$reservaCabana['apellido']}'
                            data-dni='{$reservaCabana['dni']}'
                            data-id-reserva='{$reservaCabana['id_reserva']}'
                            data-adultos='{$reservaCabana['adultos']}'
                            data-ninios='{$reservaCabana['ninios']}'
                            data-bebes='{$reservaCabana['bebes']}'
                            data-llegada='{$reservaCabana['llegada']}'
                            data-salida='{$reservaCabana['salida']}'
                            data-noches='{$reservaCabana['noches']}'
                            data-notas='{$reservaCabana['notas']}'
                            data-valor='{$reservaCabana['valor']}'
                            onclick='abrirModal(this)'>
                            <p>{$reservaCabana['apellido']}</p>
                        </div>";
                } else {
                    // Mostrar celda vacía
                    echo "<div class='reserva vacia'
                            <p>&nbsp;</p>
                        </div>";
                }
            }
            
            if ((($d + $primerDiaSemana - 1) % 7) == 0) {
                echo "</tr><tr>";
            }
        }

        // Espacios en blanco al final
        $ultimoDiaSemana = date('N', strtotime("$anio-$mes-$diasMes"));
        for ($i = $ultimoDiaSemana; $i < 7; $i++) {
            echo "<td></td>";
        }

        echo "</tr></table>";
    }
}
