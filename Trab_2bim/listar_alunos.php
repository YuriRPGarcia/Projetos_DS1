<?php
include("header.php");
include("persistencia.php");

?>

<ul class="collection with-header">
    <li class="collection-header"><h4>Alunos</h4></li>
    <?php 
            $alunoDAO = new AlunoDAO();
			$alunos = $alunoDAO->listar();
            foreach($alunos as $aluno) {
    		    echo '<li class="collection-item"><div>Nome: '.$aluno->nome.'  Matricula: '.$aluno->matricula.'<a href="editar_aluno.php?alunoMatricula='.$aluno->matricula.'" class="secondary-content"><i class="material-icons">edit</i></a><a href="excluir_aluno.php?alunoMatricula='.$aluno->matricula.'" class="secondary-content"><i class="material-icons">delete</i></a></div></li>';
        	}
    ?>
</ul>

<?php
include("footer.php");	
?>