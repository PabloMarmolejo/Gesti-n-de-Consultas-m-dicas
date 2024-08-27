<?php
class MedicosModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllMedicos() {
        $query = "SELECT * FROM medicos";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    public function getMedicoById($id) {
        $query = "SELECT * FROM medicos WHERE id_medico = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addMedico($data) {
        $query = "INSERT INTO medicos (nombre, cedula) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $data['nombre'], $data['cedula']);
        return $stmt->execute();
    }

    public function updateMedico($id, $data) {
        $query = "UPDATE medicos SET nombre = ?, cedula = ? WHERE id_medico = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $data['nombre'], $data['cedula'], $id);
        return $stmt->execute();
    }

    public function deleteMedico($id) {
        $query = "DELETE FROM medicos WHERE id_medico = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
