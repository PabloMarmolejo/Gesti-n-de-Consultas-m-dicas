<div class="container mt-4">
    <h2>Nuevo Paciente</h2>
    <form action="index.php?section=pacientes&action=create" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="curp">CURP</label>
            <input type="text" class="form-control" id="curp" name="curp" required pattern="[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9]{2}">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Paciente</button>
    </form>
</div>
