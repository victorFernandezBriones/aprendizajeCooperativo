<?php

require_once '../../data/mpdf60/mpdf.php';
require_once '../../data/Alumno.php';

$serviceAlumno = new Alumno();

if ($_POST) :
    ob_start();
    ob_get_clean();

    $pdf = new mPDF('Legal', // mode - default ''
            '', // format - A4, for example, default ''
            10, // font size - default 0
            '', // default font family
            10, // margin_left
            10, // margin right
            6, // margin top
            3, // margin bottom
            2, // margin header
            3 // margin footer
    );
    //INFORME DE ALUMNOS PSICOLICO
    $html = $_POST['htmlImprimir'];
    $html = str_replace('<img id="logoInforme" class="img-responsive" alt="logoColegio" src="media/logoCentroEducacional.jpg">', "", $html);
    $html = str_replace('<hr>', "", $html);
    $css = file_get_contents("../../pa/assets/css/estiloImpresion.css");

    $pdf->WriteHTML($css, 1);

    $pdf->WriteHTML($html);
    $flag = htmlspecialchars($_POST['flag']);

    switch ($flag) {
        case 1://ALUMNO
            $nombreAlumno = htmlspecialchars($_POST['nombreAlumnoReporte']);
            $pdf->Output($nombreAlumno . "_psicologico.pdf", 'I');
            break;

        case 2: //GRUPO O CURSO
            $nombreGrupoReporte = htmlspecialchars($_POST['nombreGrupoReporte']);
            $pdf->Output($nombreGrupoReporte . "_psicologico.pdf", 'I');
            break;
    }
    

    
endif;