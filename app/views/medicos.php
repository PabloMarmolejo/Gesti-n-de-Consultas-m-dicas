<div class="container mt-4">
    <h2>Médicos</h2>
    <a href="index.php?section=medicos&action=create" class="btn btn-primary mb-2">Nuevo Médico</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medicos as $medico): ?>
                <tr>
                    <td><?= htmlspecialchars($medico['nombre']) ?></td>
                    <td><?= htmlspecialchars($medico['cedula']) ?></td>
                    <td>
                        <a href="index.php?section=medicos&action=edit&id=<?= $medico['id_medico'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?section=medicos&action=delete&id=<?= $medico['id_medico'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este médico?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
