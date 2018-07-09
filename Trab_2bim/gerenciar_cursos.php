<?php 
include("persistencia.php");
include("header.php");
?>

<nav>
    <div class="nav-wrapper black">
      <a href="/gerenciar_alunos.php" class="brand-logo">Cursos</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      	<li><a href="/curso_disciplina.php">Inserir Disciplina em um Curso</a></li>
        <li><a href="/cadastrar_curso.php">Cadastrar Cursos</a></li>
        <li><a href="/listar_cursos.php">Lista de Cursos</a></li>
      </ul>
    </div>
  </nav>

<?php 
include("footer.php");
?>