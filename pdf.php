<?php
require('C:\xampp\htdocs\WEBSYS1\TODOLIST\FPDF/fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=claudio_todolist','root','');
class myPDF extends FPDF{

    function headerTable(){
        $this->setFont('Times','B',12);
        $this->Cell(60,10,'ID',1,0,'C');
        $this->Cell(60,10,'To do list',1,0,'C');
        $this->Ln(10);
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query('SELECT * FROM list');

        while($s = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->setFont('Times','B',12);
            $this->Cell(60,10,$s->id,1,0,'C');
            $this->Cell(60,10,$s->todolist,1,0,'C');
            $this->Ln(10);
        }
        }
    }

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>


