<?php
require_once 'app/models/PacientesModel.php';

class PacientesController {
    private $model;

    public function __construct($db) {
        $this->model = new PacientesModel($db);
    }

    public function index() {
        $pacientes = $this->model->getAllPacientes();
        require 'app/views/pacientes.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'curp' => $_POST['curp']
            ];
            $this->model->addPaciente($data);
            header('Location: index.php?section=pacientes');
        } else {
            require 'app/views/pacientes_create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'curp' => $_POST['curp']
            ];
            $this->model->updatePaciente($id, $data);
            header('Location: index.php?section=pacientes');
        } else {
            $paciente = $this->model->getPacienteById($id);
            require 'app/views/pacientes_edit.php';
        }
    }

    public function delete($id) {
        $this->model->deletePaciente($id);
        header('Location: index.php?section=pacientes');
    }
}
