<?php 
include("header.php");
include('persistencia.php');
?>

<blockquote><h4>Inserir Disciplina em um Curso</h4></blockquote>

<div class="row">
    <form class="col s12" action="curso_disciplina.php" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="input-field col s12">
          <select name="curso">
          <option value="" disabled selected>Escolha o Curso</option>
          <?php 
            $cursoDAO = new CursoDAO();
            $cursos = $cursoDAO->listar();
            foreach($cursos as $curso) {
              echo '<option value="'.$curso->id.'">'.$curso->nome.'</option>';
            }
          ?>
          </select>
          <label>Escolha o Curso</label>
        </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <select name="disciplina">
            <option value="" disabled selected>Escolha a Disciplina</option>
            <?php 
              $disciplinaDAO = new DisciplinaDAO();
              $disciplinas = $disciplinaDAO->listar();
              foreach($disciplinas as $disciplina) {
                echo '<option value="'.$disciplina->id.'">'.$disciplina->nome.'</option>';
              }
            ?>
            </select>
            <label>Escolha a Disciplina</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" name = "curso_disciplina" type="submit">Cadastrar</button>
        </form>
    </div>

<?php
if (isset($_POST['curso_disciplina'])) {
  curso_disciplina();  
}

function curso_disciplina(){
  $idCurso = trim($_POST['curso']);
  $idDisciplina = trim($_POST['disciplina']);
          
  $curso_disciplina = new CursoDisciplina($idDisciplina, $idCurso);
  $curso_disciplinaDAO = new CursoDisciplinaDAO();
  $curso_disciplinaDAO->adicionar($curso_disciplina);
  header('Location: gerenciar_cursos.php');
}

include("footer.php");

?>