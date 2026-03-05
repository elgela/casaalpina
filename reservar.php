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
$menores       = $_POST['menores'] ?? null;
$bebes         = isset($_POST['bebes']) ? 1 : 0;
$fecha_ingreso = $_POST['fecha_ingreso'] ?? null;
$fecha_egreso  = $_POST['fecha_egreso'] ?? null;
$valor         = $_POST['valor'] ?? null;

if (!$nombre || !$apellido || !$dni || !$email || !$telefono || !$id_cabania || !$adultos || !$fecha_ingreso || !$fecha_egreso) {
    die("❌ Faltan datos en el formulario");
}

// Verificar si la cabaña ya está reservada en esas fechas
$sql = "SELECT COUNT(*) as total 
        FROM reservas 
        WHERE id_cabania = :id_cabania 
          AND (
              (fecha_ingreso < :fecha_egreso AND fecha_egreso > :fecha_ingreso)
          )";
$stmt = $db->prepare($sql);
$stmt->execute([
    ':id_cabania' => $id_cabania,
    ':fecha_ingreso' => $fecha_ingreso,
    ':fecha_egreso' => $fecha_egreso
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
    $sql = "INSERT INTO reservas (id_persona, id_cabania, adultos, menores, bebes, fecha_ingreso, fecha_egreso, valor)
            VALUES (:id_persona, :id_cabania, :adultos, :menores, :bebes, :fecha_ingreso, :fecha_egreso, :valor)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':id_persona' => $id_persona,
        ':id_cabania' => $id_cabania,
        ':adultos' => $adultos,
        ':menores' => $menores,
        ':bebes' => $bebes,
        ':fecha_ingreso' => $fecha_ingreso,
        ':fecha_egreso' => $fecha_egreso,
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