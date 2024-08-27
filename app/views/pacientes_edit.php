<div class="container mt-4">
    <h2>Editar Paciente</h2>
    <form action="index.php?section=pacientes&action=edit&id=<?= $paciente['id_paciente'] ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($paciente['nombre']) ?>" required>
        </div>
        <div class="form-group">
            <label for="curp">CURP</label>
            <input type="text" class="form-control" id="curp" name="curp" value="<?= htmlspecialchars($paciente['curp']) ?>" required pattern="[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9]{2}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
    </form>
</div>
