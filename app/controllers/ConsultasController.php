<?php
require_once 'app/models/ConsultasModel.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ConsultasController
{
    private $model;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new ConsultasModel($db);
    }

    public function index()
    {
        $consultas = $this->model->getAllConsultas();
        require 'app/views/consultas.php';
    }

    public function create()
    {
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
                'costo' => $_POST['costo'],
            ];
            $this->model->addConsulta($data);
            header('Location: index.php?section=consultas');
        } else {
            require 'app/views/consultas_create.php';
        }
    }

    public function edit($id)
    {
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
                'costo' => $_POST['costo'],
            ];
            $this->model->updateConsulta($id, $data);
            header('Location: index.php?section=consultas');
        } else {
            require 'app/views/consultas_edit.php';
        }
    }
    public function delete($id)
    {
        $this->model->deleteConsulta($id);
        header('Location: index.php?section=consultas');
    }

    public function generarReporte()
    {
        // Detener la salida de contenido anterior
        ob_end_clean();

        // Consulta a la vista de la base de datos
        $query = 'SELECT * FROM reporte_consultas';
        $result = $this->db->query($query);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        // Generar CSV
        header('Content-Type: text/csv');
        header(
            'Content-Disposition: attachment;filename="reporte_consultas.csv"'
        );

        $output = fopen('php://output', 'w');
        fputcsv($output, ['DIA', 'MEDICO', 'CONSULTAS', 'TOTAL']);

        foreach ($data as $row) {
            fputcsv($output, [
                date('d de F Y', strtotime($row['dia'])),
                $row['nombre_medico'],
                $row['consultas'],
                '$' . number_format($row['total_costo'], 2),
            ]);
        }

        fclose($output);
        exit();
    }

    public function generarReporteXlsx()
    {
        // Asegúrate de limpiar cualquier buffer de salida
        if (ob_get_length()) {
            ob_end_clean();
        }

        // Consulta a la vista de la base de datos
        $query = 'SELECT * FROM reporte_consultas';
        $result = $this->db->query($query);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        // Crear un nuevo Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Escribir encabezados
        $sheet->setCellValue('A1', 'DIA');
        $sheet->setCellValue('B1', 'MEDICO');
        $sheet->setCellValue('C1', 'CONSULTAS');
        $sheet->setCellValue('D1', 'TOTAL');

        // Escribir los datos
        $rowNumber = 2; // Comienza desde la segunda fila
        foreach ($data as $row) {
            $sheet->setCellValue(
                'A' . $rowNumber,
                date('d de F Y', strtotime($row['dia']))
            );
            $sheet->setCellValue('B' . $rowNumber, $row['nombre_medico']);
            $sheet->setCellValue('C' . $rowNumber, $row['consultas']);
            $sheet->setCellValue(
                'D' . $rowNumber,
                '$' . number_format($row['total_costo'], 2)
            );
            $rowNumber++;
        }

        // Crear el escritor para guardar el archivo en formato XLSX
        $writer = new Xlsx($spreadsheet);

        // Configurar las cabeceras para la descarga del archivo
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment;filename="reporte_consultas.xlsx"'
        );
        header('Cache-Control: max-age=0');

        // Guardar el archivo en el navegador
        $writer->save('php://output');
        exit();
    }
}
