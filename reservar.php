<?php

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     die("❌ Este script solo funciona con datos enviados desde el formulario.");
// }

include_once 'db.php';

$db = conexion();

// Capturar datos del formulario
$nombre        = $_POST['nombre'] ?? null;
$apellido      = $_POST['apellido'] ?? null;
$dni           = $_POST['dni'] ?? null;
$email         = $_POST['email'] ?? null;
$telefono      = $_POST['telefono'] ?? null;
$id_cabania    = $_POST['cabania'] ?? null;
$adultos       = $_POST['adultos'] ?? null;
$ninios        = $_POST['ninios'] ?? null;
$bebes         = isset($_POST['bebes']) ? 1 : 0;
$llegada       = $_POST['llegada'] ?? null;
$salida        = $_POST['salida'] ?? null;
$noches        = $_POST['noches'] ?? null;
$notas        = $_POST['notas'] ?? null;
// $lateCheck     = $_POST['lateCheck'] ?? null;
$valor         = $_POST['valor'] ?? null;

if (!$nombre || !$apellido || !$dni || !$email || !$id_cabania || !$adultos || !$llegada || !$salida || !$noches) {
    die("❌ Faltan datos en el formulario");
}

// Verificar si la cabaña ya está reservada en esas fechas
$sql = "SELECT COUNT(*) as total 
        FROM reservas 
        WHERE id_cabania = :id_cabania 
          AND (
              (llegada < :salida AND salida > :llegada)
          )";
$stmt = $db->prepare($sql);
$stmt->execute([
    ':id_cabania' => $id_cabania,
    ':llegada' => $llegada,
    ':salida' => $salida
]);
$reserva = $stmt->fetch(PDO::FETCH_ASSOC);

if ($reserva['total'] > 0) {
    die("❌ Cabaña ya reservada en esa fecha");
}

try {
    // Iniciar transacción
    $db->beginTransaction();

    // 1. Buscar persona por dni
    $sql = "SELECT id_persona FROM personas WHERE dni = :dni";
    $stmt = $db->prepare($sql);
    $stmt->execute([':dni' => $dni]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $id_persona = $row['id_persona'];
    } else {
        // Insertar persona
        $sql = "INSERT INTO personas (nombre, apellido, dni, email, telefono) VALUES (:nombre, :apellido, :dni, :email, :telefono)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':dni' => $dni,
            ':email' => $email,
            ':telefono' => $telefono
        ]);
        $id_persona = $db->lastInsertId();
    }

    // 2. Insertar reserva
    $sql = "INSERT INTO reservas (id_persona, id_cabania, adultos, ninios, bebes, llegada, salida, noches, notas, valor)
            VALUES (:id_persona, :id_cabania, :adultos, :ninios, :bebes, :llegada, :salida, :noches, :notas, :valor)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':id_persona' => $id_persona,
        ':id_cabania' => $id_cabania,
        ':adultos' => $adultos,
        ':ninios' => $ninios,
        ':bebes' => $bebes,
        ':llegada' => $llegada,
        ':salida' => $salida,
        ':noches' => $noches,
        ':notas' => $notas,
        ':valor' => $valor
    ]);

    // Confirmar transacción
    $db->commit();

    echo "✅ Datos cargados";
} catch (Exception $e) {
    $db->rollBack();
    die("❌ Error al cargar datos: " . $e->getMessage());
}
?>