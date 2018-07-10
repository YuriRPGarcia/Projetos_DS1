<?php 
include ("persistencia.php");

$cursoID = $_GET['cursoId'];

$cursoDAO =  new CursoDAO();
$cursoDAO->excluir($cursoID);
header('Location: gerenciar_alunos.php');

?>