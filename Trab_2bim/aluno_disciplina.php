<?php 
	if (isset($_POST['disciplina'])) {
		include("persistencia.php");

		$alunoDAO = new AlunoDAO();
		$alunos = $alunoDAO->alunoporDisciplina($_POST['disciplina']);
		
		if($alunos != null){
			require("fpdf181/fpdf.php");
			$pdf= new FPDF("P","pt","A4");
			
			$pdf->AddPage();
			
			foreach($alunos as $aluno) {
				if ($aluno->idCurso < 75) {
					$pdf->SetTextColor(194,8,8);
				}else{
					$pdf->SetTextColor(0,0,0);
				}

				$pdf->SetFont('arial','B',18);
				$pdf->Cell(0,5,"Ficha do Aluno: ".$aluno->nome,0,1,'C');
				$pdf->Cell(0,5,"","B",1,'C');
				$pdf->Ln(8);
		 
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Matricula:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(0,20,$aluno->matricula,0,1,'L');
				 
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Telefone:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,$aluno->telefone,0,1,'L');
				 
				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Endereco:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,$aluno->endereco,0,1,'L');

				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,"Municipio:",0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,$aluno->municipio,0,1,'L');
			}

			$pdf->Output();
		}
	}

?>