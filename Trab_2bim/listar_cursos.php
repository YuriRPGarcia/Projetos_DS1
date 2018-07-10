<?php
include("header.php");
include("persistencia.php");

?>

<ul class="collection with-header">
    <li class="collection-header"><h4>Cursos</h4></li>
    <?php 
            $cursoDAO = new CursoDAO();
            $cursos = $cursoDAO->listar();
            foreach($cursos as $curso) {
    		    echo '<li class="collection-item"><div>'.$curso->nome.'<a href="editar_curso.php?cursoId='.$curso->id.'" class="secondary-content"><i class="material-icons">edit</i></a><a href="excluir_curso.php?cursoId='.$curso->id.'" class="secondary-content"><i class="material-icons">delete</i></a></div></li>';
        	}
    ?>
</ul>

<?php
include("footer.php");	
?>