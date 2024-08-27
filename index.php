<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Consultas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Gestión de Consultas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php?section=consultas">Consultas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?section=medicos">Médicos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?section=pacientes">Pacientes</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
<?php
require_once 'db.php';
require_once 'app/controllers/ConsultasController.php';
require_once 'app/controllers/MedicosController.php';
require_once 'app/controllers/PacientesController.php';
require 'vendor/autoload.php';

$consultasController = new ConsultasController($db);
$medicosController = new MedicosController($db);
$pacientesController = new PacientesController($db);

if (isset($_GET['section'])) {
    $section = $_GET['section'];
    $action = $_GET['action'] ?? 'index';

    switch ($section) {
        case 'consultas':
            switch ($action) {
                case 'create':
                    $consultasController->create();
                    break;
                case 'edit':
                    if (isset($_GET['id'])) {
                        $consultasController->edit($_GET['id']);
                    } else {
                        echo '<p>ID no especificado.</p>';
                    }
                    break;
                case 'delete':
                    if (isset($_GET['id'])) {
                        $consultasController->delete($_GET['id']);
                    } else {
                        echo '<p>ID no especificado.</p>';
                    }
                    break;
                case 'generarReporte':
                    $consultasController->generarReporte();
                    break;
                case 'generarReporteXlsx':
                    $consultasController->generarReporteXlsx();
                    break;
                default:
                    $consultasController->index();
                    break;
            }
            break;

        case 'medicos':
            switch ($action) {
                case 'create':
                    $medicosController->create();
                    break;
                case 'edit':
                    if (isset($_GET['id'])) {
                        $medicosController->edit($_GET['id']);
                    } else {
                        echo '<p>ID no especificado.</p>';
                    }
                    break;
                case 'delete':
                    if (isset($_GET['id'])) {
                        $medicosController->delete($_GET['id']);
                    } else {
                        echo '<p>ID no especificado.</p>';
                    }
                    break;
                default:
                    $medicosController->index();
                    break;
            }
            break;

        case 'pacientes':
            switch ($action) {
                case 'create':
                    $pacientesController->create();
                    break;
                case 'edit':
                    if (isset($_GET['id'])) {
                        $pacientesController->edit($_GET['id']);
                    } else {
                        echo '<p>ID no especificado.</p>';
                    }
                    break;
                case 'delete':
                    if (isset($_GET['id'])) {
                        $pacientesController->delete($_GET['id']);
                    } else {
                        echo '<p>ID no especificado.</p>';
                    }
                    break;
                default:
                    $pacientesController->index();
                    break;
            }
            break;

        default:
            echo '<h2>Bienvenido a la gestión de consultas</h2>';
            break;
    }
} else {
    echo '<h2>Bienvenido a la gestión de consultas</h2>';
}
?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
