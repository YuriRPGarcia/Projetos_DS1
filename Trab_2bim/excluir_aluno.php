<?php 
include ("persistencia.php");

$alunoMatricula = $_GET['alunoMatricula'];

$alunoDAO =  new AlunoDAO();
$alunoDAO->excluir($alunoMatricula);
header('Location: listar_alunos.php');

?>