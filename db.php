<?php

function conexion() {
    try { // captura errores de conexion
        $db = new PDO('mysql:host=localhost;dbname=kn000346_reserva;charset=utf8', 'kn000346_reserva', '33tiFIsesi');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // facilita el debug
        return $db;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function getReservas() {
    $db = conexion();
    $sql = "SELECT r.id_reserva,
                   p.nombre,
                   p.apellido,
                   p.dni,
                   p.email,
                   p.telefono,
                   c.nombre AS cabania,
                   r.adultos,
                   r.menores,
                   r.bebes,
                   r.fecha_ingreso,
                   r.fecha_egreso,
                   r.valor
            FROM reservas r
            JOIN personas p ON r.id_persona = p.id_persona
            JOIN cabanias c ON r.id_cabania = c.id_cabania";
    $query = $db->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); // devuelve objetos
}

function getPersonas() {
    $db = conexion();
    $sql = "SELECT id_persona, nombre, apellido, dni, email, telefono FROM personas";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>