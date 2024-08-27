<div class="container mt-4">
    <h2>Nueva Consulta</h2>
    <form action="index.php?section=consultas&action=create" method="POST">
        <div class="form-group">
            <label for="fecha_consulta">Fecha de Consulta</label>
            <input type="date" class="form-control" id="fecha_consulta" name="fecha_consulta" required>
        </div>
        <div class="form-group">
            <label for="id_medico">Médico</label>
            <select class="form-control" id="id_medico" name="id_medico" required>
                <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico['id_medico'] ?>"><?= htmlspecialchars($medico['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_paciente">Paciente</label>
            <select class="form-control" id="id_paciente" name="id_paciente" required>
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id_paciente'] ?>"><?= htmlspecialchars($paciente['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_diagnostico">Diagnóstico</label>
            <select class="form-control" id="id_diagnostico" name="id_diagnostico" required>
                <?php foreach ($diagnosticos as $diagnostico): ?>
                    <option value="<?= $diagnostico['id'] ?>"><?= htmlspecialchars($diagnostico['descripcion']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tratamiento">Tratamiento</label>
            <input type="text" class="form-control" id="tratamiento" name="tratamiento" required>
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" step="0.01" class="form-control" id="costo" name="costo" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Consulta</button>
    </form>
</div>
