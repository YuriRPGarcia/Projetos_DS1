<?php 
include("persistencia.php");
include("header.php");
?>

<nav>
	<div class="nav-wrapper black">
      <a href="/gerenciar_alunos.php" class="brand-logo">Disciplinas</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      	<li><a href="/mais_alunos.php">Disciplina com Maior número de Alunos</a></li>
      	<li><a href="/curso_disciplina.php">Inserir Disciplina em um Curso</a></li>
        <li><a href="/cadastrar_disciplina.php">Cadastrar Disciplina</a></li>
        <li><a href="/listar_disciplinas.php">Lista de Disciplina</a></li>
      </ul>
    </div>
</nav>



<?php
include("footer.php");
?>