<div class="container mt-4">
    <h2>Consultas</h2>
    <a href="index.php?section=consultas&action=create" class="btn btn-primary mb-2">Nueva Consulta</a>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Médico</th>
                <th>Paciente</th>
                <th>Tratamiento</th>
                <th>Costo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?= htmlspecialchars($consulta['fecha_consulta']) ?></td>
                    <td><?= htmlspecialchars($consulta['nombre_medico']) ?></td>
                    <td><?= htmlspecialchars($consulta['nombre_paciente']) ?></td>
                    <td><?= htmlspecialchars($consulta['tratamiento']) ?></td>
                    <td><?= htmlspecialchars($consulta['costo']) ?></td>
                    <td>
                        <a href="index.php?section=consultas&action=edit&id=<?= $consulta['folio'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?section=consultas&action=delete&id=<?= $consulta['folio'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta consulta?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
