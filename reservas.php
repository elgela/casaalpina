<?php
include_once 'db.php';

function listarReservasAnuales()
{
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

        echo "<h2>" . ucfirst($meses[$mes]) . "</h2>";
        echo "<table border='1' style='border-collapse:collapse; text-align:left;' class='tabla-reservas'>";
        echo "<tr style='text-align:center;'>
                <th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th><th>Dom</th>
              </tr><tr>";

        // Espacios en blanco antes del primer día
        for ($i = 1; $i < $primerDiaSemana; $i++) {
            echo "<td colspan='14'></td>";
        }

        // Generar días
        for ($d = 1; $d <= $diasMes; $d++) {
            $fecha = "$anio-" . str_pad($mes, 2, '0', STR_PAD_LEFT) . "-" . str_pad($d, 2, '0', STR_PAD_LEFT);

            $pdo = conexion();
            $stmt = $pdo->prepare("SELECT r.id_reserva, p.nombre, p.apellido, p.dni, c.id_cabania,
                                          r.adultos, r.menores, r.bebes, r.fecha_ingreso,
                                          r.fecha_egreso, r.valor
                                   FROM reservas r
                                   JOIN personas p ON r.id_persona = p.id_persona
                                   JOIN cabanias c ON r.id_cabania = c.id_cabania
                                   WHERE r.fecha_ingreso <= :fecha
                                     AND r.fecha_egreso >= :fecha");
            $stmt->execute(['fecha' => $fecha]);
            $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<td><strong>$d</strong>";
            // Ordenar por id_cabania
            usort($reservas, function ($a, $b) {
                return $a['id_cabania'] <=> $b['id_cabania'];
            });
            foreach ($reservas as $res) {
                echo "<div class='reserva'
                        data-id-cabania='{$res['id_cabania']}'
                        data-nombre='{$res['nombre']}'
                        data-apellido='{$res['apellido']}'
                        data-dni='{$res['dni']}'
                        data-id-reserva='{$res['id_reserva']}'
                        data-adultos='{$res['adultos']}'
                        data-menores='{$res['menores']}'
                        data-bebes='{$res['bebes']}'
                        data-fecha-ingreso='{$res['fecha_ingreso']}'
                        data-fecha-egreso='{$res['fecha_egreso']}'
                        data-valor='{$res['valor']}'
                        onclick='abrirModal(this)'>
                        <p>{$res['id_cabania']} – {$res['nombre']} {$res['apellido']}</p>
                      </div>";
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
