<?php
	session_start();
	
	if (isset($_POST['busca'])) {
		geraRelatorio($_POST['busca']);
	}
	if ($_SESSION['login'] != "admin") {
		geraRelatorio($_SESSION['login']);
	}
	
	function geraRelatorio($acao){
		
		include("persistencia.php");

		$alunoDAO = new AlunoDAO();
		$historicos = $alunoDAO->alunoBusca($acao);

		$disciplinaDAO = new DisciplinaDAO();
		
		if($historicos != null){
			require("fpdf181/fpdf.php");
			$pdf= new FPDF("P","pt","A4");
			
			$pdf->AddPage();
			
			$aux = 0;
			foreach($historicos as $historico) {
				
		 		if ($aux != $historico->matriculaAluno) {
		 			$aluno = $alunoDAO->obter($historico->matriculaAluno);
					$aux = $historico->matriculaAluno;

					$pdf->SetFont('arial','B',18);
					$pdf->Cell(0,5,"Ficha do Aluno: ".$aluno->nome,0,1,'C');
					$pdf->Cell(0,5,"","B",1,'C');
					$pdf->Ln(8);
					
		 		}
		 		
				$disciplina = $disciplinaDAO->obter($historico->idDisciplina);

				$pdf->SetFont('arial','B',12);
				$pdf->Cell(70,20,$disciplina->nome,0,0,'L');
				$pdf->setFont('arial','',12);
				$pdf->Cell(70,20,"Nota:".$historico->nota."  Frequência:". $historico->frequencia."%",0,1,'L');

				 
			}

			$pdf->Output();
		}
	}

?>