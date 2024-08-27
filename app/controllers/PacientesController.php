<?php
require_once 'app/models/PacientesModel.php';
class PacientesController
{
    private $model;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new PacientesModel($db);
    }

    public function index()
    {
        $pacientes = $this->model->getAllPacientes();
        require 'app/views/pacientes.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'curp' => $_POST['curp'],
            ];
            $this->model->addPaciente($data);
            header('Location: index.php?section=pacientes');
        } else {
            require 'app/views/pacientes_create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'curp' => $_POST['curp'],
            ];
            $this->model->updatePaciente($id, $data);
            header('Location: index.php?section=pacientes');
        } else {
            $paciente = $this->model->getPacienteById($id);
            require 'app/views/pacientes_edit.php';
        }
    }
    public function delete($id)
    {
        $this->model->deletePaciente($id);
        header('Location: index.php?section=pacientes');
    }

    public function generarReportePdf()
    {
        // Limpia cualquier salida previa
        if (ob_get_length()) {
            ob_end_clean();
        }

        // Consulta para obtener todos los pacientes
        $pacientes = $this->model->getAllPacientes();

        // Crear un nuevo documento PDF
        $pdf = new \TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Reporte de Pacientes');
        $pdf->SetHeaderData(
            '',
            0,
            'Reporte de Pacientes',
            'Generado por TCPDF',
            [0, 64, 255],
            [0, 64, 128]
        );
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage();

        // Generar el contenido de la tabla
        $html = '<h1>Listado de Pacientes</h1>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Nombre</th>';
        $html .= '<th>CURP</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($pacientes as $paciente) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($paciente['nombre']) . '</td>';
            $html .= '<td>' . htmlspecialchars($paciente['curp']) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        // Escribir el contenido HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output del PDF para descargar
        $pdf->Output('reporte_pacientes.pdf', 'D');
    }
}
