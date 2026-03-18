<?php
include_once 'db.php';

function listaPersonas() {
    // obtiene usuarios de la db
    $personas = getPersonas();

    echo "<table class='datos_personas'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($personas as $persona) {
                echo "<tr>
                        <td>" . htmlspecialchars($persona->id_persona) . "</td>
                        <td>" . htmlspecialchars($persona->nombre) . "</td>
                        <td>" . htmlspecialchars($persona->apellido) . "</td>
                        <td>" . htmlspecialchars($persona->dni) . "</td>
                        <td>" . htmlspecialchars($persona->email) . "</td>
                        <td>" . htmlspecialchars($persona->telefono) . "</td>
                    </tr>";
            }
    echo "</tbody></table>";
}