<?php
class ConsultasModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllConsultas() {
        $query = "SELECT consulta.*, medicos.nombre AS nombre_medico, pacientes.nombre AS nombre_paciente 
                  FROM consulta
                  JOIN medicos ON consulta.id_medico = medicos.id_medico
                  JOIN pacientes ON consulta.id_paciente = pacientes.id_paciente";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllMedicos() {
        $query = "SELECT id_medico, nombre FROM medicos";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAllPacientes() {
        $query = "SELECT id_paciente, nombre FROM pacientes";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAllDiagnosticos() {
        $query = "SELECT id_descripcion AS id, descripcion FROM descripcion";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getConsultaById($id) {
        $query = "SELECT * FROM consulta WHERE folio = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addConsulta($data) {
        $query = "INSERT INTO consulta (fecha_consulta, id_medico, id_paciente, id_diagnostico, tratamiento, costo) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('siisds', $data['fecha_consulta'], $data['id_medico'], $data['id_paciente'], $data['id_diagnostico'], $data['tratamiento'], $data['costo']);
        return $stmt->execute();
    }

    public function updateConsulta($id, $data) {
        $query = "UPDATE consulta SET fecha_consulta = ?, id_medico = ?, id_paciente = ?, id_diagnostico = ?, tratamiento = ?, costo = ? 
                  WHERE folio = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('siisdsi', $data['fecha_consulta'], $data['id_medico'], $data['id_paciente'], $data['id_diagnostico'], $data['tratamiento'], $data['costo'], $id);
        return $stmt->execute();
    }

    public function deleteConsulta($id) {
        $query = "DELETE FROM consulta WHERE folio = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
