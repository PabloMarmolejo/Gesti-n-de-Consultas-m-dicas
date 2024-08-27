<?php
require_once 'app/models/MedicosModel.php';

class MedicosController {
    private $model;

    public function __construct($db) {
        $this->model = new MedicosModel($db);
    }

    public function index() {
        $medicos = $this->model->getAllMedicos();
        require 'app/views/medicos.php';
    }    

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'cedula' => $_POST['cedula']
            ];
            $this->model->addMedico($data);
            header('Location: index.php?section=medicos');
        } else {
            require 'app/views/medicos_create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'cedula' => $_POST['cedula']
            ];
            $this->model->updateMedico($id, $data);
            header('Location: index.php?section=medicos');
        } else {
            $medico = $this->model->getMedicoById($id);
            require 'app/views/medicos_edit.php';
        }
    }

    public function delete($id) {
        $this->model->deleteMedico($id);
        header('Location: index.php?section=medicos');
    }
}
