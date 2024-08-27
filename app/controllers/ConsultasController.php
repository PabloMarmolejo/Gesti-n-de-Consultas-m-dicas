<?php
require_once 'app/models/ConsultasModel.php';

class ConsultasController {
    private $model;

    public function __construct($db) {
        $this->model = new ConsultasModel($db);
    }

    public function index() {
        $consultas = $this->model->getAllConsultas();
        require 'app/views/consultas.php';
    }    

    public function create() {
        $medicos = $this->model->getAllMedicos();
        $pacientes = $this->model->getAllPacientes();
        $diagnosticos = $this->model->getAllDiagnosticos();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'fecha_consulta' => $_POST['fecha_consulta'],
                'id_medico' => $_POST['id_medico'],
                'id_paciente' => $_POST['id_paciente'],
                'id_diagnostico' => $_POST['id_diagnostico'],
                'tratamiento' => $_POST['tratamiento'],
                'costo' => $_POST['costo']
            ];
            $this->model->addConsulta($data);
            header('Location: index.php?section=consultas');
        } else {
            require 'app/views/consultas_create.php';
        }
    }
    
    public function edit($id) {
        $consulta = $this->model->getConsultaById($id);
        $medicos = $this->model->getAllMedicos();
        $pacientes = $this->model->getAllPacientes();
        $diagnosticos = $this->model->getAllDiagnosticos();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'fecha_consulta' => $_POST['fecha_consulta'],
                'id_medico' => $_POST['id_medico'],
                'id_paciente' => $_POST['id_paciente'],
                'id_diagnostico' => $_POST['id_diagnostico'],
                'tratamiento' => $_POST['tratamiento'],
                'costo' => $_POST['costo']
            ];
            $this->model->updateConsulta($id, $data);
            header('Location: index.php?section=consultas');
        } else {
            require 'app/views/consultas_edit.php';
        }
    }
    public function delete($id) {
        $this->model->deleteConsulta($id);
        header('Location: index.php?section=consultas');
    }
}
