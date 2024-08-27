<div class="container mt-4">
    <h2>Nuevo Médico</h2>
    <form action="index.php?section=medicos&action=create" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Médico</button>
    </form>
</div>
