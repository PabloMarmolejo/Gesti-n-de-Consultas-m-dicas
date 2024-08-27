<?php
class PacientesModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllPacientes() {
        $query = "SELECT * FROM pacientes";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPacienteById($id) {
        $query = "SELECT * FROM pacientes WHERE id_paciente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addPaciente($data) {
        $query = "INSERT INTO pacientes (nombre, curp) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $data['nombre'], $data['curp']);
        return $stmt->execute();
    }

    public function updatePaciente($id, $data) {
        $query = "UPDATE pacientes SET nombre = ?, curp = ? WHERE id_paciente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $data['nombre'], $data['curp'], $id);
        return $stmt->execute();
    }

    public function deletePaciente($id) {
        $query = "DELETE FROM pacientes WHERE id_paciente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
