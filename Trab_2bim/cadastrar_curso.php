<?php 
include("header.php");

?>

<blockquote><h4>Cadastre um Curso</h4></blockquote>

<div class="row">
    <form class="col s12" action="cadastrar_curso.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
              <input id="nome" type="text" name="nome" required>
              <label for="nome">Insira o Nome do Curso</label>
            </div>
        </div>
        <div class="row">
          <p>
            <label>
              <input name="turno" type="radio" value="Manhã" checked />
              <span>Manhã</span>
            </label>
          </p>
          <p>
            <label>
              <input name="turno" type="radio" value="Tarde" />
              <span>Tarde</span>
            </label>
          </p>
          <p>
            <label>
              <input name="turno" type="radio" value="Noite" />
              <span>Noite</span>
            </label>
          </p>
        </div>
        <button class="btn waves-effect waves-light" name = "cadastrar_curso" type="submit">Cadastrar</button>
    </form>
</div>

<?php
include('persistencia.php');
if (isset($_POST['cadastrar_curso'])) {
  cadastrar_curso();  
}

function cadastrar_curso(){
  $nome = trim($_POST['nome']);
  $turno = trim($_POST['turno']);
          
  $curso = new Curso(0, $nome, $turno);
  $cursoDAO = new CursoDAO();
  $cursoDAO->adicionar($curso);
  header('Location: gerenciar_cursos.php');
  
}

include("footer.php");

?>