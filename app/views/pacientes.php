<div class="container mt-4">
    <h2>Pacientes</h2>
    <a href="index.php?section=pacientes&action=create" class="btn btn-primary mb-2">Nuevo Paciente</a>
    <a href="index.php?section=pacientes&action=generarReportePdf" class="btn btn-info mb-2">Descargar Reporte PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>CURP</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pacientes) && is_array($pacientes)): ?>
                <?php foreach ($pacientes as $paciente): ?>
                    <tr>
                        <td><?= htmlspecialchars($paciente['nombre']) ?></td>
                        <td><?= htmlspecialchars($paciente['curp']) ?></td>
                        <td>
                            <a href="index.php?section=pacientes&action=edit&id=<?= $paciente['id_paciente'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?section=pacientes&action=delete&id=<?= $paciente['id_paciente'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este paciente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay pacientes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
