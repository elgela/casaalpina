<?php
require_once 'db.php';

$db = conexion();

$stmt = $db->query("SELECT * FROM reservas");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($rows) {
    foreach ($rows as $fila) {
        echo "ID: " . $fila['id_reserva'] . " | ID persona: " . $fila['id_persona'] . " | ID cabaña: " . $fila['id_cabania'] . " | Adultos: " . $fila['adultos'] . " | Menores: " . $fila['menores'] . "<br>";
    }
} else {
    echo "No hay registros en la tabla.";
}