<?php 
	if (1==1) {
		include("persistencia.php");

		$disciplinaDAO = new DisciplinaDAO();
		$disciplinas = $disciplinaDAO->maisAlunos();
		$d = new Historico();

		if($disciplinas != null){
			require("fpdf181/fpdf.php");
			$pdf= new FPDF("P","pt","A4");
			
			$pdf->AddPage();
			
			$aux = 0;
			foreach($disciplinas as $disciplina) {
				if($aux < $disciplina->idDisciplina){
					$d = $disciplina;
				}
			}

				$pdf->SetFont('arial','B',18);
				$pdf->Cell(0,5,"Disciplina: ".$d->frequencia,0,1,'C');
				$pdf->Cell(0,5,"","B",1,'C');
				$pdf->Ln(8);
		 
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Creditos:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(0,20,$d->matriculaAluno,0,1,'L');

				$pdf->Output();
		}
	}

?>