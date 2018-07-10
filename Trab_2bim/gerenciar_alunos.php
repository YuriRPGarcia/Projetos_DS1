<?php 
include("persistencia.php");
include("header.php");
$cursoDAO = new CursoDAO();
$cursos = $cursoDAO->listar();

$alunoDAO = new AlunoDAO();
$alunos = $alunoDAO->listar();

$disciplinaDAO = new DisciplinaDAO();
$disciplinas = $disciplinaDAO->listar();
?>

<nav>
    <div class="nav-wrapper black">
      <a href="/gerenciar_alunos.php" class="brand-logo">Alunos</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="/cadastrar_aluno.php">Cadastrar Aluno</a></li>
        <li><a href="/listar_alunos.php">Lista de Alunos</a></li>
        <li>
          	<nav>
        	    <div class="nav-wrapper black">
          	     	<form action="alunos.php" autocomplete="off" method="post" enctype="multipart/form-data">
          	        	<div class="input-field">
          	          		<input id="busca" type="search" name="busca" required>
          	          		<label class="label-icon" for="busca"><i class="material-icons">search</i></label>
          	          		<i class="material-icons">close</i>
          	        	</div>
          	    	</form>
          	    </div>
          	</nav>
        </li>
      </ul>
    </div>
</nav>

<div class="row">
    <form class="col s6" action="aluno_curso.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <select name="curso">
            <option value="" disabled selected>Escolha o Curso</option>
            <?php 
              
              foreach($cursos as $curso) {
                echo '<option value="'.$curso->id.'">'.$curso->nome.'</option>';
              }
            ?>
            </select>
            <label>Listar todos alunos do curso selecionado</label>
            <button class="btn waves-effect waves-light" type="submit">Listar</button>
          </div>
        </div>
        
    </form>

    <form class="col s6" action="cadastrar_historico.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <select name="aluno">
            <option value="" disabled selected>Escolha o Aluno</option>
            <?php 
              
              foreach($alunos as $aluno) {
                echo '<option value="'.$aluno->matricula.'">'.$aluno->matricula."/".$aluno->nome.'</option>';
              }
            ?>
            </select>
            <label>Escolher aluno para cadastrar Histórico</label>
            <button class="btn waves-effect waves-light" type="submit">Ir</button>
          </div>

        </div>
        
    </form>
</div>

<div class="row">
    <form class="col s6" action="aluno_disciplina.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <select name="disciplina">
            <option value="" disabled selected>Escolha a Disciplina</option>
            <?php 
              
              foreach($disciplinas as $disciplina) {
                echo '<option value="'.$disciplina->id.'">'.$disciplina->nome.'</option>';
              }
            ?>
            </select>
            <label>Listar todos alunos da Disciplina Selecionada</label>
            <button class="btn waves-effect waves-light" type="submit">Listar</button>
          </div>
        </div>
    </form>
    
</div>

<?php 
include("footer.php");
?>