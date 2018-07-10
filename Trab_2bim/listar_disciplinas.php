<?php
include("header.php");
include("persistencia.php");

?>

<ul class="collection with-header">
    <li class="collection-header"><h4>Disciplinas</h4></li>
    <?php 
            $disciplinaDAO = new DisciplinaDAO();
			$disciplinas = $disciplinaDAO->listar();
            foreach($disciplinas as $disciplina) {
    		    echo '<li class="collection-item"><div>'.$disciplina->nome.'<a href="editar_disciplina.php?disciplinaID='.$disciplina->id.'" class="secondary-content"><i class="material-icons">edit</i></a><a href="excluir_disciplina.php?disciplinaID='.$disciplina->id.'" class="secondary-content"><i class="material-icons">delete</i></a></div></li>';
        	}
    ?>
</ul>

<?php
include("footer.php");	
?>