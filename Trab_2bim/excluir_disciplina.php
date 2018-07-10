<?php 
include ("persistencia.php");

$disciplinaId = $_GET['disciplinaID'];

$disciplinaDAO =  new DisciplinaDAO();
$disciplinaDAO->excluir($disciplinaId);
header('Location: listar_disciplinas.php');

?>